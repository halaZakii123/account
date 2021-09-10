<?php

namespace App\Http\Controllers;

use App\Helpers\checkPermissionHelper;
use App\Main;
use App\TblAccount;
use App\View_CurrencySymbol_main;
use App\View_TypeOperation_main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PDF;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user_id = checkPermissionHelper::checkPermission();
        $mains = Main::where('parent_id',$user_id)->get();
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
        $account_numbers = DB::table('tbl_accounts')->where('parent_id',$user_id)->pluck('account_number');
        return view('Main.crud',compact('cus','ops','accounts','account_numbers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = checkPermissionHelper::checkPermission();
        $data['operation_date'] = $request->operation_date;
        $data['explained'] = $request->Explained;
        $data['type_of_operation'] = $request->type_of_operation;
        $data['currency_symbol'] = $request->currency_symbol;
        $data['exchange_rate'] = $request->exchange_rate;
        $data['parent_id'] = $user_id;
        $data['user_id'] = Auth::user()->id;
       $main= Main::create($data);

        $details_list = [];
        for ($i = 0; $i < count($request->debit); $i++) {
            $details_list[$i]['debit'] = $request->debit[$i];
            $details_list[$i]['credit'] = $request->credit[$i];
            $details_list[$i]['account_number'] = $request->account_number[$i];
            $details_list[$i]['explained'] = $request->explained[$i];
        }
        $details = $main->subs()->createMany($details_list);

        return redirect(route('Mains.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
       $main = Main::FindOrFail($id);
        return view('Main.show',compact('main'));
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
        $cus = View_CurrencySymbol_main::where('parent_id',$user_id);
        $ops = View_TypeOperation_main::where('parent_id',$user_id);
        $account_numbers = DB::table('tbl_accounts')->where('parent_id',$user_id)->pluck('account_number');
        if ($main->parent_id == $user_id) {
            return view('Main.crud', compact('main', 'ops', 'cus', 'accounts', 'account_numbers'));
        }else{
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
        $data['type_of_operation'] = $request->type_of_operation;
        $data['currency_symbol'] = $request->currency_symbol;
        $data['exchange_rate'] = $request->exchange_rate;
        $data['user_id'] = Auth::user()->id;
        $main->update($data);


        $main->subs()->delete();

        $details_list = [];
        for ($i = 0; $i < count($request->debit); $i++) {
            $details_list[$i]['debit'] = $request->debit[$i];
            $details_list[$i]['credit'] = $request->credit[$i];
            $details_list[$i]['account_number'] = $request->account_number[$i];
            $details_list[$i]['explained'] = $request->explained[$i];
        }
       $main->subs()->createMany($details_list);
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

    public function add(){

        $user_id = checkPermissionHelper::checkPermission();
        $account_numbers = DB::table('tbl_accounts')->where('parent_id',$user_id)->pluck('account_number');

        return view('main.ajax',compact('account_numbers'));
    }
    public function addE(){
        $user_id = checkPermissionHelper::checkPermission();
        $cus = View_CurrencySymbol_main::where('parent_id',$user_id)->get();
//        foreach ($cus as $cu){
//            if ($cu->contents == "@"){
//                dd($cu->contents);
//            }
//        }
        $x=request()->selectedValue;
    return view('main.ajaxE',compact('cus','x'));
    }

    public function printM($id){
        $main = Main::where('id',$id)->first();

        $user_id = checkPermissionHelper::checkPermission();
        if ($main->parent_id == $user_id){
            return view('Main.print',compact('main'));}
        else {return ' you do not have permission';}

    }
    public function pdf($id){
        $main = Main::whereId($id)->first();
        $data['operation_date'] = $main->operation_date;
        $data['id'] = $main->id;
        $data['explained'] = $main->explained;
        $data['type_of_operation'] = $main->type_of_operation;
        $data['currency_symbol'] = $main->currency_symbol;
        $data['exchange_rate'] = $main->exchange_rate;
        $items = [];
        $subs =  $main->subs()->get();
        foreach ($subs as $item) {
            $items[] = [
                'debit'          => $item->debit,
                'credit'         => $item->credit,
                'account_number' => $item->account_number,
                'explained'      => $item->explained,
            ];
        }
        $data['items'] = $items;
        $user_id = checkPermissionHelper::checkPermission();

        if ($main->parent_id == $user_id){
            $pdf = PDF::loadView('main.pdf', $data);
            return $pdf->download('main'.'.pdf');
        }
        else {
            return ' you do not have permission';
        }

    }

}
