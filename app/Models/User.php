<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'zip',
        'country',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function orders(){
        return $this->hasMany(Order::class);
    }
    
    public function newsletter(){
        return $this->hasMany(Newsletter::class);
    }
    
    public function getFullName(){
        return ucfirst($this->fname) . ' ' . ucfirst($this->lname);
    }
    
    public function getFullAddress(){
        $address = Address::firstWhere('user_id',$this->id);
        if($address){
            return $address->shipping_address.', '.$address->shipping_city.', '.$address->shipping_state.', '.$address->shipping_country;
        }else{
            return null;
        }
    }
    
    public function getOrders(){
        return Order::where('user_id', $this->id)->get();
    }
    
    // public function getUserAddress(){
    //     return 
    // }

}
