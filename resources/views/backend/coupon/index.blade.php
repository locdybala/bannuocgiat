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
                                <h5 class="m-b-10">Quản lý mã giảm giá</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Mã giảm giá</a></li>
                                <li class="breadcrumb-item"><a href="#!">Danh sách mã giảm giá</a></li>
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
                            <h5>Danh sách mã giảm giá</h5>
                            <div>
                                <a href="{{ route('add_coupon') }}" class="btn mt-2 btn-primary btn-sm">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mã giảm giá</a>
                            </div>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên mã giảm giá</th>
                                        <th>Mã giảm giá</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Số lượng giảm giá</th>
                                        <th>Điều kiện giảm giá</th>
                                        <th>Số giảm</th>
                                        <th>Thời hạn</th>
                                        <th>Tình trạng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=0; @endphp
                                    @if ($coupons)
                                        @foreach ($coupons as $cou)
                                            @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{ $cou->coupon_name }}</td>
                                                <td>{{ $cou->coupon_code }}</td>
                                                <td>{{$cou->coupon_date_start}}</td>
                                                <td>{{$cou->coupon_date_end}}</td>
                                                <td>{{ $cou->coupon_time }}</td>
                                                <td>@if($cou->coupon_condition == 1)
                                                        Giảm theo %
                                                    @else
                                                    Giảm tiền
                                                @endif</td>
                                                <td>@if($cou->coupon_condition == 1)
                                                        Giảm {{$cou->coupon_number}} %
                                                    @else
                                                        Giảm {{number_format($cou->coupon_number, 0,',', '.')}} đ
                                                    @endif</td>
                                                <td>
                                                    @if ($cou->coupon_date_end < $today)
                                                    <span style="color: red">Hết hạn</span>
                                                        @else
                                                    <span style="color: green">Còn hạn</span>
                                                @endif
                                                </td>
                                                @if ($cou->coupon_status==1)

                                                    <td>
                                                        <a href=""
                                                           class="badge badge-success">Kích hoạt</a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href=""
                                                           class="badge badge-warning">Không kích hoạt</a>
                                                    </td>

                                                @endif
                                                <td>
                                                    <div class="mb-2" style="display: flex">
                                                    <a class="btn btn-sm btn-warning mr-2"
                                                       href="{{ route('updatecoupon',['id'=>$cou->coupon_id]) }}"
                                                    ><i class="fa fa-pencil"></i></a
                                                    >
                                                    <form method="POST" action="">
                                                        @csrf
                                                        @method('delete')
                                                        <a onclick="return confirm('Bạn có muốn xóa mã giảm giá này không?')"
                                                           href="{{route('deletecoupon',['id'=> $cou->coupon_id])}}"
                                                           class="btn btn-sm btn-danger"><i class="fa fa-trash ">
                                                            </i></a>
                                                    </form>
                                                    </div>

                                                    <a href="{{ route('send_coupon',['id'=> $cou->coupon_id]) }}"
                                                       class="btn btn-sm btn-xs btn-outline-primary mb-2">Gửi mã khách thường</a>
                                                    <a href="{{ route('send_coupon_vip',['id'=> $cou->coupon_id]) }}"
                                                       class="btn btn-sm btn-xs btn-outline-primary mb-2">Gửi mã khách vip</a>
                                                    <br>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td>Không có dữ liệu</td>
                                    @endif
                                    </tbody>
                                </table>
                                @include('backend.components.pagination', ['paginator' => $coupons]);
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
