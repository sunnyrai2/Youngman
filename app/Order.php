<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
            'quotation_id',
            'quickbooks_id',
            'job_order',
            'po_no',
            'place_of_supply',
            'security_etter',
            'rental_advance',
            'rental_order',
            'security_cheque',
            'security_amt',
    ];

    /**
     * The items in this quotation
     *
     */
    public function quotation()
    {
        return $this->hasOne('App\Quotation');
    }

    /**
     * The items in this quotation
     *
     */
    public function challan()
    {
        return $this->hasMany('App\Challan');
    }
}
