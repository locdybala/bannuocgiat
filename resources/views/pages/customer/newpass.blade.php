@extends('layout')
@section('title', 'Đặt lại mật khẩu')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('/frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                        <span>Đặt Lại Mật Khẩu</span>
                    </p>
                    <h1 class="mb-0 bread">Đặt Lại Mật Khẩu Mới</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 ftco-animate">
                    <div class="billing-form">
                        <h3 class="mb-4 billing-heading">Tạo mật khẩu mới cho tài khoản của bạn</h3>

                        {{-- Giữ nguyên logic hiển thị thông báo --}}
                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session()->get('success') }}</div>
                            @php session()->forget('success'); @endphp
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">{{ session()->get('error') }}</div>
                            @php session()->forget('error'); @endphp
                        @endif

                        {{-- Giữ nguyên logic lấy token và email từ URL --}}
                        @php
                            $token = $_GET['token'] ?? '';
                            $email = $_GET['email'] ?? '';
                        @endphp

                        <form action="{{ route('update_pass') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row align-items-end">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email_account">Tài khoản Email</label>
                                        {{-- Giữ nguyên việc email không thể sửa đổi --}}
                                        <input type="email" name="email_account" class="form-control"
                                            value="{{ $email }}" readonly>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password_account">Mật khẩu mới</label>
                                        <input type="password" name="password_account" class="form-control"
                                            placeholder="Nhập mật khẩu mới" required>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary py-3 px-4">Lưu Mật Khẩu</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('loginCustomer') }}">Quay lại trang Đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
