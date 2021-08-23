<?php

namespace App\Http\Controllers;

use App\Options;
use App\Sub;
use App\TblAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $subs = Sub::all();
        return view('Sub.index',compact('subs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id)
    {
        $accounts = TblAccount::all();
        return view('Sub.crud',compact('accounts','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return string
     */
    public function store(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'debit' => 'required|string',
            'credit'=>'required|string',
            'account_number'=>'required|string',
            'explained'=>'required|string',

        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        Sub::create(['debit'=> $request->debit,
            'credit'=>$request->credit,
            'account_number'=>$request->account_number,
            'explained'=>$request->explained,
            'main_id'=>$id
        ]);
        return redirect(route('Mains.show',$id));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $sub
     * @param $main
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($sub ,$main)
    {

        $accounts = TblAccount::all();

        $sub = Sub::findOrFail($sub);
        return view('Sub.crud',compact('sub','accounts','main'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @param $main
     * @return string
     */
    public function update(Request $request,$id,$main)
    {
        $validator = Validator::make($request->all(), [
            'debit' => 'sometimes|required|string',
            'credit'=>'sometimes|required|string',
            'account_number'=>'sometimes|required|string',
            'explained'=>'sometimes|required|string',

        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }
      $sub = Sub::where('id',$id);
        $sub->update(['debit'=> $request->debit,
            'credit'=>$request->credit,
            'account_number'=>$request->account_number,
            'explained'=>$request->explained
        ]);
        return redirect(route('Mains.show',$main));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Sub::where('id',$id)->delete();
        return redirect(route('Mains.show',$id));
    }
}
