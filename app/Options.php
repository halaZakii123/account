<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $fillable = [
        'type','type_ar','contents','user_id','parent_id','contents_ar','exchange_rate'
    ];
}
