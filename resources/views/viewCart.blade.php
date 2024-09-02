<x-layout>
    <div class="table-container">
        <h1>Your Cart</h1>
        <table class="product-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(session('cart') && count(session('cart')) > 0)

                @foreach(session('cart') as $id => $details)
                <tr>
                    <td>{{ $details['name']}}</td>
                    <td> 
                        <img src="{{ asset('storage/'.$details['image']) }}" alt="" height="60" width="80">
                    </td>
                    <td>{{$details['quantity']}}</td>
                    <td>{{$details['price']*$details['quantity']}}$</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="action-btn">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <!-- Add more rows as needed -->
                @else
                <p>Your cart is empty.</p>
                @endif
            </tbody>
        </table>
        
    </div>  
    <!-- ends of table  -->
    <div class="bill-big-container">
            <div class="bill-container">
            <h3>Cart Total</h3>
            <p><b>Total:</b>     
            @if(session('cart') && count(session('cart')) > 0)
            {{ array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, session('cart'))) }}$
            @else
            0.00$
            @endif
        </p>
            <a href="/checkout" id="proceed-btn">Proceed To Chekout</a>
            </div>
        </div>
    <!-- ends of bill -->
    <script>
    @if(session('remove'))

    toastr.options ={
                "progressBar" :true,
                "closeButton" :true,
                }
                toastr.error("{{ session('remove') }}");    
    @endif

    </script>   
</x-layout>