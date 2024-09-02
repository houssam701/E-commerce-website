<x-admin-layout>
    <div class="h2-cont">
        <h2>Product info:</h2>
        <form action="/search/product" method="POST">
        @csrf
        <input type="search" name="query" placeholder="search here..." required>
        <button type="submit">Search</button>
        </form>
        </div>
        {{-- ends of form --}}
    <div class="table-container2" >
        
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Image of Product</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr product-id={{$product->id}}>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}$</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        @foreach($product->productImages as $image)
                        <img src="{{ asset('storage/'.$image->image_path) }}" alt="" height="60" width="80">
                        @endforeach
                    </td>
                    <td>{{$product->type->name}}</td>
                    <td class="action-buttons">
                        <a href="/admin/edit/product/{{$product->id}}"><button class="done">Edit</button></a> 
                        <button class="delete" onclick="deleteProduct(event,{{$product->id}})">Delete</button>
                    </td>
                </tr>
                @endforeach
                <!-- More rows as needed -->
            </tbody>
        </table>
    </div>
    <script>
        @if(session('successEdit'))
        toastr.options ={
                    "progressBar" :true,
                    "closeButton" :true,
                    }
                    toastr.info("{{ session('successEdit') }}");    
        @endif
    </script>
</x-admin-layout>