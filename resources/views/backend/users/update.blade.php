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
                                <h5 class="m-b-10">Sửa tài khoản</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Tài khoản quản trị</a></li>
                                <li class="breadcrumb-item"><a href="#!">Sửa tài khoản</a></li>
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
                            <h5>Sửa tài khoản</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('updateUser', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="name">Tên tài khoản <span class="required">(*)</span></label>
                                            <input type="text" class="form-control"
                                                   id="name" name="name" value="{{$user->name}}"/>

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="email">Địa chỉ email <span class="required">(*)</span></label>
                                            <input type="text" class="form-control"
                                                   id="email"
                                                   name="email" value="{{$user->email}}"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="password">Mật khẩu </label>
                                            <input type="password" class="form-control"
                                                   id="password"
                                                   name="password" />
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="birthday">Ngày sinh</label>
                                            <input type="date" class="form-control"
                                                   id="birthday"
                                                   name="birthday" value="{{$user->birthday}}"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="phone">Số điện thoại</label>
                                            <input type="text" class="form-control"
                                                   id="phone" name="phone" value="{{$user->phone}}"/>

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="address">Địa chỉ</label>
                                            <input type="text" class="form-control"
                                                   id="address" name="address" value="{{$user->address}}"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" id="btnSubmit" class="btn btn-primary">Sửa</button>
                                            <a href="/admin/all_user" class="btn btn-default">Huỷ</a>
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
@section('js')
    <script>
        CKEDITOR.replace('ckeditor');
        $("#btnSubmit").click(function () {
            var name = $("#name").val();
            var email = $("#email").val();
            var password = $("#password").val();
            if (name == '') {
                toastr["error"]("Tên tài khoản không được bỏ trống");
                return false;
            } else if (email == '') {
                toastr["error"]("Không được bỏ trống tài khoản email");
                return false;
            }
            return true;
        });
    </script>
@endsection


