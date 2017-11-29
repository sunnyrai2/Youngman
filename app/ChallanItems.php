<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChallanItems extends Model
{
    public $table = "challan_items";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'challan_id', 'item_code', 'ok_quantity', 'unit_price', 'total_price'
    ];
}
