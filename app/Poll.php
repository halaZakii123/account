<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{

    protected $fillable = ['question','status','user_id'];

    public function options()
    {
        return $this->hasMany(OptionPolls::class);
    }
}
