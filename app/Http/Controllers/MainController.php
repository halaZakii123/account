<?php

namespace App\Http\Controllers;

use App\Main;
use App\TblAccount;
use App\View_CurrencySymbol_main;
use App\View_TypeOperation_main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $mains = Main::all();
        return view('Main.index',compact('mains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $accounts = TblAccount::all();
        $cus = View_CurrencySymbol_main::all();
        $ops = View_TypeOperation_main::all();

        $account_numbers = DB::table('tbl_accounts')->pluck('account_number');



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
        $data['operation_date'] = $request->operation_date;
        $data['explained'] = $request->Explained;
        $data['type_of_operation'] = $request->type_of_operation;
        $data['currency_symbol'] = $request->currency_symbol;
        $data['exchange_rate'] = $request->exchange_rate;
       $main= Main::create($data);

        $details_list = [];
        for ($i = 0; $i < count($request->debit); $i++) {
            $details_list[$i]['debit'] = $request->debit[$i];
            $details_list[$i]['credit'] = $request->credit[$i];
            $details_list[$i]['account_number'] = 1;
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
        $accounts = TblAccount::all();

        $main = Main::FindOrFail($id);
        $cus = View_CurrencySymbol_main::all();
        $ops = View_TypeOperation_main::all();
        return  view('Main.crud',compact('main','ops','cus','accounts'));
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
        $main = Main::whereId($id)->first();
        dd($request);
        $data['operation_date'] = $request->operation_date;
        $data['explained'] = $request->Explained;
        $data['type_of_operation'] = $request->type_of_operation;
        $data['currency_symbol'] = $request->currency_symbol;
        $data['exchange_rate'] = $request->exchange_rate;
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
        $accounts = TblAccount::all();
        return view('main.ajax',compact('accounts'));
    }

}
