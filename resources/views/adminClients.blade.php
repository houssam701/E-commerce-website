<x-admin-layout>

    <div class="welcome-container">
    <h1>Welcome Admin</h1>
    </div>
    <div class="table-container2">
        <h2>ORDERS INFORMATION :</h2>
        <table id="orders-table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Region</th>
                    <th>City</th>
                    <th>Street</th>
                    <th>Phone</th>
                    <th>Shopping Product</th>
                    <th>Date of Order</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr order-id="{{$order->id}}">
                    <td>{{ $order->name }}</td>
                    <td>{{$order->region}}</td>
                    <td>{{$order->city}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->phone}}</td>
                    <td><ul style="list-style-type: none;">
                        @foreach($order->orderProducts as $orderProduct)
                        <li>{{$orderProduct->product->name}} // Quantity: {{$orderProduct->quantity}}</li>
                        @endforeach
                        </ul></td>
                        <td>{{ $order->created_at->format('F d, Y \a\t h:i A') }}</td>
                    <td class="action-buttons">
                        <button class="done" onclick="doneOrder({{$order->id}})">Done</button>
                        <button class="delete" onclick="deleteOrder({{$order->id}})">Delete</button>
                    </td>
                </tr>
                @endforeach

                <!-- More rows as needed -->
            </tbody>
        </table>
    </div>
    <script>

document.addEventListener("DOMContentLoaded", function() {
    window.Echo.channel('modern-juice-75')
        .listen('ProductAdded', (e) => {

            toastr.options ={
            "progressBar" :true,
            "closeButton" :true,
            }
            toastr.success("New Order has been uploaded!"); 


            let order = e.order;
            let productsList = '';

            // Accessing order_products instead of orderProducts
            order.order_products.forEach(function(orderProduct) {
                productsList += `<li>${orderProduct.product.name} // Quantity: ${orderProduct.quantity}</li>`;
            });

            let row = `
                <tr order-id="${order.id}">
                    <td>${order.name}</td>
                    <td>${order.region}</td>
                    <td>${order.city}</td>
                    <td>${order.address}</td>
                    <td>${order.phone}</td>
                    <td><ul style="list-style-type: none;">${productsList}</ul></td>
                    <td>${new Date(order.created_at).toLocaleString('en-US', { month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true })}</td>
                    <td class="action-buttons">
                        <button class="done" onclick="doneOrder(${order.id})">Done</button>
                        <button class="delete" onclick="deleteOrder(${order.id})">Delete</button>
                    </td>
                </tr>`;
                
            document.getElementById('orders-table').innerHTML += row;
        });
});
@if(session('success'))

toastr.options ={
            "progressBar" :true,
            "closeButton" :true,
            }
            toastr.success("{{ session('success') }}");    
@endif

    </script>
</x-admin-layout>