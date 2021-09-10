<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $fillable = [
        'type','contents','user_id','parent_id','exchange_rate'
    ];
}
