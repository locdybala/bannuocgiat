@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Phí vận chuyển</li>
            <li class="breadcrumb-item active" aria-current="page">Thêm phí vận chuyển</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Thêm mới phí vận chuyển</h5>
                </div>
                <div class="card-body">
                    @include('backend.components.notification')
                    <form id="myForm" action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="city" class="form-label">Chọn thành phố <span class="text-danger">*</span></label>
                            <select name="city" id="city" class="form-select choose city" required>
                                <option value="">--Chọn tỉnh thành phố--</option>
                                @foreach($city as $ci)
                                    <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="province" class="form-label">Chọn Quận Huyện <span class="text-danger">*</span></label>
                            <select name="province" id="province" class="form-select province choose" required>
                                <option value="">--Chọn quận huyện--</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="wards" class="form-label">Chọn Xã Phường <span class="text-danger">*</span></label>
                            <select name="wards" id="wards" class="form-select wards" required>
                                <option value="">--Chọn xã phường--</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fee_ship" class="form-label">Phí vận chuyển <span class="text-danger">*</span></label>
                            <input type="number" name="fee_ship" class="form-control fee_ship" id="fee_ship" placeholder="Nhập phí vận chuyển" required/>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" name="add_delivery" class="btn btn-info add_delivery">
                                <i class="bi bi-plus-circle me-1"></i>Thêm phí vận chuyển
                            </button>
                            <a href="/admin/fee/all_fee" class="btn btn-outline-secondary">Huỷ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Danh sách phí vận chuyển</h5>
                </div>
                <div class="card-body">
                    <div id="load_delivery"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            fetch_delivery();

            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/select-feeship')}}',
                    method: 'POST',
                    data: {_token: _token},
                    success: function (data) {
                        $('#load_delivery').html(data);
                    }
                });
            }

            $(document).on('blur', '.fee_feeship_edit', function () {
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{url('/update-delivery')}}',
                    method: 'POST',
                    data: {feeship_id: feeship_id, fee_value: fee_value, _token: _token},
                    success: function (data) {
                        fetch_delivery();
                    }
                });
            });

            $('.add_delivery').click(function () {
                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();

                if (!city || !province || !wards || !fee_ship) {
                    toastr["error"]("Vui lòng điền đầy đủ thông tin");
                    return false;
                }

                $.ajax({
                    url: '{{url('/insert-delivery')}}',
                    method: 'POST',
                    data: {city: city, province: province, _token: _token, wards: wards, fee_ship: fee_ship},
                    success: function (data) {
                        fetch_delivery();
                        clearForm();
                        toastr["success"]("Thêm phí vận chuyển thành công");
                    }
                });
            });

            $('.choose').on('change', function () {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{url('/select-delivery')}}',
                    method: 'POST',
                    data: {action: action, ma_id: ma_id, _token: _token},
                    success: function (data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })

        function clearForm() {
            $('#myForm')[0].reset();
        }
    </script>
@endsection
