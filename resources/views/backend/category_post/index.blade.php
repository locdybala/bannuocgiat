@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Danh mục bài viết</li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách danh mục bài viết</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách danh mục</h5>
                    <a href="{{ route('add_PostCategory') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Thêm danh mục bài viết
                    </a>
                </div>
                <div class="card-body">
                    @include('backend.components.notification')
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên danh mục</th>
                                    <th>Hiển Thị</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @forelse ($categories as $category)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td><strong>{{$category->cate_post_name}}</strong></td>
                                        <td>
                                            @if ($category->cate_post_status==1)
                                                <a href="{{ route('unactive_category_post',['id'=>$category->cate_post_id]) }}" class="badge bg-success text-decoration-none">Kích hoạt</a>
                                            @else
                                                <a href="{{ route('active_category_post',['id'=>$category->cate_post_id]) }}" class="badge bg-warning text-dark text-decoration-none">Không kích hoạt</a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a class="btn btn-warning btn-sm" title="Sửa" href="{{ route('updatecategory_post',['id'=>$category->cate_post_id]) }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form method="POST" action="{{ route('deleteCategoryPost',['id'=>$category->cate_post_id]) }}" onsubmit="return confirm('Bạn có muốn xóa danh mục này không?')">
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
                                        <td colspan="4" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('backend.components.pagination', ['paginator' => $categories])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
