<x-layout>
    <section class="checkout-container">
        <p id="num-1">1</p>
        <h1 id="title-1">Check Your Order</h1>
        <div class="procedure1">
            <div class="pro-1">
                <p> <b>PRODUCT</b> </p>
                <p> <b>PRICE</b> </p>
            </div>
            @foreach(session('cart') as $id => $details)
            <div class="pro-1">
                <p>{{ $details['name'] }}</p>
                <p>{{ $details['price'] * $details['quantity'] }}$</p>
            </div>
            @endforeach
            <div class="pro-1">
                <p><b>TOTAL</b></p>
                <p>{{ array_sum(array_map(function($item) {
                    return $item['price'] * $item['quantity'];
                }, session('cart'))) }}$</p>
            </div>


        </div>
        <p id="num-1" style="margin-top: 20px;">2</p>
        <h1 id="title-1">Billing Details</h1>
        <div class="form-container">
            <form action="/checkout" method="POST">
                @csrf

                <label for="name">Full Name</label>
                <input type="text" name="name" placeholder="Your Full Name">

                <label for="region">Region / Country</label>
                <select name="region" id="">
                    <option value="Lebanon">Lebanon</option>
                    <option value="Canada">Canada</option>
                </select>

                <label for="city">City</label>
                <input type="text" name="city">

                <label for="street">Street / Details</label>
                <input type="text" name="street">

                <label for="phone">Phone Number</label>
                <input type="text" name="phone" placeholder="your phone number">

                <input type="submit" value="submit" style="color: black;" id="submit-checkout-btn">
            </form>
        </div>
    </section>
</x-layout>