@extends('layout')
@section('title', 'Thanh toán')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span> <span
                            class="mr-2"><a href="{{ route('cart') }}">Giỏ hàng</a></span> <span>Thanh toán</span></p>
                    <h1 class="mb-0 bread">Thanh Toán</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <form action="#" class="billing-form">
                @csrf
                <div class="row justify-content-center">
                    {{-- Bọc toàn bộ trong một form để dễ quản lý --}}


                    <div class="col-xl-7 ftco-animate">
                        <h3 class="mb-4 billing-heading">Chi Tiết Thanh Toán & Giao Hàng</h3>

                        @if (session()->has('message'))
                            <div class="alert alert-success">{!! session()->get('message') !!}</div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">{!! session()->get('error') !!}</div>
                        @endif

                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="shipping_name">Tên người nhận</label>
                                    <input type="text" id="shipping_name" name="shipping_name" class="form-control"
                                        value="{{ $customer->customer_name }}" placeholder="Nhập họ và tên người nhận">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_phone">Số điện thoại</label>
                                    <input type="text" id="shipping_phone" name="shipping_phone" class="form-control"
                                        value="{{ $customer->customer_phone }}" placeholder="Số điện thoại người nhận">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_email">Địa chỉ Email</label>
                                    <input type="email" id="shipping_email" name="shipping_email" class="form-control"
                                        value="{{ $customer->customer_email }}" placeholder="Email người nhận">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            {{-- Dropdown chọn địa chỉ --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">Tỉnh / Thành phố</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="city" id="city" class="form-control choose city">
                                            <option value="">--Chọn tỉnh thành phố--</option>
                                            @foreach ($city as $key => $ci)
                                                <option value="{{ $ci->matp }}">{{ $ci->name_city }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="province">Quận / Huyện</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="province" id="province" class="form-control province choose">
                                            <option value="">--Chọn quận huyện--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="wards">Phường / Xã</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="wards" id="wards" class="form-control wards">
                                            <option value="">--Chọn xã phường--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="address" name="address"
                                       placeholder="Địa chỉ nhận hàng" readonly/>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="shipping_address">Địa chỉ cụ thể</label>
                                    <input type="text" id="shipping_address" name="shipping_address" class="form-control"
                                        value="{{ $customer->customer_address }}"
                                        placeholder="Số nhà, tên đường, tòa nhà...">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="shipping_notes">Ghi chú đơn hàng (tùy chọn)</label>
                                    <textarea name="shipping_notes" id="shipping_notes" cols="30" rows="5" class="form-control"
                                        placeholder="Ghi chú thêm cho người giao hàng..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="row mt-5 pt-3">
                            <div class="col-md-12 d-flex mb-5">
                                <div class="cart-detail cart-total p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Tóm Tắt Đơn Hàng</h3>
                                    @if (Session::get('cart') == true)
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach (Session::get('cart') as $key => $cart)
                                            @php
                                                $subtotal = $cart['product_price'] * $cart['product_qty'];
                                                $total += $subtotal;
                                            @endphp
                                            <p class="d-flex">
                                                <span
                                                    style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $cart['product_name'] }}
                                                    x {{ $cart['product_qty'] }}</span>
                                                <span>{{ number_format($subtotal, 0, ',', '.') }}đ</span>
                                            </p>
                                        @endforeach
                                        <hr>
                                        <p class="d-flex">
                                            <span>Tạm tính</span>
                                            <span>{{ number_format($total, 0, ',', '.') }}đ</span>
                                        </p>
                                        <p class="d-flex">
                                            <span>Phí vận chuyển</span>
                                            <span>{{ number_format(Session::get('fee', 0), 0, ',', '.') }}đ</span>
                                        </p>
                                        @if (Session::get('coupon'))
                                            @foreach (Session::get('coupon') as $key => $cou)
                                                <p class="d-flex">
                                                    <span>Giảm giá (Coupon)</span>
                                                    @if ($cou['coupon_condition'] == 1)
                                                        <span>{{ $cou['coupon_number'] }}%</span>
                                                    @else
                                                        <span>{{ number_format($cou['coupon_number'], 0, ',', '.') }}đ</span>
                                                    @endif
                                                </p>
                                            @endforeach
                                        @endif
                                        <hr>
                                        @php
                                            $fee = Session::get('fee', 0);
                                            $coupon_value = 0;
                                            if (Session::has('coupon') && count(Session::get('coupon')) > 0) {
                                                $cou = Session::get('coupon')[0];
                                                if ($cou['coupon_condition'] == 1) { // Percentage discount
                                                    $coupon_value = ($total * $cou['coupon_number']) / 100;
                                                } else { // Fixed amount discount
                                                    $coupon_value = $cou['coupon_number'];
                                                }
                                            }
                                            $total_after = $total + $fee - $coupon_value;
                                            // Ensure total_after doesn't go below zero
                                            if ($total_after < 0) {
                                                $total_after = 0;
                                            }
                                        @endphp
                                        <p class="d-flex total-price">
                                            <span>Tổng cộng</span>
                                            <span>{{ number_format($total_after, 0, ',', '.') }}đ</span>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="cart-detail p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Phương Thức Thanh Toán</h3>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="radio">
                                                <label><input type="radio" value="1" name="payment_select"
                                                        class="mr-2" checked> Trả tiền mặt khi nhận hàng</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="radio">
                                                <label><input type="radio" value="2" name="payment_select"
                                                        class="mr-2"> Thanh toán qua VNPAY</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="radio">
                                                <label><input type="radio" value="3" name="payment_select"
                                                        class="mr-2"> Chuyển khoản ngân hàng</label>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        <input type="button" class="btn btn-primary py-3 px-4 send_order"
                                            value="Đặt Hàng">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (Session::get('fee'))
                        <input type="hidden" name="order_fee" class="order_fee" value="{{ Session::get('fee') }}">
                    @else
                        <input type="hidden" name="order_fee" class="order_fee" value="25000">
                    @endif

                    @if (Session::get('coupon'))
                        @foreach (Session::get('coupon') as $key => $cou)
                            <input type="hidden" name="order_coupon" class="order_coupon"
                                value="{{ $cou['coupon_code'] }}">
                        @endforeach
                    @else
                        <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                    @endif
                    <input type="hidden" name="total_after" class="total_after" value="{{ $total_after }}">
                </div>
            </form>

        </div>
    </section>
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            function loadAddress() {
                debugger
                var cityName = $('#city option:selected').text();
                var provinceName = $('#province option:selected').text();
                var wardsName = $('#wards option:selected').text();

                if ($('#wards').val() != '') {
                    $('#address').val(cityName + ', ' + provinceName + ', ' + wardsName);
                }
            }
            loadAddress();
            $('.choose').on('change', function() {
                debugger;
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
                    url: '{{ url('/select-delivery') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        debugger
                        // Cập nhật dữ liệu
                        $('#' + result).html(data);
                        let selectElement = $('#' + result); // Chọn theo ID để chính xác

                        // Xóa Nice Select trước khi cập nhật
                        if (selectElement.next('.nice-select').length) {
                            selectElement.next('.nice-select').remove(); // Xóa Div nice-select
                        }

                        // Cập nhật lại dữ liệu vào select
                        selectElement.html(data);

                        // Khởi tạo lại Nice Select
                        selectElement.niceSelect();
                    }
                });
            });

            $('.calculate_delivery').click(function() {
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if (matp == '' && maqh == '' && xaid == '') {
                    alert('Làm ơn chọn để tính phí vận chuyển');
                } else {
                    $.ajax({
                        url: '{{ url('/calculate-fee') }}',
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            xaid: xaid,
                            _token: _token
                        },
                        success: function() {
                            location.reload();
                        }
                    });
                }
            });
            $('#wards').change(function() {
                var matp = $('#city').val();
                var maqh = $('#province').val();
                var xaid = $('#wards').val();
                var _token = $('input[name="_token"]').val();

                if (matp === '' || maqh === '' || xaid === '') {
                    return; // Không làm gì nếu chưa chọn đủ
                }

                loadAddress();

                $.ajax({
                    url: '{{ url('/calculate-fee') }}',
                    method: 'POST',
                    data: {
                        matp: matp,
                        maqh: maqh,
                        xaid: xaid,
                        _token: _token
                    },
                    success: function(response) {
                        // Cập nhật phí vận chuyển trong form nếu cần
                        toastr["success"]("Phí vận chuyển đã được cập nhật!")
                        // Cập nhật giá trị địa chỉ
                        location.reload();

                    },
                    error: function() {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.send_order').click(function() {
                var shipping_email = $('#shipping_email').val();
                var shipping_name = $('#shipping_name').val();
                var shipping_address = $('#shipping_address').val();
                var shipping_phone = $('#shipping_phone').val();
                var shipping_notes = $('#shipping_notes').val();
                var shipping_method = $('input[name="payment_select"]:checked').val();
                var order_fee = $('.order_fee').val();
                var order_coupon = $('.order_coupon').val();
                var _token = $('input[name="_token"]').val();
                var total_after = $('.total_after').val();
                var address = $('#address').val();

                // Kiểm tra thông tin
                if (shipping_email === '') {
                    toastr["error"]("Tài khoản email người nhận không được bỏ trống");
                    return false;
                } else if (shipping_name === '') {
                    toastr["error"]("Tên người đặt không được bỏ trống");
                    return false;
                } else if (shipping_address === '') {
                    toastr["error"]("Địa chỉ nhận hàng không được bỏ trống");
                    return false;
                } else if (shipping_phone === '') {
                    toastr["error"]("Số điện thoại người nhận không được bỏ trống");
                    return false;
                } else if (typeof shipping_method === 'undefined' || shipping_method === '') {
                    toastr["error"]("Phương thức thanh toán không được bỏ trống");
                    return false;
                }

                // Xác nhận đơn hàng
                Swal.fire({
                        title: "Xác nhận đơn hàng",
                        text: "Đơn hàng sẽ không được hoàn trả khi đặt, bạn có muốn đặt không?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Cảm ơn, Mua hàng",
                        cancelButtonText: "Đóng, chưa mua",
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{ url('/confirm-order') }}',
                                method: 'POST',
                                data: {
                                    shipping_email: shipping_email,
                                    total_after: total_after,
                                    shipping_name: shipping_name,
                                    shipping_address: shipping_address,
                                    shipping_phone: shipping_phone,
                                    shipping_notes: shipping_notes,
                                    _token: _token,
                                    address: address,
                                    order_fee: order_fee,
                                    order_coupon: order_coupon,
                                    shipping_method: shipping_method
                                },
                                success: function(data) {
                                    console.log(data);
                                    debugger
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Đơn hàng',
                                        text: 'Đơn hàng của bạn đã được gửi thành công'
                                    });

                                    if (data.order_code) {
                                        window.location.href =
                                            `{{ url('/success') }}/${data.order_code}`;
                                    } else {
                                        if (data) {
                                            window.location.replace(data);
                                        }
                                    }
                                },
                                error: function(xhr) {
                                    debugger
                                    console.log(xhr.responseText);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Lỗi',
                                        text: 'Có lỗi xảy ra, vui lòng thử lại!'
                                    });
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Đóng',
                                text: 'Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng'
                            });
                        }
                    });
            });
        });
        $("input[name='payment_select']:checked").each(function() {
            $('#text_note_' + $(this).val()).show();
        });

        // Xử lý sự kiện khi chọn ô radio
        $("input[name='payment_select']").change(function() {
            // Ẩn tất cả các ghi chú
            $("p[id^='text_note_']").hide();
            // Hiển thị ghi chú tương ứng với ô radio đã chọn
            $('#text_note_' + $(this).val()).show();
        });
    </script>
@endsection
