@extends('backend.admin_layout')
@section('content')
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Quản lý đơn đặt hàng</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Đơn đặt hàng</a></li>
                                <li class="breadcrumb-item"><a href="#!">Danh sách đơn đặt hàng</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">

                <!-- [ stiped-table ] start -->
                <div class="col-xl-12">
                    <div class="card">
                        @include('backend.components.notification')
                        <div class="card-header">
                            <h5>Danh sách đơn đặt hàng</h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày tháng đặt hàng</th>
                                        <th>Tình trạng đơn hàng</th>
                                        <th style="width:30px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=0; @endphp
                                    @if ($orders)
                                        @foreach ($orders as $order)
                                            @php $i++; @endphp
                                            <tr>
                                                <td><i>{{$i}}</i></td>
                                                <td>{{ $order->order_code }}</td>
                                                <td>{{ $order->order_date }}</td>
                                                @if ($order->order_status==1)

                                                    <td>
                                        <span
                                            class="badge badge-primary">Đơn hàng mới</span></td>
                                                @elseif($order->order_status== 4)
                                                    <td>
                                        <span
                                            class="badge badge-warning">Xác nhận đơn hàng</span></td>
                                                @elseif($order->order_status== 5)
                                                    <td>
                                        <span
                                            class="badge badge-light">Đang vận chuyển</span></td>
                                                @elseif($order->order_status== 3)
                                                    <td>
                                        <span
                                            class="badge badge-danger">Đơn hàng bị hủy</span></td>
                                                @elseif($order->order_status== 6)
                                                    <td>
                                        <span
                                            class="badge badge-primary">Đơn hàng mới - Đã thanh toán</span></td>
                                                @else
                                                    <td><span
                                                            class="badge badge-success">Hoàn thành</span></td>

                                                @endif
                                                <td>
                                                    <div style="display: flex">
                                                        <a class="btn btn-sm btn-warning"
                                                           href="{{route('view_order',['order_code'=> $order->order_code])}}"
                                                        ><i class="fa fa-pencil"></i></a
                                                        >
                                                        <form method="POST" action="">
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="return confirm('Bạn có muốn xóa đơn hàng này không?')"
                                                               href="{{URL::to('/delete-order/'.$order->order_code)}}"
                                                               class="btn btn-sm btn-danger ml-2"><i
                                                                    class="fa fa-trash">
                                                                </i></a>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td>Không có dữ liệu</td>
                                    @endif
                                    </tbody>
                                </table>
                                @include('backend.components.pagination', ['paginator' => $orders]);
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ stiped-table ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </section>
@endsection
