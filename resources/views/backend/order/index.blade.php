@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
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
                                        <td>{{$i}}</td>
                                        <td>{{$order->order_code}}</td>
                                        <td>{{$order->customer->name ?? 'N/A'}}</td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ number_format($order->total, 0, ',', '.') }} đ</td>
                                        <td>
                                            @if ($order->status == 1)
                                                <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                            @elseif ($order->status == 2)
                                                <span class="badge bg-info">Đang giao</span>
                                            @elseif ($order->status == 3)
                                                <span class="badge bg-success">Hoàn thành</span>
                                            @else
                                                <span class="badge bg-danger">Đã hủy</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-info btn-sm" title="Xem chi tiết">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <form method="POST" action="{{ route('order.delete', $order->id) }}" onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Xóa">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
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
