<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receiver_id',
        'total_order',
        'order_date',
        'location',
    ];

    public function donor() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function orderItems() {
        return $this->belongsTo(OrderRequestItem::class);
    }

}
