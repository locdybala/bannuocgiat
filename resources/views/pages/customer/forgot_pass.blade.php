@extends('layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Quên mật khẩu</h2>
                            <p>Trang Chủ <span>-</span> Quên mật khẩu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-3"></div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <h3 style="text-align: center">Bạn quên mật khẩu <br>
                        Vui lòng nhập đúng địa chỉ email của bạn</h3>
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
                    <form action="{{route('send_mail_forgot_pass')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="email_account" class="form-label my-3">Tài khoản email<sup>*</sup></label>
                            <input type="email" id="email_account" name="email_account" class="form-control"
                                   placeholder="Nhập tài khoản email" value="{{old('email_account')}}">
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" id="btnSubmit"
                                    class="btn_3">Lấy lại mật khẩu
                            </button>
                            <a class="lost_pass" href="{{route('login')}}">Đăng nhập</a>
                        </div>
                    </form>
                    <div class="col-lg-3"></div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script type="text/javascript">

        $("#btnSubmit").click(function () {
            var email_account = $("#email_account").val();

            if (email_account == '') {
                toastr["error"]("Không được để trống email");
                return false;
            }
            return true;
        });
    </script>

@endsection
