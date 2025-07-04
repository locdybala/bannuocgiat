@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Bài viết</li>
            <li class="breadcrumb-item active" aria-current="page">Thêm bài viết</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Thêm mới bài viết</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('add_post') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="post_title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Nhập tiêu đề bài viết" required/>
                        </div>
                        <div class="mb-3">
                            <label for="post_slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="post_slug" name="post_slug" placeholder="Slug" required/>
                        </div>
                        <div class="mb-3">
                            <label for="cate_post_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                            <select id="cate_post_id" name="cate_post_id" class="form-select" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->cate_post_id }}">{{ $category->cate_post_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="post_image" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="post_image" name="post_image" accept="image/*"/>
                        </div>
                        <div class="mb-3">
                            <label for="post_desc" class="form-label">Mô tả ngắn</label>
                            <textarea id="post_desc" class="form-control" name="post_desc" rows="3" placeholder="Mô tả ngắn về bài viết"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="post_content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea id="post_content" class="form-control" name="post_content" rows="6" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="post_status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select id="post_status" name="post_status" class="form-select" required>
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Thêm</button>
                            <a href="{{ route('all_post') }}" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('post_content');
        }
    </script>
@endsection
