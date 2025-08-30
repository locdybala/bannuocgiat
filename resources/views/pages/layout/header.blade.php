<div class="py-1 bg-primary">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                class="fas fa-phone-alt"></span></div>
                        <span class="text">Tư vấn mua hàng: 0388181970</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                class="fas fa-envelope"></span></div>
                        <span class="text">info@detergentshop.com</span>
                    </div>
                    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text">Giao hàng 3-5 ngày làm việc &amp; Đổi trả miễn phí</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{URL::to('/')}}">
            <img style="width: 100px; height:80px;" src="{{ asset('frontend/images/logo/logo.jpg') }}" alt="Logo Softwave">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="menu_icon"><i class="fas fa-bars"></i></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{URL::to('/')}}" class="nav-link">Trang chủ</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{route('shop')}}" id="dropdown04" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Danh mục</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        @foreach ($category as $cate)
                            <a class="dropdown-item" href="{{ route('detailCategory',['id'=>$cate->category_id]) }}">{{$cate->category_name}}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item"><a href="{{route('categoryPostIndex')}}" class="nav-link">Tin Tức</a></li>
                <li class="nav-item"><a href="{{route('contact')}}" class="nav-link">Liên hệ</a></li>

                <!-- Checkout/Payment Link based on session -->
                @php
                    $customer_id = Session::get('customer_id');
                    $shipping_id = Session::get('shipping_id');
                @endphp
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
                @php
                $cart = collect(Session::get('cart', []));  

// Tính tổng số lượng sản phẩm trong giỏ hàng
$totalQuantity = $cart->sum('product_qty');
                @endphp
                <li class="nav-item cta cta-colored"><a href="{{route('cart')}}" class="nav-link"><span
                    class="icon-shopping_cart"></span><span style="color:red; font-weight:bold;">({{$totalQuantity}})</span></a></li>

            </ul>
        </div>

        <!-- Right side icons: Search and User Profile -->
        <div class="hearer_icon d-flex">
            <!-- Search Icon and Input Box -->
            <div id="fullscreen_search_modal" class="fullscreen-search-modal">
                <button type="button" class="close-search-modal">&times;</button>
                <form action="{{ route('frontend_search_product') }}" method="GET" class="search-modal-form">
                    <input type="text" name="query" id="search_input_modal" placeholder="Tìm kiếm sản phẩm..." value="{{ request('query') }}" autofocus>
                    <button type="submit" class="search-modal-button"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <a id="search_1" href="javascript:void(0)" class="nav-link"><i class="fas fa-search"></i></a>

            <!-- User Profile/Login -->
            @if($customer_id != NULL)
                <div class="dropdown cart">
                    <a class="dropdown-toggle nav-link" href="#" id="navbarDropdown3" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                        <div class="single_product">
                            <ul>
                                <li><a class="dropdown-item" href="{{route('history')}}">Lịch sử mua hàng</a></li>
                                <li><a class="dropdown-item" href="{{route('edit_customer',['id'=>Session::get('customer_id')])}}">Thông tin cá nhân</a></li>
                                <li><a class="dropdown-item" href="{{route('logout_checkout')}}">Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{URL::to('/login-checkout')}}" class="nav-link"><i class="fas fa-user"></i> Đăng nhập</a>
            @endif
        </div>
    </div>
</nav>
