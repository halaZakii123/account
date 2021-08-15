<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblAccount extends Model
{

    protected $fillable = [
        'account_number', 'account_name', 'master_account_number','report','mainly',
    ];

    protected $casts = [
        'mainly' => 'boolean',
    ];
}
