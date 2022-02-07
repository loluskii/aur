<?php
namespace App\Action;

use Exception;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductActions
{
    public static function create($request){
        return DB::transaction(function () use ($request) {
            $path = $request->file('image')->storeOnCloudinary('aur2611');
            if($request->has('image')){
                $product = new Product;
                $product->tag_number = mt_rand(1000,9999);
                $product->name = $request->name;
                $product->category_id = $request->category;
                $product->description = $request->description;
                $product->price = $request->unit_price;
                $product->units = $request->units;
                $product->alert_quantity = $request->alert_quantity;
                $imageUrl =  $path->getSecurePath();
                // $imageName = $product->tag_number.'.'.$request->image->extension();  
                // $request->image->move(public_path('images/products'), $imageName);
                $product->image = $imageUrl;
                if($request->has('is_featured')){
                    $product->is_featured = true;
                }
                // if(checkFeaturedCount())
                $product->save();
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
            $path = $request->file('image')->storeOnCloudinary('products');
            $product = Product::findOrFail($id);
            $product->name = $request->name ?? $product->name;
            $product->category_id = $request->category ?? $product->category_id;
            $product->description = $request->description ?? $product->description;
            $product->price = $request->unit_price ?? $product->price;
            $product->units = $request->units ?? $product->units;
            if($request->has('image')){
                $imageUrl =  $path->getSecurePath();
                // $imageName = Str::slug($request['image']).'-'.time().'.'.$request->image->extension();  
                // $request->image->move(public_path('images/products'), $imageName);
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
