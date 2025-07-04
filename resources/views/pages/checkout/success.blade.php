@extends('layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Thanh toán đơn hàng</h2>
                            <p>Trang chủ <span>-</span>Thanh toán thành công</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-12 col-lg-12">
                    <h6 style="border: 3px solid #84c423; padding: 20px 10px" class="mb-4 text-center">Cảm ơn bạn. Đơn hàng của bạn đã được nhận</h6>
                    @if($order->order_method == 3)
                        <h5 class="text-center">Vui lòng quét mã QR để thanh toán đơn hàng, kèm ghi chú mã đơn hàng</h5>
                        <img style="width: 200px; height: 200px; margin-left: 300px;" src="{{asset('frontend/img/maqr.png')}}" alt="">
                    @endif
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>Số đơn hàng</th>
                                <th>Trạng thái</th>
                                <th>Ngày</th>
                                <th>Tổng tiền</th>
                                <th>Hình thức thanh toán</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style="text-align: center">
                                <th scope="row">{{ $order->order_code }}</th>
                                <th style="color: #84c423">
                                    @if ($order->order_status==1)
                                        <span>Đơn hàng mới</span>
                                    @elseif($order->order_status== 2)
                                        <span>Hoàn thành</span>
                                    @elseif($order->order_status== 3)
                                        <span>Đơn hàng đã hủy</span>
                                    @elseif($order->order_status== 4)
                                        <span>Đơn hàng đã được xác nhận</span>
                                    @elseif($order->order_status== 5)
                                        <span>Đang trên đường vận chuyển</span>
                                    @else
                                        <span>Đã thanh toán</span>
                                    @endif
                                </th>
                                <th>{{ $order->order_date }}</th>
                                <th>{{ number_format($order->order_total) }} <u>đ</u></th>
                                <th>
                                    @if($order->order_method == 1)
                                        Trả tiền mặt khi nhận hàng
                                    @elseif($order->order_method == 2)
                                        Thanh toán qua VNPAY
                                    @elseif($order->order_method == 3)
                                        Chuyển khoản ngân hàng
                                    @endif
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3 class="mb-4">Chi tiết đơn hàng</h3>
                    <div style="border: 2px solid #dedede; padding: 20px">
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom mb-3">
                            <div class="col-12">
                                <h5>Sản phẩm</h5>
                            </div>
                        </div>
                        @php
                            $total = 0;
                            $productFeeship = 0;
                        @endphp
                        @foreach($order_details as $key => $details)
                            @php
                                $subtotal = $details->product_price * $details->product_sales_quantity;
                                $total += $subtotal;
                                $productFeeship = $details->product_feeship;
                            @endphp
                            <div class="row g-4 text-center align-items-center justify-content-center py-3">
                                <div class="col-8">
                                    {{$details->product_name}} <strong>x {{$details->product_sales_quantity}}</strong>
                                </div>
                                <div class="col-4">
                                    {{number_format($subtotal, 0, ',', '.')}} <u>đ</u>
                                </div>
                            </div>
                        @endforeach
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-8">
                                <h5>Tổng tiền sản phẩm</h5>
                            </div>
                            <div class="col-4">
                                {{number_format($total ,0,',','.')}} <u>đ</u>
                            </div>
                        </div>
                        @php
                            $total_coupon = 0;
                        @endphp
                        @if($coupon_condition == 1)
                            @php
                                $total_after_coupon = ($total * $coupon_number) / 100;
                            @endphp
                        @else
                            @php
                                $total_after_coupon = $coupon_number;
                            @endphp
                        @endif
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-8">
                                <h5>Phí vận chuyển</h5>
                            </div>
                            <div class="col-4">
                                {{number_format($productFeeship)}} <u>đ</u>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-8">
                                <h5>Mã giảm giá</h5>
                            </div>
                            <div class="col-4">
                                {{number_format($total_after_coupon)}} <u>đ</u>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center py-3">
                            <div class="col-8">
                                <h4>Tổng cộng</h4>
                            </div>
                            <div class="col-4">
                                <strong>{{number_format($order->order_total)}} <u>đ</u></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        // Additional scripts can go here
    </script>
@endsection
