<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="{{ asset('admin.css') }}">
    <link rel="icon" href="/storage/logo/edited-logo.png" type="image/x-icon">

    @vite('resources/js/app.js')
</head>
<body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <x-admin-navbar/>
  
    {{$slot}}



    <script>
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
        function deleteProduct(event,ProductId){
          event.preventDefault();
          let options ={
                method: 'POST',
                headers:{
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                body: JSON.stringify({product: ProductId})
            };
            fetch('/product/delete',options)
            .then(response=>response.json())
            .then(data => {

              if (data.message === 'Product deleted successfully.') {
                toastr.options ={
                "progressBar" :true,
                "closeButton" :true,
                }
                toastr.error(data.message);  
                document.querySelector('[product-id="' + ProductId + '"]').remove();
            } else {
                alert('Product could not be deleted!');
            }
            })
            .catch(error=> console.log("Error:",error));  
        }
        // ends of delete product 
        function deleteType(typeId){
          // event.preventDefault();
          let options ={
                method: 'POST',
                headers:{
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                body: JSON.stringify({type: typeId})
            };
            fetch('/type/delete',options)
            .then(response=>response.json())
            .then(data => {

              if (data.message === 'Type deleted successfully.') {
                  toastr.options ={
                  "progressBar" :true,
                  "closeButton" :true,
                  }
                  toastr.error(data.message);                 
                document.querySelector('[type-id="' + typeId + '"]').remove();
                window.location.reload();

            } else {
                alert('Type could not be deleted!');
            }
            })
            .catch(error=> console.log("Error:",error));  
        }
        function deleteOrder(orderId){
          // event.preventDefault();
          let options ={
                method: 'POST',
                headers:{
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                body: JSON.stringify({order: orderId})
            };
            fetch('/order/delete',options)
            .then(response=>response.json())
            .then(data => {

              if (data.message === 'Order deleted successfully.') {
                toastr.options ={
                "progressBar" :true,
                "closeButton" :true,
                }
                toastr.error(data.message);  
                document.querySelector('[order-id="' + orderId + '"]').remove();
            } else {
                alert('Order could not be deleted!');
            }
            })
            .catch(error=> console.log("Error:",error));  
        }
        function doneOrder(orderId){
          // event.preventDefault();
          let options ={
                method: 'POST',
                headers:{
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                body: JSON.stringify({order: orderId})
            };
            fetch('/order/done',options)
            .then(response=>response.json())
            .then(data => {

              if (data.message === 'Order done successfully.') {
                  toastr.options ={
              "progressBar" :true,
              "closeButton" :true,
              }
              toastr.success(data.message);  
                document.querySelector('[order-id="' + orderId + '"]').remove();
            } else {
                alert('Order could not be done!');
            }
            })
            .catch(error=> console.log("Error:",error));  
        }
    </script>
</body>
</html>