<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Product</title>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
        <link rel="stylesheet" href="{{ asset('admin.css') }}">
    </head>
<body>
    <div class="adding-form-container3">
        @if (session('success'))
        <p>{{session('success')}}</p>
        @endif
        <h2>Edit Existing Product</h2>
        <form action="/editProduct/{{$product->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Product Name</label>
            <input type="text" name="name" placeholder="Product name..." value='{{old("name",$product->name)}}'>
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
            <input type="text" name="price" placeholder="Price in $" value='{{old("price",$product->price)}}'>
            @error('price')
            <p style="color: red">{{$message}}</p>
            @enderror
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" min="1" max="250" value='{{old("quantity",$product->quantity)}}'> 
            @error('quantity')
            <p style="color: red">{{$message}}</p>
            @enderror
            <label for="description">Description</label>
            <textarea name="description" id="" cols="10" rows="8" style="color: black;" placeholder="Description of the product...">{{old("description",$product->description)}}</textarea>
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
            <input type="submit" value="Edit" id="sumbit-product-form" style="color: white">
            <p>Note: If you dont want to edit the image ,leave the input image empty!</p>
        </form>
     </div>
</body> 
</html>
