<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    protected $fillable = [
        'operation_date','explained','type_of_operation','currency_symbol','exchange_rate'
    ];

    public  function subs(){
        return $this->hasMany(Sub::class);
    }
}
