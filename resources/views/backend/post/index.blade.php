@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Bài viết</li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách bài viết</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách bài viết</h5>
                    <a href="{{ route('add_post') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Thêm bài viết
                    </a>
                </div>
                <div class="card-body">
                    @include('backend.components.notification')
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Danh mục</th>
                                    <th>Hình ảnh</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @forelse ($posts as $post)
                                    @php $i++; @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$post->post_title}}</td>
                                        <td>{{$post->categoryPost->cate_post_name ?? 'N/A'}}</td>
                                        <td>
                                            @if($post->post_image)
                                                <img src="{{ asset('upload/post/'.$post->post_image) }}" alt="Hình ảnh" style="height: 50px; width: 80px; object-fit: cover; border-radius: 4px;">
                                            @else
                                                <span class="text-muted">Không có</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($post->post_status == 1)
                                                <span class="badge bg-success">Hiển thị</span>
                                            @else
                                                <span class="badge bg-secondary">Ẩn</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a class="btn btn-sm btn-warning"
                                                           href="{{ route('updatepost',['id'=>$post->post_id]) }}"
                                                        ><i class="fa fa-pencil"></i></a
                                                        >
                                                        <form method="POST" action="">
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="return confirm('Bạn có muốn xóa bài viết này không?')"
                                                               href="{{ route('deletePost',['id'=>$post->post_id]) }}"
                                                               class="btn btn-sm btn-danger ml-2"><i class="fa fa-trash">
                                                                </i></a>
                                                        </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('backend.components.pagination', ['paginator' => $posts])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
