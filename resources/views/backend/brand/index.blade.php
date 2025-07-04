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
                                <h5 class="m-b-10">Danh sách thương hiệu sản phẩm</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Thương hiệu</a></li>
                                <li class="breadcrumb-item"><a href="#!">Danh sách thương hiệu</a></li>
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
                            <h5>Danh sách thương hiệu</h5>
                            @hasrole('admin')
                            <div>
                                <a href="{{ route('add_brand') }}" class="btn btn-sm btn-primary mt-2">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm thương hiệu</a>
                            </div>
                            @endhasrole
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
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
                                    @if ($brands)
                                        @foreach ($brands as $brand)
                                            @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><strong>{{$brand->brand_name}}</strong></td>
                                                <td>
                                                    @if($brand->brand_image)
                                                        <img src="/upload/brand/{{ $brand->brand_image }}"
                                                             style="width:100px;height:auto;">
                                                    @else
                                                        <span class="text-muted">Chưa có ảnh</span>
                                                    @endif
                                                </td>
                                                <td>{!! $brand->brand_desc !!}</td>

                                                @if ($brand->brand_status==1)

                                                    <td>
                                                        <a href="{{ route('unactive_brand',['id'=>$brand->brand_id]) }}"
                                                           class="badge badge-success">Kích hoạt</a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="{{ route('active_brand',['id'=>$brand->brand_id]) }}"
                                                           class="badge badge-warning">Không kích hoạt</a>
                                                    </td>

                                                @endif
                                                @hasrole('admin')
                                                <td>
                                                    <div style="display: flex">
                                                        <a class="btn btn-sm btn-warning mr-2"
                                                           href="{{ route('updateBrand',['id'=>$brand->brand_id]) }}"
                                                        ><i class="fa fa-pencil" aria-hidden="true"></i></a
                                                        >
                                                        <form method="POST" action="">
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="return confirm('Bạn có muốn xóa thương hiệu này không?')"
                                                               href="{{ route('deleteBrand',['id'=>$brand->brand_id]) }}"
                                                               class="btn btn-sm btn-danger"><i class="fa fa-trash"
                                                                                                aria-hidden="true"></i></a>
                                                        </form>
                                                    </div>
                                                </td>
                                                @endhasrole
                                            </tr>
                                        @endforeach
                                    @else
                                        <td>Không có dữ liệu</td>
                                    @endif
                                    </tbody>
                                </table>
                                @include('backend.components.pagination', ['paginator' => $brands]);
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
