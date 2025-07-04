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
                                <h5 class="m-b-10">Quản lý bài viết</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Bài Viết</a></li>
                                <li class="breadcrumb-item"><a href="#!">Danh sách bài viết</a></li>
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
                            <h5>Danh sách bài viết</h5>
                            <div>
                                <a href="{{ route('add_post') }}"
                                   class="btn btn-sm mt-2 btn-primary">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm bài viết</a>
                            </div>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên bài viết</th>
                                        <th>Hình ảnh</th>
                                        <th>Mô tả bài viết</th>
                                        <th>Từ khóa bài viết</th>
                                        <th>Danh mục bài viết</th>
                                        <th>Hiển thị</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=0; @endphp
                                    @if ($posts)
                                        @foreach ($posts as $post)
                                            @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><strong>{{$post->post_title}}</strong></td>
                                                <td><img src="/upload/post/{{ $post->post_image }}" style="width:150px;height:100px;"
                                                         alt=""></td>
                                                <td style="font-size: 14px;"><span style="display: block;
  width: 100px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;">{!!$post->post_description!!}</span></td>
                                                <td>{!!  $post->meta_keywords  !!}</td>
                                                <td>{{ optional($post->category)->cate_post_name    }}</td>

                                                @if ($post->post_status==1)

                                                    <td>
                                                        <a href="{{ route('unactive_post',['id'=>$post->post_id]) }}"
                                                           class="badge badge-success">Kích hoạt</a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="{{ route('active_post',['id'=>$post->post_id]) }}"
                                                           class="badge badge-warning">Không kích hoạt</a>
                                                    </td>

                                                @endif
                                                <td>

                                                    <div style="display: flex">
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
                                        @endforeach
                                    @else
                                        <td>Không có dữ liệu</td>
                                    @endif
                                    </tbody>
                                </table>
                                @include('backend.components.pagination', ['paginator' => $posts]);
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
