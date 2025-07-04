@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Slider</li>
            <li class="breadcrumb-item active" aria-current="page">Sửa slider</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Sửa slider</h5>
                </div>
                <div class="card-body">
                    <form action="{{  route('update_slider',['id'=>$slider->slider_id]) }}" method="POST" enctype="multipart/form-data" id="sliderEditForm" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên slider <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $slider->slider_name }}" class="form-control" id="name" name="name" placeholder="Tên ảnh" required/>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Ảnh</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*"/>
                            @if($slider->slider_image)
                                <img class="input-rounded mt-2" src="{{ URL::to('/upload/slider/'.$slider->slider_image) }}" height="80" style="border-radius:8px;box-shadow:0 2px 8px #eee;object-fit:cover;" alt="">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea id="ckeditor" class="form-control" name="description" rows="3" placeholder="Mô tả slider">{!!  $slider->slider_desc !!}</textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning text-dark"><i class="bi bi-pencil-square me-1"></i>Sửa</button>
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
