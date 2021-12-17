<?php

namespace App\Imports;

use App\TblAccount;
use Maatwebsite\Excel\Concerns\ToModel;

use Illuminate\Support\Facades\Auth;
use App\Helpers\checkPermissionHelper;
class AccountImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user_id = checkPermissionHelper::checkPermission();
        
        return new TblAccount([
            'account_number'     => $row[0],
            'account_name'    => $row[1],
            'master_account_number' => $row[2],
             'report' =>$row[3],
             'mainly' =>$row[4],
             'user_id'=>Auth::user()->id,
             'parent_id'=>$user_id
             

        ]);
    }
}
