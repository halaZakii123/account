<?php

namespace App\Http\Controllers;

use App\Helpers\checkPermissionHelper;
use App\Options;
use App\TblAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        return view('Option.crud');
    }

    public function edit($id){
        $option = Options::findOrFail($id);
        $user_id = checkPermissionHelper::checkPermission();
        if ($option->parent_id==$user_id){
        return view('Option.crud',compact('option'));}
        else{
            return  'you do not have permission ';
        }
    }


    public function store(Request $request){
        $user_id = checkPermissionHelper::checkPermission();
        $validator = Validator::make($request->all(), [
             'type' => 'required|string',
            'contents'=>'required|string',

        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        Options::create(['type'=> $request->type,
                         'contents'=>$request->contents,
                         'type_ar'=>'هلا',
                         'contents_ar'=>'cc',
            'exchange_rate'=>'bb',
            'parent_id'=>$user_id,
            'user_id'=>Auth::user()->id
                         ]);
        return redirect(route('Options.index'));
    }

    public function update(Request $request ,$id){
        $user_id = checkPermissionHelper::checkPermission();

        $validator = Validator::make($request->all(), [
            'type' =>'sometimes|required|string',
            'content'=>'sometimes|required|string',

        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }
        $options= Options::where('id',$id);
        $options->update(['type'=>$request->type,
            'contents'=>$request->contents,
            'user_id'=>$user_id]);

        return redirect(route('Options.index'));
    }

    public function destroy($id){
       Options::where('id',$id)->delete();


        return redirect(route('Options.index'));
    }
}