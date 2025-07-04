@extends('backend.admin_layout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Thêm sản phẩm</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">sản phẩm</a></li>
                                <li class="breadcrumb-item"><a href="#!">Thêm sản phẩm</a></li>
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
                            <h5>Thêm mới sản phẩm</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{  route('update_product',['id'=>$product->product_id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="name">Tên sản phẩm <span class="required">(*)</span></label>
                                            <input type="text" class="form-control" required id="name" name="name"
                                                   placeholder="Nhập tên sản phẩm" value="{{ $product->product_name }}"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label" for="category_id">Danh mục sản phẩm <span class="required">(*)</span></label>
                                            <select id="category_id" name="category_id" class="form-control">
                                                <option>---Chọn danh mục---</option>
                                                @foreach ($category as $category)
                                                    <option @if($product->category_id == $category->category_id) selected @endif
                                                        value="{{ $category->category_id }}">
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label" for="brand_id">Thương hiệu sản phẩm <span class="required">(*)</span></label>
                                            <select id="brand_id" name="brand_id" class="form-control">
                                                <option>---Chọn thương hiệu---</option>
                                                @foreach ($brand as $brand)
                                                    <option @if($product->brand_id == $brand->brand_id) selected @endif
                                                        value="{{ $brand->brand_id }}">
                                                        {{ $brand->brand_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label" for="name">Giá <span class="required">(*)</span></label>
                                            <input type="number" class="form-control"  id="basic-default-name" name="price"
                                                   placeholder="1.000.000 " value="{{ $product->product_price }}"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label" for="name">Số lượng <span class="required">(*)</span></label>
                                            <input type="text" class="form-control" id="basic-default-name" name="product_quantity"
                                                   placeholder="Nhập số lượng" value="{{ $product->product_quantity }}"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label" for="name">Tag sản phẩm <span class="required">(*)</span></label>
                                            <input type="text" data-role="tagsinput" class="form-control" id="product_tags" name="product_tags"
                                                   value="{{$product->product_tags}}"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="name">Ảnh <span class="required">(*)</span></label>
                                            <input type="file" class="form-control" id="basic-default-name" name="image"
                                            />
                                            <img class="input-rounded mt-2" src="{{ URL::to('/upload/product/'.$product->product_image) }}" height="150" width="150" alt="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="name">Nội dung <span class="required">(*)</span></label>
                                            <textarea
                                            id="product_content"
                                            class="form-control" name="product_content"
                                            placeholder="Nội dung sản phẩm"
                                        >{{ $product->product_content }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="description">Mô tả</label>
                                            <textarea
                                                id="ckeditor"
                                                class="form-control" name="description"
                                                placeholder="Mô tả sản phẩm"
                                            >{{ $product->product_desc }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" id="btnSubmit" class="btn btn-primary">Sửa</button>
                                            <a href="/admin/product/all_product" class="btn btn-default">Huỷ</a>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
        ClassicEditor
        .create(document.querySelector('#product_content'))
        .catch(error => {
            console.error(error);
        });
        $("#btnSubmit").click(function () {
            var name = $("#name").val();
            var category_id = $("#category_id").val();
            var brand_id = $("#brand_id").val();
            var product_quantity = $("#product_quantity").val();
            var price = $("#price").val();
            var image = $("#image").val();
            var product_content = $("#product_content").val();
            if (name == '') {
                toastr["error"]("Tên sản phẩm không được bỏ trống");
                return false;
            } else if (category_id == '') {
                toastr["error"]("Không được bỏ trống danh mục sản phẩm");
                return false;
            }
            // else if (brand_id == '') {
            //     toastr["error"]("Không được bỏ trống thương hiệu sản phẩm");
            //     return false;
            // }
            else if (product_quantity == '') {
                toastr["error"]("Không được bỏ trống số lượng sản phẩm");
                return false;
            } else if (price == '') {
                toastr["error"]("Không được bỏ trống giá sản phẩm");
                return false;
            } else if (image == '') {
                toastr["error"]("Không được bỏ trống ảnh sản phẩm");
                return false;
            } else if (product_content == '') {
                toastr["error"]("Không được bỏ trống nội dung sản phẩm");
                return false;
            }
            return true;
        });
        $('#product_tags').tagsinput();
    </script>
@endsection
