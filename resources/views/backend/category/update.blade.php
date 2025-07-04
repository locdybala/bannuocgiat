@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Danh mục</li>
            <li class="breadcrumb-item active" aria-current="page">Sửa danh mục</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Sửa danh mục</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_category',['id'=>$category->category_id]) }}" method="POST" id="categoryEditForm" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="id-category" class="form-label">Mã danh mục <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" disabled required id="id-category" name="id" value="{{ $category->category_id }}"/>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $category->category_name }}"/>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea id="ckeditor" class="form-control" name="description" rows="4" placeholder="Mô tả danh mục">{!!  $category->category_desc  !!}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select id="status" name="status" class="form-select">
                                <option @if($category->category_status == 1) selected @endif value="1">Hiển thị</option>
                                <option @if($category->category_status == 2) selected @endif value="2">Ẩn</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" id="btnSubmit" class="btn btn-warning text-white"><i class="bi bi-pencil-square me-1"></i>Sửa</button>
                            <a href="/admin/category/all_category" class="btn btn-outline-secondary">Huỷ</a>
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
                    toastr["error"]("Tên danh mục không được bỏ trống");
                    $('#name').focus();
                    return false;
                }
                return true;
            });
        });
    </script>
@endsection
