<?php
namespace App\Action;

use Exception;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductActions
{
    public static function create($request){
        return DB::transaction(function () use ($request) {
            $product = new Product;
            $product->tag_number = mt_rand(1000,9999);
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->description = $request->description;
            $product->price = $request->unit_price;
            $product->units = $request->units;
            $product->alert_quantity = $request->alert_quantity;
            
            
            
            if($request->has('is_featured')){
                $product->is_featured = true;
            }
            $product->save();
            if($request->has('image')){
                foreach ($request->file('image') as $imagefile){                
                    $path = $imagefile->storeOnCloudinary($product->tag_number);
                    $imageUrl =  $path->getSecurePath();
                    $image = new ProductImage;
                    $image->product_id = $product->id;
                    $image->image_url = $imageUrl;
                    $image->save();
                }
                return true;
            }else{
                return false;
            }
        });
    }
    
    public static function checkFeaturedCount(){
        $featured_products = Product::where('is_featured',true)->count();
        if($featured_products > 4){
            return false;
        }else{
            return true;
        }
    }

    public static function update($request, $id){
        return DB::transaction(function () use ($request, $id) {
            $product = Product::findOrFail($id);
            $product->name = $request->name ?? $product->name;
            $product->category_id = $request->category ?? $product->category_id;
            $product->description = $request->description ?? $product->description;
            $product->price = $request->unit_price ?? $product->price;
            $product->units = $request->units ?? $product->units;
            if($request->has('image')){
                $path = $request->file('image')->storeOnCloudinary('products');
                $imageUrl =  $path->getSecurePath();
                $product->image = $imageUrl;
            }else{
                $product->image = $product->image;
            }
            $product->update();
            return true;
        });
    }

}
?>
