@extends('layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Đăng ký tài khoản</h2>
                            <p>Trang Chủ <span>-</span> Đăng ký</p>
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
                            <h2>Bạn đã có tài khoản?</h2>
                            <p>Hãy đăng nhập vào hệ thống để khám phá cửa hàng</p>
                            <a href="{{route('loginCustomer')}}" class="btn_3">Đăng nhập</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Xin chào bạn ! <br>
                                Đăng ký tài khoản ngay bây giờ</h3>
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
                            <form action="{{route('addCustomer')}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Họ và tên" value="{{old('customer_name')}}">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="email" id="customer_email" name="customer_email" class="form-control" placeholder="Nhập tài khoản email" value="{{old('email_account')}}">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" id="password_account" name="password_account" class="form-control" placeholder="Nhập mật khẩu" value="{{old('password_account')}}">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="date" id="customer_birthday" name="customer_birthday" class="form-control" value="{{old('customer_birthday')}}">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" id="customer_phone" name="customer_phone" class="form-control" placeholder="Số điện thoại" value="{{old('customer_phone')}}">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="file" id="customer_avatar" name="customer_avatar" class="form-control">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" id="customer_address" name="customer_address" class="form-control" placeholder="Địa chỉ" value="{{old('customer_address')}}">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <button type="submit" class="btn_3">Đăng ký</button>
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
            var customer_name = $("#customer_name").val();
            var customer_email = $("#customer_email").val();
            var password_account = $("#password_account").val();
            var customer_birthday = $("#customer_birthday").val();
            var customer_phone = $("#customer_phone").val();
            var customer_address = $("#customer_address").val();
            if (customer_name == '') {
                toastr["error"]("Không được để trống họ và tên?");
                return false;
            } else if (customer_email == '') {
                toastr["error"]("Không được để trống địa chỉ email?");
                return false;
            } else if (password_account == '') {
                toastr["error"]("Không được để trống mật khẩu?");
                return false;
            } else if (customer_birthday == '') {
                toastr["error"]("Không được để trống ngày sinh?");
                return false;
            } else if (customer_phone == '') {
                toastr["error"]("Không được để trống số điện thoại?");
                return false;
            } else if (customer_address == '') {
                toastr["error"]("Không được để trống địa chỉ?");
                return false;
            }
            return true;

        });
    </script>

@endsection
