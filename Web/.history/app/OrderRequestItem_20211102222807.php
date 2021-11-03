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

    public function orderRequest() {
        return $this->hasMany(OrderRequest::class, 'order_id');
    }

    public function orderItem() {
        return $this->hasOne(OrderItem::class, 'id', 'item_id');
    }


}
