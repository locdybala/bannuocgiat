<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title ?? 'Admin Dashboard'}} - Đồ Dùng Học Tập</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #0dcaf0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --sidebar-width: 280px;
            --header-height: 70px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-header .logo {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .sidebar-header .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .sidebar-nav {
            padding: 1rem 0;
            height: calc(100vh - var(--header-height) - 100px);
            overflow-y: auto;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .nav-link:hover {
            color: white;
            background-color: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }

        .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .nav-link i {
            width: 20px;
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .nav-caption {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.6);
            padding: 0.5rem 1rem;
            margin-top: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submenu {
            padding-left: 2rem;
            margin-top: 0.5rem;
        }

        .submenu .nav-link {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        /* Header Styles */
        .header {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--header-height);
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 999;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
        }

        .header.sidebar-collapsed {
            left: 70px;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--secondary-color);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-dropdown {
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid var(--light-color);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border-radius: 10px;
            padding: 0.5rem 0;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 2rem;
            transition: all 0.3s ease;
            min-height: calc(100vh - var(--header-height));
        }

        .main-content.sidebar-collapsed {
            margin-left: 70px;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
            padding: 1.5rem;
        }

        /* Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 1.5rem;
        }

        .stats-card .icon {
            font-size: 3rem;
            opacity: 0.8;
        }

        .stats-card .number {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 1rem 0;
        }

        .stats-card .label {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .header {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Custom Scrollbar */
        .sidebar-nav::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 5px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }

        /* Loading Animation */
        .loading {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.9);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 2rem;
            transition: all 0.3s ease;
            min-height: calc(100vh - var(--header-height));
        }

        .main-content.sidebar-collapsed {
            margin-left: 70px;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
            padding: 1.5rem;
        }

        /* Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 1.5rem;
        }

        .stats-card .icon {
            font-size: 3rem;
            opacity: 0.8;
        }

        .stats-card .number {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 1rem 0;
        }

        .stats-card .label {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .header {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Custom Scrollbar */
        .sidebar-nav::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 5px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }

        /* Loading Animation */
        .loading {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.9);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Loading -->
    <div class="loading" id="loading">
        <div class="spinner"></div>
    </div>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{route('dashboard')}}" class="logo">
                <img src="{{asset('frontend/images/logo/logo.jpg')}}" alt="Logo">
                <span class="logo-text">Admin</span>
            </a>
        </div>

        <div class="sidebar-nav">
            <div class="nav-caption">Cửa hàng</div>

            <div class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i>
                    <span>Trang chủ</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{route('add_infomation')}}" class="nav-link {{ request()->routeIs('add_infomation') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i>
                    <span>Cấu hình website</span>
                </a>
            </div>

            @if(auth()->user()->hasAnyRoles(['admin', 'user']))
            <div class="nav-caption">Quản lý sản phẩm</div>

            <div class="nav-item">
                <a href="{{route('all_category')}}" class="nav-link {{ request()->routeIs('all_category') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i>
                    <span>Danh mục sản phẩm</span>
                </a>
                @hasrole('admin')
                <div class="submenu">
                    <a href="{{route('add_category')}}" class="nav-link">
                        <i class="bi bi-plus-circle"></i>
                        <span>Thêm danh mục</span>
                    </a>
                </div>
                @endhasrole
            </div>

            <div class="nav-item">
                <a href="{{route('all_brand')}}" class="nav-link {{ request()->routeIs('all_brand') ? 'active' : '' }}">
                    <i class="bi bi-box"></i>
                    <span>Thương hiệu</span>
                </a>
                @hasrole('admin')
                <div class="submenu">
                    <a href="{{route('add_brand')}}" class="nav-link">
                        <i class="bi bi-plus-circle"></i>
                        <span>Thêm thương hiệu</span>
                    </a>
                </div>
                @endhasrole
            </div>

            <div class="nav-item">
                <a href="{{route('all_product')}}" class="nav-link {{ request()->routeIs('all_product') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i>
                    <span>Sản phẩm</span>
                </a>
                <div class="submenu">
                    <a href="{{route('add_product')}}" class="nav-link">
                        <i class="bi bi-plus-circle"></i>
                        <span>Thêm sản phẩm</span>
                    </a>
                </div>
            </div>

            <div class="nav-item">
                <a href="{{route('index_comment')}}" class="nav-link {{ request()->routeIs('index_comment') ? 'active' : '' }}">
                    <i class="bi bi-chat-dots"></i>
                    <span>Nhận xét</span>
                </a>
            </div>
            @endif

            @if(auth()->user()->hasAnyRoles(['admin', 'user']))
            <div class="nav-caption">Quản lý hệ thống</div>

            <div class="nav-item">
                <a href="{{route('all_coupon')}}" class="nav-link {{ request()->routeIs('all_coupon') ? 'active' : '' }}">
                    <i class="bi bi-ticket-perforated"></i>
                    <span>Mã giảm giá</span>
                </a>
                <div class="submenu">
                    <a href="{{route('add_coupon')}}" class="nav-link">
                        <i class="bi bi-plus-circle"></i>
                        <span>Thêm mã giảm giá</span>
                    </a>
                </div>
            </div>

            <div class="nav-item">
                <a href="{{route('all_fee')}}" class="nav-link {{ request()->routeIs('all_fee') ? 'active' : '' }}">
                    <i class="bi bi-truck"></i>
                    <span>Phí vận chuyển</span>
                </a>
                <div class="submenu">
                    <a href="{{route('add_fee')}}" class="nav-link">
                        <i class="bi bi-plus-circle"></i>
                        <span>Thêm phí vận chuyển</span>
                    </a>
                </div>
            </div>

            <div class="nav-item">
                <a href="{{route('all_slider')}}" class="nav-link {{ request()->routeIs('all_slider') ? 'active' : '' }}">
                    <i class="bi bi-images"></i>
                    <span>Slider</span>
                </a>
                <div class="submenu">
                    <a href="{{route('add_slider')}}" class="nav-link">
                        <i class="bi bi-plus-circle"></i>
                        <span>Thêm slider</span>
                    </a>
                </div>
            </div>

            <div class="nav-item">
                <a href="{{route('all_pages')}}" class="nav-link {{ request()->routeIs('all_pages') ? 'active' : '' }}">
                    <i class="bi bi-file-text"></i>
                    <span>Trang tĩnh</span>
                </a>
            </div>
            @endif

            <div class="nav-caption">Bán hàng</div>

            @if(auth()->user()->hasAnyRoles(['admin', 'user']))
            <div class="nav-item">
                <a href="{{route('all_order')}}" class="nav-link {{ request()->routeIs('all_order') ? 'active' : '' }}">
                    <i class="bi bi-cart-check"></i>
                    <span>Đơn hàng</span>
                </a>
            </div>
            @endif

            @impersonate
            <div class="nav-item">
                <a href="{{ route('impersonate_destroy') }}" class="nav-link">
                    <i class="bi bi-person-x"></i>
                    <span>Dừng chuyển quyền</span>
                </a>
            </div>
            @endimpersonate

            @hasrole('admin')
            <div class="nav-item">
                <a href="{{route('all_user')}}" class="nav-link {{ request()->routeIs('all_user') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Quản lý tài khoản</span>
                </a>
            </div>
            @endhasrole

            @if(auth()->user()->hasAnyRoles(['admin', 'user']))
            <div class="nav-item">
                <a href="{{route('all_customer')}}" class="nav-link {{ request()->routeIs('all_customer') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i>
                    <span>Khách hàng</span>
                </a>
            </div>
            @endif

            @hasrole('author')
            <div class="nav-caption">Nội dung</div>

            <div class="nav-item">
                <a href="{{route('all_category_post')}}" class="nav-link {{ request()->routeIs('all_category_post') ? 'active' : '' }}">
                    <i class="bi bi-collection"></i>
                    <span>Danh mục bài viết</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="{{route('all_post')}}" class="nav-link {{ request()->routeIs('all_post') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Bài viết</span>
                </a>
            </div>
            @endhasrole
        </div>
    </nav>

    <!-- Header -->
    <header class="header" id="header">
        <div class="header-left">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h4 class="mb-0 ms-3">{{$title ?? 'Dashboard'}}</h4>
        </div>

        <div class="header-right">
            <div class="dropdown user-dropdown">
                <img src="{{asset('backend/assets/images/user/avatar-1.jpg')}}"
                     class="user-avatar"
                     data-bs-toggle="dropdown"
                     alt="User Avatar">
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><h6 class="dropdown-header">{{Auth::user()->name}}</h6></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{route('logout')}}"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // Sidebar Toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const header = document.getElementById('header');
            const mainContent = document.getElementById('mainContent');

            sidebar.classList.toggle('collapsed');
            header.classList.toggle('sidebar-collapsed');
            mainContent.classList.toggle('sidebar-collapsed');
        });

        // Mobile Sidebar
        if (window.innerWidth <= 768) {
            document.getElementById('sidebar').classList.add('collapsed');
            document.getElementById('header').classList.add('sidebar-collapsed');
            document.getElementById('mainContent').classList.add('sidebar-collapsed');
        }

        // Loading Animation
        function showLoading() {
            document.getElementById('loading').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('loading').style.display = 'none';
        }

        // Toastr Configuration
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>

    @yield('js')
</body>

</html>
