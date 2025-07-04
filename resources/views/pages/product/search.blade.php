@extends('layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Danh sách tìm kiếm</h2>
                            <p>Trang chủ <span>-</span> Sản phẩm</p>
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
                                    @foreach ($category as $categori)
                                        <li>
                                            <a href="{{ route('detailCategory',['id'=>$categori->category_id]) }}">{{$categori->category_name}}</a>
                                            <span>({{ $categori->product_count }})</span>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product_top_bar d-flex justify-content-between align-items-center">

                                {{--                                <div class="single_product_menu d-flex">--}}
                                {{--                                    <h5>short by : </h5>--}}
                                {{--                                    <select>--}}
                                {{--                                        <option data-display="Select">name</option>--}}
                                {{--                                        <option value="1">price</option>--}}
                                {{--                                        <option value="2">product</option>--}}
                                {{--                                    </select>--}}
                                {{--                                </div>--}}
                                {{--                               --}}
                                <form method="post" action="{{route('search')}}">
                                    @csrf
                                <div class="single_product_menu d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="keywords_submit" name="keywords_submit" placeholder="Tìm kiếm"
                                               aria-describedby="inputGroupPrepend">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend"><i
                                                    class="ti-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center latest_product_inner">
                        @if($products->isEmpty())
                            <div class="col-12 text-center">
                                <p>Chưa có sản phẩm</p>
                            </div>
                        @else
                            @foreach($products as $key => $product)
                                <div class="col-lg-4 col-sm-6">
                                    <form>
                                        @csrf
                                        <input type="hidden" value="{{$product->product_id}}"
                                               class="cart_product_id_{{$product->product_id}}">
                                        <input type="hidden" value="{{$product->product_name}}"
                                               class="cart_product_name_{{$product->product_id}}">
                                        <input type="hidden" value="{{$product->product_image}}"
                                               class="cart_product_image_{{$product->product_id}}">
                                        <input type="hidden" value="{{$product->product_price}}"
                                               class="cart_product_price_{{$product->product_id}}">
                                        <input type="hidden" value="{{$product->product_quantity}}"
                                               class="cart_product_quantity_{{$product->product_id}}">
                                        <input type="hidden" value="1"
                                               class="cart_product_qty_{{$product->product_id}}">
                                        <div class="single_product_item">
                                            <a href="{{ route('detailProduct',['id'=>$product->product_id]) }}">
                                                <img src="/upload/product/{{ $product->product_image }}" alt=""></a>
                                            <div class="single_product_text">

                                                <h4>{{$product->product_name}}</h4>
                                                <h3>{{number_format($product->product_price)}}</h3>
                                                @php
                                                    $customerId = Session::get('customer_id');
                                                @endphp
                                                @if ($customerId)
                                                    <input type="button" name="add-to-cart" value="Thêm giỏ hàng"
                                                           data-id_product="{{$product->product_id}}"
                                                           class="add-to-cart btn_3">
                                                @else
                                                    <a href="{{URL::to('/login-checkout')}}" class="add_cart">Thêm giỏ hàng<i class="ti-heart"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->
@endsection
