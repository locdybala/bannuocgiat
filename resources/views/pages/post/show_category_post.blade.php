@extends('layout')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('/frontend/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                        <span class="mr-2"><a href="{{ route('post') }}">Tin tức</a></span>
                        <span>{{ $cate_post_name->cate_post_name }}</span>
                    </p>
                    <h1 class="mb-0 bread">{{ $cate_post_name->cate_post_name }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-md-12 d-flex ftco-animate">
                                <div class="blog-entry align-self-stretch d-md-flex">
                                    <a href="{{ route('postDetail', ['slug' => $post->post_slug]) }}" class="block-20"
                                        style="background-image: url('{{ asset('/upload/post/' . $post->post_image) }}');"></a>
                                    <div class="text d-block pl-md-4">
                                        <div class="meta mb-3">
                                            <div><a href="#">{{ $post->created_at->format('d/m/Y') }}</a></div>
                                            <div><a href="#">Admin</a></div>
                                            <div><a href="#" class="meta-chat"><i class="ion-ios-eye"></i>
                                                    {{ $post->post_view }}</a></div>
                                        </div>
                                        <h3 class="heading"><a
                                                href="{{ route('postDetail', ['slug' => $post->post_slug]) }}">{{ $post->post_title }}</a>
                                        </h3>
                                        {{-- Giữ class "post-desc" để Javascript hoạt động --}}
                                        <p class="post-desc">{!! $post->post_description !!}</p>
                                        <p><a href="{{ route('postDetail', ['slug' => $post->post_slug]) }}"
                                                class="btn btn-primary py-2 px-3">Đọc thêm</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                {{ $posts->links() }}
                            </div>
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
                                {{-- Tự động đánh dấu active cho danh mục đang xem --}}
                                <li class="{{ $cate_post_name->cate_post_slug == $cate->cate_post_slug ? 'active' : '' }}">
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
    <script type="text/javascript">
        $(document).ready(function() {
            // Class ".post-desc" đã được giữ lại trong HTML mới ở trên
            $(".post-desc").each(function() {
                let content = $(this).text().trim(); // Dùng .text() để loại bỏ tag HTML khi đo độ dài
                if (content.length > 150) {
                    let shortText = content.substring(0, 150);
                    $(this).text(shortText + "...");
                }
            });
        });
    </script>
@endsection
