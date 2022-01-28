<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    
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
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
