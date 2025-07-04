@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Tài khoản quản trị</li>
            <li class="breadcrumb-item active" aria-current="page">Sửa tài khoản</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Sửa tài khoản</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('updateUser', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data" id="userEditForm" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên tài khoản <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required/>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Địa chỉ email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required/>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password"/>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="{{$user->birthday}}"/>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}"/>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}"/>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" id="btnSubmit" class="btn btn-warning text-dark"><i class="bi bi-pencil-square me-1"></i>Sửa</button>
                            <a href="/admin/all_user" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#btnSubmit").click(function () {
            var name = $("#name").val().trim();
            var email = $("#email").val().trim();
            if (name === '') {
                toastr["error"]("Tên tài khoản không được bỏ trống");
                $('#name').focus();
                return false;
            } else if (email === '') {
                toastr["error"]("Không được bỏ trống tài khoản email");
                $('#email').focus();
                return false;
            }
            return true;
        });
    </script>
@endsection


