<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){


        $users = DB::select("CALL pr_users(" .Auth::user()->id.")");
        return view('Employee.index',compact('users'));
    }

    public function create()
    {
        return view('Employee.crud');
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
            return $validator->errors()->first();
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
        return view('Employee.crud',compact('user'));
    }

    public function update(Request $request ,$id){
        $validator = Validator::make($request->all(), [
            'email' => 'sometimes|required|email',
            'password'=>'required|string|min:8',
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
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
