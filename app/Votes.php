<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{

    protected $fillable = [
        'user_id', 'option_id','question_id'
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
