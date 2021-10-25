<?php

namespace App\Http\Controllers;

use App\Helpers\checkPermissionHelper;
use App\Helpers\currencyHelper;
use App\TblAccount;
use App\transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class TransactionsController extends Controller
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
        $account = TblAccount::where('parent_id',$user_id)->get();
        $totaldb=0;
        $totaldbc=0;
        $totalcr=0;
        $totalcrc=0;
        $subAmount =0;
        $subAmountc =0;
        $searchType = $request->trans;
        $day = date('m/d/Y');

        $first = Carbon::createFromFormat('m/d/Y', $day)
            ->firstOfYear()
            ->format('Y-m-d');
        $last =  Carbon::createFromFormat('m/d/Y', $day)
            ->lastOfYear()
            ->format('Y-m-d');

        $allTrans  = DB::table('transactions')->select('accountid')->distinct()->get();
        $allTransSource  = DB::table('transactions')->select('sourceid')->distinct()->get();
        if ($request->trans != null) {
            if ($request->trans == 'account_number') {
                $account_number = $request->account_number_value;
                $from = $request->A_date_from;
                $to = $request->A_date_to;
//                $trans = transactions::where('parent_id', $user_id)
//                    ->where('accountid', $account_number)
//                    ->whereBetween('dydate', [$from, $to])
//                    ->get();

                $trans =DB::select("CALL pr_trans_Byacc(" .$user_id.",".$account_number.",'".$from."','".$to."')");
                foreach ($trans as $tran){
                    $totaldb+=$tran->trans_db;
                    $totaldbc+=$tran->trans_dbc;
                    $totalcr+=$tran->trans_cr;
                    $totalcrc+=$tran->trans_crc;

                }
                $subAmount = $totaldb -$totalcr;
                $subAmountc = $totaldbc -$totalcrc;
                return view('Transactions.index', compact('trans', 'allTrans','allTransSource','totaldb','totaldbc','totalcr','totalcrc','searchType','account_number','from','to','first','last','subAmount','subAmountc','account'));

            } elseif ($request->trans == 'source_id') {

                $source_id = $request->source_id_value;

                $trans =DB::select("CALL pr_trans_Byid(" .$user_id.",".$source_id.")");

                foreach ($trans as $tran){
                    $totaldb+=$tran->trans_db;
                    $totaldbc+=$tran->trans_dbc;
                    $totalcr+=$tran->trans_cr;
                    $totalcrc+=$tran->trans_crc;

                }
                $subAmount = $totaldb -$totalcr;
                $subAmountc = $totaldbc -$totalcrc;
                return view('Transactions.index', compact('allTrans','allTransSource', 'trans','totaldb','totaldbc','totalcr','totalcrc','source_id','searchType','first','last','subAmount','subAmountc','account'));

            } else {
                $dateFrom = $request->doc_date_from;
                $dateTo = $request->doc_date_to;
//                $trans = transactions::where('parent_id', $user_id)
//                    ->whereBetween('dydate', [$dateFrom, $dateTo])
//                    ->get();
//                dd($dateTo);
                $trans =DB::select("CALL pr_trans_Bydate(" .$user_id.",'".$dateFrom."','".$dateTo."')");

                foreach ($trans as $tran){
                    $totaldb+=$tran->trans_db;
                    $totaldbc+=$tran->trans_dbc;
                    $totalcr+=$tran->trans_cr;
                    $totalcrc+=$tran->trans_crc;

                }
                $subAmount = $totaldb -$totalcr;
                $subAmountc = $totaldbc -$totalcrc;
                return view('Transactions.index', compact('allTrans','allTransSource', 'trans','totaldb','totaldbc','totalcr','totalcrc','searchType','dateTo','dateFrom','first','last','subAmount','subAmountc','account'));
            }
        }else{
            $trans = null;
        return view('Transactions.index',compact('trans','allTrans','allTransSource','first','last','account'));        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getBlDaily()
    {
        $user_id = checkPermissionHelper::checkPermission();
        $BlDailys = DB::select("CALL pr_BLdaily(" .$user_id.")");

        return view('Transactions.Bldaily',compact('BlDailys'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return void
     */
    public function show(Request $request)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(transactions $transactions)
    {
        //
    }
    public function printtransAcc($searchType,$account_number,$from,$to){

        $user_id = checkPermissionHelper::checkPermission();
        $totaldb=0;
        $totaldbc=0;
        $totalcr=0;
        $totalcrc=0;

        $trans =DB::select("CALL pr_trans_Byacc(" .$user_id.",".$account_number.",'".$from."','".$to."')");


                foreach ($trans as $tran){
                    $totaldb+=$tran->trans_db;
                    $totaldbc+=$tran->trans_dbc;
                    $totalcr+=$tran->trans_cr;
                    $totalcrc+=$tran->trans_crc;

                }
        $subAmount = $totaldb -$totalcr;
        $subAmountc = $totaldbc -$totalcrc;
                return view('Transactions.print', compact('trans', 'totaldb','totaldbc','totalcr','totalcrc','subAmount','subAmountc'));

            }
    public function printtransSou($searchType,$source_id){


        $user_id = checkPermissionHelper::checkPermission();
        $totaldb=0;
        $totaldbc=0;
        $totalcr=0;
        $totalcrc=0;
        $trans =DB::select("CALL pr_trans_Byid(" .$user_id.",".$source_id.")");

        foreach ($trans as $tran){
            $totaldb+=$tran->trans_db;
            $totaldbc+=$tran->trans_dbc;
            $totalcr+=$tran->trans_cr;
            $totalcrc+=$tran->trans_crc;

        }
        $subAmount = $totaldb -$totalcr;
        $subAmountc = $totaldbc -$totalcrc;
    return view('Transactions.print', compact( 'trans','totaldb','totaldbc','totalcr','totalcrc','subAmount','subAmountc'));
    }
    public function printtransDate($searchType,$from,$to){
        $user_id = checkPermissionHelper::checkPermission();
        $totaldb=0;
        $totaldbc=0;
        $totalcr=0;
        $totalcrc=0;
        $trans =DB::select("CALL pr_trans_Bydate(" .$user_id.",'".$from."','".$to."')");

        foreach ($trans as $tran){
            $totaldb+=$tran->trans_db;
            $totaldbc+=$tran->trans_dbc;
            $totalcr+=$tran->trans_cr;
            $totalcrc+=$tran->trans_crc;


        } $subAmount = $totaldb -$totalcr;
        $subAmountc = $totaldbc -$totalcrc;
    return view('Transactions.print', compact( 'trans','totaldb','totaldbc','totalcr','totalcrc','subAmount','subAmountc'));
}

  public function pdftransAcc($searchType,$account_number,$from,$to){

      $user_id = checkPermissionHelper::checkPermission();
      $totaldb=0;
      $totaldbc=0;
      $totalcr=0;
      $totalcrc=0;

      $trans =DB::select("CALL pr_trans_Byacc(" .$user_id.",".$account_number.",'".$from."','".$to."')");


      foreach ($trans as $item) {
          if (app()->getLocale() == 'ar'){
              $des = $item->trans_descrip_ar;
           }else
          $des =$item->trans_descrip_en ;
          $items[] = [
              'amntdb'          => $item->trans_db,
              'amntcr'         => $item->trans_cr,
              'accountid'         => $item->trans_accno,
              'sourceid' => $item->trans_sid,
              'dydate'      => $item->trans_date,
              'amntdbc'      => $item->trans_dbc,
              'amntcrc'      => $item->trans_crc,
              'docno'      => $item->trans_docno,
              'docdate'      => $item->trans_docdate,
              'description' => $des,
              'currcode' =>$item->trans_curr

          ];
          $totaldb+=$item->trans_db;
          $totaldbc+=$item->trans_dbc;
          $totalcr+=$item->trans_cr;
          $totalcrc+=$item->trans_crc;

      }
      $data['items'] = $items;
      $data['totaldb'] =$totaldb;
      $data['totaldbc'] =$totaldbc;
      $data['totalcrc'] =$totalcrc;
      $data['totalcr'] =$totalcr;
      $subAmount = $totaldb -$totalcr;
      $subAmountc = $totaldbc -$totalcrc;
      $data['subAmount'] =$subAmount;
      $data['subAmountc'] =$subAmountc;
          $pdf = PDF::loadView('Transactions.pdf', $data);
          return $pdf->download('Transactions'.'.pdf');


  }

    public function pdftransSou($searchType,$source_id){

        $user_id = checkPermissionHelper::checkPermission();
        $totaldb=0;
        $totaldbc=0;
        $totalcr=0;
        $totalcrc=0;

        $trans =DB::select("CALL pr_trans_Byid(" .$user_id.",".$source_id.")");


        foreach ($trans as $item) {
            if (app()->getLocale() == 'ar'){
                $des = $item->trans_descrip_ar;
            }else
                $des =$item->trans_descrip_en ;
            $items[] = [
                'amntdb'          => $item->trans_db,
                'amntcr'         => $item->trans_cr,
                'accountid'         => $item->trans_accno,
                'sourceid' => $item->trans_sid,
                'dydate'      => $item->trans_date,
                'amntdbc'      => $item->trans_dbc,
                'amntcrc'      => $item->trans_crc,
                'docno'      => $item->trans_docno,
                'docdate'      => $item->trans_docdate,
                'description' => $des,
                'currcode' =>$item->trans_curr

            ];
            $totaldb+=$item->trans_db;
            $totaldbc+=$item->trans_dbc;
            $totalcr+=$item->trans_cr;
            $totalcrc+=$item->trans_crc;

        }
        $data['items'] = $items;
        $data['totaldb'] =$totaldb;
        $data['totaldbc'] =$totaldbc;
        $data['totalcrc'] =$totalcrc;
        $data['totalcr'] =$totalcr;
        $subAmount = $totaldb -$totalcr;
        $subAmountc = $totaldbc -$totalcrc;
        $data['subAmount'] =$subAmount;
        $data['subAmountc'] =$subAmountc;
        $pdf = PDF::loadView('Transactions.pdf', $data);
        return $pdf->download('Transactions'.'.pdf');


    }
    public function pdftransDate($searchType,$from,$to){

        $user_id = checkPermissionHelper::checkPermission();
        $totaldb=0;
        $totaldbc=0;
        $totalcr=0;
        $totalcrc=0;

        $trans =DB::select("CALL pr_trans_Bydate(" .$user_id.",'".$from."','".$to."')");



        foreach ($trans as $item) {
            if (app()->getLocale() == 'ar'){
                $des = $item->trans_descrip_ar;
            }else
                $des =$item->trans_descrip_en ;
            $items[] = [
                'amntdb'          => $item->trans_db,
                'amntcr'         => $item->trans_cr,
                'accountid'         => $item->trans_accno,
                'sourceid' => $item->trans_sid,
                'dydate'      => $item->trans_date,
                'amntdbc'      => $item->trans_dbc,
                'amntcrc'      => $item->trans_crc,
                'docno'      => $item->trans_docno,
                'docdate'      => $item->trans_docdate,
                'description' => $des,
                'currcode' =>$item->trans_curr

            ];
            $totaldb+=$item->trans_db;
            $totaldbc+=$item->trans_dbc;
            $totalcr+=$item->trans_cr;
            $totalcrc+=$item->trans_crc;

        }
        $data['items'] = $items;
        $data['totaldb'] =$totaldb;
        $data['totaldbc'] =$totaldbc;
        $data['totalcrc'] =$totalcrc;
        $data['totalcr'] =$totalcr;
        $subAmount = $totaldb -$totalcr;
        $subAmountc = $totaldbc -$totalcrc;

        $data['subAmount'] =$subAmount;
        $data['subAmountc'] =$subAmountc;
        $pdf = PDF::loadView('Transactions.pdf', $data);
        return $pdf->download('Transactions'.'.pdf');


    }
    public function pdfBLdaily(){
        $user_id = checkPermissionHelper::checkPermission();
        $BlDailys = DB::select("CALL pr_BLdaily(" .$user_id.")");
        $items =[];
        foreach ($BlDailys as $item) {

            $items[] = [
                'trans_db'          => $item->trans_db,
                'trans_cr'         => $item->trans_cr,
                'trans_dbc'         => $item->trans_dbc,
                'trans_crc' => $item->trans_crc,
                'trans_curr'      => $item->trans_curr,
                'acc_id'      => $item->acc_id,
                'acc_name'      => $item->acc_name,
                'acc_finalReport'      => $item->acc_finalReport,


            ];
    }
       $data['items'] =$items ;

        $pdf = PDF::loadView('Transactions.pdfBldaily', $data);
        return $pdf->download('BLDaily'.'.pdf');
    }

    public function printBl(){
        $user_id = checkPermissionHelper::checkPermission();
        $BlDailys = DB::select("CALL pr_BLdaily(" .$user_id.")");

        return view('Transactions.printBLdaily',compact('BlDailys'));
    }
}
