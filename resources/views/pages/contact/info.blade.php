@extends('layout')
@section('title', 'Liên hệ')
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
        {!! $contactUpdate->info_contact !!}
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
                <div id="map" class="bg-white w-100">{!!$contactUpdate->info_map!!}</div>
            </div>
        </div>
    </div>
</section>
@endsection

