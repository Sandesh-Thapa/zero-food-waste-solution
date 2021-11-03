<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'expiry_period',
        'exp_min',
        'exp_max',
        'exp_unit',
        'status',
        'storage',
    ];
}
