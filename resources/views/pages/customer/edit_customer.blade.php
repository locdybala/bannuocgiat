@extends('layout')
@section('title', 'Thông tin tài khoản')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('/frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                        <span>Tài khoản của tôi</span>
                    </p>
                    <h1 class="mb-0 bread">Thông Tin Tài Khoản</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar-box ftco-animate">
                        <div class="profile-info text-center mb-4">
                            <div class="profile-avatar mb-2">
                                @if ($customer->customer_avatar)
                                    <img src="{{ asset('upload/customer/' . $customer->customer_avatar) }}" alt="Avatar"
                                        class="rounded-circle" width="100" height="100">
                                @else
                                    {{-- Ảnh mặc định nếu người dùng chưa có avatar --}}
                                    <img src="{{ asset('frontend/images/default-avatar.png') }}" alt="Avatar"
                                        class="rounded-circle" width="100" height="100">
                                @endif
                            </div>
                            <h5 class="profile-name">{{ $customer->customer_name }}</h5>
                        </div>
                        <ul class="categories">
                            {{-- Dùng icon ion-ios-... của theme Vegefoods --}}
                            <li class="active"><a
                                    href="{{ URL::to('/edit-customer/' . Session::get('customer_id')) }}"><span><i
                                            class="ion-ios-person"></i> Thông tin tài khoản</span></a></li>
                            <li><a href="{{ route('history') }}"><span><i class="ion-ios-list-box"></i> Lịch sử mua
                                        hàng</span></a></li>
                            <li><a href="{{ route('logout') }}"><span><i class="ion-ios-log-out"></i> Đăng xuất</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="billing-form ftco-animate">
                        <h3 class="mb-4 billing-heading">Cập nhật thông tin tài khoản</h3>

                        @if (session()->has('message'))
                            <div class="alert alert-success">{{ session()->get('message') }}</div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">{{ session()->get('error') }}</div>
                        @endif

                        {{-- Giữ nguyên action và enctype --}}
                        <form action="{{ route('addCustomer') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="customer_name">Họ và tên</label>
                                    <input type="text" name="customer_name" class="form-control"
                                        value="{{ $customer->customer_name }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="customer_email">Email</label>
                                    <input type="email" name="customer_email" class="form-control"
                                        value="{{ $customer->customer_email }}" required>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-6 form-group">
                                    <label for="password_account">Mật khẩu mới</label>
                                    <input type="password" name="password_account" class="form-control"
                                        placeholder="Bỏ trống nếu không muốn đổi">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="customer_phone">Số điện thoại</label>
                                    <input type="text" name="customer_phone" class="form-control"
                                        value="{{ $customer->customer_phone }}" required>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12 form-group">
                                    <label for="customer_address">Địa chỉ</label>
                                    <input type="text" name="customer_address" class="form-control"
                                        value="{{ $customer->customer_address }}">
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12 form-group">
                                    <label for="customer_avatar">Thay đổi ảnh đại diện</label>
                                    <input type="file" name="customer_avatar" class="form-control-file">
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary py-3 px-4">Lưu thay đổi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btnSubmit").click(function() {
                var customer_name = $("#customer_name").val();
                var customer_email = $("#customer_email").val();
                var customer_birthday = $("#customer_birthday").val();
                var customer_phone = $("#customer_phone").val();
                var customer_address = $("#customer_address").val();

                if (!customer_name.trim()) {
                    toastr["error"]("Không được để trống họ và tên!");
                    return false;
                }
                if (!customer_email.trim()) {
                    toastr["error"]("Không được để trống địa chỉ email!");
                    return false;
                }
                if (!customer_birthday.trim()) {
                    toastr["error"]("Không được để trống ngày sinh!");
                    return false;
                }
                if (!customer_phone.trim()) {
                    toastr["error"]("Không được để trống số điện thoại!");
                    return false;
                }
                if (!customer_address.trim()) {
                    toastr["error"]("Không được để trống địa chỉ!");
                    return false;
                }

                return true;
            });
        });
    </script>
@endsection
