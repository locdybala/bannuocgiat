@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Mã giảm giá</li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách mã giảm giá</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách mã giảm giá</h5>
                    <a href="{{ route('add_coupon') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Thêm mã giảm giá
                    </a>
                </div>
                <div class="card-body">
                    @include('backend.components.notification')
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên mã giảm giá</th>
                                    <th>Mã giảm giá</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Số lượng</th>
                                    <th>Điều kiện</th>
                                    <th>Số giảm</th>
                                    <th>Thời hạn</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @forelse ($coupons as $cou)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ $cou->coupon_name }}</td>
                                        <td><code>{{ $cou->coupon_code }}</code></td>
                                        <td>{{$cou->coupon_date_start}}</td>
                                        <td>{{$cou->coupon_date_end}}</td>
                                        <td>{{ $cou->coupon_time }}</td>
                                        <td>
                                            @if($cou->coupon_condition == 1)
                                                <span class="badge bg-info">Giảm theo %</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Giảm tiền</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($cou->coupon_condition == 1)
                                                Giảm {{$cou->coupon_number}}%
                                            @else
                                                Giảm {{number_format($cou->coupon_number, 0,',', '.')}} đ
                                            @endif
                                        </td>
                                        <td>
                                            @if ($cou->coupon_date_end < $today)
                                                <span class="badge bg-danger">Hết hạn</span>
                                            @else
                                                <span class="badge bg-success">Còn hạn</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($cou->coupon_status==1)
                                                <span class="badge bg-success">Kích hoạt</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Không kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a class="btn btn-warning btn-sm" title="Sửa" href="{{ route('updatecoupon',['id'=>$cou->coupon_id]) }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form method="POST" action="{{route('deletecoupon',['id'=> $cou->coupon_id])}}" onsubmit="return confirm('Bạn có muốn xóa mã giảm giá này không?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Xóa">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('send_coupon',['id'=> $cou->coupon_id]) }}" class="btn btn-outline-primary btn-sm">Gửi khách thường</a>
                                                <a href="{{ route('send_coupon_vip',['id'=> $cou->coupon_id]) }}" class="btn btn-outline-info btn-sm">Gửi khách VIP</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('backend.components.pagination', ['paginator' => $coupons])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
