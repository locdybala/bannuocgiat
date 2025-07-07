@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Đơn hàng</li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách đơn hàng</h5>
                </div>
                <div class="card-body">
                    @include('backend.components.notification')
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @forelse ($orders as $order)
                                    @php $i++; @endphp
                                    <tr>
                                        <td><i>{{ $i }}</i></td>
                                        <td>{{ $order->order_code }}</td>
                                        <td>{{ $order->customer->customer_name }}

                                        <td>{{ $order->order_date }}</td>
                                        <td>{{ number_format($order->order_total) }} vnđ</td>
                                        @if ($order->order_status == 1)
                                            <td>
                                                <span class="badge bg-primary">Đơn hàng mới</span>
                                            </td>
                                        @elseif($order->order_status == 4)
                                            <td>
                                                <span class="badge bg-warning">Xác nhận đơn hàng</span>
                                            </td>
                                        @elseif($order->order_status == 5)
                                            <td>
                                                <span class="badge bg-light">Đang vận chuyển</span>
                                            </td>
                                        @elseif($order->order_status == 3)
                                            <td>
                                                <span class="badge bg-danger">Đơn hàng bị hủy</span>
                                            </td>
                                        @elseif($order->order_status == 6)
                                            <td>
                                                <span class="badge bg-primary">Đơn hàng mới - Đã thanh toán</span>
                                            </td>
                                        @else
                                            <td><span class="badge bg-success">Hoàn thành</span></td>
                                        @endif
                                        <td>
                                            <div style="display: flex">
                                                <a class="btn btn-sm btn-warning" style="margin-right:10px;"
                                                    href="{{ route('view_order', ['order_code' => $order->order_code]) }}"><i
                                                        class="fa fa-pencil"></i></a>
                                                        @if ($order->order_status==1)
                                                        <a onclick="return confirm('Bạn có muốn xóa đơn hàng này không?')"
                                                           href="{{route('delete_order', ['order_code' => $order->order_code])}}"
                                                           class="btn btn-sm btn-danger ml-2"><i
                                                                class="fa fa-trash">
                                                            </i></a>
                                                    @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('backend.components.pagination', ['paginator' => $orders])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
