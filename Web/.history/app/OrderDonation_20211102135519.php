<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDonation extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'donor_id',
        'total_order',
        'order_date',
    ];

    public function donor() {
        return $this->belongsTo(user::class, 'donor_id');
    }
}
