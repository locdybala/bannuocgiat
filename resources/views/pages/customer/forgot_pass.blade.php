@extends('layout')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('/frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                        <span>Quên Mật Khẩu</span>
                    </p>
                    <h1 class="mb-0 bread">Khôi Phục Mật Khẩu</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 ftco-animate">
                    <div class="billing-form">
                        <h3 class="mb-4 billing-heading">Khôi phục mật khẩu của bạn</h3>
                        <p class="mb-4">Vui lòng nhập địa chỉ email đã đăng ký. Chúng tôi sẽ gửi cho bạn một liên kết để
                            đặt lại mật khẩu.</p>

                        {{-- Hiển thị thông báo thành công hoặc thất bại --}}
                        @if (session()->has('success'))
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

                        <form action="{{ route('send_mail_forgot_pass') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row align-items-end">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email_account">Địa chỉ Email</label>
                                        <input type="email" name="email_account" class="form-control"
                                            placeholder="your.email@example.com" value="{{ old('email_account') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary py-3 px-4">Gửi Link Khôi Phục</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="text-center mt-4">
                        <p>Đã nhớ lại mật khẩu? <a href="{{ route('loginCustomer') }}">Đăng nhập ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script type="text/javascript">
        $("#btnSubmit").click(function() {
            var email_account = $("#email_account").val();

            if (email_account == '') {
                toastr["error"]("Không được để trống email");
                return false;
            }
            return true;
        });
    </script>
@endsection
