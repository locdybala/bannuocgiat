@extends('layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>{{$brand_name}}</h2>
                            <p>Trang chủ <span>-</span> Thương hiệu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Category Product Area =================-->
    <section class="cat_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Browse Categories</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach ($category as $categori)
                                        <li>
                                            <a href="{{ route('detailCategory',['id'=>$categori->category_id]) }}">{{$categori->category_name}}</a>
                                            <span>({{ $categori->product_count }})</span>
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
                                            <span>({{ $bra->product_count }})</span>

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
                                    <p><span>{{ $products->total() }} </span>sản phẩm</p>
                                </div>
                    
                                <div class="single_product_menu d-flex">
                                    <div class="input-group"> 
                                        <input type="text" class="form-control" id="search-input" placeholder="Tìm kiếm"
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
                            <div class="col-lg-12">
                                <div class="pageination">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item">
                                                <a class="page-link {{$products->onFirstPage() ? 'disabled' : ''}}" href="{{$products->previousPageUrl()}}" aria-label="Previous">
                                                    <i class="ti-angle-double-left"></i>
                                                </a>
                                            </li>
                                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                                <li class="page-item"><a class="page-link {{$products->currentPage() === $i ? 'active' : ''}}" href="{{$products->url($i)}}">{{$i}}</a></li>
                                            @endfor
                                            <li class="page-item">
                                                <a class="page-link {{$products->hasMorePages() ? '' : 'disabled'}}" href="{{$products->nextPageUrl()}}" aria-label="Next">
                                                    <i class="ti-angle-double-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->

    <!-- product_list part start-->
    <section class="product_list best_seller">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Bán chạy nhất <span>cửa hàng</span></h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <div class="best_product_slider owl-carousel">
                        @foreach($best_sellers as $product)
                            <div class="single_product_item">
                                <a href="{{ route('detailProduct',['id'=>$product->product_id]) }}">
                                    <img src="/upload/product/{{ $product->product_image }}" alt="">
                                    <div class="single_product_text">
                                        <h4>{{$product->product_name}}</h4>
                                        <h3>{{number_format($product->product_price)}} vnđ</h3>

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

@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.input-group-text').click(function() {
                debugger;
                var searchText = $('#search-input').val().toLowerCase();
                var hasResults = false;
                
                $('.col-lg-4.col-sm-6').each(function() {
                    var productName = $(this).find('h4').text().toLowerCase();
                    if (productName.includes(searchText)) {
                        $(this).show();
                        hasResults = true;
                    } else {
                        $(this).hide();
                    }
                });

                // Show/hide no results message
                if (!hasResults) {
                    if ($('.no-results-message').length === 0) {
                        $('.latest_product_inner').append('<div class="col-12 text-center no-results-message"><p>Không tìm thấy sản phẩm nào</p></div>');
                    }
                } else {
                    $('.no-results-message').remove();
                }
            });

            // Trigger search on Enter key
            $('.form-control').keypress(function(e) {
                if(e.which == 13) {
                    $('.input-group-text').click();
                }
            });
            $('.add-to-cart').click(function(){
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
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_quantity:cart_product_quantity,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                        success:function(){

                            swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                cancel: "Xem tiếp",
                                icon: "success",
                                buttons: ["Xem tiếp", "Đi đến giỏ hàng"] ,
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
