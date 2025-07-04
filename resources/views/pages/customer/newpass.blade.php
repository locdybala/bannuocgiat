@extends('layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Lấy lại mật khẩu</h2>
                            <p>Trang chủ <span>-</span> Đổi mật khẩu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-5 d-flex justify-content-center">
        <div class="col-md-6 bg-light p-4 rounded shadow">
            <h3 class="text-center mb-4">Thay đổi mật khẩu mới</h3>
            @if(session()->has('success'))
                <div class="alert alert-success">{{ session()->get('success') }}</div>
                @php session()->forget('success') @endphp
            @elseif(session()->has('error'))
                <div class="alert alert-danger">{{ session()->get('error') }}</div>
                @php session()->forget('error') @endphp
            @endif

            @php
                $token = $_GET['token'] ?? '';
                $email = $_GET['email'] ?? '';
            @endphp

            <form action="{{ route('update_pass') }}" method="POST">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="email_account" class="form-label">Tài khoản Email <sup class="text-danger">*</sup></label>
                    <input type="email" id="email_account" name="email_account" class="form-control" value="{{ $email }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="password_account" class="form-label">Mật khẩu mới <sup class="text-danger">*</sup></label>
                    <input type="password" id="password_account" name="password_account" class="form-control" placeholder="Nhập mật khẩu mới" required>
                </div>
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="d-grid">
                    <button type="submit" id="btnSubmit" class="btn btn-success">Lưu mật khẩu</button>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-primary">Quay lại đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        document.getElementById("btnSubmit").addEventListener("click", function(event) {
            var password = document.getElementById("password_account").value;
            if (password.trim() === '') {
                event.preventDefault();
                alert("Không được để trống mật khẩu");
            }
        });
    </script>
@endsection
