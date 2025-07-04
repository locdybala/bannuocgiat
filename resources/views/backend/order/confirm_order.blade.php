<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Gửi mail đặt hàng</title>
</head>
<body>
<div class="container" style="background-color: #f7f7f7; border-radius: 12px; padding: 15px">
    <div class="col-md-12">
        <p style="text-align: center">Đây là mail tự động quý khách không trả lời mail này</p>
        <div class="row">
            <div class="col-md-6">
                <h2 style="text-align: center">Công ty bán hàng điện máy</h2>
                <h4 style="text-align: center">Dịch vụ bán hàng - vận chuyển uy tín - số 1 Hà Nội</h4>
            </div>
            <div class="col-md-6 logo">
                <p>Chào bạn <strong>{{$shipping['customer_name']}}</strong></p>
            </div>
            <div class="col-md-12">
                <p>Bạn hoặc một ai đó đã đăng ký dịch vụ tại shop với thông tin sau</p>
                <h4>Thông tin đơn hàng</h4>
                <p>Mã đơn hàng: <strong>{{$order['order_code']}}</strong></p>
                <p>Mã khuyến mãi: <strong>{{$order['coupon_code']}}</strong></p>
                <p>Phí ship: <strong>{{number_format($shipping['fee'])}} vnđ</strong></p>
                <p>Dịch vụ: <strong>Đặt hàng trực tuyến</strong></p>
                <h4>Thông tin người nhận</h4>
                <p>Emai:
                    @if($shipping['shipping_email'] == '')
                        không có
                    @else
                        <span>{{$shipping['shipping_email']}}</span>
                    @endif
                </p>
                <p>Họ và tên ngưi gửi:
                    @if($shipping['shipping_name'] == '')
                        không có
                    @else
                        <span>{{$shipping['shipping_name']}}</span>
                    @endif
                </p>
                <p>Địa chỉ nhận hàng:
                    @if($shipping['shipping_address'] == '')
                        không có
                    @else
                        <span>{{$shipping['shipping_address']}}</span>
                    @endif
                </p>
                <p>Số điện thoại:
                    @if($shipping['shipping_phone'] == '')
                        không có
                    @else
                        <span>{{$shipping['shipping_phone']}}</span>
                    @endif
                </p>
                <p>Ghi chú đơn hàng:
                    @if($shipping['shipping_notes'] == '')
                        không có
                    @else
                        <span>{{$shipping['shipping_notes']}}</span>
                    @endif
                </p>
                <p>Hình thức thanh toán:
                    @if($shipping['shipping_method'] == 1)
                        Tiền mặt
                    @else
                        Thanh toán online
                    @endif
                </p>
                <p>Nếu thông tin người nhận hàng không đúng vui lòng liên hệ shop để được hỗ trợ</p>
                <h4>Sản phẩm đã đặt :</h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Gía tiền</th>
                        <th scope="col">Số lượng đặt</th>
                        <th scope="col">Thành tiền</th>

                    </tr>
                    </thead>
                    <tbody>
                    @php $sub_total = 0; $i =0; $total =0; @endphp
                    @foreach($cart_array as $cart)
                        @php $i++; $sub_total= $cart['product_qty'] * $cart['product_price']; $total +=$sub_total;  @endphp
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$cart['product_name']}}</td>
                            <td>{{number_format($cart['product_price'])}} vnđ</td>
                            <td>{{$cart['product_qty']}}</td>
                            <td>{{number_format($sub_total)}} vnđ</td>

                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="right">Tổng tiền thanh toán {{number_format($total)}} vnđ</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <p>Xem lịch sử đơn hàng đã đặt tại <a href="{{route('history')}}">lịch sử đơn hàng của bạn</a></p>
            <p>Mọi chi tiết xin liên hệ số điện thoại : 0123456789</p>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
