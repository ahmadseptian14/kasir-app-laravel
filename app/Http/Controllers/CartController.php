<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // public function index()
    // {
    //     $carts = Cart::with(['product'])->get();

    //     return view('layouts.kasir', [
    //         'carts' => $carts
    //     ]);
    // }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
 
        $cart->delete();
 
        return redirect()->route('product-kasir');
    }
}
