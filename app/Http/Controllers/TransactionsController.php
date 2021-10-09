<?php

namespace App\Http\Controllers;

use App\transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $trans = transactions::all();
      return view('Transactions.index',compact('trans'));
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
}
