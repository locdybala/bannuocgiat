<!--::header part start::-->
<header class="main_menu home_menu">
    @php
        $customer_id = Session::get('customer_id');
        $shipping_id = Session::get('shipping_id');
    @endphp
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{URL::to('/')}}"> <img style="width: 120px; height: 40px;" src="{{asset('upload/info/' . $contact->info_image)}}" alt="logo"> </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{URL::to('/')}}">Trang chủ</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{route('shop')}}" id="navbarDropdown_1"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Danh mục
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                    @foreach ($category as $cate)
                                        <a class="dropdown-item" href="{{ route('detailCategory',['id'=>$cate->category_id]) }}">{{$cate->category_name}}</a>
                                    @endforeach
                                </div>
                            </li>
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_3"--}}
{{--                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    Thương hiệu--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">--}}
{{--                                    @foreach ($brand as $brand)--}}
{{--                                        <a class="dropdown-item" href="{{ route('detailBrand',['id'=>$brand->brand_id]) }}"> {{$brand->brand_name}}</a>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('categoryPostIndex')}}">Tin Tức</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('contact')}}">Liên hệ</a>
                            </li>
                            @if ($customer_id != NULL && $shipping_id == NULL)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{URL::to('/checkout')}}">Thanh toán</a>
                                </li>
                            @elseif($customer_id != NULL && $shipping_id != NULL)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{URL::to('/payment')}}">Thanh toán</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="hearer_icon d-flex">
                        <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a>
                        <div class=" cart">
                            <a  href="{{route('cart')}}">
                                <i class="fas fa-cart-plus"></i>
                            </a>
{{--                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                                <div class="single_product">--}}

{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                        @if($customer_id != NULL)
                        <div class="dropdown cart">
                            <a class="dropdown-toggle" href="{{route('cart')}}" id="navbarDropdown3" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <div class="single_product">
                                    @if ($customer_id != NULL)
                                        <ul>
                                            <li><a href="{{route('history')}}">Lịch sử mua hàng</a></li>
                                            <li>
                                                <a href="{{route('edit_customer',['id'=>Session::get('customer_id')])}}">Thông
                                                    tin cá nhân</a></li>
                                            <li><a href="{{route('logout_checkout')}}">Đăng xuất</a></li>
                                        </ul>
                                    @endif
                                </div>
                            </div>

                        </div>
                        @else
                        <a href="{{URL::to('/login-checkout')}}"><i class="fas fa-user"></i> Đăng nhập</a>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container ">
                <form method="get" action="{{route('search')}}" class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="keywords_submit" name="keywords_submit" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </div>

</header>
<!-- Header part end-->



