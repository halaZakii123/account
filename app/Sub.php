<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    protected $fillable = [
        'debit','credit','account_number','explained','main_id'
    ];

    public function main(){
        return $this->belongsTo(Main::class);
    }
}
