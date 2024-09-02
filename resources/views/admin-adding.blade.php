<x-admin-layout>
    <div class="adding-form-container">
        
        <form action="/addingProduct" method="post" enctype="multipart/form-data">
            @csrf
            @if (session('success'))
            <p style="align-self: center">{{session('success')}}</p>
            @endif
            <h2 style="align-self: center">Adding Product</h2>
            <label for="name">Product Name</label>
            <input type="text" name="name" placeholder="Product name...">
            @error('name')
            <p style="color: red">{{$message}}</p>
            @enderror
            <label for="type_id">Product Type</label>
            <select id="type_id" name="type_id" required>
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>            
            @error('type_id')
            <p style="color: red">{{$message}}</p>
            @enderror
            <label for="price">Price</label>
            <input type="text" name="price" placeholder="Price in $">
            @error('price')
            <p style="color: red">{{$message}}</p>
            @enderror
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" min="1" max="250" value="1">
            @error('quantity')
            <p style="color: red">{{$message}}</p>
            @enderror
            <label for="description">Description</label>
            <textarea name="description" id="" cols="10" rows="8" style="color: black;" placeholder="Description of the product..."></textarea>
            @error('description')
            <p style="color: red">{{$message}}</p>
            @enderror
            <label for="images[]">Image Of Product</label>
            <input type="file" name="images[]" multiple>
            @error('images')
            <p style="color: red">{{ $message }}</p>
            @enderror
            @error('images.*')
            <p style="color: red">{{ $message }}</p>
            @enderror
            <input type="submit" value="Add" id="sumbit-product-form" style="color: white">
        </form>
        <div class="container-type">
        <form action="/adding/type" method="POST" class="second-form" enctype="multipart/form-data">
            @csrf
            @if (session('successs'))
            <p style="align-self: center">{{session('successs')}}</p>
            @endif
            <h2 style="align-self: center">Adding Type</h2>
            <label for="name">Type Name:</label>
            <input type="text" id="name" name="name" placeholder="add a parent type for products..." required>
            <label for="imge">Type Image:</label>
            <input type="file" name="image">
            <input type="submit" id="sumbit-product-form" value="Add Type">
        </form>
        <div class="cont-types-table">
            <h2 style="margin:10px">Types:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Types</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>    
                </thead>
                <tbody>
                    @foreach($types as $type)
                        <tr type-id={{$type->id}}>
                            <td>{{$type->name}}</td>
                            <td><img src="{{ asset('storage/'.$type->image_path) }}" alt="" height="60" width="80"></td>
                            <td class="action-buttons">
                                <button class="delete" onclick="deleteType({{$type->id}})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
       
     </div>
            
     <!-- ends of form -->
     
</x-layout>