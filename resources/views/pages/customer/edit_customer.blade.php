@extends('layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Thay đổi thông tin</h2>
                            <p>Trang chủ <span>-</span> Thông tin khách hàng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Page Start -->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="row g-4">
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="p-4 bg-light rounded shadow-sm">
                        <h4 class="mb-3">Quản lý tài khoản</h4>
                        <ul class="list-group">
                            <li class="list-group-item border-0">
                                <a href="{{ URL::to('/edit-customer/' . Session::get('customer_id')) }}" class="text-dark">
                                    <i class="fas fa-user me-2"></i>Thông tin tài khoản
                                </a>
                            </li>
                            <li class="list-group-item border-0">
                                <a href="{{ route('history') }}" class="text-dark">
                                    <i class="fas fa-history me-2"></i>Lịch sử mua hàng
                                </a>
                            </li>
                            <li class="list-group-item border-0">
                                <a href="{{ route('logout') }}" class="text-dark">
                                    <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Form chỉnh sửa thông tin -->
                <div class="col-lg-9">
                    <div class="p-4 bg-light rounded shadow-sm">
                        <h3 class="mb-4">Thay đổi thông tin khách hàng</h3>

                        @if(session()->has('message'))
                            <div class="alert alert-success">{{ session()->get('message') }}</div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">{{ session()->get('error') }}</div>
                        @endif

                        <form action="{{ route('addCustomer') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="customer_name" class="form-label">Họ tên <sup>*</sup></label>
                                    <input type="text" id="customer_name" name="customer_name" class="form-control"
                                           value="{{ $customer->customer_name }}" placeholder="Họ và tên">
                                </div>
                                <div class="col-md-6">
                                    <label for="customer_email" class="form-label">Email <sup>*</sup></label>
                                    <input type="email" id="customer_email" name="customer_email" class="form-control"
                                           value="{{ $customer->customer_email }}" placeholder="Nhập email">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="password_account" class="form-label">Mật khẩu</label>
                                    <input type="password" id="password_account" name="password_account"
                                           class="form-control" placeholder="Nhập mật khẩu">
                                </div>
                                <div class="col-md-6">
                                    <label for="customer_birthday" class="form-label">Ngày sinh <sup>*</sup></label>
                                    <input type="date" id="customer_birthday" name="customer_birthday"
                                           class="form-control" value="{{ $customer->customer_birthday }}">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="customer_phone" class="form-label">Số điện thoại <sup>*</sup></label>
                                    <input type="text" id="customer_phone" name="customer_phone"
                                           class="form-control" value="{{ $customer->customer_phone }}"
                                           placeholder="Số điện thoại">
                                </div>
                                <div class="col-md-6">
                                    <label for="customer_address" class="form-label">Địa chỉ <sup>*</sup></label>
                                    <input type="text" id="customer_address" name="customer_address"
                                           class="form-control" value="{{ $customer->customer_address }}"
                                           placeholder="Địa chỉ">
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="customer_avatar" class="form-label">Avatar</label>
                                <input type="file" id="customer_avatar" name="customer_avatar" class="form-control">
                                @if($customer->customer_avatar)
                                    <div class="mt-2">
                                        <img src="{{ asset('upload/customer/' . $customer->customer_avatar) }}"
                                             class="rounded-circle border shadow" width="100" height="100">
                                    </div>
                                @else
                                    <p class="text-muted">Chưa có ảnh</p>
                                @endif
                            </div>

                            <button type="submit" id="btnSubmit" class="btn btn-primary mt-4">
                                <i class="fas fa-save"></i> Cập nhật
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#btnSubmit").click(function () {
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
