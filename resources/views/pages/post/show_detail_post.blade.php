@extends('layout')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('/frontend/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                        <span class="mr-2"><a href="">Tin tức</a></span>
                        <span>Chi tiết bài viết</span>
                    </p>
                    <h1 class="mb-0 bread" style="font-size: 24px;">{{ $post->post_title }}</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <h2 class="mb-3">{{ $post->post_title }}</h2>
                    <div class="meta mb-3">
                        <div><a href="#"><span class="icon-calendar"></span>
                                {{ $post->created_at->format('d/m/Y') }}</a></div>
                        <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                        <div><a href="#"><span class="icon-eye"></span> {{ $post->post_view }} Lượt xem</a></div>
                    </div>

                    {{-- Hiển thị nội dung từ database --}}
                    {{-- Hãy chắc chắn bạn đã thêm CSS cho class .content-render như đã hướng dẫn ở trang tĩnh --}}
                    <div class="content-render">
                        {!! $post->post_content !!}
                    </div>

                    <div class="pt-5 mt-5">
                        <h3 class="mb-5">Bình luận</h3>
                        {{-- Nơi bạn có thể dùng vòng lặp để hiển thị các bình luận từ DB --}}
                        <ul class="comment-list">
                            <li class="comment">
                                <div class="vcard bio">
                                    <img src="{{ asset('images/person_1.jpg') }}" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                    <h3>Tên người dùng</h3>
                                    <div class="meta">Ngày bình luận</div>
                                    <p>Nội dung bình luận mẫu. Bạn sẽ thay thế phần này bằng dữ liệu động.</p>
                                    <p><a href="#" class="reply">Trả lời</a></p>
                                </div>
                            </li>
                        </ul>
                        <div class="comment-form-wrap pt-5">
                            <h3 class="mb-5">Để lại bình luận</h3>
                            <form action="#" class="p-5 bg-light">
                                <div class="form-group">
                                    <label for="name">Tên *</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="message">Nội dung</label>
                                    <textarea name="" id="message" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Gửi bình luận" class="btn py-3 px-4 btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 sidebar ftco-animate">
                    <div class="sidebar-box">
                        <form action="#" class="search-form">
                            <div class="form-group">
                                <span class="icon ion-ios-search"></span>
                                <input type="text" class="form-control" placeholder="Tìm kiếm...">
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Danh mục bài viết</h3>
                        <ul class="categories">
                            @foreach ($categorypost as $cate)
                                {{-- Tự động đánh dấu active cho danh mục của bài viết hiện tại --}}
                                <li class="{{ $post->cate_post_id == $cate->cate_post_id ? 'active' : '' }}">
                                    <a href="{{ route('detaiCategoryPost', ['slug' => $cate->cate_post_slug]) }}">
                                        {{ $cate->cate_post_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Bài viết gần đây</h3>
                        @foreach ($recent_posts as $recent)
                            <div class="block-21 mb-4 d-flex">
                                <a class="blog-img mr-4"
                                    style="background-image: url({{ asset('/upload/post/' . $recent->post_image) }});"></a>
                                <div class="text">
                                    <h3 class="heading-1"><a
                                            href="{{ route('postDetail', ['slug' => $recent->post_slug]) }}">{{ $recent->post_title }}</a>
                                    </h3>
                                    <div class="meta">
                                        <div><a href="#"><span class="icon-calendar"></span>
                                                {{ $recent->created_at->diffForHumans() }}</a></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script>
        $(".label_title").each(function() {
            if ($(this).text().length > 200) {
                $(this).text($(this).text().substr(0, 200));
                $(this).append('...');
            }
        });
    </script>
@endsection
