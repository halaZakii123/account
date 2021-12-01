<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    
    protected $dates = ['duedate'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
