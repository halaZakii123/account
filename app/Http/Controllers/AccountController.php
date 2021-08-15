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
        $accounts= TblAccount::all()->get();

        return view('home',compact('accounts'));
    }

    public function create(){
       $views = View_Account_Main::all();
        return view('account',compact('views'));

    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'account_number' =>'required|string',
            'account_name'=>'required|string',
            'master_account_number' => 'sometimes|required',
            'report'=>'required',
            'mainly'=>'sometimes|required'

        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }
        TblAccount::create(['account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'master_account_number' => $request->master_account_number,
            'report' => $request->report,
            'mainly' =>$request->mainly]);
        return redirect("/home");
    }

    public function show( TblAccount $account){

        return view('showAccount',compact('account'));
    }

    public function edit( TblAccount $account){
        $views = View_Account_Main::all();

        return view('EditAccount',compact('account','views'));
    }


    public function update( Request $request,TblAccount $account){

        $validator = Validator::make($request->all(), [
            'account_number' =>'required|string',
            'account_name'=>'required|string',
            'master_account_number' => 'sometimes|required',
            'report'=>'required',
            'mainly'=>'sometimes|required'

        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }

            else{
                $account->update($request->all());

                return redirect('/show_account' ."/". $account->id);
            }
        }

        public function destroy($account){
         TblAccount::where('id',$account)->delete();
         return redirect('/home');
        }

    }
