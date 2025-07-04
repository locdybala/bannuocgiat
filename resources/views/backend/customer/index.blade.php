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
                                <h5 class="m-b-10">Quản lý khách hàng</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Khách hàng</a></li>
                                <li class="breadcrumb-item"><a href="#!">Danh sách khách hàng</a></li>
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
                        @include('backend.components.notification');
                        <div class="card-header">
                            <h5>Danh sách khách hàng</h5>
                            <div>
                                <a href="{{ route('add_customer') }}"
                                   class="btn btn-sm mt-2 btn-primary">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm khách hàng</a>
                            </div>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên khách hàng</th>
                                        <th>Địa chỉ email</th>
                                        <th>Ngày sinh</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=0; @endphp
                                    @if ($customers)
                                        @foreach ($customers as $cus)
                                            @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{ $cus->customer_name }}</td>
                                                <td>{{ $cus->customer_email }}</td>
                                                <td>{{$cus->customer_birthday}}</td>
                                                <td>{{$cus->customer_phone}}</td>
                                                <td>{{ $cus->customer_address }}</td>
                                                <td>

                                                    <div style="display: flex">
                                                        <a class="btn btn-sm btn-warning"
                                                           href="{{route('update_customer',['id'=>$cus->customer_id])}}"
                                                        ><i class="fa fa-pencil"></i></a
                                                        >
                                                        <form method="POST" action="">
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="return confirm('Bạn có muốn xóa khách hàng này không?')"
                                                               href="{{ route('deletecustomer',['id'=>$cus->customer_id]) }}"
                                                               class="btn btn-sm btn-danger ml-2"><i class="fa fa-trash">
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
                                @include('backend.components.pagination', ['paginator' => $customers]);
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
