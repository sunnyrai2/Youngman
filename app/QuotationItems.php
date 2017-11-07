<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationItems extends Model
{

    public $table = "quotation_items";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quotation_id', 'item_code', 'unit_price', 'quantity',
    ];
}
