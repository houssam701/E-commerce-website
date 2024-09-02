<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $validated =    $request->validate([
            'id' => 'required',
            'quantity' => 'required'
        ]);

        $product = Product::findOrFail($validated['id']);
        $cart = session()->get('cart', []);
        if (isset($cart[$validated['id']])) {
                $cart[$validated['id']]['quantity']++;
            } else {
            $cart[$validated['id']] = [
                "name" => $product->name,
                "quantity" =>$validated['quantity'],
                "price" => $product->price,
                "image" => $product->firstImage->image_path
            ];
        }
        session()->put('cart', $cart);
        return response()->json(['success' => 'success']);
    }
    public function show()
    {
        $cart = session()->get('cart');
        return view('viewCart', compact('cart'));
    }
    public function remove($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('remove',"Product has been removed from cart!");
    }
}   