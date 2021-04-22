<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::paginate(32);
        return view('pages.kasir.products', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function categoryDetail(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('categories_id', $category->id)->paginate(32);
        
        return view('pages.kasir.products', [
            'categories' => $categories,
            'products' => $products
        ]);
    }


    public function order(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();

            $data = [
                'products_id' => $id,
                'quantity_order' => $request->quantity_order,
                'total_price' => $product->price*$request->quantity_order
            ];
    
            Cart::create($data);

       
        

        return redirect()->route('product-kasir');
    }


}
