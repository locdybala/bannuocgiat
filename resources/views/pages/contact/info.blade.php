@extends('layout')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('/frontend/images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ URL::to('/') }}">Trang chủ</a></span> <span>Liên hệ</span></p>
                <h1 class="mb-0 bread">Liên Hệ Với Chúng Tôi</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section contact-section bg-light">
    <div class="container">
        {{-- Hàng hiển thị thông tin liên hệ cơ bản --}}
        <div class="row d-flex mb-5 contact-info">
            <div class="w-100"></div>
            <div class="col-md-4 d-flex ftco-animate">
                <div class="info bg-white p-4">
                    <p><span><i class="ion-ios-pin"></i> Địa chỉ:</span> 175 P. Tây Sơn, Trung Liệt, Đống Đa, Hà Nội 116705</p>
                </div>
            </div>
            <div class="col-md-4 d-flex ftco-animate">
                <div class="info bg-white p-4">
                    <p><span><i class="ion-ios-call"></i> Số điện thoại:</span> <a href="tel://123456789">+84 123 456 789</a></p>
                </div>
            </div>
            <div class="col-md-4 d-flex ftco-animate">
                <div class="info bg-white p-4">
                    <p><span><i class="ion-ios-mail"></i> Email:</span> <a href="mailto:info@softwave.com">softwave@softwave.com</a></p>
                </div>
            </div>
        </div>

        {{-- Hàng hiển thị Form liên hệ và mô tả --}}
        <div class="row block-9">
            <div class="col-md-6 order-md-last d-flex">
                <form action="#" class="bg-white p-5 contact-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Họ và tên của bạn">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email của bạn">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tiêu đề">
                    </div>
                    <div class="form-group">
                        <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Lời nhắn"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Gửi Tin Nhắn" class="btn btn-primary py-3 px-5">
                    </div>
                </form>
            </div>

            <div class="col-md-6 d-flex">
                {{-- Giữ lại phần bản đồ của bạn --}}
                <div id="map" class="bg-white w-100"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6376138670244!2d105.82480520000001!3d21.007158699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac8109765ba5%3A0xd84740ece05680ee!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBUaOG7p3kgbOG7o2k!5e0!3m2!1svi!2s!4v1751728172170!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            </div>
        </div>

        {{-- Hiển thị thông tin thêm từ database --}}
        <div class="row mt-5">
            <div class="col-md-12 ftco-animate">
                <h3 class="billing-heading mb-4">Thông tin thêm</h3>
                <div class="info-extra bg-white p-4 rounded">

                    {!! $contactUpdate->info_contact !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

