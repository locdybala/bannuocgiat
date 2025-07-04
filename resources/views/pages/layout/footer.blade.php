<!--::footer_part start::-->
<footer class="footer_part">
    <div class="container">
        <div class="row justify-content-around">
        <div class="fpt-contact">
                <h3>KẾT NỐI VỚI DETERGENT SHOP</h3>
                    <div class="social-icons">
                        <ul class="list-unstyled">
                            <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fab fa-tiktok"></i></a></li>
                        </ul>
                    </div>
                    <div class="hotline">
                    <h4>Số điện thoại cửa hàng</h4>
                        <p>Tư vấn mua hàng <br>
                    <b>0388181970</b> </p>
                 </div>
        </div>
            <div class="col-sm-6 col-lg-3">
                <div class="single_footer_part">
                    <h4>Thông tin</h4>
                    <ul class="list-unstyled">
                        @foreach($pages as $pa)
                            @if($pa->slug == 'gioithieu')
                                <li><a href="{{ route('pages', ['slug' => $pa->slug]) }}">{{ $pa->name }}</a></li>
                            @endif
                        @endforeach
                        <li><a href="{{route('contact')}}">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="single_footer_part">
                    <h4>Hỗ trợ khách hàng</h4>
                    <ul class="list-unstyled">
                        @foreach($pages as $page)
                            @if($page->slug != 'gioithieu')
                                <li><a href="{{ route('pages', ['slug' => $page->slug]) }}">{{ $page->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="single_footer_part">
                    <h4>Đăng ký nhận tin</h4>
                    <p>Nhận thông tin khuyến mãi và sản phẩm mới nhất về bột giặt và nước xả vải.</p>
                    <div id="mc_embed_signup">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="copyright_text">
                        <p>© <script>document.write(new Date().getFullYear());</script> Công ty bán bột giặt và nước xả vải | Thiết kế bởi <a href="#">Detergent Shop</a></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer_icon social_icon">
                        <ul class="list-unstyled">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--::footer_part end::-->
