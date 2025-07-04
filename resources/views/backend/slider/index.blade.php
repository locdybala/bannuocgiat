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
                                <h5 class="m-b-10">Quản lý slider</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                                class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Slider</a></li>
                                <li class="breadcrumb-item"><a href="#!">Danh sách slider</a></li>
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
                            <h5>Danh sách slider</h5>
                            <div>
                                <a href="{{ route('add_slider') }}"
                                   class="btn mt-2 btn-sm btn-primary"><i class="fa fa-plus-circle"
                                                                          aria-hidden="true"></i> Thêm slider</a>
                            </div>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên slider</th>
                                        <th>Hình ảnh</th>
                                        <th>Tình trạng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=0; @endphp
                                    @if ($sliders)
                                        @foreach ($sliders as $slider)
                                            @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><strong>{{$slider->slider_name}}</strong></td>
                                                <td><img src="/upload/slider/{{ $slider->slider_image }}"
                                                         style="width:150px;height:100px;" alt="">
                                                </td>
                                                @if ($slider->slider_status==1)

                                                    <td>
                                                        <a href="{{ route('unactive_slider',['id'=>$slider->slider_id]) }}"
                                                           class="badge badge-success">Kích hoạt</a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="{{ route('active_slider',['id'=>$slider->slider_id]) }}"
                                                           class="badge badge-warning">Không kích hoạt</a>
                                                    </td>

                                                @endif
                                                <td>

                                                    <div style="display: flex">
                                                        <a class="btn btn-sm btn-warning"
                                                           href="{{ route('updateslider',['id'=>$slider->slider_id]) }}"
                                                        ><i class="fa fa-pencil"></i> </a
                                                        >
                                                        <form method="POST" action="">
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="return confirm('Bạn có muốn xóa slider này không?')"
                                                               href="{{ route('deleteslider',['id'=>$slider->slider_id]) }}"
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
                                @include('backend.components.pagination', ['paginator' => $sliders]);
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
