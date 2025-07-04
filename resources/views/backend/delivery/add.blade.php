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
                                <h5 class="m-b-10">Quản lý phí vận chuyển</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Phí vận chuyển</a></li>
                                <li class="breadcrumb-item"><a href="#!">Thêm phí vận chuyển</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Thêm mới phí vận chuyển</h5>
                        </div>
                        <div class="card-body">
                            @include('backend.components.notification')
                            <form id="myForm" action="" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="city">Chọn thành phố</label>
                                            <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                                <option value="">--Chọn tỉnh thành phố--</option>
                                                @foreach($city as $key => $ci)
                                                    <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="province">Chọn Quận Huyện</label>
                                            <select name="province" id="province"
                                                    class="form-control input-sm m-bot15 province choose">
                                                <option value="">--Chọn quận huyện--</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="wards">Chọn Xã Phường</label>
                                            <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                                <option value="">--Chọn xã phường--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="wards">Phí vận chuyển</label>
                                            <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1"
                                                   placeholder="Tên danh mục">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="button" name="add_delivery" class="btn btn-info add_delivery mt-2">Thêm phí
                                                vận
                                                chuyển
                                            </button>
                                            <a href="/admin/fee/all_fee" class="btn btn-default">Huỷ</a>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- [ form-element ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Danh sách phí vận chuyển</h5>
                        </div>
                        <div class="card-body">
                            <div id="load_delivery">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->

        </div>
    </section>
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
                // alert(city);
                // alert(province);
                // alert(wards);
                // alert(fee_ship);
                $.ajax({
                    url: '{{url('/insert-delivery')}}',
                    method: 'POST',
                    data: {city: city, province: province, _token: _token, wards: wards, fee_ship: fee_ship},
                    success: function (data) {
                        fetch_delivery();
                        clearForm();
                    }
                });


            });
            $('.choose').on('change', function () {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                //  alert(matp);
                //   alert(_token);

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
            // Làm sạch các ô input trong form
            $('#myForm')[0].reset();
        }

    </script>
@endsection
