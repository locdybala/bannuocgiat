@extends('layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('/frontend/images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                    <span>Đăng nhập</span>
                </p>
                <h1 class="mb-0 bread">Đăng Nhập Tài Khoản</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                {{-- Bọc form trong một khung để đẹp hơn --}}
                <div class="billing-form">
                    <h3 class="mb-4 billing-heading">Để tiếp tục, vui lòng đăng nhập</h3>

                    {{-- Hiển thị thông báo thành công hoặc thất bại --}}
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                            @php session()->forget('success'); @endphp
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                             @php session()->forget('error'); @endphp
                        </div>
                    @endif

                    <form action="{{route('login_customer')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email_account">Tài khoản Email</label>
                                    <input type="email" class="form-control" name="email_account" placeholder="Nhập địa chỉ email của bạn" value="{{old('email_account')}}" required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password_account">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password_account" placeholder="Nhập mật khẩu của bạn" required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <div class="radio">
                                        {{-- Ghi nhớ đăng nhập & Quên mật khẩu --}}
                                        <label class="mr-3"><input type="checkbox" name="remember"> Ghi nhớ đăng nhập</label>
                                        <a href="{{route('forgot_pass')}}" class="ml-5">Quên mật khẩu?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <p><button type="submit" class="btn btn-primary py-3 px-4">Đăng nhập</button></p>
                            </div>
                        </div>
                    </form></div>

                <div class="text-center mt-4">
                    <p>Bạn chưa có tài khoản? <a href="{{route('registerCustomer')}}">Đăng ký ngay</a></p>
                </div>
            </div> </div>
    </div>
</section>
@endsection
@section('javascript')
    <script type="text/javascript">

        $("#btnSubmit").click(function () {
            var password_account = $("#password_account").val();
            var email_account = $("#email_account").val();

            if (email_account == '') {
                toastr.error("Không được để trống email đăng nhập");
                return false;
            }
            // Kiểm tra mật khẩu
            else if (password_account == '') {
                toastr.error("Không được để trống mật khẩu");
                return false;
            }
            return true; // Nếu hợp lệ, tiếp tục form submit
        });
    </script>

@endsection
