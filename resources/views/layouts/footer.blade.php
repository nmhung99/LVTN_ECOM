@php
    $setting = DB::table('sitesetting')->first();
@endphp
<div class="subscribe-area bg-gray-4 pt-95 pb-95">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="section-title-3">
                            <h2>Đăng Ký Nhận Tin</h2>
                            <p>Nhận những thông tin về sản phẩm, khuyến mãi hàng tuần</p>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div id="mc_embed_signup" class="subscribe-form-2">
                            <form id="form_subscribe" class="validate subscribe-form-style-2" novalidate="" name="form_subscribe" method="post">
                                @csrf
                                <div id="mc_embed_signup_scroll" class="mc-form-2">
                                    <input onkeypress="removeMessage($(this))" class="email" type="email" required="" placeholder="Điền địa chỉ email của bạn" name="email" value="">
                                    <div class="mc-news-2" aria-hidden="true">
                                        <input type="text" value="" tabindex="-1" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef">
                                    </div>
                                    <div class="clear-2 clear-2-red">
                                        <input id="mc-embedded-subscribe" class="button" type="button" onclick="addNewsletter()" name="subscribe" value="Đăng Ký">
                                    </div>
                                </div>
                                <span class="text-danger" id="email_error"></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<footer class="footer-area bg-gray-4">
            <div class="footer-top border-bottom-4 pb-55">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-title">{{$setting->company_name}}</h3>
                                <div class="footer-info-list info-list-50-parcent">
                                    <ul>
                                        <li><a href="shop.html">New In</a></li>
                                        <li><a href="shop.html">T-Shirts</a></li>
                                        <li><a href="shop.html">Best Seller</a></li>
                                        <li><a href="shop.html">Shirts</a></li>
                                        <li><a href="shop.html">Clothing</a></li>
                                        <li><a href="shop.html">Bags</a></li>
                                        <li><a href="shop.html">Men</a></li>
                                        <li><a href="shop.html">Dresses</a></li>
                                        <li><a href="shop.html">Women</a></li>
                                        <li><a href="shop.html">Jeans</a></li>
                                        <li><a href="shop.html">Baby Girl</a></li>
                                        <li><a href="shop.html">Shorts</a></li>
                                        <li><a href="shop.html">Baby Boys</a></li>
                                        <li><a href="shop.html">Blouses & Shirts</a></li>
                                        <li><a href="shop.html">Accessories</a></li>
                                        <li><a href="shop.html">Blazers</a></li>
                                        <li><a href="shop.html">Shoes</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="footer-widget ml-70 mb-40">
                                <h3 class="footer-title">useful links</h3>
                                <div class="footer-info-list">
                                    <ul>
                                        <li><a href="my-account.html">My Account</a></li>
                                        <li><a href="wishlist.html">My Wishlish</a></li>
                                        <li><a href="#">Term & Conditions</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Track Order</a></li>
                                        <li><a href="shop.html">Shop</a></li>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li><a href="#">Returns/Exchange</a></li>
                                        <li><a href="#">FAQs</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="footer-widget mb-40 ">
                                <h3 class="footer-title">Liên Hệ Với Chúng Tôi</h3>
                                <div class="contact-info-2">
                                    <div class="single-contact-info-2">
                                        <div class="contact-info-2-icon">
                                            <i class="icon-call-end"></i>
                                        </div>
                                        <div class="contact-info-2-content">
                                            <p>Gặp vấn đề? Liên Hệ Ngay, Hỗ Trợ 24/7</p>
                                            <h3 class="red">{{$setting->phone_one}}</h3>
                                            <!-- <h3 class="blue">(365) 8635 56-24-02 </h3> -->
                                        </div>
                                    </div>
                                    <div class="single-contact-info-2">
                                        <div class="contact-info-2-icon">
                                            <i class="icon-cursor icons"></i>
                                        </div>
                                        <div class="contact-info-2-content">
                                            <p>{{$setting->company_address}}</p>
                                        </div>
                                    </div>
                                    <div class="single-contact-info-2">
                                        <div class="contact-info-2-icon">
                                            <i class="icon-envelope-open "></i>
                                        </div>
                                        <div class="contact-info-2-content">
                                            <p>{{$setting->email}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="social-style-1 social-style-1-font-inc social-style-1-mrg-2">
                                    <a href="http://www.facebook.com/my_page"><i class="icon-social-twitter"></i></a>
                                    <a href="{{$setting->facebook}}"><i class="icon-social-facebook"></i></a>
                                    <a href="{{$setting->instagram}}"><i class="icon-social-instagram"></i></a>
                                    <a href="{{$setting->youtube}}"><i class="icon-social-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom pt-30 pb-30 ">
                <div class="container">
                    <div class="row flex-row-reverse">
                        <div class="col-lg-6 col-md-6">
                            <div class="payment-img payment-img-right">
                                <a href="#"><img src="{{ asset('frontend/assets/images/icon-img/payment.png')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="copyright copyright-center">
                                <p>All rights reserved © 2021 {{$setting->company_name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>