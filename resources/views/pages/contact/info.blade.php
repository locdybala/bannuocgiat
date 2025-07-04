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
                            <h2>Liên hệ</h2>
                            <p>Trang chủ <span>-</span> Liên hệ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!-- ================ contact section start ================= -->
    <section class="contact-section padding_top">
        <div class="container">
            <div class="d-none d-sm-block mb-5 pb-4">
                <div id="map" style="height: 480px;">{!! $contact->info_map!!}</div>
            </div>


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Liên hệ</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm"
                          novalidate="novalidate">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">

                  <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Lời nhắn'"
                            placeholder='Lời nhắn'></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text" onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = 'Họ và tên'" placeholder='Họ và tên'>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email" onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = 'Địa chỉ email'" placeholder='Địa chỉ email'>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = 'Tiêu đề'" placeholder='Tiêu đề'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <a href="#" class="btn_3 button-contactForm">Gửi yêu cầu</a>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    {!! $contact->info_contact !!}
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection

