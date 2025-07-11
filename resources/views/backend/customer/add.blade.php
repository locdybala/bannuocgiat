@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Khách hàng</li>
            <li class="breadcrumb-item active" aria-current="page">Thêm khách hàng</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Thêm mới khách hàng</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('addCustomers') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Họ tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Nhập họ tên" required/>
                        </div>
                        <div class="mb-3">
                            <label for="customer_email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Nhập email" required/>
                        </div>
                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Nhập số điện thoại" required/>
                        </div>
                        <div class="mb-3">
                            <label for="customer_password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="customer_password" name="customer_password" placeholder="Nhập mật khẩu" required/>
                        </div>
                        <div class="mb-3">
                            <label for="customer_birthday" class="form-label">Ngày sinh <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="customer_birthday" name="customer_birthday"  required/>
                        </div>
                        <div class="mb-3">
                            <label for="customer_address" class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Nhập địa chỉ" required/>
                        </div>
                        <div class="mb-3">
                            <label for="customer_vip" class="form-label">Loại khách hàng <span class="text-danger">*</span></label>
                            <select id="customer_vip" name="customer_vip" class="form-select" required>
                                <option value="1">Khách hàng Vip</option>
                                <option value="0">Khách hàng thường</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Thêm</button>
                            <a href="{{ route('all_customer') }}" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


