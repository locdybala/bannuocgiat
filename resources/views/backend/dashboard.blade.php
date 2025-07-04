@extends('backend.admin_layout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Trang chủ</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Thống kê trang web</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- table card-1 start -->
                <div class="col-md-12 col-xl-6">
                    <div class="card flat-card">
                        <div class="row-table">
                            <div class="col-sm-6 card-body br">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icon feather icon-eye text-c-green mb-1 d-block"></i>
                                    </div>
                                    <div class="col-sm-8 text-md-center">
                                        <h5>{{$order_count}}</h5>
                                        <span>Tổng số đơn hàng</span><br>
                                        <a  target="_blank" href="{{route('all_order')}}">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icon feather icon-music text-c-red mb-1 d-block"></i>
                                    </div>
                                    <div class="col-sm-8 text-md-center">
                                        <h5>{{$customer_count}}</h5>
                                        <span>Tổng số khách hàng</span> <br>
                                        <a target="_blank" href="{{route('all_customer')}}">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- table card-1 end -->
                <!-- table card-2 start -->
                <div class="col-md-12 col-xl-6">
                    <div class="card flat-card">
                        <div class="row-table">
                            <div class="col-sm-6 card-body br">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icon feather icon-share-2 text-c-blue mb-1 d-block"></i>
                                    </div>
                                    <div class="col-sm-8 text-md-center">
                                        <h5>{{$user_count}}</h5>
                                        <span>Tài khoản quản lý</span><br>
                                        <a  target="_blank" href="{{route('all_user')}}">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icon feather icon-wifi text-c-blue mb-1 d-block"></i>
                                    </div>
                                    <div class="col-sm-8 text-md-center">
                                        <h5>{{$order_count}}</h5>
                                        <span>Tổng số đơn hàng</span> <br>
                                        <a target="_blank" href="{{route('all_order')}}">Xem chi tiết</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- table card-2 end -->

                <div class="col-md-12 col-xl-12" >
                    <h5 style="text-align: center" class="page-title">Thống kê doanh thu</h5>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form autocomplete="off">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>

                                            </div>
                                            <div class="col-lg-2">
                                                <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>

                                            </div>
                                            <div class="col-lg-2">
                                                <p>
                                                    Lọc theo:
                                                    <select name="" class="dashboard-filter form-control" id="">
                                                        <option value="">--Chọn--</option>
                                                        <option value="7ngay">7 ngày qua</option>
                                                        <option value="thangtruoc">tháng trước</option>
                                                        <option value="thangnay">tháng này</option>
                                                        <option value="365ngayqua">365 ngày qua</option>

                                                    </select>
                                                </p>
                                            </div>
                                        </div>
                                        <input type="button" id="btn-dashboard-filter" class="btn btn-outline-primary btn-sm"
                                               value="Lọc kết quả">
                                    </form>
                                </div>

                                <div class="card-body" style="height: 400px;">
                                    <div id="myfirstchart" style="height: 250px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- prject ,team member start -->
                <div class="col-xl-6 col-md-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>Bài viết xem nhiều nhất</h5>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i
                                                        class="feather icon-maximize"></i> maximize</span><span
                                                    style="display:none"><i
                                                        class="feather icon-minimize"></i> Restore</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                                        class="feather icon-minus"></i> collapse</span><span style="display:none"><i
                                                        class="feather icon-plus"></i> expand</span></a></li>
                                        <li class="dropdown-item reload-card"><a href="#!"><i
                                                    class="feather icon-refresh-cw"></i> reload</a></li>
                                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i>
                                                remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>
                                            STT
                                        </th>
                                        <th>Tiêu đề</th>
                                        <th>Số lượt xem</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=0; @endphp
                                    @foreach($posts as $post)
                                        @php $i++; @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <div class="d-inline-block">
                                                    <h6><a target="_blank" href="{{route('postDetail',['slug'=>$post->post_slug])}}">{{$post->post_title}}</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$post->post_view}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @include('backend.components.pagination', ['paginator' => $posts]);
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>Sản phẩm xem nhiều nhất</h5>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item full-card"><a href="#!"><span><i
                                                        class="feather icon-maximize"></i> maximize</span><span
                                                    style="display:none"><i
                                                        class="feather icon-minimize"></i> Restore</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                                        class="feather icon-minus"></i> collapse</span><span style="display:none"><i
                                                        class="feather icon-plus"></i> expand</span></a></li>
                                        <li class="dropdown-item reload-card"><a href="#!"><i
                                                    class="feather icon-refresh-cw"></i> reload</a></li>
                                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i>
                                                remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>
                                            STT
                                        </th>
                                        <th>Tiêu đề</th>
                                        <th>Số lượt xem</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=0; @endphp
                                    @foreach($products as $product)
                                        @php $i++; @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>
                                                <div class="d-inline-block align-middle">
                                                    <div class="d-inline-block">
                                                        <h6><a target="_blank" href="{{route('detailProduct',['id'=>$product->product_id])}}">{{$product->product_name}}</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$product->product_view}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @include('backend.components.pagination', ['paginator' => $products]);

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
  @endsection
@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">

        $(function() {
            $("#datepicker").datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-mm-dd",
                dayNamesMin:['Thứ 2','Thứ 3','Thứ 4','Thứ 5', 'Thứ 6', 'Thứ 7','Chủ nhật'],
                duration:"slow"
            });
            $("#datepicker2").datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-mm-dd",
                dayNamesMin:['Thứ 2','Thứ 3','Thứ 4','Thứ 5', 'Thứ 6', 'Thứ 7','Chủ nhật'],
                duration:"slow"
            });

        });
        $(document).ready(function() {
            chart30daysorder();
            var chart = new Morris.Bar({
                element: 'myfirstchart',
                lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                parseTime: false,
                xkey: 'period',
                ykeys: ['order', 'sales', 'profit', 'quantity'],
                behaveLikeLine: true,
                labels: ['đơn hàng', 'doanh số', 'tiền hàng', 'số lượng']
            });
            $('#btn-dashboard-filter').click(function() {
                debugger;
                var _token = $('input[name="_token"]').val();
                var form_date = $('#datepicker').val();
                var to_date = $('#datepicker2').val();
                $.ajax({
                    url: "{{ url('/admin/filter-by-date') }}",
                    method: "POST",
                    data: {
                        form_date: form_date,
                        to_date: to_date,
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        chart.setData(data)
                    }
                });

            });

            function chart30daysorder() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/admin/days-order') }}",
                    method: "POST",
                    data: {
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        chart.setData(data)
                    }
                });
            }
            $('.dashboard-filter').change(function() {
                var dashboard_value = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/admin/dashboard-filter') }}",
                    method: "POST",
                    data: {
                        dashboard_value: dashboard_value,
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        chart.setData(data)
                    }
                });
            });
        });
    </script>
@endsection
