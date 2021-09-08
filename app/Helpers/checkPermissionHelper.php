<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Auth;

class checkPermissionHelper
{
    public static function checkPermission(){
        if ( Auth::user()->parent_id == null)
            $user_id =Auth::user()->id;
        else
            $user_id= Auth::user()->parent_id;
        return$user_id;
    }
}
