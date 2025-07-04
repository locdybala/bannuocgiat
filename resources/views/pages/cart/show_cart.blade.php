@extends('layout')
@section('content')
        <!-- breadcrumb start -->
        <section class="breadcrumb breadcrumb_bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="breadcrumb_iner">
                            <div class="breadcrumb_iner_item">
                                <h2>Giỏ hàng</h2>
                                <p>Trang chủ <span>-</span> Giỏ hàng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb end -->

        <!-- Cart Area -->
        <section class="cart_area padding_top">
            <div class="container">
                <div class="cart_inner">
                    @if(session()->has('message'))
                        <div class="alert alert-success">{!! session()->get('message') !!}</div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">{!! session()->get('error') !!}</div>
                    @endif

                    <div class="table-responsive">
                        <form action="{{route('update_cart')}}" method="post">
                            @csrf
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Số lượng trong kho</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Thành tiền</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(Session::get('cart'))
                                    @php $total = 0; @endphp
                                    @foreach(Session::get('cart') as $key => $cart)
                                        @php
                                            $subtotal = $cart['product_price'] * $cart['product_qty'];
                                            $total += $subtotal;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <img src="{{asset('/upload/product/'.$cart['product_image'])}}" style="width: 80px; height: 80px;" alt="">
                                                    </div>
                                                    <div class="media-body">
                                                        <p>{{$cart['product_name']}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><p class="mb-0 mt-4">{{$cart['product_quantity']}}</p>
                                           </td>
                                            <td><h5>{{number_format($cart['product_price'],0,',','.')}}đ</h5></td>
                                            <td>
                                                <div class="product_count">
                                                    <span class="input-number-decrement"> <i class="ti-angle-down"></i></span>
                                                    <input class="input-number" type="text" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" min="0">
                                                    <span class="input-number-increment"> <i class="ti-angle-up"></i></span>
                                                </div>
                                            </td>
                                            <td><h5>{{number_format($subtotal,0,',','.')}}đ</h5></td>
                                            <td>
                                                <a class="btn rounded-circle bg-light cart_quantity_delete"
                                                   href="{{route('delete_product_cart',['session_id'=>$cart['session_id']])}}"><i class="fa fa-times text-danger"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="bottom_button">
                                        <td colspan="5">
                                            <input type="submit" value="Cập nhật giỏ hàng" class="btn_1">
                                        </td>

                                        <td>
                                            <div class="cupon_text float-right">
                                                <a class="btn_1" href="{{route('delete_all_cart')}}">Xóa giỏ hàng</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <h5>Tổng cộng</h5>
                                        </td>
                                        <td>
                                            <h5>{{number_format($total,0,',','.')}}đ</h5>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Giỏ hàng trống</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <div class="checkout_btn_inner float-right">
                                <a class="btn_1" href="{{route('home')}}">Tiếp tục mua hàng</a>
                                @if(Session::get('customer_id'))
                                    <a class="btn_1 checkout_btn_1" href="{{URL::to('/checkout')}}">Thanh toán đơn hàng</a>
                                @else
                                    <a class="btn_1 checkout_btn_1" href="{{URL::to('/login-checkout')}}">Thanh toán đơn hàng</a>
                                @endif
                            </div>
                        </form>
                    </div>

                    @if(Session::get('cart'))
                        <div class="coupon_section mt-4">
                            <form method="POST" action="{{route('check_coupon')}}">
                                @csrf
                                <input type="text" name="coupon" placeholder="Nhập mã giảm giá" class="form-control" style="width: 200px; display: inline-block; margin-right: 10px;">
                                <button class="btn btn-success" type="submit">Áp dụng</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    <script src="">
        $(document).ready(function() {
            // Khi nhấn nút tăng
            $('.input-number-increment').click(function() {
                debugger
                var $input = $(this).siblings('input');
                var currentVal = parseInt($input.val());
                if (!isNaN(currentVal) && currentVal < 10) {
                    $input.val(currentVal + 1);
                }
            });

            // Khi nhấn nút giảm
            $('.input-number-decrement').click(function() {
                var $input = $(this).siblings('input');
                var currentVal = parseInt($input.val());
                if (!isNaN(currentVal) && currentVal > 0) {
                    $input.val(currentVal - 1);
                }
            });
        });
    </script>
@endsection
