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
                                <h5 class="m-b-10">Sửa thương hiệu</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">thương hiệu</a></li>
                                <li class="breadcrumb-item"><a href="#!">Sửa thương hiệu</a></li>
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
                            <h5>Sửa thương hiệu</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update_brand',['id'=>$brand->brand_id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="id-category">Mã thương hiệu <span class="required">(*)</span></label>
                                            <input type="text" class="form-control" readonly value="{{ $brand->brand_id }}" id="basic-default-name" name="id"  />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="name">Tên thương hiệu <span class="required">(*)</span></label>
                                            <input type="text" class="form-control" required id="name" name="name"
                                                   value="{{ $brand->brand_name }}"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="brand_image">Hình ảnh thương hiệu</label>
                                            <input type="file" class="form-control" id="brand_image" name="brand_image"/>
                                            @if($brand->brand_image)
                                                <img src="/upload/brand/{{ $brand->brand_image }}" style="width:100px;height:auto;margin-top:10px;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="description">Mô tả</label>
                                            <textarea
                                                id="ckeditor"
                                                class="form-control" name="description"
                                                placeholder="Mô tả thương hiệu"
                                            >{!!  $brand->brand_desc  !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="status">Trạng thái <span class="required">(*)</span></label>
                                            <select id="status" name="status" class="form-control">
                                                <option @if($brand->brand_status == 1) selected @endif value="1">Hiển thị
                                                </option>
                                                <option @if($brand->brand_status == 2) selected @endif value="2">Ẩn
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" id="btnSubmit" class="btn btn-primary">Sửa</button>
                                            <a href="/admin/brand/all_brand" class="btn btn-default">Huỷ</a>
                                        </div>
                                    </div>
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
        CKEDITOR.replace('ckeditor');
        $("#btnSubmit").click(function () {
            var name = $("#name").val();

            if (name == '') {
                toastr["error"]("Tên thương hiệu không được bỏ trống");
                return false;
            }
            return true;
        });
    </script>
@endsection
