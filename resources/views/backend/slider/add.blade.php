@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Slider</li>
            <li class="breadcrumb-item active" aria-current="page">Thêm slider</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Thêm mới slider</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('addSlider')}}" method="POST" enctype="multipart/form-data" id="sliderForm" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên slider <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên ảnh" required/>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Ảnh <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required/>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea id="ckeditor" class="form-control" name="description" rows="3" placeholder="Mô tả slider"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="1">Hiển thị</option>
                                <option value="2">Ẩn</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Thêm</button>
                            <a href="/admin/slider/all_slider" class="btn btn-outline-secondary">Huỷ</a>
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
    </script>
@endsection
