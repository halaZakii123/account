<?php

namespace App\Http\Controllers;

use App\TblAccount;
use App\User;
use App\View_Account_Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $accounts= TblAccount::all();
        return view('Account.index',compact('accounts'));
    }

    public function create(){
       $views = View_Account_Main::all();
        return view('Account.crud',compact('views'));

    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'account_number' =>['required','string',
                Rule::unique('tbl_accounts'),],
            'account_name'=>'required|string',
            'master_account_number' => 'sometimes|required',
            'report'=>'required',
            'mainly'=>'sometimes|required'

        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }
        else{
        TblAccount::create(['account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'master_account_number' => $request->master_account_number,
            'report' => $request->report,
            'mainly' =>$request->mainly]);}
        return redirect(route('Accounts.index'));
    }

//    public function show(  $id){
//        $account = TblAccount::findOrFail($id);
//        return view('Account.showAccount',compact('account'));
//    }

    public function edit($id){
        $views = View_Account_Main::all();
        $account = TblAccount::findOrFail($id);
        return view('Account.crud',compact('account','views'));
    }


    public function update( Request $request, $id){
        $validator = Validator::make($request->all(), [
            'account_number' =>'sometimes|required|string',
            'account_name'=>'sometimes|required|string',
            'master_account_number' => 'sometimes|required',
            'report'=>'sometimes|required',
            'mainly'=>'sometimes|required'

        ]);
        $account = TblAccount::where('id',$id);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }
        else{
                $account->update(['account_number' => $request->account_number,
                    'account_name' => $request->account_name,
                    'master_account_number' => $request->master_account_number,
                    'report' => $request->report,
                    'mainly' =>$request->mainly]);

                return redirect(route('Accounts.index'));
            }
        }

        public function destroy($account){
         TblAccount::where('id',$account)->delete();
         return redirect(route('Accounts.index'));
        }

    }
