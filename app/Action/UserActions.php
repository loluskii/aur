<?php
namespace App\Action;

use Exception;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserActions
{
    public static function create($request){
        return DB::transaction(function () use ($request) {
            $address =  new Address;
            $address->user_id = Auth::id();
            $address->shipping_fname = $request->shipping_fname ;
            $address->shipping_lname = $request->shipping_lname ;
            $address->shipping_address = $request->shipping_address;
            $address->shipping_city  =$request->shipping_city;
            $address->shipping_state = $request->shipping_state;
            $address->shipping_zipcode = $request->shipping_zipcode;
            $address->shipping_country = $request->shipping_country;
            $address->shipping_phone = $request->shipping_phone;
            $address->save();
            return true;
        });
    }
    
    public static function update($request, $id){
        return DB::transaction(function () use ($request, $id) {
            $address =  Address::findOrFail($id);
            $address->shipping_fname = $request->shipping_fname ?? $address->shipping_fname;
            $address->shipping_lname = $request->shipping_lname ?? $address->shipping_lname;
            $address->shipping_address = $request->shipping_address ?? $address->shipping_address;
            $address->shipping_city  =$request->shipping_city ?? $address->shipping_city;
            $address->shipping_state = $request->shipping_state ?? $address->shipping_state;
            $address->shipping_zipcode = $request->shipping_zipcode ?? $address->shipping_zipcode;
            $address->shipping_country = $request->shipping_country ?? $address->shipping_country;
            $address->update();
            return true;
        });
    }

}
?>
