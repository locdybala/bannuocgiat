@extends('layout')
@section('title', 'Trang tĩnh')
@section('content')
    <style>
        /* CSS cho khu vực nội dung được render từ database */
        .content-render h1,
        .content-render h2,
        .content-render h3,
        .content-render h4,
        .content-render h5,
        .content-render h6 {
            color: #82ae46;
            /* Màu xanh lá của theme */
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .content-render p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .content-render ul,
        .content-render ol {
            padding-left: 25px;
            margin-bottom: 1.5rem;
        }

        .content-render li {
            margin-bottom: 0.75rem;
        }

        .content-render a {
            color: #007bff;
            /* Màu xanh dương cho các liên kết */
            text-decoration: underline;
        }

        .content-render img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1.5rem 0;
        }
    </style>
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                        <span>{{ $page->title }}</span>
                    </p>
                    <h1 class="mb-0 bread">{{ $page->title }}</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar-box ftco-animate">
                        <h3 class="billing-heading mb-4">Chính sách & Hướng dẫn</h3>
                        <ul class="categories">
                            {{-- Lặp qua danh sách các trang tĩnh --}}
                            @foreach ($pagess as $value)
                                {{-- Đánh dấu active cho trang đang được chọn --}}
                                <li class="{{ $page->slug == $value->slug ? 'active' : '' }}">
                                    <a href="{{ route('pages', ['slug' => $value->slug]) }}">
                                        <span>{{ $value->title }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="page-content-wrap p-4 bg-white ftco-animate">
                        <h2 class="mb-4">{{ $page->title }}</h2>
                        <hr>
                        {{-- Hiển thị nội dung từ database --}}
                        <div class="content-render">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
