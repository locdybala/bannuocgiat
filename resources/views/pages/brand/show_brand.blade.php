@extends('layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('/images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                    <span>{{ $brand_name }}</span>
                </p>
                <h1 class="mb-0 bread">{{ $brand_name }}</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">

        {{-- Thanh lọc sản phẩm theo thương hiệu (thay thế cho sidebar) --}}
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    {{-- Lặp qua danh sách thương hiệu của bạn --}}
                    @foreach ($brand as $bra)
                    <li>
                        {{-- Đánh dấu 'active' cho thương hiệu đang được chọn --}}
                        <a href="{{ route('detailBrand',['id'=>$bra->brand_id]) }}" class="{{ $brand_name == $bra->brand_name ? 'active' : '' }}">
                            {{$bra->brand_name}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Lưới hiển thị sản phẩm --}}
        <div class="row">
            @if($products->isEmpty())
                <div class="col-12 text-center">
                    <p>Chưa có sản phẩm nào thuộc thương hiệu này.</p>
                </div>
            @else
                @foreach($products as $product)
                <div class="col-md-6 col-lg-3 ftco-animate">
                    {{-- Giữ nguyên Form và các hidden input để đảm bảo AJAX hoạt động --}}
                    <form>
                        @csrf
                        <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                        <div class="product">
                            <a href="{{ route('detailProduct',['id'=>$product->product_id]) }}" class="img-prod">
                                <img class="img-fluid" src="/upload/product/{{ $product->product_image }}" alt="{{ $product->product_name }}">
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{ route('detailProduct',['id'=>$product->product_id]) }}">{{$product->product_name}}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span class="price-sale">{{number_format($product->product_price)}} VNĐ</span></p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="{{ route('detailProduct',['id'=>$product->product_id]) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        @php $customerId = Session::get('customer_id'); @endphp
                                        @if ($customerId)
                                        <button type="button" name="add-to-cart" data-id_product="{{$product->product_id}}" class="add-to-cart buy-now d-flex justify-content-center align-items-center mx-1">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </button>
                                        @else
                                        <a href="{{URL::to('/login-checkout')}}" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        @endif
                                        <a href="#" class="heart d-flex justify-content-center align-items-center">
                                            <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
            @endif
        </div>

        {{-- Phân trang --}}
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    {{-- Sử dụng hàm render pagination chuẩn của Laravel --}}
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

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
