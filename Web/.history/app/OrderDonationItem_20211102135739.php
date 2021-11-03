<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDonationItem extends Model
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
        'quantity',
    ];

     public function orderRequest() {
        return $this->belongsTo(OrderRequest::class, 'order_id');
    }
}
