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
                                <h5 class="m-b-10">Danh sách các trang</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Quản lý trang</a></li>
                                <li class="breadcrumb-item"><a href="#!">Danh sách trang</a></li>
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
                            <h5>Danh sách trang</h5>
                            <div>
                                <a href="{{ route('add_pages') }}" class="btn btn-sm btn-primary mt-2">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm trang</a>
                            </div>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên trang</th>
                                        <th>Tiêu đề</th>
                                        <th>Slug</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=0; @endphp
                                    @if ($pages)
                                        @foreach ($pages as $page)
                                            @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><strong>{{$page->name}}</strong></td>
                                                <td>{{$page->title}}</td>
                                                <td>{!! $page->slug !!}</td>

                                                <td>
                                                    <div style="display: flex">
                                                        <a class="btn btn-sm btn-warning mr-2"
                                                           href="{{ route('updatePages',['id'=>$page->id]) }}"
                                                        ><i class="fa fa-pencil" aria-hidden="true"></i></a
                                                        >
                                                        <form method="POST" action="">
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="return confirm('Bạn có muốn xóa trang này không?')"
                                                               href="{{ route('deletePages',['id'=>$page->id]) }}"
                                                               class="btn btn-sm btn-danger"><i class="fa fa-trash"
                                                                                                aria-hidden="true"></i></a>
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
                                @include('backend.components.pagination', ['paginator' => $pages]);
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
