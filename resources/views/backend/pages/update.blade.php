@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Quản lý trang</li>
            <li class="breadcrumb-item active" aria-current="page">Sửa trang</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Sửa trang</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_pages',['id'=>$pages->id]) }}" method="POST" id="pageEditForm" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="id" class="form-label">Mã trang</label>
                            <input type="text" class="form-control" readonly value="{{ $pages->id }}" id="id" name="id"/>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên trang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required id="name" name="name" value="{{ $pages->name }}"/>
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required id="slug" name="slug" value="{{ $pages->slug }}"/>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required id="title" name="title" value="{{ $pages->title }}"/>
                        </div>
                        <div class="mb-3">
                            <label for="ckeditor" class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea id="ckeditor" class="form-control" name="contents" placeholder="Nội dung trang" required>{!!  $pages->content  !!}</textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" id="btnSubmit" class="btn btn-warning text-dark"><i class="bi bi-pencil-square me-1"></i>Sửa</button>
                            <a href="/admin/pages/all_pages" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        CKEDITOR.replace('ckeditor');
        $("#btnSubmit").click(function () {
            var name = $("#name").val().trim();
            var slug = $("#slug").val().trim();
            var content = CKEDITOR.instances.ckeditor.getData();
            var title = $("#title").val().trim();
            if (name === '') {
                toastr["error"]("Tên trang không được bỏ trống");
                $('#name').focus();
                return false;
            } else if (slug === '') {
                toastr["error"]("Slug không được bỏ trống");
                $('#slug').focus();
                return false;
            } else if (title === '') {
                toastr["error"]("Tiêu đề không được bỏ trống");
                $('#title').focus();
                return false;
            } else if (content === '') {
                toastr["error"]("Nội dung không được bỏ trống");
                CKEDITOR.instances.ckeditor.focus();
                return false;
            }
            return true;
        });
    </script>
@endsection
