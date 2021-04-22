<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {   
        $code = 'TRX' . mt_rand(0000000,999999);
        $carts = Cart::with(['product'])->get();

        $transaction = Transaction::create([
            'total_price' => $request->total_price,
            'code' => $code,
            // 'total_order' => $carts->quantity_order  
        ]);

        foreach ($carts as $cart) {

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
            ]);
        }

        Cart::with(['product'])->delete();

        return redirect()->route('success');
    }

    public function success()
    {
        return view('pages.kasir.success');
    }
}
