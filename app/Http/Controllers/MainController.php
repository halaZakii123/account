<?php

namespace App\Http\Controllers;

use App\Main;
use App\View_CurrencySymbol_main;
use App\View_TypeOperation_main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $cus = View_CurrencySymbol_main::all();
        $ops = View_TypeOperation_main::all();
        return view('Main.crud',compact('cus','ops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'operation_date'=>'required|date',
            'explained'=>'required|string',
            'type_of_operation'=>'required|string',
            'currency_symbol'=>'required|string',
            'exchange_rate'=>'required|string',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }
        Main::create(['operation_date'=> $request->operation_date,
            'explained'=>$request->explained,
            'type_of_operation'=>$request->type_of_operation,
            'currency_symbol'=>$request->currency_symbol,
            'exchange_rate'=>$request->exchange_rate
        ]);
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
        $main = Main::FindOrFail($id);
        $cus = View_CurrencySymbol_main::all();
        $ops = View_TypeOperation_main::all();
        return  view('Main.crud',compact('main','ops','cus'));
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
  $main = Main::where('id',$id);
        $validator = Validator::make($request->all(), [
            'operation_date'=>'sometimes|required|date',
            'explained'=>'sometimes|required|string',
            'type_of_operation'=>'sometimes|required|string',
            'currency_symbol'=>'sometimes|required|string',
            'exchange_rate'=>'sometimes|required|string',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }
        $main->update(['operation_date'=> $request->operation_date,
            'explained'=>$request->explained,
            'type_of_operation'=>$request->type_of_operation,
            'currency_symbol'=>$request->currency_symbol,
            'exchange_rate'=>$request->exchange_rate
        ]);
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
}
