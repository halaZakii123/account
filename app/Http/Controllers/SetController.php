 <?php

namespace App\Http\Controllers;

use App\Helpers\checkPermissionHelper;
use App\Set;
use App\TblAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

class SetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user_id = checkPermissionHelper::checkPermission();
        $sets = Set::where('parent_id',$user_id)->get();
        $accounts = TblAccount::where('parent_id',$user_id)->where('mainly',0)->get();
        return view('Set.index',compact('sets','accounts'));
    }
    public function create(){
        $user_id = checkPermissionHelper::checkPermission();
        $account_numbers = DB::table('tbl_accounts')->where('parent_id',$user_id)
<<<<<<< HEAD
            ->where('mainly',1)
            ->pluck('account_number');
=======
            ->where('mainly',0)->get();


>>>>>>> 71d2600e1d03320fa354aea0d0767bcf684ef50e
        return view('Set.crud',compact('account_numbers'));
    }

    public function edit($id){
        $set = Set::findOrFail($id);
        $user_id = checkPermissionHelper::checkPermission();
        $account_numbers = DB::table('tbl_accounts')->where('parent_id',$user_id)
<<<<<<< HEAD
            ->where('mainly',1)
            ->pluck('account_number');
=======
            ->where('mainly',0)->get();
>>>>>>> 71d2600e1d03320fa354aea0d0767bcf684ef50e

        if ($set->parent_id==$user_id){
            return view('Set.crud',compact('set','account_numbers'));}
        else{
            return  'you do not have permission ';
        }
    }


    public function store(Request $request){
        $user_id = checkPermissionHelper::checkPermission();
        $validator = Validator::make($request->all(), [
            'key' => 'required|string',
            'value'=>'required|string',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        Set::create(['key'=> $request->key,
            'value'=>$request->value,
            'parent_id'=>$user_id,
            'user_id'=>Auth::user()->id
        ]);
        return redirect(route('Sets.index'));
    }

    public function update(Request $request ,$id){
        $user_id = checkPermissionHelper::checkPermission();

        $validator = Validator::make($request->all(), [
            'key' =>'sometimes|required|string',
            'value'=>'sometimes|required|string',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }
        $set= Set::where('id',$id);
        $set->update(['key'=>$request->key,
            'value'=>$request->value,
            'user_id'=>$user_id]
            );

        return redirect(route('Sets.index'));
    }

    public function destroy($id){
        Set::where('id',$id)->delete();


        return redirect(route('Sets.index'));
    }
}
