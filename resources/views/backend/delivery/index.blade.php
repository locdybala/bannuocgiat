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
                                <h5 class="m-b-10">Quản lý phí vận chuyển</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Phí vận chuyển</a></li>
                                <li class="breadcrumb-item"><a href="#!">Danh sách phí vận chuyển</a></li>
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
                            <h5>Danh sách phí vận chuyển</h5>
                            <div>
                                <a href="{{ route('add_fee') }}" class="btn mt-2 btn-sm btn-primary">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm phí vận
                                    chuyển</a>
                            </div>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên thành phố</th>
                                        <th>Tên quận huyện</th>
                                        <th>Tên xã phường</th>
                                        <th>Phí ship</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=0; @endphp
                                    @if ($feeship)
                                        @foreach ($feeship as $feeship)
                                            @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{ optional($feeship->city)->name_city }}</td>
                                                <td>{{ optional($feeship->province)->name_quanhuyen }}</td>
                                                <td>{{ optional($feeship->wards)->name_xaphuong }}</td>
                                                <td>{{number_format($feeship->fee_feeship)}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td>Không có dữ liệu</td>
                                    @endif
                                    </tbody>
                                </table>
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
