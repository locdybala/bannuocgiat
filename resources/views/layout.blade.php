<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Điện thoại</title>
    <link rel="icon" href="{{asset('frontend/img/favicon.png')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/all.css')}}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/lightslider.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/nice-select.css')}}">
</head>

<body>
@include('pages.layout.header')
@yield('content')
@include('pages.layout.footer')

<!-- jquery plugins here-->
<script src="{{asset('frontend/js/jquery-1.12.1.min.js')}}"></script>
<!-- popper js -->
<script src="{{asset('frontend/js/popper.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<!-- easing js -->
<script src="{{asset('frontend/js/jquery.magnific-popup.js')}}"></script>
<!-- swiper js -->
<script src="{{asset('frontend/js/swiper.min.js')}}"></script>
<!-- swiper js -->
<script src="{{asset('frontend/js/masonry.pkgd.js')}}"></script>
<!-- particles js -->
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.nice-select.min.js')}}"></script>
<!-- slick js -->
<script src="{{asset('frontend/js/slick.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
<script src="{{asset('frontend/js/contact.js')}}"></script>
<script src="{{asset('frontend/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.form.js')}}"></script>
<script src="{{asset('frontend/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('frontend/js/mail-script.js')}}"></script>
<script src="{{asset('frontend/js/lightslider.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('frontend/js/jquery.nice-select.min.js')}}"></script>

<!-- custom js -->
<script src="{{asset('frontend/js/custom.js')}}"></script>
@yield('javascript')
<script type="text/javascript">
    $(document).ready(function () {
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
                        }).then((result) => {
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
