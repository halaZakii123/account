<?php

namespace App\Http\Controllers;

use App\Helpers\checkPermissionHelper;
use App\Options;
use App\TblAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

class OptionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user_id = checkPermissionHelper::checkPermission();
        $options = Options::where('parent_id',$user_id)->get();
        return view('Option.index',compact('options'));
    }
    public function create(){
        $user_id = checkPermissionHelper::checkPermission();
        $account_numbers = DB::table('tbl_accounts')->where('parent_id',$user_id )
            ->pluck('account_number');
        return view('Option.crud',compact('account_numbers'));
    }

    public function edit($id){
        $option = Options::findOrFail($id);
        $user_id = checkPermissionHelper::checkPermission();
        $account_numbers = DB::table('tbl_accounts')->where('parent_id',$user_id)->pluck('account_number');

        if ($option->parent_id==$user_id){
        return view('Option.crud',compact('option','account_numbers'));}
        else{
            return  'you do not have permission ';
        }
    }


    public function store(Request $request){
        $user_id = checkPermissionHelper::checkPermission();
        $validator = Validator::make($request->all(), [
             'type' => 'required|string',
            'contents'=>'required|string',
            'exchange_rate'=>'sometimes|required|numeric',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }else{


        Options::create(['type'=> $request->type,
                        'type_ar'=> $request->type,
                         'contents'=>$request->contents,
                         'exchange_rate'=>$request->exchange_rate,
                         'parent_id'=>$user_id,
                         'user_id'=>Auth::user()->id
                                     ]);
        return redirect(route('Options.index'));}
    }

    public function update(Request $request ,$id){
        $user_id = checkPermissionHelper::checkPermission();

        $validator = Validator::make($request->all(), [
            'type' =>'sometimes|required|string',
            'content'=>'sometimes|required|string',
            'exchange_rate'=>'sometimes|required|numeric',


        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }else{

        $options= Options::where('id',$id);
        $options->update(['type'=>$request->type,
            'contents'=>$request->contents,
            'user_id'=>$user_id,
            'exchange_rate'=>$request->exchange_rate]);

        return redirect(route('Options.index'));
        }
    }

    public function destroy($id){
       Options::where('id',$id)->delete();


        return redirect(route('Options.index'));
    }
}
