<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationItem extends Model
{
     public $table = "location_items";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_name', 'item_code', 'ok_quantity', 'damaged_quantity','missing_quantity',
    ];
}
