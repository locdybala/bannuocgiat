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
                                <h5 class="m-b-10">Quản lý bài viết</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Bài viết</a></li>
                                <li class="breadcrumb-item"><a href="#!">Sửa bài viết</a></li>
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
                            <h5>Sửa bài viết</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{  route('update_Post',['id'=>$post->post_id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="name_categorypost">Tên bài viết</label>
                                            <input type="text" class="form-control" value="{{$post->post_title}}" onkeyup="ChangeToSlug()" id="name_categorypost" name="title"
                                                   placeholder="Nhập tên bài viết"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="slug">Slug</label>
                                            <input type="text" class="form-control" value="{{$post->post_slug}}"  id="slug" name="slug"
                                                   placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="category_id">Danh mục bài viết</label>
                                            <select id="category_id" name="category_id" class="form-control">
                                                <option>---Chọn danh mục---</option>
                                                @foreach ($category as $category)
                                                    <option @if($post->cate_post_id == $category->cate_post_id) selected @endif value="{{ $category->cate_post_id }}">{{ $category->cate_post_name }}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="image">Ảnh</label>
                                            <input type="file" class="form-control" id="basic-default-name" name="image"
                                            />
                                            <img class="input-rounded mt-2" src="{{ URL::to('/upload/post/'.$post->post_image) }}" height="100" width="100" alt="">

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="description">Tóm tắt</label>
                                            <textarea
                                                id="ckeditor1"
                                                class="form-control" name="description"
                                                placeholder="Mô tả bài viết"
                                            >{{$post->post_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="description">Nội dung</label>
                                            <textarea
                                                id="ckeditor"
                                                class="form-control" name="contents"
                                                placeholder="Mô tả bài viết"
                                            >{{$post->post_content}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="status">Meta từ khóa</label>
                                            <textarea class="form-control  " name="meta_keywords" id="ckeditor3" rows="5" >{{$post->meta_keywords}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="status">Meta nội dung</label>
                                            <textarea class="form-control  " name="meta_desc" id="ckeditor4" rows="5" >{{$post->meta_desc}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="status">Trạng thái</label>
                                            <select id="defaultSelect" name="status" class="form-control">
                                                <option>---- Trạng thái ----</option>
                                                <option @if($post->post_status == 1) selected @endif value="1">Hiển thị</option>
                                                <option @if($post->post_status == 2) selected @endif value="2">Ẩn</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Sửa</button>
                                            <a href="/admin/post/all_post" class="btn btn-default">Huỷ</a>

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
        ClassicEditor
        .create(document.querySelector('#ckeditor1'))
        .catch(error => {
            console.error(error);
        });
    </script>
    <script>
        function ChangeToSlug()
        {
            var slug;

            //Lấy text từ thẻ input title
            slug = document.getElementById("name_categorypost").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        }

    </script>
@endsection
