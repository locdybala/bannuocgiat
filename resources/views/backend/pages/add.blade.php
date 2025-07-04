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
                                <h5 class="m-b-10">Thêm trang</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Quản lý trang</a></li>
                                <li class="breadcrumb-item"><a href="#!">Thêm trang</a></li>
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
                            <h5>Thêm mới trang</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('addPages')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="name">Tên trang <span class="required">(*)</span></label>
                                            <input type="text" class="form-control" required id="name" name="name"
                                                   placeholder="Nhập tên trang"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="name">Slug <span
                                                    class="required">(*)</span></label>
                                            <input type="text" class="form-control" required id="slug" name="slug"
                                                   placeholder="Slug"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="title">Tiêu đề <span
                                                    class="required">(*)</span></label>
                                            <input type="text" class="form-control" required id="title" name="title"
                                                   placeholder="Nhập tiêu đề"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="ckeditor">Nội dung <span
                                                    class="required">(*)</span></label>
                                            <textarea
                                                id="ckeditor"
                                                class="form-control" name="contents"
                                                placeholder="Mô tả trang" required
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" id="btnSubmit" class="btn btn-primary">Thêm</button>
                                            <a href="/admin/pages/all_pages" class="btn btn-default">Huỷ</a>

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
            var slug = $("#slug").val();
            var content = $("#content").val();
            var title = $('#title').val();

            if (name == '') {
                toastr["error"]("Tên trang không được bỏ trống");
                return false;
            } else if (slug == '') {
                toastr["error"]("Slug không được bỏ trống");
                return false;
            } else if (title == '') {
                toastr["error"]("Tiêu đề không được bỏ trống");
                return false;
            } else if (content == '') {
                toastr["error"]("Nội dung không được bỏ trống");
                return false;
            }
            return true;
        });
    </script>
@endsection
