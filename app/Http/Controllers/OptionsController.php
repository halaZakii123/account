<?php

namespace App\Http\Controllers;

use App\Options;
use App\TblAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OptionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $options = Options::all();
        return view('Option.index',compact('options'));
    }
    public function create(){
        return view('Option.crud');
    }

    public function edit($id){
        $option = Options::findOrFail($id);
        return view('Option.crud',compact('option'));
    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
             'type' => 'required|string',
            'contents'=>'required|string',

        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        Options::create(['type'=> $request->type,
                         'contents'=>$request->contents
                         ]);
        return redirect(route('Options.index'));
    }

    public function update(Request $request ,$id){

        $validator = Validator::make($request->all(), [
            'type' =>'sometimes|required|string',
            'content'=>'sometimes|required|string',

        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }
        $options= Options::where('id',$id);
        $options->update(['type'=>$request->type,
            'contents'=>$request->contents]);

        return redirect(route('Options.index'));
    }

    public function destroy($id){
       Options::where('id',$id)->delete();


        return redirect(route('Options.index'));
    }
}
