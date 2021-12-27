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

        $allTransSource  = DB::table('transactions')->where('parent_id',$user_id)->select('sourceid')->distinct()->get();
        if ($request->trans != null) {
            if ($request->trans == 'source_id') {

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
                return view('Transactions.index', compact('allTransSource', 'trans','totaldb','totaldbc','totalcr','totalcrc','source_id','searchType','first','last','subAmount','subAmountc','account'));

            } else {
                $dateFrom = $request->doc_date_from;
                $dateTo = $request->doc_date_to;
                $trans =DB::select("CALL pr_trans_Bydate(" .$user_id.",'".$dateFrom."','".$dateTo."')");

                foreach ($trans as $tran){
                    $totaldb+=$tran->trans_db;
                    $totaldbc+=$tran->trans_dbc;
                    $totalcr+=$tran->trans_cr;
                    $totalcrc+=$tran->trans_crc;

                }
                $subAmount = $totaldb -$totalcr;
                $subAmountc = $totaldbc -$totalcrc;
                return view('Transactions.index', compact('allTransSource', 'trans','totaldb','totaldbc','totalcr','totalcrc','searchType','dateTo','dateFrom','first','last','subAmount','subAmountc','account'));
            }
        }else{
            $trans = null;
        return view('Transactions.index',compact('trans','allTransSource','first','last','account'));        }

    }

    public function getTransByAccount(Request $request){
        $user_id = checkPermissionHelper::checkPermission();
        $account = TblAccount::where('parent_id',$user_id)->get();
        $totaldb=0;
        $totaldbc=0;
        $totalcr=0;
        $totalcrc=0;
        $subAmount =0;
        $subAmountc =0;
        $day = date('m/d/Y');
        $first = Carbon::createFromFormat('m/d/Y', $day)
            ->firstOfYear()
            ->format('Y-m-d');
        $last =  Carbon::createFromFormat('m/d/Y', $day)
            ->lastOfYear()
            ->format('Y-m-d');
        $allTrans  = DB::table('transactions')->where('parent_id',$user_id)->select('accountid')->distinct()->get();
        $trans = null;
        if ($request->trans != null) {
            $account_number = $request->account_number_value;
            $from = $request->A_date_from;
            $to = $request->A_date_to;

            $trans = DB::select("CALL pr_trans_Byacc(" . $user_id . "," . $account_number . ",'" . $from . "','" . $to . "')");
            foreach ($trans as $tran) {
                $totaldb += $tran->trans_db;
                $totaldbc += $tran->trans_dbc;
                $totalcr += $tran->trans_cr;
                $totalcrc += $tran->trans_crc;

            }
            $subAmount = $totaldb - $totalcr;
            $subAmountc = $totaldbc - $totalcrc;
            return view('Transactions.gl', compact('trans', 'allTrans',  'totaldb', 'totaldbc', 'totalcr', 'totalcrc', 'account_number', 'from', 'to', 'first', 'last', 'subAmount', 'subAmountc', 'account'));
        }else
            return view('Transactions.gl',compact('trans','allTrans','first','last','account'));

            }


    public function getBlDaily()
    {
        $user_id = checkPermissionHelper::checkPermission();
        $BlDailys = DB::select("CALL pr_BLdaily(" .$user_id.")");
        $totdb =0;
        $totcr =0;
        $totdbc =0;
        $totcrc =0;
        $totBAl =0;
        $totBAlc =0;
        foreach ($BlDailys as $blDaily){
            $totdb += $blDaily->Db;
            $totcr += $blDaily->CR;
            $totdbc += $blDaily->Dbc;
            $totcrc += $blDaily->Crc;
            $totBAl += $blDaily->BAl;
            $totBAlc += $blDaily->BAlc;
        }

        return view('Transactions.Bldaily',compact('BlDailys','totBAl','totdb','totBAlc','totcr','totcrc','totdbc'));

    }



    public function printtransAcc($account_number,$from,$to){

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

  public function pdftransAcc($account_number,$from,$to){

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
              'currcode' =>$item->trans_curr,
              'acc_name'=>$item->acc_name

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
                'currcode' =>$item->trans_curr,
                'acc_name'=>$item->acc_name


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
                'currcode' =>$item->trans_curr,
                'acc_name'=>$item->acc_name


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
        $data['search_type']=$searchType;
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
        $totdb =0;
        $totcr =0;
        $totdbc =0;
        $totcrc =0;
        $totBAl =0;
        $totBAlc =0;
        foreach ($BlDailys as $blDaily){
            $totdb += $blDaily->Db;
            $totcr += $blDaily->CR;
            $totdbc += $blDaily->Dbc;
            $totcrc += $blDaily->Crc;
            $totBAl += $blDaily->BAl;
            $totBAlc += $blDaily->BAlc;
        }
        $data['totdb'] = $totdb;
        $data['totcr'] = $totcr;
        $data['totdbc'] = $totdbc;
        $data['totcrc'] = $totcrc;
        $data['totBAl'] = $totBAl;
        $data['totBAlc'] = $totBAlc;
        foreach ($BlDailys as $item) {

            $items[] = [
                'Db'          => $item->Db,
                'CR'         => $item->CR,
                'Dbc'         => $item->Dbc,
                'Crc' => $item->Crc,
                'BAl' => $item->BAl,
                'BAlc' => $item->BAlc,
                'trans_curr'      => $item->trans_curr,
                'acc_id'      => $item->acc_no,
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
        $totdb =0;
        $totcr =0;
        $totdbc =0;
        $totcrc =0;
        $totBAl =0;
        $totBAlc =0;
        foreach ($BlDailys as $blDaily){
            $totdb += $blDaily->Db;
            $totcr += $blDaily->CR;
            $totdbc += $blDaily->Dbc;
            $totcrc += $blDaily->Crc;
            $totBAl += $blDaily->BAl;
            $totBAlc += $blDaily->BAlc;
        }

        return view('Transactions.printBLdaily',compact('BlDailys','totBAl','totdb','totBAlc','totcr','totcrc','totdbc'));
    }

    public function getBlalanceSheet(Request $request , $b){
        
        
        $user_id = checkPermissionHelper::checkPermission();

        $day = date('m/d/Y');
        $first = Carbon::createFromFormat('m/d/Y', $day)
            ->firstOfYear()
            ->format('Y-m-d');
        $last =  Carbon::createFromFormat('m/d/Y', $day)
            ->lastOfYear()
            ->format('Y-m-d');
           
        if ($request->date_from != null){
            $from = $request->date_from;
            $to = $request->date_to;
            $sheets = DB::select("CALL PR_BL('".$from."','".$to."',".$user_id.")") ;
            $totdb =0;
            $totcr =0;
            $totBAl =0;
            $totBalCr =0;
            $totBalDb =0;
            foreach ($sheets as $sheet){
             if($b == 'budget') {
                if(($sheet->acc_ismaster == 0) && ($sheet->acc_finalReport == 1))
                {
                    $totdb += $sheet->Tot_DB;
                    $totcr += $sheet->Tot_Cr;
                    $totBalDb += $sheet->Tot_BalDb;
                    $totBalCr += $sheet->Tot_BalCr;
                    $totBAl += $sheet->Tot_Bal;
                } 
                
             }
              elseif($b =='Income_list') 
              {
                if(($sheet->acc_ismaster == 0) && ($sheet->acc_finalReport == 2))
                {
                    $totdb += $sheet->Tot_DB;
                    $totcr += $sheet->Tot_Cr;
                    $totBalDb += $sheet->Tot_BalDb;
                    $totBalCr += $sheet->Tot_BalCr;
                    $totBAl += $sheet->Tot_Bal;
                } 

              }elseif($b == 'general'){
                if($sheet->acc_ismaster == 0 )
                {
                    $totdb += $sheet->Tot_DB;
                    $totcr += $sheet->Tot_Cr;
                    $totBalDb += $sheet->Tot_BalDb;
                    $totBalCr += $sheet->Tot_BalCr;
                    $totBAl += $sheet->Tot_Bal;
                } 
                
              }
            }
            
            if($b == 'budget') {
                $b = 1 ;}
               elseif($b == 'Income_list'){
               $b = 2; }
               else{
                   $b = 3;
               }
         return view('Transactions.blSheet',compact('sheets','first','last','from','to','totdb','totcr','totBalDb','totBalCr','totBAl','b'));

      }
        else{
            $sheets = null;
            return view('Transactions.blSheet',compact('first','last','sheets','b'));
        }
    }

    public function pdfBLsheet($from,$to,$b){
        $user_id = checkPermissionHelper::checkPermission();
        $sheets = DB::select("CALL PR_BL('".$from."','".$to."',".$user_id.")") ;
        $items=[];
        $totdb =0;
        $totcr =0;
        $totBAl =0;
        $totBalCr =0;
        $totBalDb =0;
        $data['from'] =$from;
        $data['to'] = $to;
        
        foreach ($sheets as $sheet){
               $items[]=[
                   'AccId'=> $sheet->AccID,
                   'acc_name'=>   $sheet->acc_name,
                   'acc_belongTo'=>     $sheet->acc_belongTo,
                   'acc_finalReport'=>     $sheet->acc_finalReport,
                   'acc_ismaster'=>     $sheet->acc_ismaster,
                   'Tot_DB'=>      $sheet->Tot_DB,
                   'Tot_Cr'=>    $sheet->Tot_Cr,
                   'Tot_Bal'=>  $sheet->Tot_Bal,
                   'Tot_BalDb'=>  $sheet->Tot_BalDb,
                   'Tot_BalCr'=>   $sheet->Tot_BalCr,
                   'Tot_DBc'=>      $sheet->Tot_DBc,
                   'Tot_Crc'=>      $sheet->Tot_Crc,
                   'Tot_Balc'=>     $sheet->Tot_Balc,
                   'Tot_BalDbc'=>      $sheet->Tot_BalDbc,
                   'Tot_BalCrc'=>     $sheet->Tot_BalCrc,
                   ];
                   if($sheet->acc_ismaster == 0){
                   $totdb += $sheet->Tot_DB;
                   $totcr += $sheet->Tot_Cr;
                   $totBalDb += $sheet->Tot_BalDb;
                   $totBalCr += $sheet->Tot_BalCr;
                   $totBAl += $sheet->Tot_Bal;}
        }
        
           $data['b'] =$b;
        $data['items'] = $items;
        $data['totdb'] =$totdb;
        $data['totcr'] =$totcr;
        $data['totBalDb'] =$totBalDb;
        $data['totBalCr'] =$totBalCr;
        $data['totBAl'] =$totBAl;
       
        $pdf = PDF::loadView('Transactions.pdfSheet', $data);
        return $pdf->download('BLSheet'.'.pdf');
    }
    public function printsheet($from ,$to,$b){
        
        $user_id = checkPermissionHelper::checkPermission();
        $sheets = DB::select("CALL PR_BL('".$from."','".$to."',".$user_id.")") ;
        $totdb =0;
        $totcr =0;
        $totBAl =0;
        $totBalCr =0;
        $totBalDb =0;
        
        foreach ($sheets as $sheet){
            if($sheet->acc_ismaster == 0){
            $totdb += $sheet->Tot_DB;
            $totcr += $sheet->Tot_Cr;
            $totBalDb += $sheet->Tot_BalDb;
            $totBalCr += $sheet->Tot_BalCr;
            $totBAl += $sheet->Tot_Bal;
        }}
       
        return view('transactions.printsheet',compact('sheets','totdb','totcr','totBalDb','totBalCr','totBAl','from','to','b'));
    }
}
