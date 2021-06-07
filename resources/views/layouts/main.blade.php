<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Norda - Minimal eCommerce HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- All CSS is here
	============================================ -->

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vendor/signericafat.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vendor/cerebrisans.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vendor/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vendor/elegant.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vendor/linear-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/easyzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/jquery-ui.css') }}">
    <link href="{{ asset('backend/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('toastr/toastr.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Use the minified version files listed below for better performance and remove the files listed above
    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css"> -->
    @stack('css')

</head>

<body>

    <div class="main-wrapper">
        @include('layouts.navbar')
        @yield('slider')

        @yield('content')

        @include('layouts.footer')



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-12 col-sm-12">
                                <div class="tab-content quickview-big-img">
                                    <div id="pro-1" class="tab-pane fade show active">
                                        <img src="{{ asset('frontend/assets/images/product/product-1.jpg')}}" alt="">
                                    </div>
                                    <div id="pro-2" class="tab-pane fade">
                                        <img src="{{ asset('frontend/assets/images/product/product-3.jpg')}}" alt="">
                                    </div>
                                    <div id="pro-3" class="tab-pane fade">
                                        <img src="{{ asset('frontend/assets/images/product/product-6.jpg')}}" alt="">
                                    </div>
                                    <div id="pro-4" class="tab-pane fade">
                                        <img src="{{ asset('frontend/assets/images/product/product-3.jpg')}}" alt="">
                                    </div>
                                </div>
                                <div class="quickview-wrap mt-15">
                                    <div class="quickview-slide-active nav-style-6">
                                        <a class="active" data-toggle="tab" href="#pro-1"><img src="{{ asset('frontend/assets/images/product/quickview-s1.jpg')}}" alt=""></a>
                                        <a data-toggle="tab" href="#pro-2"><img src="{{ asset('frontend/assets/images/product/quickview-s2.jpg')}}" alt=""></a>
                                        <a data-toggle="tab" href="#pro-3"><img src="{{ asset('frontend/assets/images/product/quickview-s3.jpg')}}" alt=""></a>
                                        <a data-toggle="tab" href="#pro-4"><img src="{{ asset('frontend/assets/images/product/quickview-s2.jpg')}}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-12 col-sm-12">
                                <div class="product-details-content quickview-content">
                                    <h2>Simple Black T-Shirt</h2>
                                    <div class="product-ratting-review-wrap">
                                        <div class="product-ratting-digit-wrap">
                                            <div class="product-ratting">
                                                <i class="icon_star"></i>
                                                <i class="icon_star"></i>
                                                <i class="icon_star"></i>
                                                <i class="icon_star"></i>
                                                <i class="icon_star"></i>
                                            </div>
                                            <div class="product-digit">
                                                <span>5.0</span>
                                            </div>
                                        </div>
                                        <div class="product-review-order">
                                            <span>62 Reviews</span>
                                            <span>242 orders</span>
                                        </div>
                                    </div>
                                    <p>Seamlessly predominate enterprise metrics without performance based process improvements.</p>
                                    <div class="pro-details-price">
                                        <span class="new-price">$75.72</span>
                                        <span class="old-price">$95.72</span>
                                    </div>
                                    <div class="pro-details-color-wrap">
                                        <span>Color:</span>
                                        <div class="pro-details-color-content">
                                            <ul>
                                                <li><a class="dolly" href="#">dolly</a></li>
                                                <li><a class="white" href="#">white</a></li>
                                                <li><a class="azalea" href="#">azalea</a></li>
                                                <li><a class="peach-orange" href="#">Orange</a></li>
                                                <li><a class="mona-lisa active" href="#">lisa</a></li>
                                                <li><a class="cupid" href="#">cupid</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="pro-details-size">
                                        <span>Size:</span>
                                        <div class="pro-details-size-content">
                                            <ul>
                                                <li><a href="#">XS</a></li>
                                                <li><a href="#">S</a></li>
                                                <li><a href="#">M</a></li>
                                                <li><a href="#">L</a></li>
                                                <li><a href="#">XL</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="pro-details-quality">
                                        <span>Quantity:</span>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                        </div>
                                    </div>
                                    <div class="product-details-meta">
                                        <ul>
                                            <li><span>Categories:</span> <a href="#">Woman,</a> <a href="#">Dress,</a> <a href="#">T-Shirt</a></li>
                                            <li><span>Tag: </span> <a href="#">Fashion,</a> <a href="#">Mentone</a> , <a href="#">Texas</a></li>
                                        </ul>
                                    </div>
                                    <div class="pro-details-action-wrap">
                                        <div class="pro-details-add-to-cart">
                                            <a title="Add to Cart" href="#">Add To Cart </a>
                                        </div>
                                        <div class="pro-details-action">
                                            <a title="Add to Wishlist" href="#"><i class="icon-heart"></i></a>
                                            <a title="Add to Compare" href="#"><i class="icon-refresh"></i></a>
                                            <a class="social" title="Social" href="#"><i class="icon-share"></i></a>
                                            <div class="product-dec-social">
                                                <a class="facebook" title="Facebook" href="#"><i class="icon-social-facebook"></i></a>
                                                <a class="twitter" title="Twitter" href="#"><i class="icon-social-twitter"></i></a>
                                                <a class="instagram" title="Instagram" href="#"><i class="icon-social-instagram"></i></a>
                                                <a class="pinterest" title="Pinterest" href="#"><i class="icon-social-pinterest"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->
    </div>

    <!-- All JS is here
============================================ -->

    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.instagramfeed.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery-ui-touch-punch.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/sticky-sidebar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/easyzoom.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/ajax-mail.js') }}"></script>

    <!-- Use the minified version files listed below for better performance and remove the files listed above  
<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>  -->
    <!-- Main JS -->
    <script src="{{ asset('frontend/assets/js/main.js')}}"></script>
    <script type="application/javascript" charset="UTF-8" src="{{ asset('backend/assets/lib/loadingoverlay.min.js') }}"></script>
    <script type="application/javascript" charset="UTF-8" src="{{ asset('backend/assets/lib/axios.min.js') }}"></script>
    <script type="application/javascript" charset="UTF-8" src="{{ asset('backend/assets/lib/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('js/frontend/newsletter.js')}}"></script>
    <script src="{{ asset('js/frontend/index.js')}}"></script>
    @stack('js')
    <script>
        @if (Session::has('message')) {
            var type = "{{Session::get('alert-type','info')}}";
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            switch(type){
                case 'info':
                Toast.fire({
                        icon: 'info',
                        title: "{{Session::get('message')}}"
                    })
                // toastr.info("{{Session::get('message')}}");
                break;

                case 'success':
                Toast.fire({
                        icon: 'success',
                        title: "{{Session::get('message')}}"
                    })
                // toastr.success("{{Session::get('message')}}");
                break;

                case 'warning':
                Toast.fire({
                        icon: 'warning',
                        title: "{{Session::get('message')}}"
                    })
                // toastr.warning("{{Session::get('message')}}");
                break;

                case 'error':
                Toast.fire({
                        icon: 'error',
                        title: "{{Session::get('message')}}"
                    })
                // toastr.error("{{Session::get('message')}}");
                break;
            }
        }
        @endif
    </script>
</body>

</html>