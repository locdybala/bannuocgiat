@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Sản phẩm</li>
            <li class="breadcrumb-item active" aria-current="page">Sửa sản phẩm</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Sửa sản phẩm</h5>
                </div>
                <div class="card-body">
                    <form action="{{  route('update_product',['id'=>$product->product_id]) }}" method="POST" enctype="multipart/form-data" id="productEditForm" autocomplete="off">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="name" name="name" placeholder="Nhập tên sản phẩm" value="{{ $product->product_name }}"/>
                            </div>
                            <div class="col-md-6">
                                <label for="product_tags" class="form-label">Tag sản phẩm</label>
                                <input type="text" data-role="tagsinput" class="form-control" id="product_tags" name="product_tags" value="{{$product->product_tags}}" placeholder="Nhập tag, cách nhau bởi dấu phẩy"/>
                            </div>
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Danh mục sản phẩm <span class="text-danger">*</span></label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option value="">---Chọn danh mục---</option>
                                    @foreach ($category as $category)
                                        <option @if($product->category_id == $category->category_id) selected @endif value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="brand_id" class="form-label">Thương hiệu sản phẩm <span class="text-danger">*</span></label>
                                <select id="brand_id" name="brand_id" class="form-select" required>
                                    <option value="">---Chọn thương hiệu---</option>
                                    @foreach ($brand as $brand)
                                        <option @if($product->brand_id == $brand->brand_id) selected @endif value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="price" class="form-label">Giá <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="1.000.000" value="{{ $product->product_price }}" required/>
                            </div>
                            <div class="col-md-4">
                                <label for="product_quantity" class="form-label">Số lượng <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="product_quantity" name="product_quantity" placeholder="Nhập số lượng" value="{{ $product->product_quantity }}" required/>
                            </div>
                            <div class="col-md-4">
                                <label for="image" class="form-label">Ảnh sản phẩm</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*"/>
                                @if($product->product_image)
                                    <img class="input-rounded mt-2" src="{{ URL::to('/upload/product/'.$product->product_image) }}" height="80" style="border-radius:8px;box-shadow:0 2px 8px #eee;object-fit:cover;" alt="">
                                @endif
                            </div>
                            <div class="col-12">
                                <label for="product_content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                                <textarea id="product_content" class="form-control" name="product_content" rows="4" placeholder="Nội dung sản phẩm" required>{{ $product->product_content }}</textarea>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea id="ckeditor" class="form-control" name="description" rows="3" placeholder="Mô tả sản phẩm">{{ $product->product_desc }}</textarea>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                                <select id="status" name="status" class="form-select">
                                    <option @if($product->product_status == 1) selected @endif value="1">Hiển thị</option>
                                    <option @if($product->product_status == 2) selected @endif value="2">Ẩn</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" id="btnSubmit" class="btn btn-warning text-dark"><i class="bi bi-pencil-square me-1"></i>Sửa</button>
                            <a href="/admin/product/all_product" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#product_content'))
            .catch(error => { console.error(error); });
        $('#product_tags').tagsinput();
        $("#btnSubmit").click(function () {
            var name = $("#name").val().trim();
            var category_id = $("#category_id").val();
            var brand_id = $("#brand_id").val();
            var product_quantity = $("#product_quantity").val();
            var price = $("#price").val();
            var product_content = $("#product_content").val();
            if (name === '') {
                toastr["error"]("Tên sản phẩm không được bỏ trống");
                $('#name').focus();
                return false;
            } else if (category_id === '' || category_id === null) {
                toastr["error"]("Vui lòng chọn danh mục sản phẩm");
                $('#category_id').focus();
                return false;
            } else if (brand_id === '' || brand_id === null) {
                toastr["error"]("Vui lòng chọn thương hiệu sản phẩm");
                $('#brand_id').focus();
                return false;
            } else if (product_quantity === '' || isNaN(product_quantity)) {
                toastr["error"]("Vui lòng nhập số lượng sản phẩm hợp lệ");
                $('#product_quantity').focus();
                return false;
            } else if (price === '' || isNaN(price)) {
                toastr["error"]("Vui lòng nhập giá sản phẩm hợp lệ");
                $('#price').focus();
                return false;
            } else if (product_content === '') {
                toastr["error"]("Vui lòng nhập nội dung sản phẩm");
                $('#product_content').focus();
                return false;
            }
            return true;
        });
    </script>
@endsection
