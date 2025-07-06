<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-ua-compatible" content="ie=edge">
    <title>Xác nhận đơn hàng - Softwave</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
            color: #51545e;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f7f6;
            padding: 40px 0;
        }
        .email-container {
            max-width: 680px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .email-header {
            background-color: #00b8d4; /* Màu xanh ngọc của sóng biển, tươi mát */
            padding: 24px;
            text-align: center;
        }
        .email-header h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        .email-body {
            padding: 30px 40px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .order-summary {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .summary-item:last-child {
            border-bottom: none;
        }
        .summary-item strong {
            color: #333;
        }
        .section-title {
            font-size: 20px;
            color: #007b8f;
            border-bottom: 2px solid #00b8d4;
            padding-bottom: 10px;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        .info-table {
            width: 100%;
        }
        .info-table td {
            padding: 8px 0;
            vertical-align: top;
        }
        .info-table td:first-child {
            width: 150px;
            font-weight: bold;
            color: #333;
        }
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .products-table th, .products-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        .products-table th {
            background-color: #e9f7fa;
            color: #007b8f;
            font-weight: bold;
        }
        .products-table .total-row td {
            text-align: right;
            font-weight: bold;
            font-size: 18px;
            color: #333;
            border-top: 2px solid #00b8d4;
        }
        .email-footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="email-header">
                <h1>Softwave</h1>
                {{-- <img src="link_logo_cua_ban" alt="Softwave Logo"> --}}
            </div>
            <div class="email-body">
                <h3 class="greeting">Cảm ơn bạn, <strong>{{$shipping['customer_name']}}</strong>, đã mua sắm tại Softwave!</h3>
                <p>Chúng tôi xác nhận đã nhận được đơn hàng của bạn. Đơn hàng sẽ sớm được xử lý và vận chuyển đến bạn. Dưới đây là thông tin chi tiết:</p>

                <div class="order-summary">
                    <div class="summary-item">
                        <span>Mã đơn hàng:</span>
                        <strong>{{$order['order_code']}}</strong>
                    </div>
                    <div class="summary-item">
                        <span>Mã khuyến mãi:</span>
                        <strong>{{$order['coupon_code'] ?? 'Không áp dụng'}}</strong>
                    </div>
                    <div class="summary-item">
                        <span>Phí vận chuyển:</span>
                        <strong>{{number_format($shipping['fee'])}} VNĐ</strong>
                    </div>
                </div>

                <h4 class="section-title">Thông Tin Giao Hàng</h4>
                <table class="info-table">
                    <tr>
                        <td>Người nhận:</td>
                        <td>{{$shipping['shipping_name']}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>{{$shipping['shipping_email']}}</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại:</td>
                        <td>{{$shipping['shipping_phone']}}</td>
                    </tr>
                    <tr>
                        <td>Địa chỉ:</td>
                        <td>{{$shipping['shipping_address']}}</td>
                    </tr>
                    <tr>
                        <td>Thanh toán:</td>
                        <td>
                            @if($shipping['shipping_method'] == 0)
                                Chuyển khoản ngân hàng
                            @else
                                Thanh toán khi nhận hàng (COD)
                            @endif
                        </td>
                    </tr>
                    @if($shipping['shipping_notes'])
                    <tr>
                        <td>Ghi chú:</td>
                        <td>{{$shipping['shipping_notes']}}</td>
                    </tr>
                    @endif
                </table>

                <h4 class="section-title">Chi Tiết Đơn Hàng</h4>
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th style="text-align: center;">Số lượng</th>
                            <th style="text-align: right;">Đơn giá</th>
                            <th style="text-align: right;">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($cart_array as $cart)
                            @php
                                $sub_total = $cart['product_qty'] * $cart['product_price'];
                                $total += $sub_total;
                            @endphp
                            <tr>
                                <td>{{$cart['product_name']}}</td>
                                <td style="text-align: center;">{{$cart['product_qty']}}</td>
                                <td style="text-align: right;">{{number_format($cart['product_price'])}} VNĐ</td>
                                <td style="text-align: right;">{{number_format($sub_total)}} VNĐ</td>
                            </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="3"><strong>Tổng cộng:</strong></td>
                            <td style="text-align: right;"><strong>{{number_format($total)}} VNĐ</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="email-footer">
                <p>Đây là email tự động, vui lòng không trả lời. Nếu có bất kỳ thắc mắc nào, xin vui lòng liên hệ hotline của chúng tôi.</p>
                <p><strong>Softwave - Làn Sóng Mềm Mại, Hương Thơm Bền Lâu.</strong></p>
                <p>Hotline: 0123.456.789 | Website: softwave.com.vn</p>
            </div>
        </div>
    </div>
</body>
</html>
