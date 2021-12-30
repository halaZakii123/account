<?php

namespace App\Http\Controllers;

use App\Helpers\checkPermissionHelper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DataTables;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(){
        if (Auth::user()->parent_id == 0){
            $users = DB::select("CALL pr_users(" .Auth::user()->id.")");
        return view('Employee.index',compact('users'));}
        else{
            return 'you do not have permission';
        }
    }

    public function getEmployees(Request $request){
        if (Auth::user()->parent_id == 0){
            $users = DB::select("CALL pr_users(" .Auth::user()->id.")");
            if ($request->ajax()) {
                $data = $users;
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="user\{$data->id} " <i class="fa fa-edit"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
        else return 'you do not have permission' ;
    }



    public function create()
    {
        if (Auth::user()->parent_id == 0){
        return view('Employee.crud');}
        else{
                return 'you do not have permission';
            }
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users'),
            ],
            'password'=>'required|string|min:8',
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator);

        }
        else {

            User::create(['name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'parent_id' => Auth::id(),
                'company_name' => Auth::user()->company_name]);
        }
        return redirect(route('Users.index'));

    }

    public function edit($id)
    {
       
        $user = User::findOrFail($id);
        if (Auth::user()->parent_id == 0 and $user->parent_id == Auth::user()->id){
        return view('Employee.crud',compact('user'));}
        else{
            return ' you do not have permission';
        }
    }

    public function update(Request $request ,$id){
        $validator = Validator::make($request->all(), [
            'email' => 'sometimes|required|email',
            'password'=>'required|string|min:8',
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }
        else{
            $user =User::where('id',$id);
        $user->update(['name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_name'=>Auth::user()->company_name]);}
        return redirect(route('Users.index'));
    }

    public function destroy($id){
        
        User::where('id',$id)->delete();
        return redirect(route('Users.index'));
    }

}
