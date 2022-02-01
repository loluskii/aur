<?php
namespace App\Actions;

use Exception;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StoreProduct
{
    public static function run($request){
        if($request->file()) {
            DB::beginTransaction();
                $path = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();

                $product = new Product;
                $product->tag_number = mt_rand(1000,9999);
                $product->name = $request->product_name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->category_id = $request->category;
                $product->image = $path;
                $product->type = $request->type;
                $product->units = $request->units;
                $product->save();                
            DB::commit();

            return true;
        }else{
            return false;
        }
    }

}
?>
