<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            color: #555;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e0e0e0;
        }
        .email-header {
            background-color: #007bff; /* Một màu xanh tươi mát, sạch sẽ */
            padding: 30px 20px;
            text-align: center;
        }
        .email-header img {
            max-width: 120px;
            filter: brightness(0) invert(1); /* Đổi màu logo thành trắng để nổi bật trên nền xanh */
        }
        .email-body {
            padding: 30px 40px;
            text-align: left;
            line-height: 1.7;
        }
        h3 {
            color: #0056b3; /* Màu xanh đậm hơn */
            font-size: 22px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .btn-reset {
            display: inline-block;
            padding: 14px 28px;
            margin: 20px 0;
            background-image: linear-gradient(45deg, #007bff, #0056b3);
            color: white !important; /* Quan trọng để ghi đè màu mặc định của link */
            text-decoration: none;
            font-size: 16px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
            transition: all 0.3s ease;
        }
        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
        }
        .link-fallback {
            word-wrap: break-word;
            font-size: 13px;
            color: #007bff;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            color: #888;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            {{-- Giữ nguyên link logo của bạn --}}
            <img src="{{$message->embed(public_path('frontend/img/logo/logo.png'))}}" alt="Logo Cửa hàng">
        </div>
        <div class="email-body">
            <h3>Yêu cầu đặt lại mật khẩu</h3>
            <p>Xin chào,</p>
            <p>Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn tại <strong>Cửa Hàng Nước Giặt Sạch Thơm</strong>. Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này một cách an toàn.</p>
            <p>Để tiếp tục, bạn vui lòng nhấn vào nút bên dưới:</p>

            <div style="text-align: center;">
                 {{-- Giữ nguyên biến link của bạn --}}
                <a href="{{ $data['body'] }}" class="btn-reset">Đặt Lại Mật Khẩu</a>
            </div>

            <p style="margin-top: 30px; font-size: 14px;">Nếu nút trên không hoạt động, vui lòng sao chép và dán liên kết sau vào trình duyệt của bạn:</p>
            <p><a href="{{ $data['body'] }}" class="link-fallback">{{ $data['body'] }}</a></p>

            <p style="font-size: 14px;"><strong>Lưu ý:</strong> Vì lý do bảo mật, liên kết này sẽ hết hạn sau 60 phút.</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Cửa Hàng Nước Giặt Sạch Thơm. Mọi quyền được bảo lưu.</p>
        </div>
    </div>
</body>
</html>
