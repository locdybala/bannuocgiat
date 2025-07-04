@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Phí vận chuyển</li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách phí vận chuyển</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách phí vận chuyển</h5>
                    <a href="{{ route('add_fee') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Thêm phí vận chuyển
                    </a>
                </div>
                <div class="card-body">
                    @include('backend.components.notification')
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
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
                                @forelse ($feeship as $feeship)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ optional($feeship->city)->name_city }}</td>
                                        <td>{{ optional($feeship->province)->name_quanhuyen }}</td>
                                        <td>{{ optional($feeship->wards)->name_xaphuong }}</td>
                                        <td><strong>{{number_format($feeship->fee_feeship)}} đ</strong></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
