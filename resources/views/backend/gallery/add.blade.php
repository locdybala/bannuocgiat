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
                    <form action="{{route('insert_gallery',['product_id'=> $product_id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Chọn ảnh <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="file" multiple name="file[]" accept="image/*" required onchange="previewGalleryImage(event)"/>
                            <img id="gallery-preview" style="display:none; margin-top:10px; max-height:120px; border-radius:8px; border:1px solid #eee;"/>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Thêm</button>
                            <a href="{{ route('all_product') }}" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" id="product_id" name="product_id" value="{{$product_id}}" hidden>
                        <div class="gallery_loading">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Tên hình ảnh</th>
                                    <th>Ảnh</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">


                                </tbody>
                            </table>
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
    <script>
        $(document).ready(function(){
            load_gallery();

            function load_gallery() {
                var product_id = $('#product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('select_gallery')}}",
                    method: 'POST',
                    data:{product_id: product_id,_token: _token},
                    success: function(data) {
                        $('.gallery_loading').html(data);
                    }
                })
            }
            $('#file').change(function() {
                var error = '';
                var file = $('#file')[0].files;

                if(file.length>5) {
                    error +='<p>Chỉ được chọn tối đa 5 ảnh </p>';
                } else if(file.length === '') {
                    error +='<p>Không được bỏ trống ảnh</p>';
                } else if (file.size >2000000 ) {
                    error +='<p>Không được chọn kích ảnh lớn hơn 2MB</p>';
                }
                if(error == '') {

                } else {
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                    return false;
                }
            })

            $(document).on('blur', '.edit_gallery_name',function() {
                var gallery_id = $(this).data('gallery_id');
                var gallery_text = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('update_gallery_name')}}",
                    method: 'POST',
                    data:{gallery_id: gallery_id,gallery_text: gallery_text,_token:_token},
                    success: function(data) {
                        debugger
                        $('#error_gallery').html('<span class="text-danger">Cập nhập tên ảnh thành công</span>');

                        load_gallery();

                    }
                })
            })
            $(document).on('click', '.delete-gallery',function() {
                var gallery_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('delete_gallery_name')}}",
                    method: 'POST',
                    data:{gallery_id: gallery_id,_token:_token},
                    success: function(data) {
                        debugger
                        $('#error_gallery').html('<span class="text-danger">Xóa tên ảnh thành công</span>');

                        load_gallery();

                    }
                })
            })
        })
    </script>
@endsection
