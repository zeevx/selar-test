<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function merchant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'id','merchant_id');
    }
}
