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
                                <h5 class="m-b-10">Thêm khách hàng</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Khách hàng</a></li>
                                <li class="breadcrumb-item"><a href="#!">Thêm khách hàng</a></li>
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
                            <h5>Thêm khách hàng</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('addCustomers')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="customer_name">Tên khách hàng</label>
                                            <input type="text" class="form-control"
                                                   id="customer_name" name="customer_name"/>

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="customer_name">Địa chỉ email</label>
                                            <input type="text" class="form-control"
                                                   id="basic-default-name"
                                                   name="customer_email"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="password">Mật khẩu</label>
                                            <input type="password" class="form-control"
                                                   id="password"
                                                   name="customer_password"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="customer_name">Ngày sinh</label>
                                            <input type="date" class="form-control"
                                                   id="basic-default-name"
                                                   name="customer_birthday"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="customer_name">Số điện thoại</label>
                                            <input type="text" class="form-control"
                                                   id="basic-default-name" name="customer_phone"/>

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="customer_name">Địa chỉ</label>
                                            <input type="text" class="form-control"
                                                   id="basic-default-name" name="customer_address"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="customer_vip">Loại khách hàng</label>
                                            <select name="customer_vip" class="form-control">
                                                <option value="1">Khách hàng Vip</option>
                                                <option value="0">Khách hàng thường</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Thêm</button>
                                            <a href="/admin/customer/all_customer" class="btn btn-default">Huỷ</a>
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


