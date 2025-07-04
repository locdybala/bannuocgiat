@extends('layout')
@section('content')
    @php
        $customerId = Session::get('customer_id');
    @endphp

        <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Chi tiết sản phẩm</h2>
                            <p>Trang chủ <span>-</span> {{$productDetail->category->category_name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->
    <!--================End Home Banner Area =================-->

    <!--================Single Product Area =================-->
    <div class="product_image_area section_padding">
        <div class="container">
            <div class="row s_product_inner justify-content-between">
                <div class="col-lg-7 col-xl-7">
                    <div class="product_slider_img">
                        <div id="vertical">
                            @foreach($gallery as $image)
                                <div data-thumb="{{asset('upload/gallery/'.$image->gallery_name)}}">
                                    <img src="{{asset('upload/gallery/'.$image->gallery_name)}}"/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4">
                    <div class="s_product_text">
                        <form action="">
                            @csrf
                            <input type="hidden" value="{{$productDetail->product_id}}"
                                   class="cart_product_id_{{$productDetail->product_id}}">
                            <input type="hidden" value="{{$productDetail->product_name}}"
                                   class="cart_product_name_{{$productDetail->product_id}}">
                            <input type="hidden" value="{{$productDetail->product_image}}"
                                   class="cart_product_image_{{$productDetail->product_id}}">
                            <input type="hidden" value="{{$productDetail->product_price}}"
                                   class="cart_product_price_{{$productDetail->product_id}}">
                            <input type="hidden" value="{{$productDetail->product_quantity}}"
                                   class="cart_product_quantity_{{$productDetail->product_id}}">

                            <h3>{{$productDetail->product_name}}</h3>
                            <h2>{{number_format($productDetail->product_price,0,',','.').'đ'}}</h2>
                            <ul class="list">
                                <li>
                                    <a class="active" href="#">
                                        <span>Danh mục</span> : {{$productDetail->category->category_name}}</a>
                                </li>
                                <li>
                                    <a href="#"> <span>Mã ID</span> : {{$productDetail->product_id}}</a>
                                </li>
                                <li>
                                    <a href="#"> <span>Số lượt xem</span> : {{$productDetail->product_view}}</a>
                                </li>
                            </ul>
                            <p>
                                {!! $productDetail->product_content !!}
                            </p>
                            <style>
                                a.tags_style {
                                    margin: 3px 2px;
                                    border: 1px solid;
                                    height: auto;
                                    background: #ff3b3b;
                                    color: #ffffff;
                                    padding: 0px;
                                }

                                a.tags_style:hover {
                                    background: black;
                                }
                            </style>
                            <fieldset>
                                <legend>Tags:</legend>
                                <p><i class="fa fa-tag"></i>
                                    @php
                                        $tag = $productDetail->product_tags;
                                        $tag = explode(",",$tag);
                                    @endphp
                                    @foreach($tag as $tag)
                                        <a href="#" class="tags_style">{{$tag}}</a>
                                    @endforeach
                                </p>
                            </fieldset>
                            <div class="card_area d-flex justify-content-between align-items-center">
                                <div class="product_count">
                                    <span class="inumber-decrement"> <i class="ti-minus"></i></span>
                                    <input class="input-number cart_product_qty_{{$productDetail->product_id}}"
                                           type="text" value="1" min="0" max="10">
                                    <span class="number-increment"> <i class="ti-plus"></i></span>
                                </div>
                                @php
                                    $customerId = Session::get('customer_id');
                                @endphp
                                @if ($customerId)
                                    <input type="button"
                                           value="Đặt ngay"
                                           class="btn_3 add-to-cart"
                                           data-id_product="{{$productDetail->product_id}}"
                                           name="add-to-cart">
                                @else
                                    <a href="{{URL::to('/login-checkout')}}" class="btn_3">Đặt ngay</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                       aria-selected="true">Mô tả sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab"
                       aria-controls="review"
                       aria-selected="false">Đánh giá</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>
                        {!! $productDetail->product_desc!!}
                    </p>
                </div>
                <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row total_rate">
                                <div class="col-6">
                                    <div class="box_total">
                                        <h5>Overall</h5>
                                        <h4>4.0</h4>
                                        <h6>(03 Reviews)</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="review_list">
                                <div id="comment_show">


                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <form class="row contact_form comment_form" action="#" method="post" id="commentForm"
                                      novalidate="novalidate">
                                    <h4>Viết đánh giá</h4>
                                    <p>Đánh giá:</p>
                                    <ul class="list">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-star"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-star"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-star"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-star"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-star"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <p>Nhận xét</p>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="comment_name" id="comment_name"
                                                   placeholder="Họ và tên *"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email"
                                                   placeholder="Địa chỉ Email *"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="comment" id="comment_content" rows="1"
                                                      placeholder="Nhận xét của bạn"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="button" value="submit" class="btn_3 send-comment">
                                            Gửi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->

    <!-- product_list part start-->
    <section class="product_list best_seller">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Sản phẩm <span>gợi ý</span></h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <div class="best_product_slider owl-carousel">
                        @foreach($related_products as $product)
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
    <!-- product_list part end-->
    <!-- Single Page Header start -->
    <!-- Single Page Header End -->
@endsection
@section('javascript')

    <script type="text/javascript">
        $(document).ready(function () {
            loadComments();

            function loadComments() {
                var product_id = $('#comment_product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/load-comments')}}",
                    method: "POST",
                    data: {product_id: product_id, _token: _token},
                    success: function (data) {
                        $('#comment_show').html(data);
                    }
                })
            }

            $('.send-comment').click(function () {
                var product_id = $('#comment_product_id').val();
                var comment_name = $('#comment_name').val();
                var comment_content = $('#comment_content').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ url('/send-comments')}}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        _token: _token,
                        comment_name: comment_name,
                        comment_content: comment_content
                    },
                    success: function (data) {
                        $('#notifi_comments').html('<span class="text text-success">Thêm bình luận thành công, bình luận đang được chờ duyệt</span>');
                        loadComments();
                        $('#notifi_comments').fadeOut('slow');
                        $('#comment_name').val('');
                        $('#comment_content').val(' ');
                    }
                })
            })
        });
    </script>

@endsection
@section('javascript')
    <script type="text/javascript">
        $('.number-increment').click(function () {
            alert(1);
        })
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
@endsection
