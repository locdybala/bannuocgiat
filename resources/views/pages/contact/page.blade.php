@extends('layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>{{$page->title}}</h2>
                            <p>Trang chủ <span>-</span>Chính sách cửa hàng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Danh mục sản phẩm</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach ($pagess as $value)
                                        <li>
                                            <a href="{{route('pages', ['slug' => $value->slug])}}">{{$value->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row align-items-center latest_product_inner">
                        <h2>{{$page->title}}</h2>
                        <p class="excert">
                            {!! $page->content !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->
@endsection

