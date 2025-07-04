@extends('layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Đăng nhập tài khoản</h2>
                            <p>Trang Chủ <span>-</span> Đăng nhập</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Page Start -->
    <section class="login_part padding_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>Bạn là khách hàng mới?</h2>
                            <p>Bạn muốn sử dụng trang web và mua hàng trực tuyến</p>
                            <a href="{{route('registerCustomer')}}" class="btn_3">Tạo mới tài khoản</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Chào mừng trở lại! <br> Vui lòng đăng nhập ngay bây giờ</h3>
                            @if(session()->has('success'))
                                <div class="alert alert-success alert-block">
                                    {{session()->get('success')}}
                                    @php session()->forget('success') @endphp
                                </div>
                            @elseif(session()->has('error'))
                                <div class="alert alert-danger alert-block">
                                    {{session()->get('error')}}
                                    @php session()->forget('error') @endphp
                                </div>
                            @endif
                            <form class="row contact_form" action="{{route('login_customer')}}" method="POST">
                                {{csrf_field()}}
                                <div class="col-md-12 form-group p_star">
                                    <input type="email" class="form-control" id="email_account" name="email_account" value="{{old('email_account')}}" placeholder="Tài khoản email">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password_account" name="password_account" value="{{old('password_account')}}" placeholder="Mật khẩu">
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" id="f-option" name="selector">
                                        <label for="f-option">Ghi nhớ đăng nhập</label>
                                    </div>
                                    <button type="submit" id="btnSubmit" value="submit" class="btn_3">Đăng nhập</button>
                                    <a class="lost_pass" href="{{route('forgot_pass')}}">Quên mật khẩu?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
