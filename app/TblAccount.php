<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblAccount extends Model
{

    protected $fillable = [
        'account_number', 'account_name', 'master_account_number', 'report', 'mainly','user_id','parent_id','account_name_ar'
    ];

    protected $casts = [
        'mainly' => 'boolean',
    ];

}
