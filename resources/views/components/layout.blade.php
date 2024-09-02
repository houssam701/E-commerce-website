<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home Page</title>
    <link rel="icon" href="/storage/logo/edited-logo.png" type="image/x-icon">

</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <x-user-navbar/>
    
    {{$slot}}

    <x-footer/>
    <script>
        document.getElementById('search-icon').addEventListener('click', function() {
        document.querySelector('.search-box').submit();
    });
        const nav = document.querySelector(".nav"),
        searchIcon = document.querySelector("#searchIcon"),
        navOpenBtn = document.querySelector(".navOpenBtn"),
        navCloseBtn = document.querySelector(".navCloseBtn");
        
        searchIcon.addEventListener("click", () => {
        nav.classList.toggle("openSearch");
        nav.classList.remove("openNav");
        if (nav.classList.contains("openSearch")) {
            return searchIcon.classList.replace("uil-search", "uil-times");
        }
        searchIcon.classList.replace("uil-times", "uil-search");
        });
        
        navOpenBtn.addEventListener("click", () => {
        nav.classList.add("openNav");
        nav.classList.remove("openSearch");
        searchIcon.classList.replace("uil-times", "uil-search");
        });
        navCloseBtn.addEventListener("click", () => {
        nav.classList.remove("openNav");
        });
        // ends of nav js
        document.addEventListener('DOMContentLoaded', () => {
        const sliderWrapper = document.querySelector('.slider-wrapper');
        const sliderItems = document.querySelectorAll('.slider-item');
        const leftArrow = document.querySelector('.left-arrow');
        const rightArrow = document.querySelector('.right-arrow');
        let currentIndex = 0;
        const itemsCount = sliderItems.length;
        let itemWidth;
        let containerWidth;
        let maxTranslate;
    
        function calculateWidths() {
        itemWidth = sliderItems[0].clientWidth;
        containerWidth = document.querySelector('.slider-container').clientWidth;
          maxTranslate = itemWidth * itemsCount - containerWidth;
        }
    
        function updateSlider() {
        calculateWidths();
          let newTranslate = currentIndex * itemWidth;
    
          // Ensure the translate value doesn't exceed the maximum allowed value
        if (newTranslate > maxTranslate) {
            newTranslate = maxTranslate;
        }
    
        sliderWrapper.style.transform = `translateX(-${newTranslate}px)`;
        }
    
        leftArrow.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
        }
        updateSlider();
        });
    
        rightArrow.addEventListener('click', () => {
        if (currentIndex < itemsCount - Math.ceil(containerWidth / itemWidth)) {
            currentIndex++;
        }
        updateSlider();
        });
    
        window.addEventListener('resize', () => {
        updateSlider();
        });
    
        // Initialize slider
        calculateWidths();
        updateSlider();
        });
      // ends of slider js

    </script>
</body>
</html>