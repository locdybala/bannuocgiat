@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Thư viện ảnh</li>
            <li class="breadcrumb-item active" aria-current="page">Thêm ảnh</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Thêm mới ảnh vào gallery</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên ảnh <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên ảnh" required/>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Mô tả ảnh"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Chọn ảnh <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required onchange="previewGalleryImage(event)"/>
                            <img id="gallery-preview" style="display:none; margin-top:10px; max-height:120px; border-radius:8px; border:1px solid #eee;"/>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Thêm</button>
                            <a href="{{ route('gallery.index') }}" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function previewGalleryImage(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('gallery-preview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }
    </script>
@endsection
