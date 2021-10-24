<?php

namespace App\Http\Controllers;

use App\Helpers\checkPermissionHelper;
use App\Main;
use App\Set;
use App\TblAccount;
use App\View_CurrencySymbol_main;
use App\View_TypeOperation_main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PDF;
use DataTables;



class MainController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user_id = checkPermissionHelper::checkPermission();
            if ($request->from != null){
            $from = $request->from;
            $to = $request->to;
            $mains = Main::whereBetween('operation_date', [$from, $to])
                ->where('parent_id',$user_id)
                ->get();
        }
        else{
        $mains = Main::where('parent_id',$user_id)->get();}
        return view('Main.index',compact('mains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $user_id = checkPermissionHelper::checkPermission();
        $cus = View_CurrencySymbol_main::where('parent_id',$user_id)->get();
        $ops = View_TypeOperation_main::where('parent_id',$user_id)->get();
//        $account_numbers = DB::table('tbl_accounts')->where('parent_id',$user_id)
//            ->where('mainly',0)
//            ->pluck('account_number');
//        dd($account_numbers);
        $accounts = TblAccount::where('parent_id',$user_id)
            ->where('mainly',0)->get();
     //   $sets = DB::select("CALL pr_set(" ."cash_id".")");


        // $sets = Set::where( 'parent_id',$user_id)->get();
        // foreach ($sets as $set ){
        //     if ($set->key == "cash_id"){
        //         $c = $set->value;
        //     }
        // }

        $c= Set::where( 'parent_id',$user_id)->where('key','cash_id')->first()->account;


  return view('Main.crud', compact('cus', 'ops', 'accounts','c'));

    }
    public function createDailyOperation($cash)
    {
        $user_id = checkPermissionHelper::checkPermission();
        $cus = View_CurrencySymbol_main::where('parent_id',$user_id)->get();
        $ops = View_TypeOperation_main::where('parent_id',$user_id)->get();
        $account_numbers = DB::table('tbl_accounts')->where('parent_id',$user_id)
            ->where('mainly',0)
            ->pluck('account_number');
        $accounts = TblAccount::where('parent_id',$user_id)
            ->where('mainly',0)->get();


        // $sets = Set::where( 'parent_id',$user_id)->get();
        // foreach ($sets as $set ){
        //     if ($set->key == "cash_id"){
        //         $c = $set->account;
        //     }
        // }

        $c= Set::where( 'parent_id',$user_id)->where('key','cash_id')->first()->account;



        if ($cash == 3){
            $v = __('Cash');
        }elseif($cash == 1){
            $v = __('Cash in');
        }
        else{
            $v=__('Cash out');
        }
            return view('Main.daily_op_crud', compact('cus', 'ops', 'account_numbers','v','c','accounts','cash'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

//        $validator = Validator::make($request->all(), [
//            'operation_date' => 'required',
//            'Explained'=>'required',
//            'Explained_ar' => 'required',
//            'cash_id' => 'required',
//            'document_number' => 'sometimes|required',
//            'type_of_operation' => 'required',
//            'currency_symbol' => 'required',
//            'exchange_rate' => 'required',
//            'account_number' => 'required',
//            'explained' => 'required',
//            'explained_ar' => 'required',
//            'doc_date' => 'required|date',
//            'doc_no' => 'required',
//        ]);
//        if ($validator->fails()) {
//           return back()
//                ->withErrors($validator);
//        }else{
        $user_id = checkPermissionHelper::checkPermission();
        $data['operation_date'] = $request->operation_date;
        $data['explained'] = $request->Explained;
        $data['explained_ar'] = $request->Explained_ar;
//        $data['cash_id'] = $request->cash_id;
        $data['document_number'] = $request->document_number;
        $data['type_of_operation'] = $request->type_of_operation;
        $data['currency_symbol'] = $request->currency_symbol;
        $data['exchange_rate'] = $request->exchange_rate;
        $data['parent_id'] = $user_id;
        $data['user_id'] = Auth::user()->id;
        $data['doc_date'] = $request->doc_date;
        $data['doc_no'] = $request->doc_no;
       $main= Main::create($data);
        $details_list = [];

        if ($request->type_of_operation == 1) {

            for ($i = 0; $i < count($request->amount); $i++) {
                $details_list[$i]['credit'] = $request->amount[$i];
                $details_list[$i]['debit'] = 0.0;
                $details_list[$i]['account_number'] = $request->account_number[$i];

                $details_list[$i]['explained'] = $request->explained[$i];
                $details_list[$i]['explained_ar'] = $request->explained_ar[$i];
            }
        }elseif($request->type_of_operation == 2 or  $request->type_of_operation == 3){

            for ($i = 0; $i < count($request->amount); $i++) {
                $details_list[$i]['credit'] = 0.0;
                $details_list[$i]['debit'] = $request->amount[$i];
                $details_list[$i]['account_number'] = $request->account_number[$i];
                $details_list[$i]['explained'] = $request->explained[$i];
                $details_list[$i]['explained_ar'] =$request->explained_ar[$i];

            }
        }
        else{
            for ($i = 0; $i < count($request->debit); $i++) {
                $details_list[$i]['debit'] = $request->debit[$i];
                $details_list[$i]['credit'] = $request->credit[$i];
                $details_list[$i]['account_number'] = $request->account_number[$i];
                $details_list[$i]['explained'] = $request->explained[$i];
                $details_list[$i]['explained_ar'] = $request->explained_ar[$i];
            }
        }

       $sub = $main->subs()->createMany($details_list);
         $bid =$main->id;
         $pid = $main->parent_id;

        if ($main->type_of_operation == 0){
            DB::select("CALL pr_postid(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid0(" .$main->id.",".$main->parent_id.")");
        }elseif ($main->type_of_operation == 1){
            DB::select("CALL pr_postid(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid1A(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid1B(" .$main->id.",".$main->parent_id.")");
        }elseif ($main->type_of_operation == 2){
            DB::select("CALL pr_postid(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid2A(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid2B(" .$main->id.",".$main->parent_id.")");
        }elseif ($main->type_of_operation == 3){
            DB::select("CALL pr_postid(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid3A(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid3B(" .$main->id.",".$main->parent_id.")");
        }

        return redirect(route('Mains.index'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Main  $main
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user_id = checkPermissionHelper::checkPermission();
        $main = Main::FindOrFail($id);
        $cus = View_CurrencySymbol_main::where('parent_id',$user_id)->get();
        $ops = View_TypeOperation_main::where('parent_id',$user_id)->get();
        $accounts = TblAccount::where('parent_id',$user_id)
            ->where('mainly',0)->get();
        $account_numbers = DB::table('tbl_accounts')->where('parent_id',$user_id)
            ->where('mainly',0)
            ->pluck('account_number');
        // $sets = Set::where( 'parent_id',$user_id)->get();

        // foreach ($sets as $set ){
        //     if ($set->key == "cash_id"){
        //         $c = $set->value;
        //     }
        // }
        $c= Set::where( 'parent_id',$user_id)->where('key','cash_id')->first()->account;
        if ($main->parent_id == $user_id)
        {
            if($main->type_of_operation == 0 )
            {
             return view('Main.crud', compact('main', 'ops', 'cus',  'account_numbers','c','accounts'));
            }
            else
              return view('Main.daily_op_crud', compact('main', 'ops', 'cus', 'account_numbers','c','accounts'));}


        else{
            return ' you do not have permission';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Main  $main
     * @return string
     */
    public function update(Request $request,$id)
    {
        $user_id = checkPermissionHelper::checkPermission();
        $main = Main::whereId($id)->first();

        $data['operation_date'] = $request->operation_date;
        $data['explained'] = $request->Explained;
        $data['explained_ar'] = $request->Explained_ar;
        $data['cash_id'] = $request->cash_id;
        $data['document_number'] = $request->document_number;
        $data['type_of_operation'] = $request->type_of_operation;
        $data['currency_symbol'] = $request->currency_symbol;
        $data['exchange_rate'] = $request->exchange_rate;
        $data['doc_date'] = $request->doc_date;

        $data['user_id'] = Auth::user()->id;
        $main->update($data);


        $main->subs()->delete();
        $details_list = [];
        if ($request->type_of_operation == 1) {
            for ($i = 0; $i < count($request->amount); $i++) {
                $details_list[$i]['credit'] = $request->amount[$i];
                $details_list[$i]['debit'] = 0;
                $details_list[$i]['account_number'] = $request->account_number[$i];
                $details_list[$i]['account_name'] = "b";

                $details_list[$i]['explained'] = $request->explained[$i];
                $details_list[$i]['explained_ar'] = $request->explained_ar[$i];
            }
        }elseif($request->type_of_operation == 2 or  $request->type_of_operation == 3){
            for ($i = 0; $i < count($request->amount); $i++) {
                $details_list[$i]['credit'] = 0;
                $details_list[$i]['debit'] = $request->amount[$i];
                $details_list[$i]['account_number'] = $request->account_number[$i];
                $details_list[$i]['account_name'] = "b";

                $details_list[$i]['explained'] = $request->explained[$i];
                $details_list[$i]['explained_ar'] = $request->explained_ar[$i];
            }
        }
        else{
            for ($i = 0; $i < count($request->debit); $i++) {
                $details_list[$i]['debit'] = $request->debit[$i];
                $details_list[$i]['credit'] = $request->credit[$i];
                $details_list[$i]['account_number'] = $request->account_number[$i];
                $details_list[$i]['account_name'] = "b";

                $details_list[$i]['explained'] = $request->explained[$i];
                $details_list[$i]['explained_ar'] = $request->explained_ar[$i];
            }
        }
       $main->subs()->createMany($details_list);

        if ($main->type_of_operation == 0){
            DB::select("CALL pr_postid(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid0(" .$main->id.",".$main->parent_id.")");
        }elseif ($main->type_of_operation == 1){
            DB::select("CALL pr_postid(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid1A(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid1B(" .$main->id.",".$main->parent_id.")");
        }elseif ($main->type_of_operation == 2){
            DB::select("CALL pr_postid(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid2A(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid2B(" .$main->id.",".$main->parent_id.")");
        }elseif ($main->type_of_operation == 3){
            DB::select("CALL pr_postid(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid3A(" .$main->id.",".$main->parent_id.")");
            DB::select("CALL pr_postid3B(" .$main->id.",".$main->parent_id.")");
        }
        return redirect(route('Mains.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Main  $main
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Main::where('id',$id)->delete();
        return redirect(route('Mains.index'));
    }

    public function addNewRow(){

        $user_id = checkPermissionHelper::checkPermission();
        $accounts = TblAccount::where('parent_id',$user_id)
            ->where('mainly',0)->get();
        $account_numbers = DB::table('tbl_accounts')->where('parent_id',$user_id)
            ->where('mainly',0)
            ->pluck('account_number');
        $x=request()->count;
//       $c = 'A'.$x ;
        return view('main.ajax',compact('account_numbers','x','accounts'));
    }


    public function addNewDaily(){
       $user_id = checkPermissionHelper::checkPermission();
        $accounts = TblAccount::where('parent_id',$user_id)
            ->where('mainly',0)->get();
        $account_numbers = DB::table('tbl_accounts')->where('parent_id',$user_id)
            ->where('mainly',1)
            ->pluck('account_number');
          $x=request()->count;
        return view('main.ajax_daily',compact('x','account_numbers','accounts'));
    }
    public function addExchangeRate(){
        $user_id = checkPermissionHelper::checkPermission();
        $cus = View_CurrencySymbol_main::where('parent_id',$user_id)->get();
        $x=request()->selectedValue;
    return view('main.ajaxE',compact('cus','x'));
    }
    public function addAccountNumber(){
        $user_id = checkPermissionHelper::checkPermission();
        $x=request()->selectedValue;
        $account_number = TblAccount::where('parent_id',$user_id)->where('account_name',$x)->get();

        $account_numbers =  TblAccount::where('parent_id',$user_id)
        ->where('mainly',0)->get();
        return view('main.ajaxA',compact('account_number','account_numbers'));
    }
    public function addAccountNumber_Daily(){
        $user_id = checkPermissionHelper::checkPermission();
        $x=request()->selectedValue;
        $account_number = TblAccount::where('parent_id',$user_id)->where('account_name',$x)->get();

        $account_numbers =  TblAccount::where('parent_id',$user_id)
            ->where('mainly',0)->get();
        return view('main.ajaxADaily',compact('account_number','account_numbers'));
    }
    public function printM($id){
        $main = Main::where('id',$id)->first();
        $total =0;
        $totalDebit =0;
        $totalCredit =0;
        foreach ($main->subs as $sub){
            if($main->type_of_operation == 0) {
                $totalDebit += $sub->debit;
                $totalCredit += $sub->credit;
            }
            elseif($main->type_of_operation == 1) {
                $total+=$sub->credit;
            }
            else{
                $total+=$sub->debit;
            }
        }
        $user_id = checkPermissionHelper::checkPermission();
        if ($main->parent_id == $user_id){
            return view('Main.print',compact('main','totalCredit','totalDebit','total'));}
        else {return ' you do not have permission';}
    }

    public function printMDaily($id){
        $main = Main::where('id',$id)->first();
        $user_id = checkPermissionHelper::checkPermission();
        $total =0;
        $totalDebit =0;
        $totalCredit =0;
        foreach ($main->subs as $sub){
            if($main->type_of_operation == 0) {
                $totalDebit += $sub->debit;
                $totalCredit += $sub->credit;
            }
            elseif($main->type_of_operation == 1) {
                $total+=$sub->credit;
            }
            else{
                $total+=$sub->debit;
            }
        }
        if ($main->parent_id == $user_id){
            return view('Main.printDaily',compact('main','total','totalDebit','totalCredit'));}
        else {return ' you do not have permission';}
    }


    public function pdf($id){
        $main = Main::whereId($id)->first();
        if (app()->getLocale() == 'ar'){
            $exp = $main->explained_ar;
        }else
            $exp =$main->explained ;
        $data['operation_date'] = $main->operation_date;
        $data['id'] = $main->id;
        $data['explained'] = $exp;
        $data['cash_id'] = $main->cash_id;

        $data['type_of_operation'] = $main->type_of_operation;
        $data['document_number'] = $main->document_number;
        $data['doc_date'] = $main->doc_date;

        $data['currency_symbol'] = $main->currency_symbol;
        $data['exchange_rate'] = $main->exchange_rate;
        $items = [];
        $subs =  $main->subs()->get();
        foreach ($subs as $item) {
            if (app()->getLocale() == 'ar'){
                $exp = $item->explained_ar;
            }else
                $exp =$main->explained ;
            $items[] = [
                'debit'          => $item->debit,
                'credit'         => $item->credit,
                'account_number' => $item->account_number,
                'explained'      => $exp,
            ];
        }
        $data['items'] = $items;
        $total =0;
        $totalDebit =0;
        $totalCredit =0;
        foreach ($main->subs as $sub){
            if($main->type_of_operation == 0) {
                $totalDebit += $sub->debit;
                $totalCredit += $sub->credit;
            }
            elseif($main->type_of_operation == 1) {
                $total+=$sub->credit;
            }
            else{
                $total+=$sub->debit;
            }
        }
        $data['total'] =$total;
        $data['totalDebit'] =$totalDebit;
        $data['totalCredit'] =$totalCredit;
        $user_id = checkPermissionHelper::checkPermission();

        if ($main->parent_id == $user_id){
            $pdf = PDF::loadView('main.pdf', $data);
            return $pdf->download('main'.'.pdf');
        }
        else {
            return ' you do not have permission';
        }

    }
    public function pdfDaily($id){

        $main = Main::whereId($id)->first();
        if (app()->getLocale() == 'ar'){
            $exp = $main->explained_ar;
        }else
            $exp =$main->explained ;
        $data['operation_date'] = $main->operation_date;
        $data['id'] = $main->id;
        $data['explained'] = $exp;
        $data['cash_id'] = $main->cash_id;
        $data['document_number'] = $main->document_number;
        $data['doc_date'] = $main->doc_date;
        $data['type_of_operation'] = $main->type_of_operation;
        $data['currency_symbol'] = $main->currency_symbol;
        $data['exchange_rate'] = $main->exchange_rate;
        $items = [];
        $subs =  $main->subs()->get();
        foreach ($subs as $item) {
            if (app()->getLocale() == 'ar'){
                $exp = $item->explained_ar;
            }else
                $exp =$item->explained ;
            $items[] = [
                'debit'          => $item->debit,
                'credit'         => $item->credit,
                'account_number' => $item->account_number,
                'explained'      => $exp,
            ];
        }
        $data['items'] = $items;
        $user_id = checkPermissionHelper::checkPermission();
        $total =0;
        $totalDebit =0;
        $totalCredit =0;
        foreach ($main->subs as $sub){
            if($main->type_of_operation == 0) {
                $totalDebit += $sub->debit;
                $totalCredit += $sub->credit;
            }
            elseif($main->type_of_operation == 1) {
                $total+=$sub->credit;
            }
            else{
                $total+=$sub->debit;
            }
        }
        $data['total'] =$total;
        $data['totalDebit'] =$totalDebit;
        $data['totalCredit'] =$totalCredit;
           if ($main->parent_id == $user_id){
            $pdf = PDF::loadView('main.pdfDaily', $data);
            return $pdf->download('main'.'.pdf');
        }
        else {
            return ' you do not have permission';
        }

    }

}
