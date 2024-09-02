<?php

namespace App\Http\Controllers;

use App\Events\Noti;
use App\Models\Order;
use App\Events\OrderPlaced;
use App\Events\ProductAdded;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function showCheckOut()
    {
        if (!session()->has('cart') || count(session('cart')) == 0) {
            // Redirect to the products page or cart page with a message
            return redirect('/home')->with('warning', 'Your cart is empty. Please add items before checking out.');
        }
        $cart = session()->get('cart');
        return view('checkout', compact('cart'));
    }
    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $order = new Order();
        $order->name = strip_tags($request->name);
        $order->region = strip_tags($request->region);
        $order->city = strip_tags($request->city);
        $order->address = strip_tags($request->street);
        $order->phone = strip_tags( $request->phone);
        $order->save();

        $cart = session()->get('cart');

        foreach ($cart as $id => $details) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $id;
            $orderProduct->quantity = $details['quantity'];
            $orderProduct->price = $details['price'];
            $orderProduct->save();
        }
        event(new ProductAdded($order));
        session()->forget('cart');
        
        return redirect('/home')->with('success', 'Order placed successfully!');
    }
    
}