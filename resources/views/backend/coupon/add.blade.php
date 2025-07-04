@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Mã giảm giá</li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mã giảm giá</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Thêm mới mã giảm giá</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('addcoupon')}}" method="POST" enctype="multipart/form-data" id="couponForm" autocomplete="off">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="coupon_name" class="form-label">Tên mã giảm giá <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="coupon_name" name="coupon_name" placeholder="Nhập tên mã giảm giá"/>
                            </div>
                            <div class="col-md-6">
                                <label for="coupon_code" class="form-label">Mã code giảm giá <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="coupon_code" name="coupon_code" placeholder="Nhập mã giảm giá"/>
                            </div>
                            <div class="col-md-6">
                                <label for="stardate" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="stardate" name="stardate" required/>
                            </div>
                            <div class="col-md-6">
                                <label for="enddate" class="form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="enddate" name="enddate" required/>
                            </div>
                            <div class="col-12">
                                <label for="coupon_time" class="form-label">Số lượng mã <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="coupon_time" name="coupon_time" placeholder="10" required/>
                            </div>
                            <div class="col-12">
                                <label for="coupon_condition" class="form-label">Tính năng mã <span class="text-danger">*</span></label>
                                <select id="coupon_condition" name="coupon_condition" class="form-select" required>
                                    <option value="">---Chọn loại giảm giá---</option>
                                    <option value="1">Giảm theo phần trăm</option>
                                    <option value="2">Giảm theo số tiền</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="coupon_number" class="form-label">Nhập số % hoặc tiền giảm <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="coupon_number" name="coupon_number" placeholder="10" required/>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Thêm</button>
                            <a href="/admin/coupon/all_coupon" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
