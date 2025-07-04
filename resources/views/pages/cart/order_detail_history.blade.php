@extends('layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Chi tiết đơn hàng</h2>
                            <p>Trang chủ <span>-</span>Lịch sử mua hàng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cart_area padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Quản lý tài khoản</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <li class="list-group-item border-0">
                                        <a href="{{ URL::to('/edit-customer/' . Session::get('customer_id')) }}" class="text-dark">
                                            <i class="fas fa-user me-2"></i>Thông tin tài khoản
                                        </a>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <a href="{{ route('history') }}" class="text-dark">
                                            <i class="fas fa-history me-2"></i>Lịch sử mua hàng
                                        </a>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <a href="{{ route('logout') }}" class="text-dark">
                                            <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="cart_inner">
                        <h3 class="mb-4 text-center">Thông tin chi tiết đơn hàng</h3>

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {!! session()->get('message') !!}
                            </div>
                            {{ session()->forget('message') }}
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">
                                {!! session()->get('error') !!}
                            </div>
                            {{ session()->forget('error') }}
                        @endif

                        <div class="cart_inner">
                            <h4>Thông tin người đặt</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$customer->customer_name}}</td>
                                        <td>{{$customer->customer_phone}}</td>
                                        <td>{{$customer->customer_email}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="cart_inner mt-4">
                            <h4>Địa chỉ nhận hàng</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Tên người vận chuyển</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Ghi chú</th>
                                        <th>Hình thức thanh toán</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$shipping->shipping_name}}</td>
                                        <td>{{$shipping->shipping_address}}</td>
                                        <td>{{$shipping->shipping_phone}}</td>
                                        <td>{{$shipping->shipping_email}}</td>
                                        <td>{{$shipping->shipping_notes}}</td>
                                        <td>@if($shipping->shipping_method == 1)
                                                <span class="badge badge-warning">Tiền mặt</span>
                                            @else
                                                <span class="badge badge-success">Thanh toán online</span>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="cart_inner mt-4">
                            <h4>Thông tin đơn hàng</h4>
                            <div class="table-responsive">
                                <table class="table table-condensed table-striped">
                                    <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng kho còn</th>
                                        <th>Mã giảm giá</th>
                                        <th>Phí ship</th>
                                        <th>Số lượng</th>
                                        <th>Giá sản phẩm</th>
                                        <th>Tổng tiền</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach($order_details as $key => $details)
                                        @php
                                            $subtotal = $details->product_price * $details->product_sales_quantity;
                                            $total += $subtotal;
                                        @endphp
                                        <tr>
                                            <td>{{$details->product_name}}</td>
                                            <td>{{$details->product->product_quantity}}</td>
                                            <td>@if($details->product_coupon != 'no')
                                                    {{$details->product_coupon}}
                                                @else
                                                    Không mã
                                                @endif
                                            </td>
                                            <td>{{number_format($details->product_feeship ,0,',','.')}}đ</td>
                                            <td>{{$details->product_sales_quantity}}</td>
                                            <td>{{number_format($details->product_price ,0,',','.')}}đ</td>
                                            <td>{{number_format($subtotal ,0,',','.')}}đ</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="text-right">
                                            @php
                                                $total_coupon = 0;
                                            @endphp
                                            @if($coupon_condition == 1)
                                                @php
                                                    $total_after_coupon = ($total * $coupon_number) / 100;
                                                    echo 'Tổng giảm: ' . number_format($total_after_coupon, 0, ',', '.') . ' đ<br>';
                                                    $total_coupon = $total + $details->product_feeship - $total_after_coupon;
                                                @endphp
                                            @else
                                                @php
                                                    echo 'Tổng giảm: ' . number_format($coupon_number, 0, ',', '.') . ' đ<br>';
                                                    $total_coupon = $total + $details->product_feeship - $coupon_number;
                                                @endphp
                                            @endif

                                            Phí ship: {{number_format($details->product_feeship, 0, ',', '.')}}đ<br>
                                            Thanh toán: {{number_format($total_coupon, 0, ',', '.')}}đ
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a class="btn btn-primary btn-sm" href="{{route('print_order',['order_code' => $details->order_code])}}" target="_blank">In đơn hàng</a>

                            @if($order_status == 1 || $order_status == 6)
                                <form method="POST" action="{{route('cancel_order',['order_code' => $details->order_code])}}">
                                    @csrf
                                    @method('post')
                                    <button class="btn btn-danger btn-sm" type="submit">Hủy đơn hàng</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
