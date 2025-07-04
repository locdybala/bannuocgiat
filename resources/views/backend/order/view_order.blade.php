@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Đơn hàng</li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-receipt me-2"></i>Chi tiết đơn hàng</h5>
                </div>
                <div class="card-body">
                    <h6 class="mb-3">Thông tin khách hàng</h6>
                    <ul class="list-group mb-4">
                        <li class="list-group-item"><strong>Họ tên:</strong> {{ $order->customer->name ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $order->customer->email ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Số điện thoại:</strong> {{ $order->customer->phone ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Địa chỉ:</strong> {{ $order->customer->address ?? 'N/A' }}</li>
                    </ul>
                    <h6 class="mb-3">Chi tiết đơn hàng</h6>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; $total=0; @endphp
                                @foreach ($order->items as $item)
                                    @php $i++; $total += $item->price * $item->quantity; @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->product->name ?? 'N/A'}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Tổng cộng</th>
                                    <th>{{ number_format($total, 0, ',', '.') }} đ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="mb-3">
                        <span class="fw-bold">Trạng thái đơn hàng: </span>
                        @if ($order->status == 1)
                            <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                        @elseif ($order->status == 2)
                            <span class="badge bg-info">Đang giao</span>
                        @elseif ($order->status == 3)
                            <span class="badge bg-success">Hoàn thành</span>
                        @else
                            <span class="badge bg-danger">Đã hủy</span>
                        @endif
                    </div>
                    <a href="{{ route('order.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@endsection
