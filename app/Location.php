<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
            'type',
            'location_name',
            'address',
            'state_code',
    ];

    /**
     * The items at this location
     *
     */
public function location_items()
    {
        return $this->hasMany('App\LocationItem');
    }
}
