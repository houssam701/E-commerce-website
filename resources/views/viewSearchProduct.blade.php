<x-layout>
    <section class="product-container" style="margin-top:100px">
        @if($products->isEmpty())
        <p>No products available at the moment.</p>
        @else
        @foreach ($products as $product)
        <div class="item">
        <a href="/view/product/{{$product->id}}" title="Quick view"><img src="{{ asset('storage/'.$product->firstImage->image_path) }}" alt="products images!"></a>
        <p id="item-name">{{$product->name}}</p>
        <p id="price">{{$product->price}}$</p>
        </div>
        @endforeach
        @endif
    </section>
</x-layout>