@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Thương hiệu</li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách thương hiệu</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách thương hiệu</h5>
                    @hasrole('admin')
                        <a href="{{ route('add_brand') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle me-1"></i> Thêm thương hiệu
                        </a>
                    @endhasrole
                </div>
                <div class="card-body">
                    @include('backend.components.notification')
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên thương hiệu</th>
                                    <th>Hình ảnh</th>
                                    <th>Mô tả</th>
                                    <th>Tình trạng</th>
                                    @hasrole('admin')
                                    <th>Thao tác</th>
                                    @endhasrole
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @forelse ($brands as $brand)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td><strong>{{$brand->brand_name}}</strong></td>
                                        <td>
                                            @if($brand->brand_image)
                                                <img src="/upload/brand/{{ $brand->brand_image }}" style="width:80px;height:auto;border-radius:8px;box-shadow:0 2px 8px #eee;">
                                            @else
                                                <span class="text-muted">Chưa có ảnh</span>
                                            @endif
                                        </td>
                                        <td>{!! $brand->brand_desc !!}</td>
                                        <td>
                                            @if ($brand->brand_status==1)
                                                <a href="{{ route('unactive_brand',['id'=>$brand->brand_id]) }}" class="badge bg-success text-decoration-none">Kích hoạt</a>
                                            @else
                                                <a href="{{ route('active_brand',['id'=>$brand->brand_id]) }}" class="badge bg-warning text-dark text-decoration-none">Không kích hoạt</a>
                                            @endif
                                        </td>
                                        @hasrole('admin')
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a class="btn btn-warning btn-sm" title="Sửa"
                                                   href="{{ route('updateBrand',['id'=>$brand->brand_id]) }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form method="POST" action="{{ route('deleteBrand',['id'=>$brand->brand_id]) }}" onsubmit="return confirm('Bạn có muốn xóa thương hiệu này không?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Xóa">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        @endhasrole
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('backend.components.pagination', ['paginator' => $brands])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
