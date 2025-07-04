@extends('layout')
@section('content')
    <!--================Home Banner Area =================-->
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Thành toán</h2>
                            <p>Trang chủ <span>-</span> Thành toán đơn hàng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Checkout Area =================-->
    <section class="checkout_area padding_top">
        <div class="container">
            <div class="cupon_area">
                <div class="check_title">
                    <h2>
                        Bạn có mã giảm giá?
                        <a href="#">Nhập code để áp dụng mã giảm giá</a>
                    </h2>
                </div>
                @if(session()->has('message'))
                        <div class="alert alert-success">{!! session()->get('message') !!}</div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">{!! session()->get('error') !!}</div>
                    @endif
                <form method="POST" action="{{route('check_coupon')}}">
                    @csrf
                <input type="text" name="coupon" placeholder="Enter coupon code"/>
                <button class="tp_btn" type="submit">Áp dụng</button>
                </form>
            </div>
            <div class="billing_details">
                <div class="row">
                    <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                        @csrf
                        <div class="col-lg-8">
                            <h3>Chi tiết hoá đơn</h3>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" value="{{$customer->customer_name}}"
                                       id="shipping_name" name="shipping_name"/>
                                @if(!$customer->customer_name)
                                    <span class="placeholder" data-placeholder="Tên người nhận"></span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" value="{{$customer->customer_phone}}" class="form-control"
                                       id="shipping_phone" name="shipping_phone"/>
                                @if(!$customer->customer_phone)
                                    <span class="placeholder" data-placeholder="Số điện thoại"></span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" value="{{$customer->customer_email}}"
                                       id="shipping_email" name="shipping_email"/>
                                @if(!$customer->customer_email)
                                    <span class="placeholder" data-placeholder="Tài khoản email"></span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class=" col-lg-4 form-group p_star">
                                        <select name="city" id="city"
                                                class="form-select choose city country_select">
                                            <option value="">--Chọn tỉnh thành phố--</option>
                                            @foreach($city as $key => $ci)
                                                <option @if(Session::get('selected_city') == $ci->matp) selected
                                                        @endif value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class=" col-lg-4 form-group p_star">
                                        <select name="province" id="province"
                                                class="form-select province choose">
                                            <option value="">--Chọn quận huyện--</option>
                                            @if(Session::get('selected_city'))
                                                @foreach($provinces as $province)
                                                    <option
                                                        @if(Session::get('selected_province') == $province->maqh) selected
                                                        @endif value="{{$province->maqh}}">{{$province->name_quanhuyen}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class=" col-lg-4 form-group p_star">
                                        <select name="wards" id="wards"
                                                class="form-select wards">
                                            <option value="">--Chọn xã phường--</option>
                                            @if(Session::get('selected_province'))
                                                @foreach($wards as $ward)
                                                    <option @if(Session::get('selected_wards') == $ward->xaid) selected
                                                            @endif value="{{$ward->xaid}}">{{$ward->name_xaphuong}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="address" name="address"
                                       placeholder="Địa chỉ nhận hàng" readonly/>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                                       value="{{$customer->customer_address}}" placeholder="Chi tiết địa chỉ"/>
                                @if(!$customer->customer_address)
                                    <span class="placeholder" data-placeholder="Chi tiết địa chỉ"></span>
                                @endif

                            </div>
                            <div class="col-md-12 form-group">
                                <textarea name="shipping_notes" id="shipping_notes" class="form-control"
                                          spellcheck="false"
                                          cols="30" rows="11"
                                          placeholder="Ghi chú đơn"></textarea>
                            </div>
                            @if(Session::get('fee'))
                                <input type="hidden" name="order_fee" class="order_fee"
                                       value="{{Session::get('fee')}}">
                            @else
                                <input type="hidden" name="order_fee" class="order_fee" value="25000">
                            @endif

                            @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key => $cou)
                                    <input type="hidden" name="order_coupon" class="order_coupon"
                                           value="{{$cou['coupon_code']}}">
                                @endforeach
                            @else
                                <input type="hidden" name="order_coupon" class="order_coupon"
                                       value="no">
                            @endif
                        </div>
                        <div class="col-lg-4">
                            @if(Session::get('cart')==true)
                                @php
                                    $total = 0;
                                @endphp
                                <div class="order_box">
                                    <h2>Đơn hàng của bạn</h2>
                                    <ul class="list">
                                        <li>
                                            <a href="#">Sản phẩm
                                                <span>Tổng tiền</span>
                                            </a>
                                        </li>
                                        @foreach(Session::get('cart') as $key => $cart)
                                            @php
                                                $subtotal = $cart['product_price']*$cart['product_qty'];
                                                $total+=$subtotal;
                                            @endphp
                                            <li>
                                                <a href="#">
                                                    <img src="{{asset('/upload/product/'.$cart['product_image'])}}"
                                                         class="img-fluid rounded-circle"
                                                         style="width: 30px; height: 30px;" alt="">{{ \Illuminate\Support\Str::limit($cart['product_name'], 11, '...') }}
                                                    <span class="middle"> x {{$cart['product_quantity']}}</span>
                                                    <span class="last">{{number_format($subtotal,0,',','.')}}đ</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul class="list list_2">
                                        <li>
                                            <a href="#">Tổng tạm tính
                                                <span>{{number_format($total,0,',','.')}}đ</span>
                                            </a>
                                        </li>
                                        <li>
                                            @php
                                                // Lấy giá trị fee từ session hoặc gán mặc định là 30000 nếu không có
                                                $priceFee = \Illuminate\Support\Facades\Session::get('fee', 30000);
                                                $total_after_fee = $total + $priceFee;
                                            @endphp
                                            <a href="#">Phí ship
                                                <span>{{number_format($priceFee,0,',','.')}}đ</span>
                                            </a>
                                        </li>
                                        @php
                                            $coupons = Session::get('coupon', []); // Gán mặc định là mảng rỗng nếu không có coupon
                                            $total_after_coupon = $total; // Khởi tạo giá trị ban đầu
                                        @endphp
                                        @if(!empty($coupons))
                                            <!-- Kiểm tra nếu có coupon -->
                                            @foreach($coupons as $key => $cou)
                                                @if($cou['coupon_condition'] == 1)
                                                    @php
                                                        $total_coupon = ($total * $cou['coupon_number']) / 100;
                                                    @endphp
                                                @elseif($cou['coupon_condition'] == 2)
                                                    @php
                                                        $total_coupon = $cou['coupon_number'];
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                        @if(isset($total_coupon) && $total_coupon > 0)
                                        <li>

                                            <a href="#">Giảm giá:
                                                <span>{{number_format($total_coupon,0,',','.')}}đ</span>
                                            </a>
                                        </li>
                                        @endif
                                        @php
                                            if(!Session::get('coupon')){
                                                $total_after = $total_after_fee;
                                            } else {
                                                $total_after = $total_after_fee - $total_coupon;
                                            }
                                        @endphp
                                        <li>
                                            <a href="#">Tổng cộng
                                                <span>{{number_format($total_after,0,',','.')}}đ</span>
                                            </a>
                                            <input type="hidden" name="total_after" class="total_after"
                                                   value="{{$total_after}}">
                                        </li>
                                    </ul>
                                    <div class="payment_item">
                                        <div class="radion_btn">
                                            <input checked type="radio" id="f-option5" name="payment_select" value="1"/>
                                            <label for="f-option5">Trả tiền mặt khi nhận
                                                hàng</label>
                                            <div class="check"></div>
                                        </div>
                                        <p>
                                            Trả tiền
                                            mặt khi giao hàng.
                                        </p>
                                    </div>
                                    <div class="payment_item active">
                                        <div class="radion_btn">
                                            <input type="radio" id="f-option6" name="payment_select" value="2"/>
                                            <label for="f-option6">Thanh toán qua VNPAY </label>
                                            <img src="{{asset('frontend/img/product/single-product/card.jpg')}}" alt=""/>
                                            <div class="check"></div>
                                        </div>
                                        <p>
                                            Thực hiện
                                            thanh toán online qua app ngân hàng VNPAY
                                        </p>
                                    </div>
                                    <div class="payment_item">
                                        <div class="radion_btn">
                                            <input checked type="radio" id="f-option3" name="payment_select" value="3"/>
                                            <label for="f-option3">Chuyển khoản ngân hàng</label>
                                            <div class="check"></div>
                                        </div>
                                        <p>
                                            Thực hiện
                                            thanh toán vào ngay tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng Mã
                                            đơn hàng của bạn trong phần Nội dung thanh toán. Đơn hàng sẽ được giao sau
                                            khi tiền đã chuyển.
                                        </p>
                                    </div>
                                    <input type="button" name="send_order"
                                           class="btn_3 send_order"
                                           value="Đặt hàng">
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
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
            $('.choose').on('change', function () {
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
                    url: '{{url('/select-delivery')}}',
                    method: 'POST',
                    data: {action: action, ma_id: ma_id, _token: _token},
                    success: function (data) {
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

            $('.calculate_delivery').click(function () {
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if (matp == '' && maqh == '' && xaid == '') {
                    alert('Làm ơn chọn để tính phí vận chuyển');
                } else {
                    $.ajax({
                        url: '{{url('/calculate-fee')}}',
                        method: 'POST',
                        data: {matp: matp, maqh: maqh, xaid: xaid, _token: _token},
                        success: function () {
                            location.reload();
                        }
                    });
                }
            });
            $('#wards').change(function () {
                var matp = $('#city').val();
                var maqh = $('#province').val();
                var xaid = $('#wards').val();
                var _token = $('input[name="_token"]').val();

                if (matp === '' || maqh === '' || xaid === '') {
                    return; // Không làm gì nếu chưa chọn đủ
                }

                loadAddress();

                $.ajax({
                    url: '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data: {matp: matp, maqh: maqh, xaid: xaid, _token: _token},
                    success: function (response) {
                        // Cập nhật phí vận chuyển trong form nếu cần
                        toastr["success"]("Phí vận chuyển đã được cập nhật!")
                        // Cập nhật giá trị địa chỉ
                        location.reload();

                    },
                    error: function () {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('.send_order').click(function () {
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
                                url: '{{url('/confirm-order')}}',
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
                                success: function (data) {
                                    console.log(data);
                                    debugger
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Đơn hàng',
                                        text: 'Đơn hàng của bạn đã được gửi thành công'
                                    });

                                    if (data.order_code) {
                                        window.location.href = `{{ url('/success') }}/${data.order_code}`;
                                    } else {
                                        if (data) {
                                            window.location.replace(data);
                                        }
                                    }
                                },
                                error: function (xhr) {
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
        $("input[name='payment_select']:checked").each(function () {
            $('#text_note_' + $(this).val()).show();
        });

        // Xử lý sự kiện khi chọn ô radio
        $("input[name='payment_select']").change(function () {
            // Ẩn tất cả các ghi chú
            $("p[id^='text_note_']").hide();
            // Hiển thị ghi chú tương ứng với ô radio đã chọn
            $('#text_note_' + $(this).val()).show();
        });
    </script>

@endsection
