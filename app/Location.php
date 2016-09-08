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
       'fb_id', 'name', 'street', 'city', 'state', 'zip', 'country', 'email', 'phone', 'website', 'fb_url', 'longitude', 'latitude', 'image'
    ];
}
