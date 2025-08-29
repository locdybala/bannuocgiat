@extends('layout')
@section('title', 'Trang chủ')
@section('content')
    @if (isset($sliders) && count($sliders) > 0)
        <section id="home-section" class="hero">
            <div class="home-slider owl-carousel">
                @foreach ($sliders as $slider)
                    <div class="slider-item"
                        style="background-image: url({{ asset('upload/slider/' . $slider->slider_image) }});">
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="row slider-text justify-content-center align-items-center"
                                data-scrollax-parent="true">
                                <div class="col-md-12 ftco-animate text-center">
                                    <h1 class="mb-2">{{ $slider->slider_name }}</h1>
                                    <h2 class="subheading mb-4">{!! $slider->slider_desc !!}</h2>
                                    <p><a href="{{ route('shop') }}" class="btn btn-primary">Mua ngay</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <section class="ftco-section" style="padding: 90px 0 ">
        <div class="container">
            <div class="row no-gutters ftco-services">

                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-shipped"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Miễn Phí Giao Hàng</h3>
                            <span>Cho đơn hàng từ 1.000.000đ</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-diet"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Đáp ứng đủ nhu cầu</h3>
                            <span>Đa dạng mặt hàng, đáp ứng tốt nhu cầu</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-award"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Chất Lượng Vượt Trội</h3>
                            <span>Đồ dùng uy tin, chất lượng sô 1</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-customer-service"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Hỗ Trợ 24/7</h3>
                            <span>Tư vấn và giải đáp thắc mắc</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- feature_part start-->
    <section class="ftco-section ftco-category ftco-no-pt">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 order-md-last align-items-stretch d-flex">
                            {{-- Khối danh mục lớn nhất --}}
                            @if (isset($categories[0]))
                                <div class="category-wrap-2 ftco-animate img align-self-stretch d-flex"
                                    style="background-image: url(frontend/images/category.jpg);">
                                    <div class="text text-center">
                                        <h2>{{ $categories[0]->category_name }}</h2>
                                        <p>Sản phẩm chất lượng hàng đầu</p>
                                        <p><a href="{{ route('detailCategory', ['id' => $categories[0]->category_id]) }}"
                                                class="btn btn-primary">Xem ngay</a></p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {{-- Khối danh mục nhỏ thứ nhất --}}
                            @if (isset($categories[1]))
                                <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end"
                                    style="background-image: url(frontend/images/category-1.jpg);">
                                    <div class="text px-3 py-1">
                                        <h2 class="mb-0"><a
                                                href="{{ route('detailCategory', ['id' => $categories[1]->category_id]) }}">{{ $categories[1]->category_name }}</a>
                                        </h2>
                                    </div>
                                </div>
                            @endif
                            {{-- Khối danh mục nhỏ thứ hai --}}
                            @if (isset($categories[2]))
                                <div class="category-wrap ftco-animate img d-flex align-items-end"
                                    style="background-image: url(frontend/images/category-2.jpg);">
                                    <div class="text px-3 py-1">
                                        <h2 class="mb-0"><a
                                                href="{{ route('detailCategory', ['id' => $categories[2]->category_id]) }}">{{ $categories[2]->category_name }}</a>
                                        </h2>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    {{-- Khối danh mục nhỏ thứ ba --}}
                    @if (isset($categories[3]))
                        <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end"
                            style="background-image: url(frontend/images/category-3.jpg);">
                            <div class="text px-3 py-1">
                                <h2 class="mb-0"><a
                                        href="{{ route('detailCategory', ['id' => $categories[3]->category_id]) }}">{{ $categories[3]->category_name }}</a>
                                </h2>
                            </div>
                        </div>
                    @endif
                    {{-- Khối danh mục nhỏ thứ tư --}}
                    @if (isset($categories[4]))
                        <div class="category-wrap ftco-animate img d-flex align-items-end"
                            style="background-image: url(frontend/images/category-4.jpg);">
                            <div class="text px-3 py-1">
                                <h2 class="mb-0"><a
                                        href="{{ route('detailCategory', ['id' => $categories[4]->category_id]) }}">{{ $categories[4]->category_name }}</a>
                                </h2>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- product_list start-->
    <section class="ftco-section">
        <div class="container">
            {{-- Phần Tiêu Đề --}}
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Sản phẩm nổi bật</span>
                    <h2 class="mb-4">Danh sách sản phẩm</h2>
                    <p>Những sản phẩm tốt nhất được chọn lọc dành cho bạn</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                {{-- Bắt đầu vòng lặp sản phẩm --}}
                @foreach ($products as $product)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        {{-- Mở Form cho từng sản phẩm để dùng cho AJAX Add to Cart --}}
                        <form>
                            @csrf
                            <input type="hidden" value="{{ $product->product_id }}"
                                class="cart_product_id_{{ $product->product_id }}">
                            <input type="hidden" value="{{ $product->product_name }}"
                                class="cart_product_name_{{ $product->product_id }}">
                            <input type="hidden" value="{{ $product->product_image }}"
                                class="cart_product_image_{{ $product->product_id }}">
                            <input type="hidden" value="{{ $product->product_price }}"
                                class="cart_product_price_{{ $product->product_id }}">
                            <input type="hidden" value="{{ $product->product_quantity }}"
                                class="cart_product_quantity_{{ $product->product_id }}">
                            <input type="hidden" value="1" class="cart_product_qty_{{ $product->product_id }}">

                            <div class="product">
                                <a href="{{ route('detailProduct', ['id' => $product->product_id]) }}" class="img-prod">
                                    <img class="img-fluid" style="width:253px; height:202px;"
                                        src="/upload/product/{{ $product->product_image }}"
                                        alt="Hình ảnh {{ $product->product_name }}">
                                    {{-- Bạn có thể thêm logic cho tag giảm giá ở đây nếu cần --}}
                                    {{-- <span class="status">30%</span> --}}
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 pb-4 px-3 text-center">
                                    <h3><a
                                            href="{{ route('detailProduct', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a>
                                    </h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price">
                                                {{-- Chỉ hiển thị một giá, không có giá gạch ngang --}}
                                                <span class="price-sale">{{ number_format($product->product_price) }}
                                                    VNĐ</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="bottom-area d-flex px-3">
                                        <div class="m-auto d-flex">
                                            {{-- Giữ nguyên logic kiểm tra đăng nhập của bạn --}}
                                            @php
                                                $customerId = Session::get('customer_id');
                                            @endphp
                                            @if ($customerId)
                                                {{-- Nút Thêm giỏ hàng cho người đã đăng nhập (dùng cho AJAX) --}}
                                                <button type="button" name="add-to-cart"
                                                    data-id_product="{{ $product->product_id }}"
                                                    class="add-to-cart buy-now d-flex justify-content-center align-items-center mx-1">
                                                    <span><i class="ion-ios-cart"></i></span>
                                                </button>
                                            @else
                                                {{-- Nút Thêm giỏ hàng chuyển đến trang đăng nhập --}}
                                                <a href="{{ URL::to('/login-checkout') }}"
                                                    class="buy-now d-flex justify-content-center align-items-center mx-1">
                                                    <span><i class="ion-ios-cart"></i></span>
                                                </a>
                                            @endif

                                            {{-- Nút xem chi tiết (có thể giữ hoặc bỏ) --}}
                                            <a href="{{ route('detailProduct', ['id' => $product->product_id]) }}"
                                                class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                                <span><i class="ion-ios-menu"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> {{-- Đóng Form --}}
                    </div>
                @endforeach
                {{-- Kết thúc vòng lặp --}}
            </div>
        </div>
    </section>

    @if ($coupon)
        <section class="ftco-section img" style="background-image: url(/frontend/images/bg_3.jpg);">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
                        <span class="subheading">Mã Giảm Giá Tốt Nhất Dành Cho Bạn</span>
                        <h2 class="mb-4">Ưu đãi đặc biệt hôm nay</h2>

                        {{-- Hiển thị Mức giảm --}}
                        <h3 class="text-light">
                            Giảm ngay
                            <a href="#" style="color: #82ae46; text-decoration: underline;">
                                {{ $coupon->coupon_condition == 1 ? $coupon->coupon_number . '%' : number_format($coupon->coupon_number) . ' VNĐ' }}
                            </a>
                        </h3>

                        {{-- Hiển thị Mã Coupon --}}
                        <h4>Áp dụng với mã: <strong style="color: #ffc107;">{{ $coupon->coupon_code }}</strong></h4>

                        {{-- Đồng hồ đếm ngược --}}
                        <div id="timer" class="d-flex mt-5"
                            data-deadline="{{ date('Y/m/d H:i:s', strtotime($coupon->coupon_date_end)) }}">
                            <div class="time" id="days"></div>
                            <div class="time pl-3" id="hours"></div>
                            <div class="time pl-3" id="minutes"></div>
                            <div class="time pl-3" id="seconds"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="ftco-section">
        <div class="container">
            {{-- Phần Tiêu Đề --}}
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Sản phẩm mới</span>
                    <h2 class="mb-4">Danh sách sản phẩm</h2>
                    <p>Những sản phẩm mới nhất của cửa hàng</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                {{-- Bắt đầu vòng lặp sản phẩm --}}
                @foreach ($bestSellers as $product)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        {{-- Mở Form cho từng sản phẩm để dùng cho AJAX Add to Cart --}}
                        <form>
                            @csrf
                            <input type="hidden" value="{{ $product->product_id }}"
                                class="cart_product_id_{{ $product->product_id }}">
                            <input type="hidden" value="{{ $product->product_name }}"
                                class="cart_product_name_{{ $product->product_id }}">
                            <input type="hidden" value="{{ $product->product_image }}"
                                class="cart_product_image_{{ $product->product_id }}">
                            <input type="hidden" value="{{ $product->product_price }}"
                                class="cart_product_price_{{ $product->product_id }}">
                            <input type="hidden" value="{{ $product->product_quantity }}"
                                class="cart_product_quantity_{{ $product->product_id }}">
                            <input type="hidden" value="1" class="cart_product_qty_{{ $product->product_id }}">

                            <div class="product">
                                <a href="{{ route('detailProduct', ['id' => $product->product_id]) }}" class="img-prod">
                                    <img class="img-fluid" style="width:253px; height:202px;"
                                        src="/upload/product/{{ $product->product_image }}"
                                        alt="Hình ảnh {{ $product->product_name }}">
                                    {{-- Bạn có thể thêm logic cho tag giảm giá ở đây nếu cần --}}
                                    {{-- <span class="status">30%</span> --}}
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 pb-4 px-3 text-center">
                                    <h3><a
                                            href="{{ route('detailProduct', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a>
                                    </h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price">
                                                {{-- Chỉ hiển thị một giá, không có giá gạch ngang --}}
                                                <span class="price-sale">{{ number_format($product->product_price) }}
                                                    VNĐ</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="bottom-area d-flex px-3">
                                        <div class="m-auto d-flex">
                                            {{-- Giữ nguyên logic kiểm tra đăng nhập của bạn --}}
                                            @php
                                                $customerId = Session::get('customer_id');
                                            @endphp
                                            @if ($customerId)
                                                {{-- Nút Thêm giỏ hàng cho người đã đăng nhập (dùng cho AJAX) --}}
                                                <button type="button" name="add-to-cart"
                                                    data-id_product="{{ $product->product_id }}"
                                                    class="add-to-cart buy-now d-flex justify-content-center align-items-center mx-1">
                                                    <span><i class="ion-ios-cart"></i></span>
                                                </button>
                                            @else
                                                {{-- Nút Thêm giỏ hàng chuyển đến trang đăng nhập --}}
                                                <a href="{{ URL::to('/login-checkout') }}"
                                                    class="buy-now d-flex justify-content-center align-items-center mx-1">
                                                    <span><i class="ion-ios-cart"></i></span>
                                                </a>
                                            @endif

                                            {{-- Nút xem chi tiết (có thể giữ hoặc bỏ) --}}
                                            <a href="{{ route('detailProduct', ['id' => $product->product_id]) }}"
                                                class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                                <span><i class="ion-ios-menu"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> {{-- Đóng Form --}}
                    </div>
                @endforeach
                {{-- Kết thúc vòng lặp --}}
            </div>
        </div>
    </section>


    <section class="ftco-section ftco-partner">
        <div class="container">
            {{-- Thêm tiêu đề cho đồng bộ với các section khác --}}
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <span class="subheading">Đối Tác Của Chúng Tôi</span>
                    <h2 class="mb-4">Thương Hiệu Nổi Bật</h2>
                </div>
            </div>

            <div class="row">
                {{-- Bắt đầu vòng lặp để hiển thị các thương hiệu --}}
                @foreach ($brand as $item)
                    {{-- Chỉ hiển thị thương hiệu có trạng thái đang hoạt động --}}
                    @if ($item->brand_status == 1)
                    <div class="col-sm ftco-animate">
                        <a href="#" class="partner">
                            <img src="/upload/brand/{{ $item->brand_image }}" class="img-fluid" alt="{{ $item->brand_name }}">
                        </a>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-to-cart').click(function() {
                debugger;
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                if (cart_product_qty >= cart_product_quantity) {
                    toastr["error"](
                        'Số lượng đặt lớn hơn số lượng còn trong kho, Vui lòng chọn số lượng nhỏ hơn', +
                        cart_product_quantity);
                } else {
                    $.ajax({
                        url: '{{ url('/add-cart-ajax') }}',
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
                        success: function() {
                            Swal.fire({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    icon: "success",
                                    showCancelButton: true,
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    cancelButtonText: "Xem tiếp",
                                    dangerMode: true,
                                })
                                .then((willDelete) => {
                                    if (willDelete) {
                                        window.location.href = "{{ url('/cart') }}";
                                    }
                                });
                        }

                    });
                }
            })

            // Cập nhật cấu hình slider cho thương hiệu
            $('.client_logo_slider').owlCarousel({
                items: 4,
                loop: true,
                margin: 30,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                nav: true,
                dots: false,
                navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                        margin: 0
                    },
                    576: {
                        items: 2,
                        margin: 20
                    },
                    768: {
                        items: 3,
                        margin: 20
                    },
                    992: {
                        items: 4,
                        margin: 30
                    }
                }
            });
        });

        function add_wistlist(clicked_id) {
            debugger;
            var id = clicked_id;
            var name = $("#wishlish_product_name_" + id).val();
            var price = $("#wishlish_product_price_" + id).val();
            var image = $("#wishlish_product_image_" + id).val();
            var url = $("#wishlish_product_url_" + id).attr("href");
            var customerId = $("#customerId").val();
            var newItem = {
                'url': url,
                'id': id,
                'image': image,
                'price': price,
                'name': name,
                'customerId': customerId
            }
            if (localStorage.getItem('data') == null) {
                localStorage.setItem('data', '[]');
            }
            var old_data = JSON.parse(localStorage.getItem('data'));
            var matches = $.grep(old_data, function(obj) {
                return obj.id == id && obj.customerId == customerId;
            })
            if (matches.length) {
                toastr["warning"]('Sản phẩm bạn đã yêu thích, nên không thể thêm');
            } else {
                old_data.push(newItem);
                toastr["success"]('Sản phẩm đã được thêm vào danh sách yêu thích');
            }
            localStorage.setItem('data', JSON.stringify(old_data));
        }
    </script>
@endsection
