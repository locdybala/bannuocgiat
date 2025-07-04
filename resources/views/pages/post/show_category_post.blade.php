@extends('layout')
@section('content')

    <!--================Home Banner Area =================-->
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>{{$cate_post_name->cate_post_name}}</h2>
                            <p>Trang chủ <span>-</span> Bài viết</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->


    <!--================Blog Area =================-->
    <section class="blog_area padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @foreach($posts as $post)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="/upload/post/{{$post->post_image}}" alt="">
                                    <a href="#" class="blog_item_date">
                                        <h3>15</h3>
                                        <p>Jan</p>
                                    </a>
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{route('postDetail',['slug'=>$post->post_slug])}}">
                                        <h2>{{$post->post_title}}</h2>
                                    </a>
                                    <p class="post-desc">{!! $post->post_description !!}</p>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="far fa-user"></i> Lượt xem: {{$post->post_view}}</a>
                                        </li>
                                        <li><a href="{{route('postDetail',['slug'=>$post->post_slug])}}"><i
                                                    class="far fa-edit"></i> Xem chi tiết</a></li>
                                    </ul>
                                </div>
                            </article>

                        @endforeach
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="{{$posts->previousPageUrl()}}" class="page-link {{$posts->onFirstPage() ? 'disabled' : ''}}" aria-label="Previous">
                                        <i class="ti-angle-left"></i>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $posts->lastPage(); $i++)
                                    <li class="page-item">
                                        <a href="{{$posts->url($i)}}" class="page-link {{$posts->currentPage() === $i ? 'active' : ''}}">{{$i}}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a href="{{$posts->nextPageUrl()}}" class="page-link {{$posts->hasMorePages() ? '' : 'disabled'}}" aria-label="Next">
                                        <i class="ti-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Danh mục bài viết</h4>
                            <ul class="list cat-list">
                                @foreach($categorypost as $categorypost)
                                    <li>
                                        <a href="{{route('detaiCategoryPost', ['slug' => $categorypost->cate_post_slug])}}" class="d-flex">
                                            <p>{{$categorypost->cate_post_name}}</p>
                                            <p>(37)</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Bài viết gần đây</h3>

                            @foreach($recent_posts as $post)
                                <div class="media post_item">
                                    <img width="80px" src="/upload/post/{{$post->post_image}}" alt="{{ $post->post_title }}">
                                    <div class="media-body">
                                        <a href="{{ route('postDetail', ['slug' => $post->post_slug]) }}">
                                            <h3>{{ $post->post_title }}</h3>
                                        </a>
                                        <p>{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach

                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
@section('javascript')
    <script>$(".label_title").each(function () {
            if ($(this).text().length > 200) {
                $(this).text($(this).text().substr(0, 200));
                $(this).append('...');
            }
        });</script>
@endsection
