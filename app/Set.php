<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable = [
        'key','value','user_id','parent_id'
    ];


    /**
     * Get the account that owns the Set
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(TblAccount::class, 'value', 'account_number');
    }
}
