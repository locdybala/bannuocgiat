<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="coupon">
    <div class="container">
        <h3>Mã khuyến mãi dành cho khách thường từ shop <a target="_blank" href="http://127.0.0.1:8000/">Đồ điện máy</a></h3>
    </div>
    <div class="container">

        <h2 class="note"><b>
                @if($coupon['coupon_condition'] == 1)
                    Giảm {{$coupon['coupon_number']}}%
                @else
                    Giảm {{number_format($coupon['coupon_number'])}} vnđ
                @endif
                <i>cho tổng đơn hàng đặt mua</i></b></h2>
        <p>Quý khách đã từng mua hàng tại cửa hàng vui lòng <a target="_blank" href="http://127.0.0.1:8000/login-checkout">Đăng nhập</a> vào hệ thống để tiến hàng mua hàng và sử dụng mã giảm giá</p>
    </div>
    <div class="container">
        <p class="code">Sử dụng code sau: <span style="color: red; background-color: #6E8192; font-size: 18px;" class="promo">{{$coupon['coupon_code']}}</span> với chỉ <span style="color: red; background-color: #6E8192; font-size: 18px;">{{$coupon['coupon_time']}}</span> mã giảm giá, nhanh tay kẻo bỏ lỡ cơ hội sale sốc này</p>
        <p class="expire">Ngày bắt đầu: {{$coupon['coupon_date_start']}}</p>
        <p class="expire">Ngày hết hạn: {{$coupon['coupon_date_end']}}</p>
    </div>
</div>
</body>
</html>
