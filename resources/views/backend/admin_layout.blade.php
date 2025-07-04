<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$title}}</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content=""/>
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded"/>
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('backend/assets/images/favicon.ico')}}" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
          integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .ck-editor__editable_inline {
            min-height: 200px; /* hoặc 400px tùy bạn */
        }
    </style>
</head>
<body class="">
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">

            <div class="">
                @php
                    // $name = Auth::user('name');
                    $name = Auth::user()->name;
                @endphp
                <div class="main-menu-header">
                    <img class="img-radius" src="{{asset('backend/assets/images/user/avatar-2.jpg')}}"
                         alt="User-Profile-Image">
                    <div class="user-details">
                        <span>{{$name}}</span>
                        <div id="more-details">Chi tiết<i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="{{route('logout')}}"><i
                                    class="feather icon-log-out m-r-5"></i>Đăng xuất</a></li>
                    </ul>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Cửa hàng</label>
                </li>
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-home"></i></span><span
                            class="pcoded-mtext">Trang chủ</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('add_infomation')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-settings"></i></span><span
                            class="pcoded-mtext">Cấu hình website</span></a>
                </li>
                @if(auth()->user()->hasAnyRoles(['admin', 'user']))
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0);" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-bookmark"></i></span><span
                            class="pcoded-mtext">Danh mục sản phẩm</span></a>
                    <ul class="pcoded-submenu">
                        @hasrole('admin')
                        <li><a href="{{route('add_category')}}">Thêm danh mục</a></li>
                        @endhasrole
                        <li><a href="{{route('all_category')}}">Danh sách danh mục</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span
                            class="pcoded-mtext">Thương hiệu sản phẩm</span></a>
                    <ul class="pcoded-submenu">
                        @hasrole('admin')
                        <li><a href="{{route('add_brand')}}">Thêm thương hiệu</a></li>
                        @endhasrole
                        <li><a href="{{route('all_brand')}}">Danh sách thương hiệu</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-book"></i></span><span
                            class="pcoded-mtext">Quản lý sản phẩm</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('add_product')}}">Thêm sản phẩm</a></li>
                        <li><a href="{{ route('all_product') }}">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('index_comment')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-map"></i></span><span
                            class="pcoded-mtext">Quản lý nhận xét</span></a>
                </li>
                @endif
                @if(auth()->user()->hasAnyRoles(['admin', 'user']))
                <li class="nav-item pcoded-menu-caption">
                    <label>Quản lý</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-cloud"></i></span><span
                            class="pcoded-mtext">Quản lý mã giảm giá</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('add_coupon')}}">Thêm giảm giá</a></li>
                        <li><a href="{{ route('all_coupon') }}">Danh sách giảm giá</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-activity"></i></span><span
                            class="pcoded-mtext">Quản lý phí vận chuyển</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('add_fee')}}">Thêm phí vận chuyển</a></li>
                        <li><a href="{{ route('all_fee') }}">Danh sách phí vận chuyển</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-image"></i></span><span class="pcoded-mtext">Quản lý slider</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('add_slider')}}">Thêm slider</a></li>
                        <li><a href="{{ route('all_slider') }}">Danh sách slider</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('all_pages')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-package"></i></span><span
                            class="pcoded-mtext">Quản lý trang</span></a>
                </li>
                @endif
                <li class="nav-item pcoded-menu-caption">
                    <label>Bán hàng</label>
                </li>
                @if(auth()->user()->hasAnyRoles(['admin', 'user']))
                <li class="nav-item">
                    <a href="{{route('all_order')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-shopping-cart"></i></span><span
                            class="pcoded-mtext">Danh sách đơn hàng</span></a>
                </li>
                @endif
                @impersonate
                <li class="nav-item">
                    <a href="{{ route('impersonate_destroy') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-align-justify"></i></span><span
                            class="pcoded-mtext">Stop chuyển quyền</span></a>
                </li>
                @endimpersonate
                @hasrole('admin')
                <li class="nav-item">
                    <a href="{{route('all_user')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-user-check"></i></span><span
                            class="pcoded-mtext">Quản lý tài khoản</span></a>
                </li>
                @endhasrole
                @if(auth()->user()->hasAnyRoles(['admin', 'user']))
                <li class="nav-item">
                    <a href="{{route('all_customer')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-user"></i></span><span
                            class="pcoded-mtext">Quản lý khách hàng</span></a>
                </li>
                @endif
                @hasrole('author')
                <li class="nav-item pcoded-menu-caption">
                    <label>Bài viết</label>
                </li>
                <li class="nav-item">
                    <a href="{{route('all_category_post')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-bookmark"></i></span><span
                            class="pcoded-mtext">Danh mục bài viết</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('all_post')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-folder"></i></span><span class="pcoded-mtext">Danh sách bài viết</span></a>
                </li>
                @endhasrole

            </ul>

        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">


    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="{{asset('contact/logo.png')}}" alt="" class="logo">
            <img src="{{asset('backend/assets/images/logo-icon.png')}}" alt="" class="logo-thumb">
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{asset('backend/assets/images/user/avatar-1.jpg')}}" class="img-radius"
                                 alt="User-Profile-Image">
                            <span>{{$name}}</span>
                            <a href="{{route('logout')}}" class="dud-logout" title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </li>
        </ul>
    </div>


</header>
<!-- Layout wrapper -->
@yield('content')

<!-- / Layout wrapper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossOrigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#ckeditor'))
        .catch(error => {
            console.error(error);
        });
</script>

<!-- Required Js -->
<script src="{{asset('backend/assets/js/vendor-all.min.js')}}"></script>
<script src="{{asset('backend/assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/assets/js/pcoded.min.js')}}"></script>

<script src="{{asset('backend/assets/js/plugins/apexcharts.min.js')}}"></script>
<script src="{{asset('backend/assets/js/plugins/apexcharts.min.js')}}"></script>
<script src="{{asset('backend/assets/js/pcoded.js')}}"></script>


<!-- custom-chart js -->
<script src="{{asset('backend/assets/js/pages/dashboard-main.js')}}"></script>
@yield('js')

</body>

</html>
