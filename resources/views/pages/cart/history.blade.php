@extends('layout')
@section('title', 'Lịch sử mua hàng')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span>
                        <span class="mr-2"><a href="{{ URL::to('/edit-customer/' . Session::get('customer_id')) }}">Tài
                                khoản</a></span>
                        <span>Lịch sử mua hàng</span>
                    </p>
                    <h1 class="mb-0 bread">Lịch Sử Mua Hàng</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar-box ftco-animate">
                        <div class="profile-info text-center mb-4">
                            <div class="profile-avatar mb-2">
                                @if (Session::get('customer_avatar'))
                                    <img src="{{ asset('upload/customer/' . Session::get('customer_avatar')) }}" alt="Avatar"
                                        class="rounded-circle" width="100" height="100">
                                @else
                                    {{-- Ảnh mặc định nếu người dùng chưa có avatar --}}
                                    <img src="{{ asset('frontend/images/default-avatar.png') }}" alt="Avatar"
                                        class="rounded-circle" width="100" height="100">
                                @endif
                            </div>
                            <h5 class="profile-name">{{ Session::get('customer_name') }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item {{ Request::is('edit-customer/*') ? 'active' : '' }}"><a
                                    href="{{ URL::to('/edit-customer/' . Session::get('customer_id')) }}"><span><i
                                            class="ion-ios-person mr-2"></i> Thông tin tài khoản</span></a></li>
                            <li class="list-group-item {{ Request::is('history') ? 'active' : '' }}"><a href="{{ route('history') }}"><span><i class="ion-ios-list-box mr-2"></i> Lịch sử mua
                                        hàng</span></a></li>
                            <li class="list-group-item"><a href="{{ route('logout') }}"><span><i class="ion-ios-log-out mr-2"></i> Đăng xuất</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="order-history-wrap p-4 bg-white ftco-animate">
                        <h3 class="mb-4 billing-heading">Các đơn hàng đã đặt</h3>

                        @if (session()->has('message'))
                            <div class="alert alert-success">{!! session()->get('message') !!}</div>
                            @php session()->forget('message'); @endphp
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">{!! session()->get('error') !!}</div>
                            @php session()->forget('error'); @endphp
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Tình trạng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($orders && count($orders) > 0)
                                        @foreach ($orders as $key => $order)
                                            <tr class="text-center">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $order->order_code }}</td>
                                                <td>{{ date('d/m/Y', strtotime($order->order_date)) }}</td>
                                                <td>
                                                    @switch($order->order_status)
                                                        @case(1)
                                                            <span class="badge badge-primary">Đơn hàng mới</span>
                                                        @break

                                                        @case(2)
                                                            <span class="badge badge-success">Hoàn thành</span>
                                                        @break

                                                        @case(3)
                                                            <span class="badge badge-danger">Đã hủy</span>
                                                        @break

                                                        @case(4)
                                                            <span class="badge badge-warning">Đã xác nhận</span>
                                                        @break

                                                        @case(5)
                                                            <span class="badge badge-info">Đang vận chuyển</span>
                                                        @break

                                                        @default
                                                            <span class="badge badge-secondary">Chờ xử lý</span>
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <a href="{{ route('view_order_history', ['order_code' => $order->order_code]) }}"
                                                        class="btn btn-primary btn-sm">Xem</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center text-muted p-4">Bạn chưa có đơn hàng nào.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-5">
                            <div class="col text-center">
                                <div class="block-27">
                                    {{-- Sử dụng hàm render pagination chuẩn của Laravel --}}
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
