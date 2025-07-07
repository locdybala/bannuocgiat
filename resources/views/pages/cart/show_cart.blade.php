@extends('layout')
@section('title', 'Giỏ hàng')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span> <span>Giỏ
                            hàng</span></p>
                    <h1 class="mb-0 bread">Giỏ Hàng Của Tôi</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">

            @if (session()->has('message'))
                <div class="alert alert-success">{!! session()->get('message') !!}</div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger">{!! session()->get('error') !!}</div>
            @endif

            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <form action="{{ route('update_cart') }}" method="post">
                        @csrf
                        <div class="cart-list">
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>&nbsp;</th>
                                        <th>Sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (Session::get('cart'))
                                        @php $total = 0; @endphp
                                        @foreach (Session::get('cart') as $key => $cart)
                                            @php
                                                $subtotal = $cart['product_price'] * $cart['product_qty'];
                                                $total += $subtotal;
                                            @endphp
                                            <tr class="text-center">
                                                <td class="product-remove"><a
                                                        href="{{ route('delete_product_cart', ['session_id' => $cart['session_id']]) }}"><span
                                                            class="ion-ios-close"></span></a></td>

                                                <td class="product-name">
                                                    <div class="d-flex align-items-center">
                                                        <div class="image-prod">
                                                            <img style="width:100px; height:100px" src="{{ asset('upload/product/' . $cart['product_image']) }}" alt="" class="img">
                                                        </div>
                                                        <div class="ml-4 text-left">
                                                            <h3>{{ $cart['product_name'] }}</h3>
                                                            <p>Còn lại: {{ $cart['product_quantity'] }}</p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="price">{{ number_format($cart['product_price'], 0, ',', '.') }}đ
                                                </td>

                                                <td class="quantity">
                                                    {{-- Sử dụng cấu trúc quantity của theme mới nhưng giữ lại name của bạn --}}
                                                    <div class="input-group mb-3">
                                                        <input type="number" name="cart_qty[{{ $cart['session_id'] }}]"
                                                            class="quantity form-control input-number"
                                                            value="{{ $cart['product_qty'] }}" min="1"
                                                            max="{{ $cart['product_quantity'] }}">
                                                    </div>
                                                </td>

                                                <td class="total">{{ number_format($subtotal, 0, ',', '.') }}đ</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center py-5">Giỏ hàng của bạn đang trống!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if (Session::get('cart'))
                            <div class="row justify-content-start">
                                <div class="col col-lg-5 col-md-6 mt-3 cart-wrap ftco-animate">
                                    <div class="cart-total mb-3">
                                        <p class="d-flex">
                                            <button type="submit" class="btn btn-primary py-3 px-4">Cập nhật giỏ
                                                hàng</button>
                                            <a href="{{ route('delete_all_cart') }}" class="btn btn-danger py-3 px-4 ml-2"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng không?')">Xóa
                                                tất cả</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="row justify-content-end">
                {{-- Form áp dụng coupon --}}
                <div class="col-lg-7 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Mã Giảm Giá</h3>
                        <p>Nhập mã giảm giá của bạn nếu có</p>
                        <form action="{{ route('check_coupon') }}" class="info" method="POST">
                            @csrf
                            <div class="form-group d-flex">
                                <input type="text" name="coupon" class="form-control text-left px-3"
                                    placeholder="Nhập mã tại đây">
                                <button type="submit" class="btn btn-primary py-2 px-4 ml-2">Áp dụng</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Bảng tổng tiền --}}
                <div class="col-lg-5 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Tổng Cộng Giỏ Hàng</h3>
                        @if (Session::get('cart'))
                            <p class="d-flex">
                                <span>Tạm tính</span>
                                <span>{{ number_format($total, 0, ',', '.') }}đ</span>
                            </p>
                            <p class="d-flex">
                                <span>Vận chuyển</span>
                                <span>Sẽ được tính khi thanh toán</span>
                            </p>
                            @if (Session::get('coupon'))
                                @foreach (Session::get('coupon') as $key => $cou)
                                    <p class="d-flex">
                                        <span>Giảm giá (Coupon)</span>
                                        @if ($cou['coupon_condition'] == 1)
                                            <span>-{{ $cou['coupon_number'] }}%</span>
                                        @else
                                            <span>-{{ number_format($cou['coupon_number'], 0, ',', '.') }}đ</span>
                                        @endif
                                    </p>
                                @endforeach
                            @endif
                            <hr>
                            <p class="d-flex total-price">
                                <span><strong>Thành tiền</strong></span>
                                <span><strong>
                                        @if (Session::get('coupon'))
                                            @php $total_coupon = $total - $cou['coupon_price']; @endphp
                                            {{ number_format($total_coupon, 0, ',', '.') }}đ
                                        @else
                                            {{ number_format($total, 0, ',', '.') }}đ
                                        @endif
                                    </strong></span>
                            </p>
                        @endif
                    </div>
                    @if (Session::get('customer_id'))
                        <p><a href="{{ URL::to('/checkout') }}" class="btn btn-primary py-3 px-4">Tiến hành thanh toán</a>
                        </p>
                    @else
                        <p><a href="{{ URL::to('/login-checkout') }}" class="btn btn-primary py-3 px-4">Tiến hành thanh
                                toán</a></p>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
