@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Sản phẩm</li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="mb-0">Danh sách sản phẩm</h5>
                    <div class="d-flex gap-2 flex-wrap">
                        <form action="{{ route('search_product') }}" method="GET" class="d-flex">
                            <input type="text" name="query" class="form-control form-control-sm me-2" placeholder="Tìm kiếm sản phẩm..." value="{{ request('query') }}">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-search"></i></button>
                        </form>
                        <a href="{{ route('add_product') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle me-1"></i> Thêm sản phẩm
                        </a>
                        <form action="{{route('export_csv')}}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-dark btn-sm"><i class="bi bi-file-earmark-excel me-1"></i>Xuất Excel</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @include('backend.components.notification')
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Thư viện ảnh</th>
                                    <th>Giá</th>
                                    <th>Hình ảnh</th>
                                    <th>Số lượng</th>
                                    <th>Danh mục</th>
                                    <th>Tình trạng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @forelse ($products as $product)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td><strong>{{$product->product_name}}</strong></td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{route('add_gallery',['product_id'=>$product->product_id])}}">
                                                <i class="bi bi-images"></i> Thêm thư viện
                                            </a>
                                        </td>
                                        <td>{{number_format($product->product_price, 0,',' , '.')}} đ</td>
                                        <td>
                                            <img src="/upload/product/{{ $product->product_image }}" style="width:100px;height:70px;border-radius:8px;box-shadow:0 2px 8px #eee;object-fit:cover;" alt="">
                                        </td>
                                        <td>{{$product->product_quantity}}</td>
                                        <td>{{ optional($product->category)->category_name }}</td>
                                        <td>
                                            @if ($product->product_status==1)
                                                <a href="{{ route('unactive_product',['id'=>$product->product_id]) }}" class="badge bg-success text-decoration-none">Kích hoạt</a>
                                            @else
                                                <a href="{{ route('active_product',['id'=>$product->product_id]) }}" class="badge bg-warning text-dark text-decoration-none">Không kích hoạt</a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a class="btn btn-warning btn-sm" title="Sửa"
                                                   href="{{ route('updateproduct',['id'=>$product->product_id]) }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form method="POST" action="{{ route('deleteproduct',['id'=>$product->product_id]) }}" onsubmit="return confirm('Bạn có muốn xóa sản phẩm này không?')">
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
                                        <td colspan="9" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('backend.components.pagination', ['paginator' => $products])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
