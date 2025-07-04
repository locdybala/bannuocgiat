<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .logo img {
            max-width: 120px;
        }
        h3 {
            color: #333;
            margin-bottom: 10px;
        }
        p {
            color: #555;
            font-size: 14px;
            line-height: 1.6;
        }
        .btn-reset {
            display: inline-block;
            padding: 12px 24px;
            margin: 20px 0;
            background: #28a745;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn-reset:hover {
            background: #218838;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="{{asset('frontend/img/logo/logo.png')}}" alt="Logo Cửa hàng Điện thoại">
    </div>
    <h3>Yêu cầu đặt lại mật khẩu</h3>
    <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Nếu bạn không yêu cầu điều này, vui lòng bỏ qua email này.</p>
    <p>Để đặt lại mật khẩu, vui lòng nhấn vào nút dưới đây:</p>
    <a href="{{$data['body']}}" class="btn-reset">Đặt lại mật khẩu</a>
    <p>Nếu nút không hoạt động, bạn có thể sao chép và dán liên kết này vào trình duyệt:</p>
    <p><a href="{{$data['body']}}">{{$data['body']}}</a></p>
    <p><strong>Lưu ý:</strong> Liên kết này sẽ hết hạn trong 3 giờ. Nếu bạn cần yêu cầu mới, vui lòng truy cập <a href="http://127.0.0.1:8000/forgot_pass">trang đặt lại mật khẩu</a>.</p>
    <div class="footer">
        <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
        <p><strong>Cửa hàng Điện thoại</strong></p>
    </div>
</div>
</body>
</html>
