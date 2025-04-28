<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSerial extends Model
{
    protected $fillable = [
        'product_id',
        'variation_id',
        'serial_no',
    ];
}
