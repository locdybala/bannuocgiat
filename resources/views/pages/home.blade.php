@extends('layout')
@section('content')

    @if(isset($sliders) && count($sliders) > 0)
        <section class="banner_part">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="banner_slider owl-carousel">
                            @foreach($sliders as $slider)
                                <div class="single_banner_slider">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-8">
                                            <div class="banner_text">
                                                <div class="banner_text_iner">
                                                    <h1>{{ $slider->slider_name }}</h1>
                                                    <p>{!! $slider->slider_desc !!} </p>
                                                    <a href="{{route('shop')}}" class="btn_2">Mua ngay</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="banner_img d-none d-lg-block">
                                            <img src="{{ asset('upload/slider/'. $slider->slider_image) }}"
                                                 alt="{{ $slider->title }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="slider-counter"></div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- feature_part start-->
    <section class="feature_part padding_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle text-center">
                        <h2>Danh mục nổi bật</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                @foreach($categories as $key => $ca)
                    <div class="col-lg-6 col-sm-6">
                        <div class="single_feature_post_text" style="height: 150px !important;">
                            <p>Chất lượng cao</p>
                            <h3>{{ $ca->category_name }}</h3>
                            <a style="margin-left:300px;" href="{{ route('detailCategory',['id'=>$ca->category_id]) }}" class="feature_btn">XEM NGAY <i class="fas fa-play"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- product_list start-->
    <section class="product_list section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Danh sách <span>Sản phẩm</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @foreach ($products->chunk(8) as $chunk)
                        <div class="single_product_list_slider">
                            <div class="row align-items-center justify-content-between">
                                @foreach ($chunk as $product)
                                    <div class="col-lg-3 col-sm-6">
                                        <form>
                                            @csrf
                                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                                            <div class="single_product_item">
                                                <a href="{{ route('detailProduct',['id'=>$product->product_id]) }}">
                                                    <img src="/upload/product/{{ $product->product_image }}" alt=""></a>
                                                <div class="single_product_text">
                                                    <h4>{{$product->product_name}}</h4>
                                                    <h3>{{number_format($product->product_price)}} vnđ</h3>
                                                    @php
                                                        $customerId = Session::get('customer_id');
                                                    @endphp
                                                    @if ($customerId)
                                                        <input type="button" name="add-to-cart" value="Thêm giỏ hàng" data-id_product="{{$product->product_id}}" class="add-to-cart btn_3">
                                                    @else
                                                        <a href="{{URL::to('/login-checkout')}}" class="add_cart">Thêm giỏ hàng<i class="ti-heart"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @if($coupon)
        <section class="our_offer section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 col-md-6">
                        <div class="offer_img">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="offer_text">
                            <h2>Ưu đãi đặc biệt: {{ $coupon->coupon_condition == 1 ? $coupon->coupon_number.'%' : number_format($coupon->coupon_number) . ' VND' }} giảm giá</h2>
                            <p>Áp dụng với mã: <strong>{{ $coupon->coupon_code }}</strong></p>
                            <p>Thời gian khuyến mãi: {{ date('d/m/Y', strtotime($coupon->coupon_date_start)) }} - {{ date('d/m/Y', strtotime($coupon->coupon_date_end)) }}</p>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ $coupon->coupon_code }}" readonly>
                                <div class="input-group-append">
                                    <a href="#" class="input-group-text btn_2">Dùng ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="product_list best_seller section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Sản phẩm <span>mới</span></h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <div class="best_product_slider owl-carousel">
                        @foreach($bestSellers as $product)
                            <div class="single_product_item">
                                <a href="{{ route('detailProduct',['id'=>$product->product_id]) }}">
                                    <img src="/upload/product/{{ $product->product_image }}" alt="">
                                    <div class="single_product_text">
                                        <h4>{{$product->product_name}}</h4>
                                        <h3>{{number_format($product->product_price)}}</h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="client_logo padding_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center mb-5">
                        <h2>Thương hiệu nổi bật</h2>
                    </div>
                    <div class="client_logo_slider owl-carousel">
                        @foreach($brand as $item)
                            @if($item->brand_status == 1)
                                <div class="single_client_logo">
                                    <div class="brand-item">
                                        <img src="/upload/brand/{{ $item->brand_image }}" alt="{{ $item->brand_name }}">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .client_logo .single_client_logo {
            height: 50px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            border-left: 1px solid #edeff2;
            width: 100%;
            float: left;
            border-bottom: 1px solid #edeff2;
        }
        .client_logo {
            padding: 60px 0;
            background: #f8f9fa;
        }
        .single_client_logo {
            margin: 0 15px;
        }
        .brand-item {
            background: #ffffff;
            border-radius: 8px;
            height: 100px;
            width: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
    </style>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.add-to-cart').click(function () {
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
                    toastr["error"]('Số lượng đặt lớn hơn số lượng còn trong kho, Vui lòng chọn số lượng nhỏ hơn', +cart_product_quantity);
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
                                .then((willDelete) => {
                                    if (willDelete) {
                                        window.location.href = "{{url('/cart')}}";
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
            var matches = $.grep(old_data, function (obj) {
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
