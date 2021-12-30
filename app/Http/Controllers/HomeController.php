<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\checkPermissionHelper;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = checkPermissionHelper::checkPermission();
        
        $nums = DB::select("CALL PR_userAccounts(".$user_id.")");
        $userAccount = count($nums);
        
        $users = DB::select("CALL pr_users(".$user_id.")");
        $user_num = count($users);

        $mains = DB::select("CALL pr_userMains(".$user_id.")");
        $main_num = count($mains);

        return view('home' ,compact('userAccount','user_num','main_num'));
    }
}
