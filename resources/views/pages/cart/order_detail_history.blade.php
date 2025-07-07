@extends('layout')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('/frontend/images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                    <span class="mr-2"><a href="{{ route('history') }}">Lịch sử mua hàng</a></span>
                    <span>Chi tiết đơn hàng</span>
                </p>
                <h1 class="mb-0 bread">Chi Tiết Đơn Hàng #{{ $order_details[0]->order_code }}</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="sidebar-box ftco-animate">
                    <ul class="categories">
                        <li><a href="{{ URL::to('/edit-customer/' . Session::get('customer_id')) }}"><span><i class="ion-ios-person"></i> Thông tin tài khoản</span></a></li>
                        <li class="active"><a href="{{ route('history') }}"><span><i class="ion-ios-list-box"></i> Lịch sử mua hàng</span></a></li>
                        <li><a href="{{ route('logout') }}"><span><i class="ion-ios-log-out"></i> Đăng xuất</span></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                <div class="order-details-wrap p-4 bg-white ftco-animate">

                    @if(session()->has('message'))
                        <div class="alert alert-success">{!! session()->get('message') !!}</div>
                        @php session()->forget('message'); @endphp
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">{!! session()->get('error') !!}</div>
                        @php session()->forget('error'); @endphp
                    @endif

                    <h3 class="billing-heading mb-4">Thông tin giao hàng</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Người nhận:</strong> {{$shipping->shipping_name}}</p>
                            <p><strong>Số điện thoại:</strong> {{$shipping->shipping_phone}}</p>
                            <p><strong>Email:</strong> {{$shipping->shipping_email}}</p>
                        </div>
                        <div class="col-md-6">
                             <p><strong>Địa chỉ:</strong> {{$shipping->shipping_address}}</p>
                             <p><strong>Thanh toán:</strong>
                                @if($shipping->shipping_method == 1) Tiền mặt khi nhận hàng @else Đã thanh toán online @endif
                             </p>
                             <p><strong>Ghi chú:</strong> {{$shipping->shipping_notes ?? 'Không có'}}</p>
                        </div>
                    </div>
                    <hr>

                    <h3 class="billing-heading mb-4">Các sản phẩm đã đặt</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tạm tính</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($order_details as $details)
                                    @php
                                        $subtotal = $details->product_price * $details->product_sales_quantity;
                                        $total += $subtotal;
                                    @endphp
                                    <tr class="text-center">
                                        <td class="product-name">
                                            <h3>{{$details->product_name}}</h3>
                                        </td>
                                        <td class="price">{{number_format($details->product_price, 0, ',', '.')}}đ</td>
                                        <td class="quantity">{{$details->product_sales_quantity}}</td>
                                        <td class="total">{{number_format($subtotal, 0, ',', '.')}}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-lg-6 mt-5 cart-wrap ftco-animate">
                            <div class="cart-total mb-3">
                                <h3>Tổng Cộng</h3>
                                <p class="d-flex">
                                    <span>Tạm tính</span>
                                    <span>{{number_format($total, 0, ',', '.')}}đ</span>
                                </p>
                                <p class="d-flex">
                                    <span>Phí vận chuyển</span>
                                    <span>{{number_format($details->product_feeship, 0, ',', '.')}}đ</span>
                                </p>
                                <p class="d-flex">
                                    <span>Giảm giá (Coupon)</span>
                                    <span>
                                        @php $discount = 0; @endphp
                                        @if($coupon_condition == 1)
                                            @php
                                                $discount = ($total * $coupon_number) / 100;
                                                echo '- '.number_format($discount, 0, ',', '.').'đ';
                                            @endphp
                                        @else
                                             @php
                                                $discount = $coupon_number;
                                                echo '- '.number_format($discount, 0, ',', '.').'đ';
                                            @endphp
                                        @endif
                                    </span>
                                </p>
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Thành tiền</span>
                                    @php $grand_total = $total + $details->product_feeship - $discount; @endphp
                                    <span>{{number_format($grand_total, 0, ',', '.')}}đ</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a class="btn btn-primary btn-sm" href="{{route('print_order',['order_code' => $details->order_code])}}" target="_blank"><i class="ion-ios-print"></i> In đơn hàng</a>
                        @if($order->order_status == 1 || $order->order_status == 4)
                            <form method="POST" action="{{route('cancel_order',['order_code' => $details->order_code])}}" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit"><i class="ion-ios-close-circle-outline"></i> Hủy đơn hàng</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
