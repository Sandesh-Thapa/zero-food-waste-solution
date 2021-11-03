<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderRequestItem extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'order_item_id',
        'item_id',
    ];

     public function donor() {
        return $this->belongsTo(User::class, 'receiver_id');
    }


}
