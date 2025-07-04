@extends('layout')
@section('content')

    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Tất cả sản phẩm</h2>
                            <p>Trang chủ <span>-</span> Sản phẩm</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Danh mục sản phẩm</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach ($category as $categori)
                                    <li>
                                        <a href="{{ route('detailCategory',['id'=>$categori->category_id]) }}">{{$categori->category_name}}</a>
                                        <span>({{ count($categori->product) }})</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>

                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Thương hiệu</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach ($brand as $bra)
                                    <li>
                                        <a href="{{ route('detailBrand',['id'=>$bra->brand_id]) }}">{{$bra->brand_name}}</a>
                                        <span>({{ count($bra->product) }})</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product_top_bar d-flex justify-content-between align-items-center">
                                <div class="single_product_menu">
                                    <p><span>{{ count($products) }} </span>sản phẩm</p>
                                </div>
                                <div class="single_product_menu d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm"
                                               aria-describedby="inputGroupPrepend">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend"><i
                                                    class="ti-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center latest_product_inner">
                        @if($products->isEmpty())
                            <div class="col-12 text-center">
                                <p>Chưa có sản phẩm</p>
                            </div>
                        @else
                        @foreach($products as $product)
                        <div class="col-lg-4 col-sm-6">
                            <form>
                                @csrf
                                <input type="hidden" value="{{$product->product_id}}"
                                       class="cart_product_id_{{$product->product_id}}">
                                <input type="hidden" value="{{$product->product_name}}"
                                       class="cart_product_name_{{$product->product_id}}">
                                <input type="hidden" value="{{$product->product_image}}"
                                       class="cart_product_image_{{$product->product_id}}">
                                <input type="hidden" value="{{$product->product_price}}"
                                       class="cart_product_price_{{$product->product_id}}">
                                <input type="hidden" value="{{$product->product_quantity}}"
                                       class="cart_product_quantity_{{$product->product_id}}">
                                <input type="hidden" value="1"
                                       class="cart_product_qty_{{$product->product_id}}">
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
                                        <input type="button" name="add-to-cart" value="Thêm giỏ hàng"
                                                data-id_product="{{$product->product_id}}"
                                                class="add-to-cart btn_3">
                                    @else
                                        <a href="{{URL::to('/login-checkout')}}" class="add_cart">Thêm giỏ hàng<i class="ti-heart"></i></a>
                                    @endif
                                </div>
                            </div>
                            </form>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            // Search functionality
            $('.input-group-text').click(function() {
                var searchText = $('.form-control').val().toLowerCase();
                $('.single_product_item').each(function() {
                    var productName = $(this).find('h4').text().toLowerCase();
                    if (productName.includes(searchText)) {
                        $(this).parent().parent().show();
                    } else {
                        $(this).parent().parent().hide();
                    }
                });
            });

            // Trigger search on Enter key
            $('.form-control').keypress(function(e) {
                if(e.which == 13) {
                    $('.input-group-text').click();
                }
            });

            // Add to cart functionality
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
                    swal('error', 'Số lượng đặt lớn hơn số lượng còn trong kho, Vui lòng chọn số lượng nhỏ hơn', +cart_product_quantity);
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
                            swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                cancel: "Xem tiếp",
                                icon: "success",
                                buttons: ["Xem tiếp", "Đi đến giỏ hàng"],
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
        });
    </script>
@endsection
