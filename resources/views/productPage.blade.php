<x-layout>
    <section class="product-name-container">
        <h1>{{$typeName}}</h1>
    </section>
    <section class="product-container">
        @if($relatedProducts->isEmpty())
        <p>No products available at the moment.</p>
        @else
        @foreach ($relatedProducts as $product)
        <div class="item">
        <a href="/view/product/{{$product->id}}" title="Quick view"><img src="{{ asset('storage/'.$product->firstImage->image_path) }}" alt="products images!"></a>
        <p id="item-name">{{$product->name}}</p>
        <p id="price">{{$product->price}}$</p>
        </div>
        @endforeach
        @endif
    </section>
</x-layout>