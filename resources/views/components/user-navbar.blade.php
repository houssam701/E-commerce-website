<nav class="nav">
    <i class="uil uil-bars navOpenBtn"></i>
    <div href="#" class="logo"> 
        <img src="storage\logo\techspot-high-resolution-logo-transparent (1).png" width="150px" height="40px" alt="logo">
    </div>
    <ul class="nav-links">
    <i class="uil uil-times navCloseBtn"></i>
    <li><a href="/home">Home</a></li>
    <li><a href="/cart">Your Cart</a></li>
    <li> <a id="cart-num">
        @if(session('cart') && count(session('cart')) > 0)
        {{count(session('cart'))}}
        @else
        0
        @endif</a>
    </li>
    <li> <a href="/cart"> @if(session('cart') && count(session('cart')) > 0)
        {{ array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, session('cart'))) }}$
        @else
        0.00$
        @endif 
        </a>
        </li>    
    </ul>
    <i class="uil uil-search search-icon" id="searchIcon"></i>
    <form class="search-box" action="/product/search" method="POST">
    @csrf   
    <i class="uil uil-search search-icon" id="search-icon"></i>
    <input type="text" name="query" style="color: black" placeholder="Search here..." />
    </form>
</nav>