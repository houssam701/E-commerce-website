<x-layout>
    <section class="view-item-big-container">
        <div class="view-item-container">
        <div class="slider">
            <div class="slides">
                @foreach($product->productImages as $image)
                <div class="slide">
                <img src="{{ asset('storage/'.$image->image_path) }}" alt="Product image">
                </div>
                @endforeach
            </div>
            <button class="prev" onclick="prevSlide()">&#10094;</button>
            <button class="next" onclick="nextSlide()">&#10095;</button>
        </div>
        <div class="view-item-info">
                <h1>{{$product->name}}</h1>
                <hr>
                <h2>Description:</h2>
                <p>{{$product->description}}</p>
                <hr>
                <div class="view-button-container">
                    <p>{{$product->price}}$</p>
                    <form action="" id="myForm">
                    <input type="number"  name="quantity" value="1" id="input-number" min="1" max="100">
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <button type="button" id="submit-item-button" onclick="submitForm(event)">Add To Cart</button>
                    </form>
                </div>    
            </div>
        </div>
    </section>
    <!-- ends of view item -->
    <div class="view-title-container"><h2>Related Products</h2></div>
    <section class="items-big-container">
    <div class="items-container">
        @foreach ($relatedProducts as $product)
            <div class="item">
            <a href="/view/product/{{$product->id}}" title="Quick view"><img src="{{ asset('storage/'.$product->firstImage->image_path) }}" alt="products images!"></a>
            <p id="item-name">{{$product->name}}</p>
            <p id="price">{{$product->price}}$</p>
            </div>
        @endforeach
    </div>
    </section>
    <!-- ends of dipslaying related item -->
    
<script>
let slideIndex = 0;
const slideInterval = 3000; // Set interval time (in milliseconds)
const slides = document.querySelectorAll('.slide');

function showSlide(index) {
  if (index >= slides.length) {
      slideIndex = 0;
  } else if (index < 0) {
      slideIndex = slides.length - 1;
  } else {
      slideIndex = index;
  }
  const offset = -slideIndex * 100; // Adjust based on slide width percentage
  document.querySelector('.slides').style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
  showSlide(slideIndex + 1);
}

function prevSlide() {
  showSlide(slideIndex - 1);
}

// Auto-slide function
function startAutoSlide() {
  setInterval(nextSlide, slideInterval);
}

// Start the auto-slide when the page loads
document.addEventListener('DOMContentLoaded', () => {
  showSlide(slideIndex); // Show the first slide
  startAutoSlide(); // Start auto-slide
});
// ends of slider js
function submitForm(event){
          event.preventDefault();
          const form = document.getElementById('myForm');
          const formData = new FormData(form);

          let options ={
                method: 'POST',
                headers:{
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            };
            fetch('/cart/add',options)
            .then(response=>response.json())
            .then(data => {
              if (data.success === 'success') {
                // alert('Product added to the cart !'); 
                toastr.options ={
                  "progressBar" :true,
                  "closeButton" :true,
                }
                toastr.success("Product added successfully!");
                form.reset(); // Clear the form
            } else {
              alert('Something went wrong: ' + (data.message || 'product not added'));
            }
            })
            .catch(error=> console.log("Error:",error));  
        }
  </script>
</x-layout>