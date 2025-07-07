@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Liên hệ</li>
            <li class="breadcrumb-item active" aria-current="page">Sửa thông tin website</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Sửa thông tin website</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('update_info',['id'=>$contact->info_id])}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="info_facebook" class="form-label">Link Facebook</label>
                            <input type="text" class="form-control" id="info_facebook" name="info_facebook" value="{{ old('info_facebook', $contact->info_facebook) }}">
                        </div>
                        <div class="mb-3">
                            <label for="info_youtobe" class="form-label">Link Youtube</label>
                            <input type="text" class="form-control" id="info_youtobe" name="info_youtobe" value="{{ old('info_youtobe', $contact->info_youtobe) }}">
                        </div>
                        <div class="mb-3">
                            <label for="info_instagram" class="form-label">Link Instagram</label>
                            <input type="text" class="form-control" id="info_instagram" name="info_instagram" value="{{ old('info_instagram', $contact->info_instagram) }}">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Ảnh Logo</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewLogo(event)"/>
                            @if($contact->info_image)
                                <div class="mt-2">
                                    <img id="logo-preview" src="{{ asset('upload/info/'.$contact->info_image) }}" height="120" style="max-width: 200px; border-radius: 8px; border: 1px solid #eee;" alt="Logo">
                                </div>
                            @else
                                <img id="logo-preview" style="display:none;" height="120" />
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="ckeditor" class="form-label">Thông tin liên hệ</label>
                            <textarea id="ckeditor" class="form-control" name="info_name" placeholder="">{!! $contact->info_contact !!}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="info_map" class="form-label">Bản đồ</label>
                            <textarea rows="4" class="form-control" id="info_map" name="info_map" placeholder="Nhúng iframe bản đồ hoặc mô tả">{{ $contact->info_map }}</textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning text-dark"><i class="bi bi-pencil-square me-1"></i>Sửa</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function previewLogo(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('logo-preview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('ckeditor');
        }
    </script>
@endsection
