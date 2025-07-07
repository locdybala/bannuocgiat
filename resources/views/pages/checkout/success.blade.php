@extends('layout')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('/frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                        <span class="mr-2"><a href="{{ route('cart') }}">Giỏ hàng</a></span>
                        <span>Hoàn thành</span>
                    </p>
                    <h1 class="mb-0 bread">Đặt Hàng Thành Công</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 ftco-animate text-center">

                    {{-- Thông báo thành công --}}
                    <div class="thank-you-wrap p-4 bg-light rounded">
                        <span class="ion-ios-checkmark-circle-outline" style="font-size: 80px; color: #82ae46;"></span>
                        <h2 class="mb-3" style="color: #82ae46;">Cảm ơn bạn. Đơn hàng của bạn đã được tiếp nhận!</h2>
                        <p>Một email xác nhận đã được gửi tới hòm thư của bạn. Vui lòng kiểm tra và liên hệ với chúng tôi
                            nếu có bất kỳ thắc mắc nào.</p>
                    </div>

                    {{-- Hiển thị mã QR nếu có --}}
                    @if ($order->order_method == 3)
                        <div class="qr-payment-wrap mt-4">
                            <h5 class="text-center">Vui lòng quét mã QR dưới đây để thanh toán, ghi rõ mã đơn hàng
                                <strong>#{{ $order->order_code }}</strong> trong nội dung chuyển khoản.</h5>
                            <img class="mx-auto d-block" style="width: 200px; height: 200px;"
                                src="{{ asset('frontend/images/maqr.png') }}" alt="Mã QR thanh toán">
                        </div>
                    @endif

                    {{-- Bảng chi tiết đơn hàng --}}
                    <div class="order-details-wrap p-4 mt-5 border rounded">
                        <h3 class="billing-heading mb-4">Chi tiết đơn hàng của bạn</h3>

                        {{-- Tóm tắt thông tin chính --}}
                        <div class="row text-left mb-4">
                            <div class="col-md-6">
                                <p><strong>Mã đơn hàng:</strong> #{{ $order->order_code }}</p>
                                <p><strong>Ngày đặt:</strong> {{ date('d/m/Y H:i', strtotime($order->order_date)) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Tổng tiền:</strong> <strong
                                        class="text-primary">{{ number_format($order->order_total) }} đ</strong></p>
                                <p><strong>Thanh toán:</strong>
                                    @if ($order->order_method == 1)
                                        Trả tiền mặt khi nhận hàng
                                    @elseif($order->order_method == 2)
                                        Thanh toán qua VNPAY
                                    @elseif($order->order_method == 3)
                                        Chuyển khoản ngân hàng
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{-- Chi tiết sản phẩm --}}
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Tạm tính</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_details as $details)
                                        <tr>
                                            <td>{{ $details->product_name }}</td>
                                            <td class="text-center">{{ $details->product_sales_quantity }}</td>
                                            <td class="text-right">
                                                {{ number_format($details->product_price, 0, ',', '.') }}đ</td>
                                            <td class="text-right">
                                                {{ number_format($details->product_price * $details->product_sales_quantity, 0, ',', '.') }}đ
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
                        <a href="{{ route('history') }}" class="btn btn-secondary">Xem lịch sử đơn hàng</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script>
        // Additional scripts can go here
    </script>
@endsection
