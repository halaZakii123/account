<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    protected $fillable = [
        'operation_date','explained','type_of_operation','currency_symbol','exchange_rate','user_id','parent_id','explained_ar','document_number','cash_id'
    ];

    public  function subs(){
        return $this->hasMany(Sub::class);
    }


}
