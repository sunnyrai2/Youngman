<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
            'pickup_location',
            'delivery_location',
            'challan_type',
            'order_id',
            'amount',
    ];

    /**
     * The order for which this challan has been made
     *
     */
    public function order()
    {
        return $this->hasOne('App\Order');
    }

    /**
     * The items in this challan
     *
     */
    public function challanItems()
    {
        return $this->hasMany('App\ChallanItems');
    }

    /**
     * The items fullfilled by this challan
     *
     */
    public function challanOrderItems()
    {
        return $this->hasMany('App\ChallanOrderItem');
    }
}
