@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Khách hàng</li>
            <li class="breadcrumb-item active" aria-current="page">Sửa khách hàng</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Sửa khách hàng</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateCustomer',['id'=>$customer->customer_id,'admin'=>1]) }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Họ tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name', $customer->customer_name) }}" placeholder="Nhập họ tên" required/>
                        </div>
                        <div class="mb-3">
                            <label for="customer_email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ old('customer_email', $customer->customer_email) }}" placeholder="Nhập email" required/>
                        </div>
                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', $customer->customer_phone) }}" placeholder="Nhập số điện thoại" required/>
                        </div>
                        <div class="mb-3">
                            <label for="customer_birthday" class="form-label">Ngày sinh <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="customer_birthday" name="customer_birthday" value="{{ old('customer_birthday', $customer->customer_birthday) }}" required/>
                        </div>
                        <div class="mb-3">
                            <label for="customer_address" class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_address" name="customer_address" value="{{ old('customer_address', $customer->customer_address) }}" placeholder="Nhập địa chỉ" required/>
                        </div>
                        <div class="mb-3">
                            <label for="customer_vip" class="form-label">Loại khách hàng <span class="text-danger">*</span></label>
                            <select id="customer_vip" name="customer_vip" class="form-select" required>
                                <option value="1" {{ old('customer_vip', $customer->customer_vip) == 1 ? 'selected' : '' }}>Khách hàng Vip</option>
                                <option value="0" {{ old('customer_vip', $customer->customer_vip) == 0 ? 'selected' : '' }}>Khách hàng thường</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i>Sửa</button>
                            <a href="{{ route('all_customer') }}" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


