@extends('layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Lịch sử mua hàng</h2>
                            <p>Trang chủ <span>-</span> Lịch sử</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Category Product Area =================-->
    <section class="cart_area padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Quản lý tài khoản</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <li class="list-group-item border-0">
                                        <a href="{{ URL::to('/edit-customer/' . Session::get('customer_id')) }}" class="text-dark">
                                            <i class="fas fa-user me-2"></i>Thông tin tài khoản
                                        </a>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <a href="{{ route('history') }}" class="text-dark">
                                            <i class="fas fa-history me-2"></i>Lịch sử mua hàng
                                        </a>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <a href="{{ route('logout') }}" class="text-dark">
                                            <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="cart_inner">
                        <h3>Lịch sử mua hàng</h3>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {!! session()->get('message') !!}
                            </div>
                            {{ session()->forget('message') }} <!-- Xóa thông báo -->
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">
                                {!! session()->get('error') !!}
                            </div>
                            {{ session()->forget('error') }} <!-- Xóa thông báo -->
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Thứ tự</th>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Ngày tháng đặt hàng</th>
                                    <th scope="col">Tình trạng đơn hàng</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @if ($orders && count($orders) > 0)
                                    @php $i = 0; @endphp
                                    @foreach ($orders as $order)
                                        @php $i++; @endphp
                                        <tr>
                                            <td class="text-center"><strong>{{ $i }}</strong></td>
                                            <td class="text-center">{{ $order->order_code }}</td>
                                            <td class="text-center">{{ date('d/m/Y', strtotime($order->order_date)) }}</td>
                                            <td class="text-center">
                                                @switch($order->order_status)
                                                    @case(1)
                                                        <span class="badge bg-primary">Đơn hàng mới</span>
                                                        @break
                                                    @case(2)
                                                        <span class="badge bg-success">Hoàn thành</span>
                                                        @break
                                                    @case(3)
                                                        <span class="badge bg-danger">Đơn hàng đã hủy</span>
                                                        @break
                                                    @case(4)
                                                        <span class="badge bg-warning text-dark">Đơn hàng đã được xác nhận</span>
                                                        @break
                                                    @case(5)
                                                        <span class="badge bg-info">Đang vận chuyển</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary">Đơn hàng mới - Đã thanh toán</span>
                                                @endswitch
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('view_order_history', ['order_code' => $order->order_code]) }}" class="btn btn-success btn-sm">
                                                    <i class="fas fa-eye"></i> Chi tiết
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center text-muted p-3">
                                            <i class="fas fa-exclamation-circle"></i> Không có đơn hàng nào
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <div class="col-12">
                                <div class="pagination d-flex justify-content-center mt-5">
                                    <a href="{{$orders->previousPageUrl()}}"
                                       class="rounded {{$orders->onFirstPage() ? 'disabled' : ''}}">&laquo;</a>

                                    @for ($i = 1; $i <= $orders->lastPage(); $i++)
                                        <a href="{{$orders->url($i)}}"
                                           class="rounded {{$orders->currentPage() === $i ? 'active' : ''}}">{{$i}}</a>
                                    @endfor

                                    <a href="{{$orders->nextPageUrl()}}"
                                       class="rounded {{$orders->hasMorePages() ? '' : 'disabled'}}">&raquo;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->
@endsection
