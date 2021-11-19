<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class OptionPolls extends Model
{

    protected $fillable = ['name','votes','poll_id'];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
