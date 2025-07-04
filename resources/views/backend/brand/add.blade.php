@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Thương hiệu</li>
            <li class="breadcrumb-item active" aria-current="page">Thêm thương hiệu</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Thêm mới thương hiệu</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('addBrand')}}" method="POST" enctype="multipart/form-data" id="brandForm" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên thương hiệu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required id="name" name="name" placeholder="Nhập tên thương hiệu"/>
                        </div>
                        <div class="mb-3">
                            <label for="brand_image" class="form-label">Hình ảnh thương hiệu <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" required id="brand_image" name="brand_image" accept="image/*"/>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea id="ckeditor" class="form-control" name="description" rows="4" placeholder="Mô tả thương hiệu"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select id="status" name="status" class="form-select">
                                <option value="1">Hiển thị</option>
                                <option value="2">Ẩn</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" id="btnSubmit" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Thêm</button>
                            <a href="/admin/brand/all_brand" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('#btnSubmit').click(function () {
                var name = $('#name').val().trim();
                var image = $('#brand_image').val();
                if (name === '') {
                    toastr["error"]("Tên thương hiệu không được bỏ trống");
                    $('#name').focus();
                    return false;
                }
                if (image === '') {
                    toastr["error"]("Vui lòng chọn hình ảnh thương hiệu");
                    $('#brand_image').focus();
                    return false;
                }
                return true;
            });
        });
    </script>
@endsection
