<x-layout>
    <section class="post-pic-container">
        <h1 style="font-size: xxx-large">Find your perfect gadget</h1>
    </section>
    <!-- ends of welcome image // post -->
    <section class="slider-container">
      <div class="slider-wrapper">
        <!-- items: -->
        @foreach ($types as $type)
            <div class="slider-item">
            <a href="/view/products/{{$type->id}}" ><img src="{{ asset('storage/'.$type->image_path) }}" alt="Vape"></a> 
            <p>{{$type->name}}</p>
            </div>
        @endforeach
        
        
        </div>
      <!-- Add more items as needed -->
      </div>
      <button class="slider-arrow left-arrow">&#10094;</button>
      <button class="slider-arrow right-arrow">&#10095;</button>
    </section>
    <!-- ends of first slider -->
    <section class="video-section">
      <video autoplay muted loop>
        
        <source src="{{ Storage::url($video->video) }}" type="video/mp4">
          Your browser does not support the video tag.        
      
      </video>
    </section>
    <!-- ends of video section -->
    <section class="items-big-container">
        <div class="items-container">
            @foreach ($products as $product)
            <div class="item">
            <a href="/view/product/{{$product->id}}" title="Quick view"><img src="{{ asset('storage/'.$product->firstImage->image_path) }}" alt="products images!"></a>
            <p id="item-name">{{$product->name}}</p>
            <p id="price">{{$product->price}}$</p>
            </div>
            @endforeach
        <!-- add more -->
        </div>
    </section>
    <script>
      @if(session('success'))

toastr.options ={
            "progressBar" :true,
            "closeButton" :true,
            }
            toastr.success("{{ session('success') }}");    
@endif
@if(session('warning'))

toastr.options ={
            "progressBar" :true,
            "closeButton" :true,
            }
            toastr.error("{{ session('warning') }}");    
@endif
    </script>
</x-layout>