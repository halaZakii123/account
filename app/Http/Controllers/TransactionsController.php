<?php

namespace App\Http\Controllers;

use App\Helpers\checkPermissionHelper;
use App\Helpers\currencyHelper;
use App\transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user_id = checkPermissionHelper::checkPermission();
        $totaldb=0;
        $totaldbc=0;
        $totalcr=0;
        $totalcrc=0;
        $searchType = $request->trans;

//        $allTrans = transactions::where('parent_id', $user_id)->distinct('sourceid')
//            ->distinct('accountid')
//            ->get();
        $allTrans  = DB::table('transactions')->select('accountid')->distinct()->get();
        $allTransSource  = DB::table('transactions')->select('sourceid')->distinct()->get();
        if ($request->trans != null) {

            if ($request->trans == 'account_number') {
                $account_number = $request->account_number_value;
                $from = $request->A_date_from;
                $to = $request->A_date_to;
                $trans = transactions::where('parent_id', $user_id)
                    ->where('accountid', $account_number)
                    ->whereBetween('dydate', [$from, $to])
                    ->get();
                foreach ($trans as $tran){
                    $totaldb+=$tran->amntdb;
                    $totaldbc+=$tran->amntdbc;
                    $totalcr+=$tran->amntcr;
                    $totalcrc+=$tran->amntcrc;

                }
                return view('Transactions.index', compact('trans', 'allTrans','allTransSource','totaldb','totaldbc','totalcr','totalcrc','searchType','account_number','from','to'));

            } elseif ($request->trans == 'source_id') {
                $source_id = $request->source_id_value;
                $trans = transactions::where('sourceid', $source_id)
                    ->where('parent_id', $user_id)
                    ->get();
                foreach ($trans as $tran){
                    $totaldb+=$tran->amntdb;
                    $totaldbc+=$tran->amntdbc;
                    $totalcr+=$tran->amntcr;
                    $totalcrc+=$tran->amntcrc;

                }

                return view('Transactions.index', compact('allTrans','allTransSource', 'trans','totaldb','totaldbc','totalcr','totalcrc','source_id','searchType'));

            } else {
                $dateFrom = $request->doc_date_from;
                $dateTo = $request->doc_date_to;
                $trans = transactions::where('parent_id', $user_id)
                    ->whereBetween('dydate', [$dateFrom, $dateTo])
                    ->get();
                foreach ($trans as $tran){
                    $totaldb+=$tran->amntdb;
                    $totaldbc+=$tran->amntdbc;
                    $totalcr+=$tran->amntcr;
                    $totalcrc+=$tran->amntcrc;

                }
                return view('Transactions.index', compact('allTrans','allTransSource', 'trans','totaldb','totaldbc','totalcr','totalcrc','searchType','dateTo','dateFrom'));
            }
        }else{
            $trans = null;
        return view('Transactions.index',compact('trans','allTrans','allTransSource'));        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $total =0;
        if ($request->trans == 'account_number')
        {
            $account_number = $request->account_number_value;
            $trans =transactions::where('accountid',$account_number)->get();
        }elseif ($request->trans == 'document_number'){
            $document_number = $request->document_number_value;
            $trans =transactions::where('sourceid',$document_number)->get();
        }else{
            $dateFrom = $request->doc_date_from;
            $dateTo = $request->doc_date_to;
            $trans= transactions::whereBetween('dydate', [$dateFrom, $dateTo])->get();

        }
        return view('Transactions.show',compact('trans'));

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

                $trans = transactions::where('parent_id', $user_id)
                    ->where('accountid', $account_number)
                    ->whereBetween('dydate', [$from, $to])
                    ->get();
                foreach ($trans as $tran){
                    $totaldb+=$tran->amntdb;
                    $totaldbc+=$tran->amntdbc;
                    $totalcr+=$tran->amntcr;
                    $totalcrc+=$tran->amntcrc;

                }
                return view('Transactions.print', compact('trans', 'totaldb','totaldbc','totalcr','totalcrc'));

            }
    public function printtransSou($searchType,$source_id){


        $user_id = checkPermissionHelper::checkPermission();
        $totaldb=0;
        $totaldbc=0;
        $totalcr=0;
        $totalcrc=0;
        $trans = transactions::where('sourceid', $source_id)
            ->where('parent_id', $user_id)
            ->get();
        foreach ($trans as $tran){
            $totaldb+=$tran->amntdb;
            $totaldbc+=$tran->amntdbc;
            $totalcr+=$tran->amntcr;
            $totalcrc+=$tran->amntcrc;
    }

    return view('Transactions.print', compact( 'trans','totaldb','totaldbc','totalcr','totalcrc'));
    }
    public function printtransDate($searchType,$from,$to){
        $user_id = checkPermissionHelper::checkPermission();
        $totaldb=0;
        $totaldbc=0;
        $totalcr=0;
        $totalcrc=0;
        $trans = transactions::where('parent_id', $user_id)
            ->whereBetween('dydate', [$from, $to])
            ->get();
        foreach ($trans as $tran){
            $totaldb+=$tran->amntdb;
            $totaldbc+=$tran->amntdbc;
            $totalcr+=$tran->amntcr;
            $totalcrc+=$tran->amntcrc;

        }
    return view('Transactions.print', compact( 'trans','totaldb','totaldbc','totalcr','totalcrc'));
}

  public function pdftransAcc($searchType,$account_number,$from,$to){

      $user_id = checkPermissionHelper::checkPermission();
      $totaldb=0;
      $totaldbc=0;
      $totalcr=0;
      $totalcrc=0;

      $trans = transactions::where('parent_id', $user_id)
          ->where('accountid', $account_number)
          ->whereBetween('dydate', [$from, $to])
          ->get();

      foreach ($trans as $item) {
          if (app()->getLocale() == 'ar'){
              $des = $item->description_ar;
           }else
          $des =$item->description_en ;
          $items[] = [
              'amntdb'          => $item->amntdb,
              'amntcr'         => $item->amntcr,
              'accountid'         => $item->accountid,
              'sourceid' => $item->sourceid,
              'dydate'      => $item->dydate,
              'amntdbc'      => $item->amntdbc,
              'amntcrc'      => $item->amntcrc,
              'docno'      => $item->docno,
              'docdate'      => $item->docdate,
              'description' => $des,
              'currcode' =>$item->currcode

          ];
          $totaldb+=$item->amntdb;
          $totaldbc+=$item->amntdbc;
          $totalcr+=$item->amntcr;
          $totalcrc+=$item->amntcrc;
       }
      $data['items'] = $items;
      $data['totaldb'] =$totaldb;
      $data['totaldbc'] =$totaldbc;
      $data['totalcrc'] =$totalcrc;
      $data['totalcr'] =$totalcr;
          $pdf = PDF::loadView('Transactions.pdf', $data);
          return $pdf->download('Transactions'.'.pdf');


  }
}
