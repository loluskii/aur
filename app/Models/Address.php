<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';
    protected $fillable = [
        'shipping_fname',
        'shipping_lname',
        'shipping_address',
        'shipping_landmark',
        'shipping_city',
        'shipping_state',
        'shipping_zipcode',
        'shipping_phone',
    ];
    
}
