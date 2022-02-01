<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));

    }

    public function create(){
        return view('admin.products.create');
    }

    public function store(Request $request){
        // dd($request);
        try{
            // $request->validated();
            $store = (new StoreProduct())->run($request);
            if($store){
                return back()->with(
                    'success',
                    'Product added successfully'
                );
            }else{
                return back()->with('error','Please add an image!');
            }
        }catch(\Exception $e){
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function updateProduct(Request $request, $id){
        try{
            DB::beginTransaction();
                $product = Product::find($id);
                $product->name = $request->product_name ?? $product->name;
                $product->price = $request->price ?? $product->price;
                $product->category_id = $request->category ?? $product->category_id;
                if($request->file()){
                    $path = cloudinary()->upload($request->file('featured_image')->getRealPath())->getSecurePath();

                    $product->cover_img = $path;
                }else{
                    $product->cover_img = $product->cover_img;
                }

                $product->save();
            DB::commit();

            return back()->with(
                'success',
                'Product updated successfully'
            );

        }catch(\Exception $e){
            return back()->with(
                'error',
                $e->getMessage()
            );
        }

    }

    public function updateCategory(Request $request, $id){
        try{
            DB::beginTransaction();
                $category = Category::find($id);
                $category->name = $request->name ?? $category->name;
                $category->description = $request->desc ?? $category->description;
                $category->save();
            DB::commit();

            return back()->with(
                'success',
                'Category updated successfully'
            );

        }catch(\Exception $e){
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function viewCategory($id){
        $category = Category::find($id);
        $products = Product::where('category_id', $id)->get();
        return view('admin.category.show')->with('products', $products)->with('category', $category);
    }

    public function makeCategory(){
        $categories = Category::all();
        return view('admin.category.index')->with('categories',$categories);
    }

    public function addCategory(Request $request){
        try{
            $category = new Category;
            $category->name = $request->name;
            $category->slug = Str::random(8);
            $category->description = $request->desc;
            $category->save();

            return back()->with('success', 'Category added successfully');
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteCategory(Category $id){
        $id->delete();
        return redirect()->route('admin.category.view')->with('success', 'Category Deleted');
    }

    public function deleteProduct(Product $id){
        $id->delete();
        return back()->with('success','Deleted successfully');
    }

}
