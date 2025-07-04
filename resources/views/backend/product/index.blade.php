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
                                <h5 class="m-b-10">Danh sách sản phẩm</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Sản phẩm</a></li>
                                <li class="breadcrumb-item"><a href="#!">Danh sách sản phẩm</a></li>
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
                            <h5>Danh sách sản phẩm</h5>
                            <div style="display: flex">
                                <a href="{{ route('add_product') }}" class="btn btn-sm btn-primary mt-2 mr-2">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm sản phẩm</a>
                                <form action="{{route('export_csv')}}" method="POST">
                                    @csrf
                                    <input type="submit" value="Xuất Excel" name="export_csv"
                                           class="btn btn-dark btn-sm mt-2">
                                </form>
                            </div>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Thư viện ảnh</th>
                                        <th>Giá</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Danh mục</th>
{{--                                        <th>Thương hiệu</th>--}}
                                        <th>Tình trạng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=0; @endphp
                                    @if ($products)
                                        @foreach ($products as $product)
                                            @php $i++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>

                                                <td><strong>{{$product->product_name}}</strong></td>
                                                <td><a class="btn btn-sm btn-primary"
                                                       href="{{route('add_gallery',['product_id'=>$product->product_id])}}">Thêm
                                                        thư viện ảnh</a></td>
                                                <td>{{number_format($product->product_price, 0,',' , '.')}} đ</td>
                                                <td><img src="/upload/product/{{ $product->product_image }}"
                                                         style="width:150px;height:100px;" alt=""></td>
                                                <td>{{$product->product_quantity}}</td>
                                                <td>{{ optional($product->category)->category_name }}</td>
{{--                                                <td>{{ optional($product->brand)->brand_name }}</td>--}}

                                                @if ($product->product_status==1)

                                                    <td>
                                                        <a href="{{ route('unactive_product',['id'=>$product->product_id]) }}"
                                                           class="badge badge-success">Kích hoạt</a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="{{ route('active_product',['id'=>$product->product_id]) }}"
                                                           class="badge badge-warning">Không kích hoạt</a>
                                                    </td>

                                                @endif
                                                <td>
                                                    <div style="display: flex">
                                                        <a class="btn btn-sm btn-warning"
                                                           href="{{ route('updateproduct',['id'=>$product->product_id]) }}"
                                                        ><i class="fa fa-pencil"></i></a
                                                        >
                                                        <form method="POST" action="">
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')"
                                                               href="{{ route('deleteproduct',['id'=>$product->product_id]) }}"
                                                               class="btn btn-sm btn-danger ml-2"><i class="fa fa-trash"></i></a>
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
                                @include('backend.components.pagination', ['paginator' => $products]);
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
