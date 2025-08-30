@extends('layout')
@section('title', 'Chi tiết sản phẩm')
@section('content')
    @php
        $customerId = Session::get('customer_id');
    @endphp

    <div class="hero-wrap hero-bread" style="background-image: url('/frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                        <span class="mr-2"><a
                                href="{{ route('detailCategory', ['id' => $productDetail->category->category_id]) }}">{{ $productDetail->category->category_name }}</a></span>
                        <span>Chi tiết sản phẩm</span>
                    </p>
                    <h1 class="mb-0 bread">{{ $productDetail->product_name }}</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                {{-- Cột bên trái (Hình ảnh sản phẩm) --}}
                <div class="col-lg-6 mb-5 ftco-animate">
                    <div class="item">
                        <a href="{{ asset('upload/product/' . $productDetail->product_image) }}" class="image-popup">
                            <img src="{{ asset('upload/product/' . $productDetail->product_image) }}" class="img-fluid"
                                alt="{{ $productDetail->product_name }}">
                        </a>
                    </div>
                    {{-- Bọc tất cả ảnh trong một div owl-carousel --}}
                    <div class="product-img-slider owl-carousel">
                        {{-- Ảnh đại diện --}}

                        {{-- Các ảnh trong thư viện --}}
                        @foreach ($gallery as $image)
                            <div class="item">
                                <a href="{{ asset('upload/gallery/' . $image->gallery_name) }}" class="image-popup">
                                    <img src="{{ asset('upload/gallery/' . $image->gallery_name) }}" class="img-fluid"
                                        alt="gallery image">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Cột bên phải (Thông tin và nút mua hàng) --}}
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    {{-- Bọc tất cả trong form để giữ logic AJAX --}}
                    <form action="">
                        @csrf
                        <input type="hidden" value="{{ $productDetail->product_id }}"
                            class="cart_product_id_{{ $productDetail->product_id }}">
                        <input type="hidden" value="{{ $productDetail->product_name }}"
                            class="cart_product_name_{{ $productDetail->product_id }}">
                        <input type="hidden" value="{{ $productDetail->product_image }}"
                            class="cart_product_image_{{ $productDetail->product_id }}">
                        <input type="hidden" value="{{ $productDetail->product_price }}"
                            class="cart_product_price_{{ $productDetail->product_id }}">
                        <input type="hidden" value="{{ $productDetail->product_quantity }}"
                            class="cart_product_quantity_{{ $productDetail->product_id }}">

                        <h3>{{ $productDetail->product_name }}</h3>
                        <div class="rating d-flex">
                            <p class="text-left mr-4">
                                <a href="#" class="mr-2" style="color: #000;">
                                    <span>{{ $productDetail->product_view }}</span> <span style="color: #bbb;">Lượt
                                        xem</span>
                                </a>
                            </p>
                            <p class="text-left">
                                <a href="#reviews_tab" class="mr-2" style="color: #000;">
                                    <span id="review_count">...</span> <span style="color: #bbb;">Đánh giá</span>
                                </a>
                            </p>
                        </div>
                        <p class="price"><span>{{ number_format($productDetail->product_price, 0, ',', '.') }} VNĐ</span></p>
                        <p>{!! $productDetail->product_content !!}</p>

                        <div class="row mt-4">
                            <div class="w-100"></div>
                            <div class="input-group col-md-6 d-flex mb-3">
                                <span class="input-group-btn mr-2">
                                    <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                        <i class="ion-ios-remove"></i>
                                    </button>
                                </span>
                                {{-- Giữ nguyên class của bạn để JS hoạt động --}}
                                <input type="text" name="quantity"
                                    class="form-control input-number cart_product_qty_{{ $productDetail->product_id }}"
                                    value="1" min="1" max="{{ $productDetail->product_quantity }}">
                                <span class="input-group-btn ml-2">
                                    <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                        <i class="ion-ios-add"></i>
                                    </button>
                                </span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <p style="color: #000;">Còn lại: {{ $productDetail->product_quantity }} sản phẩm</p>
                            </div>
                        </div>

                        {{-- Nút Thêm vào giỏ hàng --}}
                        @php $customerId = Session::get('customer_id'); @endphp
                        @if ($customerId)
                            <p>
                                <input type="button" value="Thêm vào giỏ" class="btn btn-black py-3 px-5 add-to-cart"
                                    data-id_product="{{ $productDetail->product_id }}" name="add-to-cart">
                            </p>
                        @else
                            <p><a href="{{ URL::to('/login-checkout') }}" class="btn btn-black py-3 px-5">Thêm vào giỏ</a>
                            </p>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section" id="reviews_tab">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    {{-- Cấu trúc tab dùng thẻ div thay vì card để gọn hơn --}}
                    <div class="tab-section">
                        <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                    role="tab" aria-controls="home" aria-selected="true">Mô Tả Chi Tiết</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                                    aria-controls="review" aria-selected="false">Đánh Giá</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            {{-- Tab Mô tả --}}
                            <div class="tab-pane fade show active p-4" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                {!! $productDetail->product_desc !!}
                            </div>
                            {{-- Tab Đánh giá --}}
                            <div class="tab-pane fade p-4" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <h3>Các đánh giá hiện có</h3>
                                        <hr>
                                        {{-- Nơi hiển thị các comment bằng AJAX --}}
                                        <div id="comment_show">
                                            {{-- Ví dụ một comment sẽ trông như thế này --}}
                                            {{-- <div class="review_item"> ... </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-5 border-left">
                                        <div class="review_box">
                                            <h4>Viết đánh giá của bạn</h4>
                                            <p>Đánh giá của bạn:</p>

                                            {{-- Cấu trúc sao đúng, không dùng thẻ <a> --}}
                                            <ul class="list-inline" id="rating_stars"
                                                style="cursor:pointer; font-size: 22px; color: #ccc;">
                                                <li class="list-inline-item star" data-rating="1"><span
                                                        class="ion-ios-star"></span></li>
                                                <li class="list-inline-item star" data-rating="2"><span
                                                        class="ion-ios-star"></span></li>
                                                <li class="list-inline-item star" data-rating="3"><span
                                                        class="ion-ios-star"></span></li>
                                                <li class="list-inline-item star" data-rating="4"><span
                                                        class="ion-ios-star"></span></li>
                                                <li class="list-inline-item star" data-rating="5"><span
                                                        class="ion-ios-star"></span></li>
                                            </ul>
                                            <p id="rating_text" class="text-muted small">Vui lòng chọn số sao</p>

                                            <form class="row contact_form comment_form" id="commentForm">
                                                <input type="hidden" name="rating_value" id="rating_value"
                                                    value="">
                                                <div class="col-md-12 form-group">
                                                    <input type="text" class="form-control" name="comment_name"
                                                        id="comment_name" placeholder="Họ và tên *">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <textarea class="form-control" name="comment" id="comment_content" rows="3" placeholder="Nhận xét của bạn *"></textarea>
                                                </div>
                                                <div class="col-md-12 text-right">
                                                    <button type="button" class="btn btn-primary send-comment">Gửi đánh
                                                        giá</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Sản phẩm</span>
                    <h2 class="mb-4">Sản phẩm liên quan</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($related_products as $product)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{ route('detailProduct', ['id' => $product->product_id]) }}" class="img-prod">
                                <img class="img-fluid" src="/upload/product/{{ $product->product_image }}"
                                    alt="{{ $product->product_name }}">
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a
                                        href="{{ route('detailProduct', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a>
                                </h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>{{ number_format($product->product_price) }} VNĐ</span>
                                        </p>
                                    </div>
                                </div>
                                {{-- Có thể thêm các nút bấm ở đây nếu muốn --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            // Quantity Increment/Decrement
            $('.quantity-right-plus').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                var quantity_input = $(this).closest('.input-group').find('.input-number');
                var current_quantity = parseInt(quantity_input.val());
                var max_quantity = parseInt(quantity_input.attr('max'));

                if (current_quantity < max_quantity) {
                    quantity_input.val(current_quantity + 1);
                }
            });

            $('.quantity-left-minus').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                var quantity_input = $(this).closest('.input-group').find('.input-number');
                var current_quantity = parseInt(quantity_input.val());

                if (current_quantity > 1) {
                    quantity_input.val(current_quantity - 1);
                }
            });

            // Load Comments
            loadComments();

            function loadComments() {
                var product_id = $('#comment_product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/load-comments') }}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#comment_show').html(data);
                    }
                })
            }

            // Send Comment
            $('.send-comment').click(function() {
                var product_id = $('#comment_product_id').val();
                var comment_name = $('#comment_name').val();
                var comment_content = $('#comment_content').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ url('/send-comments') }}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        _token: _token,
                        comment_name: comment_name,
                        comment_content: comment_content
                    },
                    success: function(data) {
                        $('#notifi_comments').html(
                            '<span class="text text-success">Thêm bình luận thành công, bình luận đang được chờ duyệt</span>'
                        );
                        loadComments();
                        $('#notifi_comments').fadeOut('slow');
                        $('#comment_name').val('');
                        $('#comment_content').val(' ');
                    }
                })
            })

            // Add to Cart
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
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ url('/cart') }}";
                                }
                            });
                        }
                    });
                }
            });

            // Owl Carousel for product images
            $('.product-img-slider').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });

            // Star Rating Logic
            const stars = $('#rating_stars .star');
            const ratingValueInput = $('#rating_value');
            const ratingText = $('#rating_text');

            function highlightStars(rating) {
                stars.each(function() {
                    if (parseInt($(this).data('rating')) <= rating) {
                        $(this).find('span').removeClass('ion-ios-star-outline').addClass('ion-ios-star');
                    } else {
                        $(this).find('span').removeClass('ion-ios-star').addClass('ion-ios-star-outline');
                    }
                });
            }

            stars.on('mouseover', function() {
                const rating = $(this).data('rating');
                highlightStars(rating);
            });

            stars.on('mouseout', function() {
                const currentRating = ratingValueInput.val() || 0;
                highlightStars(parseInt(currentRating));
            });

            stars.on('click', function() {
                const rating = $(this).data('rating');
                ratingValueInput.val(rating);
                ratingText.text(`Bạn đã chọn ${rating} sao.`);
                highlightStars(rating);
            });
        });
    </script>
@endsection
