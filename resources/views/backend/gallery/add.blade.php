@extends('backend.admin_layout')
@section('content')
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Thêm thư viện ảnh</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Thư viện ảnh</a></li>
                                <li class="breadcrumb-item"><a href="#!">Thêm thư viện ảnh</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Thêm thư viện ảnh</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('insert_gallery',['product_id'=> $product_id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3" align="right">

                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" id="file" multiple  name="file[]" class="form-control">
                                        <span id="error_gallery"></span>
                                    </div>
                                    <div class="col-md-3" >
                                        <input type="submit" name="upload" value="Tải ảnh" class="btn btn-success">
                                    </div>
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
                <!-- [ form-element ] start -->
            </div>
            <!-- [ Main Content ] end -->

        </div>
    </section>
@endsection
@section('js')
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
