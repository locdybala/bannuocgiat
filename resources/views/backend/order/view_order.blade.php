@extends('backend.admin_layout')
@section('content')
    {{-- Breadcrumb theo style mới --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i> Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('all_order') }}">Quản lý đơn hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    {{-- Sử dụng mã đơn hàng từ biến $order --}}
                    @foreach ($order as $or)
                        <h5 class="mb-0">Chi tiết đơn hàng: #{{ $or->order_code }}</h5>
                    @endforeach
                </div>
                <div class="card-body">
                    @include('backend.components.notification')

                    {{-- Gộp thông tin khách hàng và người nhận --}}
                    <div class="row mb-4">
                        {{-- Thông tin người đặt hàng --}}
                        <div class="col-md-6">
                            <h6><i class="bi bi-person-fill me-2"></i>Thông tin người đặt hàng</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Họ tên:</strong> {{ $customer->customer_name }}</li>
                                <li class="list-group-item"><strong>Số điện thoại:</strong> {{ $customer->customer_phone }}</li>
                                <li class="list-group-item"><strong>Email:</strong> {{ $customer->customer_email }}</li>
                            </ul>
                        </div>

                        {{-- Thông tin người nhận hàng --}}
                        <div class="col-md-6">
                            <h6><i class="bi bi-truck me-2"></i>Thông tin giao hàng</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Họ tên:</strong> {{ $shipping->shipping_name }}</li>
                                <li class="list-group-item"><strong>Số điện thoại:</strong> {{ $shipping->shipping_phone }}</li>
                                <li class="list-group-item"><strong>Địa chỉ:</strong> {{ $shipping->shipping_address }}</li>
                                <li class="list-group-item"><strong>Ghi chú:</strong> {{ $shipping->shipping_notes }}</li>
                                <li class="list-group-item"><strong>Hình thức thanh toán:</strong>
                                    @if ($shipping->shipping_method == 1)
                                        Tiền mặt
                                    @elseif($shipping->shipping_method == 2)
                                        Thanh toán qua VNPAY
                                    @elseif($shipping->shipping_method == 3)
                                        Chuyển khoản ngân hàng
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Chi tiết sản phẩm trong đơn hàng --}}
                    <h6><i class="bi bi-box-seam me-2"></i>Chi tiết sản phẩm</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Kho còn</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($order_details as $key => $details)
                                    @php
                                        $i++;
                                        $subtotal = $details->product_price * $details->product_sales_quantity;
                                        $total += $subtotal;
                                    @endphp
                                    <tr class="color_qty_{{ $details->product_id }}">
                                        <td class="text-center">{{ $i }}</td>
                                        <td>{{ $details->product_name }}</td>
                                        <td class="text-center">{{ $details->product->product_quantity }}</td>
                                        <td style="width: 150px;">
                                            {{-- Giữ lại form cập nhật số lượng --}}
                                            <div class="input-group">
                                                <input type="number" min="1" style="width: 60px;"
                                                    {{ $order_status == 2 ? 'disabled' : '' }}
                                                    class="form-control form-control-sm order_qty_{{ $details->product_id }}"
                                                    value="{{ $details->product_sales_quantity }}"
                                                    name="product_sales_quantity">

                                                @if ($order_status != 2)
                                                    <button class="btn btn-sm btn-primary update_quantity_order"
                                                        data-product_id="{{ $details->product_id }}"
                                                        name="update_quantity_order" data-bs-toggle="tooltip" title="Cập nhật số lượng">
                                                        <i class="bi bi-check-lg"></i>
                                                    </button>
                                                @endif
                                            </div>

                                            <input type="hidden" name="order_qty_storage"
                                                class="order_qty_storage_{{ $details->product_id }}"
                                                value="{{ $details->product->product_quantity }}">
                                            <input type="hidden" name="order_code" class="order_code"
                                                value="{{ $details->order_code }}">
                                            <input type="hidden" name="order_product_id" class="order_product_id"
                                                value="{{ $details->product_id }}">
                                        </td>
                                        <td class="text-end">{{ number_format($details->product_price, 0, ',', '.') }} đ</td>
                                        <td class="text-end">{{ number_format($subtotal, 0, ',', '.') }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- Phần tổng kết --}}
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end"><strong>Tổng tiền hàng</strong></td>
                                    <td class="text-end"><strong>{{ number_format($total, 0, ',', '.') }} đ</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end">Phí vận chuyển</td>
                                    <td class="text-end">{{ number_format($details->product_feeship, 0, ',', '.') }} đ</td>
                                </tr>
                                @if ($coupon_condition == 1)
                                    @php
                                        $total_after_coupon = ($total * $coupon_number) / 100;
                                    @endphp
                                    <tr>
                                        <td colspan="5" class="text-end">Giảm giá ({{$coupon_number}}%)</td>
                                        <td class="text-end">- {{ number_format($total_after_coupon, 0, ',', '.') }} đ</td>
                                    </tr>
                                @else
                                    @php
                                        $total_after_coupon = $coupon_number;
                                    @endphp
                                     <tr>
                                        <td colspan="5" class="text-end">Giảm giá</td>
                                        <td class="text-end">- {{ number_format($total_after_coupon, 0, ',', '.') }} đ</td>
                                    </tr>
                                @endif
                                 @php
                                    $total_coupon = $total + $details->product_feeship - $total_after_coupon;
                                 @endphp
                                <tr class="table-active">
                                    <td colspan="5" class="text-end h5"><strong>Tổng thanh toán</strong></td>
                                    <td class="text-end h5"><strong>{{ number_format($total_coupon, 0, ',', '.') }} đ</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{-- Phần cập nhật trạng thái và hành động --}}
                    <div class="row mt-4 align-items-center">
                        <div class="col-md-6">
                            <form>
                                @csrf
                                @foreach ($order as $key => $or)
                                    <div class="d-flex align-items-center">
                                        <label for="order_details_select" class="form-label me-2 fw-bold mb-0">Trạng thái:</label>
                                        <select @if ($or->order_status == 2 || $or->order_status == 3) disabled @endif class="form-select order_details" id="order_details_select" style="width: auto;">
                                            <option value="">-- Chọn hình thức --</option>
                                            <option @if($or->order_status == 1) selected @endif id="{{ $or->order_id }}" value="1">Chưa xử lý</option>
                                            <option @if($or->order_status == 4) selected @endif id="{{ $or->order_id }}" value="4">Xác nhận đơn hàng</option>
                                            <option @if($or->order_status == 5) selected @endif id="{{ $or->order_id }}" value="5">Đang giao hàng</option>
                                            <option @if($or->order_status == 2) selected @endif id="{{ $or->order_id }}" value="2">Đã giao hàng</option>
                                            <option @if($or->order_status == 3) selected @endif id="{{ $or->order_id }}" value="3">Hủy đơn hàng</option>
                                        </select>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="col-md-6 text-end">
                             <a class="btn btn-warning" target="_blank"
                                href="{{ route('print_order', ['order_code' => $details->order_code]) }}">
                                <i class="bi bi-printer me-1"></i> In đơn hàng
                            </a>
                            <a href="{{ url('/admin/order/all_order') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- Giữ nguyên phần Javascript của form cũ để đảm bảo chức năng --}}
    <script type="text/javascript">
        // Kích hoạt tooltip của Bootstrap 5
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        $('.order_details').change(function() {
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();

            // Lấy ra số lượng
            var quantity = [];
            $("input[name='product_sales_quantity']").each(function() {
                quantity.push($(this).val());
            });

            // Lấy ra product id
            var order_product_id = [];
            $("input[name='order_product_id']").each(function() {
                order_product_id.push($(this).val());
            });

            var j = 0;
            for (var i = 0; i < order_product_id.length; i++) {
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

                if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                    j = j + 1;
                    if (j == 1) {
                        alert('Số lượng bán trong kho không đủ');
                    }
                    // Reset lại dropdown về trạng thái ban đầu
                    // Bạn cần một cách để lấy trạng thái cũ, ở đây tạm thời quay về "Chưa xử lý"
                    $(this).val(1);
                    $('.color_qty_' + order_product_id[i]).css('background-color', '#ffcccc');
                }
            }

            if (j == 0) {
                $.ajax({
                    url: '{{ url('/admin/order/update-order-qty') }}',
                    method: 'POST',
                    data: {
                        _token: _token,
                        order_status: order_status,
                        order_id: order_id,
                        quantity: quantity,
                        order_product_id: order_product_id
                    },
                    success: function(data) {
                        alert('Thay đổi tình trạng đơn hàng thành công');
                        location.reload();
                    }
                });
            }
        });

        $('.update_quantity_order').click(function(e) {
            e.preventDefault(); // Ngăn hành vi mặc định của button
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_' + order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();

            var order_qty_storage = $('.order_qty_storage_' + order_product_id).val();

            if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                 alert('Số lượng bán trong kho không đủ');
                 return; // Dừng thực thi
            }

            $.ajax({
                url: '{{ url('/admin/order/update-qty') }}',
                method: 'POST',
                data: {
                    _token: _token,
                    order_product_id: order_product_id,
                    order_qty: order_qty,
                    order_code: order_code
                },
                success: function(data) {
                    alert('Cập nhật số lượng thành công');
                    location.reload();
                }
            });
        });
    </script>
@endsection
