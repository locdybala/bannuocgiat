@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Thương hiệu</li>
            <li class="breadcrumb-item active" aria-current="page">Sửa thương hiệu</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Sửa thương hiệu</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_brand',['id'=>$brand->brand_id]) }}" method="POST" enctype="multipart/form-data" id="brandEditForm" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Mã thương hiệu</label>
                            <input type="text" class="form-control" readonly value="{{ $brand->brand_id }}" id="brand_id" name="id" />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên thương hiệu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required id="name" name="name" value="{{ $brand->brand_name }}"/>
                        </div>
                        <div class="mb-3">
                            <label for="brand_image" class="form-label">Hình ảnh thương hiệu</label>
                            <input type="file" class="form-control" id="brand_image" name="brand_image" accept="image/*"/>
                            @if($brand->brand_image)
                                <img src="/upload/brand/{{ $brand->brand_image }}" style="width:100px;height:auto;margin-top:10px;border-radius:8px;box-shadow:0 2px 8px #eee;">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea id="ckeditor" class="form-control" name="description" rows="4" placeholder="Mô tả thương hiệu">{!!  $brand->brand_desc  !!}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select id="status" name="status" class="form-select">
                                <option @if($brand->brand_status == 1) selected @endif value="1">Hiển thị</option>
                                <option @if($brand->brand_status == 2) selected @endif value="2">Ẩn</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" id="btnSubmit" class="btn btn-warning text-dark"><i class="bi bi-pencil-square me-1"></i>Sửa</button>
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
                if (name === '') {
                    toastr["error"]("Tên thương hiệu không được bỏ trống");
                    $('#name').focus();
                    return false;
                }
                return true;
            });
        });
    </script>
@endsection
