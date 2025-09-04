<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title', 'Web bán nước giặt')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{asset('frontend/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('frontend/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('frontend/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">

    <style>
        .ftco-section {
            padding: 30px 0;
        }

        html, body {
            height: 100%;
            margin: 0;
        }

        .fullscreen-search-modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 9999; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
            /* Ensure content is centered */
        }
        .fullscreen-search-modal .close-search-modal {
            position: absolute;
            top: 20px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
            opacity: 1; /* Ensure it's always visible by default */
        }
        .fullscreen-search-modal .close-search-modal:hover,
        .fullscreen-search-modal .close-search-modal:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
        .fullscreen-search-modal .search-modal-form {
            display: flex;
            width: 80%; /* Adjust as needed */
            max-width: 600px; /* Max width of the search bar */
        }
        .fullscreen-search-modal .search-modal-form input[type="text"] {
            flex-grow: 1;
            padding: 15px 20px;
            border: none;
            outline: none;
            font-size: 1.5rem;
            background: #fff; /* White background for input */
            color: #333; /* Dark text for input */
            border-radius: 5px 0 0 5px;
        }
        .fullscreen-search-modal .search-modal-form button {
            background: #82ae46; /* Primary color for button */
            color: white;
            border: none;
            padding: 15px 20px;
            font-size: 1.5rem;
            cursor: pointer;
            border-radius: 0 5px 5px 0;
        }
    </style>
  </head>

<body class="goto-here">
@include('pages.layout.header')
@yield('content')
@include('pages.layout.footer')

<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
        stroke="#F96D00" />
</svg></div>


<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('frontend/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('frontend/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('frontend/js/aos.js')}}"></script>
<script src="{{asset('frontend/js/jquery.animateNumber.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('frontend/js/scrollax.min.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('javascript')
<script type="text/javascript">
    $(document).ready(function () {
        // Fullscreen search modal toggle
        $('#search_1').click(function(e) {
            e.preventDefault();
            $('#fullscreen_search_modal').css({
                'display': 'flex',
                'align-items': 'center',
                'justify-content': 'center'
            }).hide().fadeIn(300); // Set flex properties, then fade in
            $('#search_input_modal').focus(); // Focus on the input field
        });

        // Close modal button
        $('.close-search-modal').click(function() {
            $('#fullscreen_search_modal').fadeOut(300, function() {
                $(this).css({
                    'display': 'none',
                    'align-items': '',
                    'justify-content': ''
                });
            });
        });

        // Close modal with Escape key
        $(document).keydown(function(e) {
            if (e.key === "Escape") { // ESC key
                $('#fullscreen_search_modal').fadeOut(300, function() {
                    $(this).css({
                        'display': 'none',
                        'align-items': '',
                        'justify-content': ''
                    });
                });
            }
        });

        // Add to cart functionality (existing code, ensure it still works with the new modal structure)
        $('.add-to-cart').click(function () {
            debugger;
            var id = $(this).data('id_product');
            var cart_product_id = parseInt($('.cart_product_id_' + id).val(), 10);
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_price = parseInt($('.cart_product_price_' + id).val(), 10);
            var cart_product_quantity = parseInt($('.cart_product_quantity_' + id).val(), 10);
            var cart_product_qty = parseInt($('.cart_product_qty_' + id).val(), 10);
            var _token = $('input[name="_token"]').val();
            if (cart_product_qty >= cart_product_quantity) {
                toastr["error"]('Số lượng đặt lớn hơn số lượng còn trong kho, Vui lòng chọn số lượng nhỏ hơn ' + cart_product_quantity);
            } else {
                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_quantity: cart_product_quantity,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        _token: _token
                    },
                    success: function () {

                        Swal.fire({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            icon: "success",
                            showCancelButton: true,
                            confirmButtonText: "Đi đến giỏ hàng",
                            cancelButtonText: "Xem tiếp",
                            dangerMode: true,
                        })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{url('/cart')}}";
                                }
                            });
                    }

                });
            }
        })
    });
</script>
</body>

</html>
