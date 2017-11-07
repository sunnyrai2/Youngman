<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
            'created_by',
            'customer_id',
            'contact_name',
            'total',
            'freight',
            'billing_address_line',
            'billing_address_city',
            'billing_address_pincode',
            'delivery_address_line',
            'delivery_address_city',
            'delivery_address_pincode',
            'delivery_date',
            'pickup_date',
    ];

    /**
     * The items in this quotation
     *
     */
public function quotation_items()
    {
        return $this->hasMany('App\QuotationItems');
    }



}
