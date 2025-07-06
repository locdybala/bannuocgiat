<!--::footer_part start::-->
<footer class="ftco-footer ftco-section">
    <div class="container">
        <div class="row">
            <!-- Scroll to top button -->
            <div class="mouse">
                <a href="#" class="mouse-icon">
                    <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                </a>
            </div>
        </div>
        <div class="row mb-5">
            <!-- About Detergent Shop & Social Icons -->
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">SOFTWAVE SHOP</h2>
                    <p>SoftWave Shop chuyên cung cấp các sản phẩm bột giặt và nước xả vải chất lượng cao, an toàn cho sức khỏe và môi trường.</p>
                    <!-- Newsletter description -->
                    <p>Nhận thông tin khuyến mãi và sản phẩm mới nhất về bột giặt và nước xả vải của chúng tôi.</p>

                </div>
            </div>

            <!-- Thông tin (Information) -->
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Thông tin</h2>
                    <ul class="list-unstyled">
                        @foreach($pages as $pa)
                            @if($pa->slug == 'gioithieu')
                                <li><a href="{{ route('pages', ['slug' => $pa->slug]) }}" class="py-2 d-block">{{ $pa->name }}</a></li>
                            @endif
                        @endforeach
                        <li><a href="{{route('contact')}}" class="py-2 d-block">Liên hệ</a></li>
                    </ul>
                </div>
            </div>

            <!-- Hỗ trợ khách hàng (Customer Support) -->
            <div class="col-md-4">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Hỗ trợ khách hàng</h2>
                    <div class="d-flex">
                        <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
                            @foreach($pages as $page)
                                @if($page->slug != 'gioithieu')
                                    <li><a href="{{ route('pages', ['slug' => $page->slug]) }}" class="py-2 d-block">{{ $page->name }}</a></li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            <!-- Have a Questions? (Contact Info) -->
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Có câu hỏi?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">Địa chỉ cửa hàng: 175 P. Tây Sơn, Trung Liệt, Đống Đa, Hà Nội 116705</span></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text">Tư vấn mua hàng: 0388181970</span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span class="text">Email: info@detergentshop.com</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    <!-- Original copyright from old footer -->
                    &copy; <script>document.write(new Date().getFullYear());</script> Công ty bán bột giặt và nước xả vải | Thiết kế bởi <a href="#">Nguyễn Đình Kiên</a>
                    <!-- Template attribution from new footer -->
                </p>
            </div>
        </div>
    </div>
</footer>
<!--::footer_part end::-->
