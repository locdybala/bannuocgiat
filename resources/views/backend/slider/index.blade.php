@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Slider</li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách slider</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách slider</h5>
                    <a href="{{ route('add_slider') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Thêm slider
                    </a>
                </div>
                <div class="card-body">
                    @include('backend.components.notification')
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên slider</th>
                                    <th>Hình ảnh</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @forelse ($sliders as $slider)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td><strong>{{$slider->slider_name}}</strong></td>
                                        <td><img src="/upload/slider/{{ $slider->slider_image }}" style="width:120px;height:70px;border-radius:8px;box-shadow:0 2px 8px #eee;object-fit:cover;" alt=""></td>
                                        <td>
                                            @if ($slider->slider_status==1)
                                                <a href="{{ route('unactive_slider',['id'=>$slider->slider_id]) }}" class="badge bg-success text-decoration-none">Kích hoạt</a>
                                            @else
                                                <a href="{{ route('active_slider',['id'=>$slider->slider_id]) }}" class="badge bg-warning text-dark text-decoration-none">Không kích hoạt</a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a class="btn btn-warning btn-sm" title="Sửa" href="{{ route('updateslider',['id'=>$slider->slider_id]) }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form method="POST" action="{{ route('deleteslider',['id'=>$slider->slider_id]) }}" onsubmit="return confirm('Bạn có muốn xóa slider này không?')">
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
                                        <td colspan="5" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('backend.components.pagination', ['paginator' => $sliders])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
