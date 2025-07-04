@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Mã giảm giá</li>
            <li class="breadcrumb-item active" aria-current="page">Sửa mã giảm giá</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Sửa mã giảm giá</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('update_coupon', ['id' => $coupon->coupon_id])}}" method="POST" enctype="multipart/form-data" id="couponEditForm" autocomplete="off">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="coupon_name" class="form-label">Tên mã giảm giá <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$coupon->coupon_name}}" required id="coupon_name" name="coupon_name" placeholder="Nhập tên mã giảm giá"/>
                            </div>
                            <div class="col-md-6">
                                <label for="coupon_code" class="form-label">Mã code giảm giá <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$coupon->coupon_code}}" required id="coupon_code" name="coupon_code" placeholder="Nhập mã giảm giá"/>
                            </div>
                            <div class="col-md-6">
                                <label for="stardate" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" value="{{$coupon->coupon_date_start}}" id="stardate" name="stardate" required/>
                            </div>
                            <div class="col-md-6">
                                <label for="enddate" class="form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" value="{{$coupon->coupon_date_end}}" id="enddate" name="enddate" required/>
                            </div>
                            <div class="col-12">
                                <label for="coupon_time" class="form-label">Số lượng mã <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" value="{{$coupon->coupon_time}}" id="coupon_time" name="coupon_time" placeholder="10" required/>
                            </div>
                            <div class="col-12">
                                <label for="coupon_condition" class="form-label">Tính năng mã <span class="text-danger">*</span></label>
                                <select id="coupon_condition" name="coupon_condition" class="form-select" required>
                                    <option value="">---Chọn loại giảm giá---</option>
                                    <option @if($coupon->coupon_condition == 1) selected @endif value="1">Giảm theo phần trăm</option>
                                    <option @if($coupon->coupon_condition == 2) selected @endif value="2">Giảm theo số tiền</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="coupon_number" class="form-label">Nhập số % hoặc tiền giảm <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" value="{{$coupon->coupon_number}}" id="coupon_number" name="coupon_number" placeholder="10" required/>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-warning text-dark"><i class="bi bi-pencil-square me-1"></i>Sửa</button>
                            <a href="/admin/coupon/all_coupon" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
