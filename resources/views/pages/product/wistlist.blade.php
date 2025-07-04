@extends('layout')
@section('content')
    <div class="slider-area ">
        <div style="min-height: 300px" class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Sản phẩm yêu thích</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End-->
    <!-- Latest Products Start -->
    <section class="popular-items latest-padding">
        <div class="container">
            <!-- Nav Card -->
            <div class="tab-content" id="nav-tabContent">
                <!-- card one -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <input type="text" hidden id="customerId" value="{{$customerId}}">
                    <div class="row" id="row_wishlist">

                    </div>
                </div>
            </div>
            <!-- End Nav Card -->
        </div>
    </section>
    <!-- Latest Products End -->

@endsection

@section('javascript')
    <script type="text/javascript">
        function view() {
            if (localStorage.getItem('data') != null) {
                var customerId = $("#customerId").val();
                var data = JSON.parse(localStorage.getItem('data'));
                // Lọc dữ liệu theo customerId
                var filteredData = data.filter(function(item) {
                    return item.customerId == customerId;
                });
                filteredData.reverse();
                if (filteredData.length > 0) {


                    for (i = 0; i < filteredData.length; i++) {
                        var name = data[i].name;
                        var price = data[i].price;
                        var image = data[i].image;
                        var url = data[i].url;
                        var id = data[i].id;
                        $("#row_wishlist").append('<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6"> <form> <input type="hidden" ' +
                            'id="wishlish_product_id_' + id + '"value="' + id + '" ' +
                            'class="cart_product_id_' + id + '"> ' +
                            '<input type="hidden" id="wishlish_product_name_' + id + '"' +
                            'value="' + name + '" class="cart_product_name_' + id + '"> ' +
                            '<input type="hidden" id="wishlish_product_image_' + id + '" value="' + image + '" class="cart_product_image_' + id + '"> ' +
                            '<input type="hidden" id="wishlish_product_price_' + id + '" value="' + price + '" class="cart_product_price_' + id + '"> ' +
                            ' <input type="hidden" value="1" id="wishlish_product_qty_' + id + '" class="cart_product_qty_' + id + '"> ' +
                            '<div class="single-popular-items mb-50 text-center"> ' +
                            '<div class="popular-img"> ' +
                            '<img style="height: 380px;" src="/upload/product/' + image + '" alt=""> ' +
                            '<div class="img-cap "> <button type="button" name="add-to-cart" data-id_product="' + id + '" class="add-to-cart ">Thêm giỏ hàng </button> </div> ' +
                            '<input type="hidden" id="customerId" value="' + customerId + '"> <div class="favorit-items"> ' +
                            '<span id="' + id + '" onclick="add_wistlist(this.id);" class="flaticon-heart"></span> </div> </div> ' +
                            '<div class="popular-caption"> <h3> <a id="wishlish_product_url_' + id + '"' +
                            'href="' + url + '">' + name + '</a> </h3> ' +
                            '<span>' + (price) + ' đ</span> </div> </div> </form> </div>')
                    }
                } else {
                    $("#row_wishlist").append('<span>Không có sản phẩm nào được yêu thích</span>')
                }
            }
        }
        view();
    </script>
@endsection
