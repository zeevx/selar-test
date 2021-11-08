<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Started Here

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class, 'merchant_id', 'id');
    }

    public function purchases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Purchase::class, 'merchant_id', 'id');
    }

    public function scopeNewMerchants($query, $from, $to)
    {
        return $query->whereHas('products',function ($products) use ($from, $to)
        {
            $products->whereBetween('created_at', [$from, $to]);
        },'=', 1)->get();
    }

    public function scopeUniqueMerchants($query, $from, $to)
    {
        return $query->whereHas('products',function ($products) use ($from, $to)
        {
            $products->whereBetween('created_at', [$from, $to]);
        },'>', 0)->get();
    }

    public function scopeNewSellers($query, $from, $to)
    {
        return $query->whereHas('purchases',function ($products) use ($from, $to)
        {
            $products->whereBetween('created_at', [$from, $to]);
        },'=', 1)->get();
    }

    public function scopeUniqueSellers($query, $from, $to)
    {
        return $query->whereHas('purchases',function ($products) use ($from, $to)
        {
            $products->whereBetween('created_at', [$from, $to]);
        },'>', 0)->get();
    }
}
