@extends('layout')
@section('title', 'Kết quả tìm kiếm')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('/frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span> <span>Tìm kiếm</span></p>
                    <h1 class="mb-0 bread">Kết quả tìm kiếm cho "{{ $query }}"</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                @if($products->isEmpty())
                    <div class="col-12 text-center">
                        <p>Không tìm thấy sản phẩm nào phù hợp với từ khóa "<strong>{{ $query }}</strong>".</p>
                    </div>
                @else
                    @foreach($products as $product)
                        <div class="col-md-6 col-lg-3 ftco-animate">
                            <form>
                                @csrf
                                <input type="hidden" value="{{ $product->product_id }}" class="cart_product_id_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->product_name }}" class="cart_product_name_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->product_image }}" class="cart_product_image_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->product_price }}" class="cart_product_price_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->product_quantity }}" class="cart_product_quantity_{{ $product->product_id }}">
                                <input type="hidden" value="1" class="cart_product_qty_{{ $product->product_id }}">

                                <div class="product">
                                    <a href="{{ route('detailProduct', ['id' => $product->product_id]) }}" class="img-prod">
                                        <img class="img-fluid" src="/upload/product/{{ $product->product_image }}" alt="{{ $product->product_name }}">
                                        <div class="overlay"></div>
                                    </a>
                                    <div class="text py-3 pb-4 px-3 text-center">
                                        <h3><a href="{{ route('detailProduct', ['id' => $product->product_id]) }}">{{ $product->product_name }}</a></h3>
                                        <div class="d-flex">
                                            <div class="pricing">
                                                <p class="price"><span class="price-sale">{{ number_format($product->product_price) }} VNĐ</span></p>
                                            </div>
                                        </div>
                                        <div class="bottom-area d-flex px-3">
                                            <div class="m-auto d-flex">
                                                @php $customerId = Session::get('customer_id'); @endphp
                                                @if ($customerId)
                                                    <a href="javascript:;" name="add-to-cart" data-id_product="{{ $product->product_id }}" class="add-to-cart buy-now d-flex justify-content-center align-items-center mx-1">
                                                        <span><i class="ion-ios-cart"></i></span>
                                                    </a>
                                                @else
                                                    <a href="{{ URL::to('/login-checkout') }}" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                                        <span><i class="ion-ios-cart"></i></span>
                                                    </a>
                                                @endif
                                                <a href="{{ route('detailProduct', ['id' => $product->product_id]) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                                    <span><i class="ion-ios-menu"></i></span>
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

            {{-- Pagination --}}
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
