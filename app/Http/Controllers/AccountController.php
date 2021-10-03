<?php

namespace App\Http\Controllers;

use App\Helpers\checkPermissionHelper;
use App\TblAccount;
use App\User;
use App\View_Account_Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDF;
use DataTables;


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(){
        $user_id = checkPermissionHelper::checkPermission();
        $accounts= TblAccount::where('parent_id',$user_id)->get();
        return view('Account.index',compact('accounts'));
    }

//    public function getAccounts(Request $request){
//        $user_id = checkPermissionHelper::checkPermission();
//        $accounts= TblAccount::where('parent_id',$user_id);
//        if ($request->ajax()) {
//            $data = $accounts;
//            return Datatables::of($data)
//                ->addIndexColumn()
//                ->addColumn('action', function($row){
//                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
//                    return $actionBtn;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//    }

    public function create(){
       $user_id = checkPermissionHelper::checkPermission();
        $views = View_Account_Main::where('parent_id',$user_id)->get();

        return view('Account.crud',compact('views'));

    }
    public function store(Request $request){

        $user_id = checkPermissionHelper::checkPermission();

        $validator = Validator::make($request->all(), [
            'account_number' =>'required',
            'account_name'=>'required|string',
            'master_account_number' => 'sometimes|required',
            'report'=>'required',
            'mainly'=>'sometimes|required'

        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }
        else{
        TblAccount::create(['account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'master_account_number' => $request->master_account_number,
            'report' => $request->report,
            'mainly' =>$request->mainly,
            'parent_id'=>$user_id,
            'user_id'=>Auth::user()->id,
            'account_name_ar'=>'هلا']);}
        return redirect(route('Accounts.index'));
    }

//    public function show(  $id){
//        $account = TblAccount::findOrFail($id);
//        return view('Account.showAccount',compact('account'));
//    }

    public function edit($id){
        $user_id = checkPermissionHelper::checkPermission();
        $views = View_Account_Main::where('parent_id',$user_id)->get();
        $account = TblAccount::findOrFail($id);
        if ($account->user_id == $user_id) {
        return view('Account.crud',compact('account','views'));}
        else {
            return 'you do not have permission';
}
    }


    public function update( Request $request, $id){
        $user_id = checkPermissionHelper::checkPermission();
        $validator = Validator::make($request->all(), [
            'account_number' =>'sometimes|required|string',
            'account_name'=>'sometimes|required|string',
            'master_account_number' => 'sometimes|required',
            'report'=>'sometimes|required',
            'mainly'=>'sometimes|required'

        ]);
        $account = TblAccount::where('id',$id);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }
        else{
                $account->update(['account_number' => $request->account_number,
                    'account_name' => $request->account_name,
                    'master_account_number' => $request->master_account_number,
                    'report' => $request->report,
                    'mainly' =>$request->mainly,
                    'parent_id'=>$user_id,
                    'user_id'=>Auth::user()->id]);

                return redirect(route('Accounts.index'));
            }
        }

        public function destroy($account){
         TblAccount::where('id',$account)->delete();
         return redirect(route('Accounts.index'));
        }

        public function printAccount(){
            $user_id = checkPermissionHelper::checkPermission();
            $accounts = TblAccount::where('parent_id',$user_id)->get();
            return view('Account.print',compact('accounts'));

        }

        public function pdf(){

            $user_id = checkPermissionHelper::checkPermission();

            $accounts = TblAccount::where('parent_id',$user_id)->get();
            $items = [];
            foreach ($accounts as $account) {
                $items[] = [
                    'account_number' => $account->account_number,
                    'account_name' => $account->account_name,
                    'master_account_number' => $account->master_account_number,
                    'report' => $account->report,
                    'mainly' => $account->mainly,
                ];

            }
            $data['items']=$items;
               $pdf = PDF::loadView('Account.pdf', $data);
                return $pdf->download('accounts'.'.pdf');

        }
    }
