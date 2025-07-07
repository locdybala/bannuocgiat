@extends('layout')
@section('title', 'Đăng ký')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('/frontend/images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                    <span>Đăng ký</span>
                </p>
                <h1 class="mb-0 bread">Tạo Tài Khoản Mới</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 ftco-animate">
                <div class="billing-form">
                    <h3 class="mb-4 billing-heading">Điền thông tin để tạo tài khoản</h3>

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

                    {{-- Đảm bảo giữ nguyên action, method và enctype --}}
                    <form action="{{route('addCustomer')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row align-items-end">
                            {{-- Sắp xếp các trường thành 2 cột cho gọn --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_name">Họ và tên</label>
                                    <input type="text" name="customer_name" class="form-control" placeholder="Ví dụ: Nguyễn Văn A" value="{{old('customer_name')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_email">Địa chỉ Email</label>
                                    <input type="email" name="customer_email" class="form-control" placeholder="your.email@example.com" value="{{old('customer_email')}}" required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password_account">Mật khẩu</label>
                                    <input type="password" name="password_account" class="form-control" placeholder="Tối thiểu 6 ký tự" required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_phone">Số điện thoại</label>
                                    <input type="text" name="customer_phone" class="form-control" placeholder="Số điện thoại của bạn" value="{{old('customer_phone')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_birthday">Ngày sinh</label>
                                    <input type="date" name="customer_birthday" class="form-control" value="{{old('customer_birthday')}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_address">Địa chỉ</label>
                                    <input type="text" name="customer_address" class="form-control" placeholder="Số nhà, tên đường, phường/xã..." value="{{old('customer_address')}}">
                                </div>
                            </div>
                             <div class="w-100"></div>
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label for="customer_avatar">Ảnh đại diện (tùy chọn)</label>
                                    <input type="file" name="customer_avatar" class="form-control-file">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary py-3 px-4">Đăng ký</button>
                                </div>
                            </div>
                        </div>
                    </form></div>

                <div class="text-center mt-4">
                    <p>Bạn đã có tài khoản? <a href="{{route('loginCustomer')}}">Đăng nhập tại đây</a></p>
                </div>
            </div> </div>
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
