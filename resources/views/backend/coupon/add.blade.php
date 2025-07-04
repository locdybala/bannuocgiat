@extends('backend.admin_layout')
@section('content')
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Quản lý mã giảm giá</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Mã giảm giá</a></li>
                                <li class="breadcrumb-item"><a href="#!">Thêm mã giảm giá</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Thêm mới mã giảm giá</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('addcoupon')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label" for="coupon_name">Tên mã giảm giá</label>
                                            <input type="text" class="form-control" required id="coupon_name" name="coupon_name"
                                                   placeholder="Nhập tên mã giảm giá"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label" for="coupon_code">Mã code giảm giá</label>
                                            <input type="text" class="form-control" required id="coupon_code" name="coupon_code"
                                                   placeholder="Nhập mã giảm giá"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label" for="stardate">Ngày bắt đầu</label>
                                            <input type="date" class="form-control" id="stardate" name="stardate"
                                                   placeholder="SD20021"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label" for="enddate">Ngày kết thúc</label>
                                            <input type="date" class="form-control" id="enddate" name="enddate"
                                                   placeholder="SD20021"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="coupon_time">Số lượng mã</label>
                                            <input type="text" class="form-control" id="coupon_time" name="coupon_time"
                                                   placeholder="10"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="coupon_condition">Tính năng mã</label>
                                            <select id="coupon_condition" name="coupon_condition" class="form-control">
                                                <option>---Chọn loại giảm giá---</option>
                                                <option value="1">Giảm theo phần trăm</option>
                                                <option value="2">Giảm theo số tiền</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="coupon_time">Nhập số % hoặc tiền giảm</label>
                                            <input type="number" class="form-control" id="coupon_number" name="coupon_number"
                                                   placeholder="10"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Thêm</button>
                                            <a href="/admin/coupon/all_coupon" class="btn btn-default">Huỷ</a>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- [ form-element ] start -->
            </div>
            <!-- [ Main Content ] end -->

        </div>
    </section>
@endsection
