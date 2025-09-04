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
                        <div class="profile-info text-center mb-4">
                            <div class="profile-avatar mb-2">
                                @if (Session::get('customer_avatar'))
                                    <img src="{{ asset('upload/customer/' . Session::get('customer_avatar')) }}" alt="Avatar"
                                        class="rounded-circle" width="100" height="100">
                                @else
                                    {{-- Ảnh mặc định nếu người dùng chưa có avatar --}}
                                    <img src="{{ asset('frontend/images/default-avatar.png') }}" alt="Avatar"
                                        class="rounded-circle" width="100" height="100">
                                @endif
                            </div>
                            <h5 class="profile-name">{{ Session::get('customer_name') }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item {{ Request::is('edit-customer/*') ? 'active' : '' }}"><a
                                    href="{{ URL::to('/edit-customer/' . Session::get('customer_id')) }}"><span><i
                                            class="ion-ios-person mr-2"></i> Thông tin tài khoản</span></a></li>
                            <li class="list-group-item {{ Request::is('history') ? 'active' : '' }}"><a href="{{ route('history') }}"><span><i class="ion-ios-list-box mr-2"></i> Lịch sử mua
                                        hàng</span></a></li>
                            <li class="list-group-item"><a href="{{ route('logout') }}"><span><i class="ion-ios-log-out mr-2"></i> Đăng xuất</span></a>
                            </li>
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
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tạm tính</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; $i = 0; @endphp
                                @foreach($order_details as $details)
                                    @php
                                        $i++;
                                        $subtotal = $details->product_price * $details->product_sales_quantity;
                                        $total += $subtotal;
                                    @endphp
                                    <tr class="text-center">
                                        <td>{{ $i }}</td>
                                        <td class="product-name">
                                            <h3>{{$details->product_name}}</h3>
                                        </td>
                                        <td class="price">{{number_format($details->product_price, 0, ',', '.')}}đ</td>
                                        <td class="quantity">{{$details->product_sales_quantity}}</td>
                                        <td class="total">{{number_format($subtotal, 0, ',', '.')}}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Tổng tiền hàng</strong></td>
                                    <td class="text-right"><strong>{{number_format($total, 0, ',', '.')}}đ</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">Phí vận chuyển</td>
                                    <td class="text-right">{{number_format($details->product_feeship, 0, ',', '.')}}đ</td>
                                </tr>
                                @php
                                    $discount = 0;
                                    if ($coupon_condition == 1) {
                                        $discount = ($total * $coupon_number) / 100;
                                    } else {
                                        $discount = $coupon_number;
                                    }
                                    $grand_total = $total + $details->product_feeship - $discount;
                                @endphp
                                <tr>
                                    <td colspan="4" class="text-right">Giảm giá
                                        @if($coupon_condition == 1) ({{$coupon_number}}%) @endif
                                    </td>
                                    <td class="text-right">- {{number_format($discount, 0, ',', '.')}}đ</td>
                                </tr>
                                <tr class="total-price">
                                    <td colspan="4" class="text-right"><strong>Tổng thanh toán</strong></td>
                                    <td class="text-right"><strong>{{number_format($grand_total, 0, ',', '.')}}đ</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a class="btn btn-primary btn-sm" href="{{route('print_order',['order_code' => $details->order_code])}}" target="_blank"><i class="ion-ios-print"></i> In đơn hàng</a>
                        @if($order[0]->order_status == 1 || $order[0]->order_status == 4)
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
