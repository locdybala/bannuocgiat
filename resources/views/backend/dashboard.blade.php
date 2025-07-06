@extends('backend.admin_layout')
@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="number">{{number_format($order_count)}}</div>
                        <div class="label">Tổng đơn hàng</div>
                        <a href="{{route('all_order')}}" class="text-white text-decoration-none">
                            <small>Xem chi tiết <i class="bi bi-arrow-right"></i></small>
                        </a>
                    </div>
                    <div class="icon">
                        <i class="bi bi-cart-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="number">{{number_format($customer_count)}}</div>
                        <div class="label">Khách hàng</div>
                        <a href="{{route('all_customer')}}" class="text-white text-decoration-none">
                            <small>Xem chi tiết <i class="bi bi-arrow-right"></i></small>
                        </a>
                    </div>
                    <div class="icon">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="number">{{number_format($user_count)}}</div>
                        <div class="label">Tài khoản quản lý</div>
                        <a href="{{route('all_user')}}" class="text-white text-decoration-none">
                            <small>Xem chi tiết <i class="bi bi-arrow-right"></i></small>
                        </a>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-gear"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="number">{{number_format($order_count)}}</div>
                        <div class="label">Đơn hàng hôm nay</div>
                        <a href="{{route('all_order')}}" class="text-white text-decoration-none">
                            <small>Xem chi tiết <i class="bi bi-arrow-right"></i></small>
                        </a>
                    </div>
                    <div class="icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Thống kê doanh thu</h5>
                </div>
                <div class="card-body">
                    <form autocomplete="off" class="row g-3 mb-4">
                        @csrf
                        <div class="col-lg-2">
                            <label class="form-label">Từ ngày:</label>
                            <input type="text" id="datepicker" class="form-control" placeholder="Chọn ngày">
                        </div>
                        <div class="col-lg-2">
                            <label class="form-label">Đến ngày:</label>
                            <input type="text" id="datepicker2" class="form-control" placeholder="Chọn ngày">
                        </div>
                        <div class="col-lg-2">
                            <label class="form-label">Lọc theo:</label>
                            <select class="dashboard-filter form-select" id="dashboard-filter">
                                <option value="">--Chọn--</option>
                                <option value="7ngay">7 ngày qua</option>
                                <option value="thangtruoc">Tháng trước</option>
                                <option value="thangnay">Tháng này</option>
                                <option value="365ngayqua">365 ngày qua</option>
                            </select>
                        </div>
                        <div class="col-lg-2 d-flex align-items-end">
                            <button type="button" id="btn-dashboard-filter" class="btn btn-primary">
                                <i class="bi bi-funnel me-1"></i>Lọc kết quả
                            </button>
                        </div>
                    </form>

                    <div id="myfirstchart" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Content -->
    <div class="row">
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-eye me-2"></i>Bài viết xem nhiều nhất</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">STT</th>
                                    <th class="border-0">Tiêu đề</th>
                                    <th class="border-0">Lượt xem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @foreach($posts as $post)
                                    @php $i++; @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <span class="text-white fw-bold">{{$i}}</span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0">
                                                    <a href="{{route('postDetail',['slug'=>$post->post_slug])}}" target="_blank" class="text-decoration-none">
                                                        {{$post->post_title}}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{number_format($post->post_view)}}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('backend.components.pagination', ['paginator' => $posts])
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i>Sản phẩm xem nhiều nhất</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">STT</th>
                                    <th class="border-0">Tên sản phẩm</th>
                                    <th class="border-0">Lượt xem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @foreach($products as $product)
                                    @php $i++; @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <span class="text-white fw-bold">{{$i}}</span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0">
                                                    <a href="{{route('detailProduct',['id'=>$product->product_id])}}" target="_blank" class="text-decoration-none">
                                                        {{$product->product_name}}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning text-dark">{{number_format($product->product_view)}}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('backend.components.pagination', ['paginator' => $products])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">

    <script>
        $(function() {
            // Datepicker initialization
            $("#datepicker, #datepicker2").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ['Thứ 2','Thứ 3','Thứ 4','Thứ 5', 'Thứ 6', 'Thứ 7','Chủ nhật'],
                duration: "slow",
                autoclose: true,
                todayHighlight: true
            });

            // Initialize chart
            const ctx = document.getElementById('myfirstchart').getContext('2d');
            let chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Đơn hàng',
                        data: [],
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        tension: 0.4
                    }, {
                        label: 'Doanh số',
                        data: [],
                        borderColor: '#f093fb',
                        backgroundColor: 'rgba(240, 147, 251, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Biểu đồ doanh thu'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Load initial data
            chart30daysorder();

            // Filter button click
            $('#btn-dashboard-filter').click(function() {
                const form_date = $('#datepicker').val();
                const to_date = $('#datepicker2').val();

                if (!form_date || !to_date) {
                    toastr.warning('Vui lòng chọn đầy đủ ngày bắt đầu và kết thúc!');
                    return;
                }

                $.ajax({
                    url: "{{ url('/admin/filter-by-date') }}",
                    method: "POST",
                    data: {
                        form_date: form_date,
                        to_date: to_date,
                        _token: $('input[name="_token"]').val()
                    },
                    dataType: "JSON",
                    success: function(data) {
                        updateChart(chart, data);
                        toastr.success('Dữ liệu đã được cập nhật!');
                    },
                    error: function() {
                        toastr.error('Có lỗi xảy ra khi tải dữ liệu!');
                    }
                });
            });

            // Dashboard filter change
            $('.dashboard-filter').change(function() {
                const dashboard_value = $(this).val();

                if (!dashboard_value) return;

                $.ajax({
                    url: "{{ url('/admin/dashboard-filter') }}",
                    method: "POST",
                    data: {
                        dashboard_value: dashboard_value,
                        _token: $('input[name="_token"]').val()
                    },
                    dataType: "JSON",
                    success: function(data) {
                        updateChart(chart, data);
                        toastr.success('Dữ liệu đã được cập nhật!');
                    },
                    error: function() {
                        toastr.error('Có lỗi xảy ra khi tải dữ liệu!');
                    }
                });
            });

            function chart30daysorder() {
                $.ajax({
                    url: "{{ url('/admin/days-order') }}",
                    method: "POST",
                    data: {
                        _token: $('input[name="_token"]').val()
                    },
                    dataType: "JSON",
                    success: function(data) {
                        updateChart(chart, data);
                    }
                });
            }

            function updateChart(chart, data) {
                const labels = data.map(item => item.period);
                const orderData = data.map(item => item.order);
                const salesData = data.map(item => item.sales);

                chart.data.labels = labels;
                chart.data.datasets[0].data = orderData;
                chart.data.datasets[1].data = salesData;
                chart.update();
            }
        });
    </script>
@endsection
