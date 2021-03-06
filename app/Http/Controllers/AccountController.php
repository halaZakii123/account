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
//use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccountsExport;
use App\Imports\AccountImport;


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);


    }

    public function index(){
        $user_id = checkPermissionHelper::checkPermission();

        $accounts= TblAccount::where('parent_id',$user_id)->get();
        $count = count($accounts);


        return view('Account.index',compact('accounts','count'));
    }


    public function create(){
       $user_id = checkPermissionHelper::checkPermission();
        $views = View_Account_Main::where('parent_id',$user_id)->get();
        return view('Account.crud',compact('views'));
    }

    public function createAccountTree(){
        $user_id = checkPermissionHelper::checkPermission();
        $acc =DB::select("CALL pr_buildacc(" .$user_id.")");
        return back();
    }
    public function store(Request $request){

        $user_id = checkPermissionHelper::checkPermission();

        $validator = Validator::make($request->all(), [
            'account_number' =>[
                'required',
                Rule::unique('tbl_accounts', 'account_number')->where(function ($query) use ($user_id) {
                    $query->where('parent_id', $user_id);
                })
            ],
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
            'account_name_ar'=>'??????']);}
        return redirect(route('Accounts.index'));
    }


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
            'account_number' =>['sometimes',
            'required',
            Rule::unique('tbl_accounts', 'account_number')->where(function ($query) use ($id, $user_id) {
                $query->where('parent_id', $user_id);
                $query->where('id','!=', $id);
            })
        ],
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

         /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImportExport()
    {
       return view('file-import');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request)
    {
        Excel::import(new AccountImport, $request->file('file')->store('temp'));
        return back();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport()
    {
        return Excel::download(new AccountsExport, 'users-collection.xlsx');
    }

    // public function getAccountNumber(){
    //     $id = Auth::user()->parent_id;
    //     $num = DB::select("CALL PR_Account_number(" .$id.")");

    //     return view()
    // }
    }
