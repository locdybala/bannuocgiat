@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Khách hàng</li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách khách hàng</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách khách hàng</h5>
                    <a href="{{ route('add_customer') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Thêm khách hàng
                    </a>
                </div>
                <div class="card-body">
                    @include('backend.components.notification')
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @forelse ($customers as $customer)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$customer->customer_name}}</td>
                                        <td>{{$customer->customer_email}}</td>
                                        <td>{{$customer->customer_phone}}</td>
                                        <td>
                                            @if ($customer->customer_status == 1)
                                                <span class="badge bg-success">Hoạt động</span>
                                            @else
                                                <span class="badge bg-secondary">Khóa</span>
                                            @endif
                                        </td>
                                        <td>{{ $customer->created_at }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a class="btn btn-sm btn-warning"
                                                           href="{{route('update_customer',['id'=>$customer->customer_id])}}"
                                                        ><i class="fa fa-pencil"></i></a
                                                        >
                                                        <form method="POST" action="">
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="return confirm('Bạn có muốn xóa khách hàng này không?')"
                                                               href="{{ route('deletecustomer',['id'=>$customer->customer_id]) }}"
                                                               class="btn btn-sm btn-danger ml-2"><i class="fa fa-trash">
                                                                </i></a>
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
                        @include('backend.components.pagination', ['paginator' => $customers])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
