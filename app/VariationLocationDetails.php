<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VariationLocationDetails extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
         protected $table = 'variation_location_details'; // if not default
    protected $guarded = ['id'];
}
