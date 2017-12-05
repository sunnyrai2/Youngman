<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
            'first_name',
            'last_name',
            'company',
            'email',
            'phone',
            'credit_limit',
            'billing_address_line',
            'billing_address_city',
            'billing_address_pincode',
            'mailing_address_line',
            'mailing_address_city',
            'mailing_address_pincode',
            'gstn',
            'security_etter',
            'rental_advance',
            'rental_order',
            'security_cheque',

    ];


    /**
     * The orders for this customer
     *
     */
    public function challanOrderItems()
    {
        return $this->hasMany('App\Order');
    }

}
