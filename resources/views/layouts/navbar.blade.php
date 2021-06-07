@php
    $category = DB::table('categories')->get();
@endphp
<style type="text/css">
    .list-group li{
        display: flex;
    }
    .list-group li .div1{
        position: relative;
    }
    .list-group li .div1 img{
        position: absolute; top: 0; bottom: 0; margin: auto;
    }
    .list-group .pricesell{
       font-size: 18px;
       color: red;
    }
    .list-group .discountprice{
        font-size: 14px;
       color: gray;
       text-decoration: line-through;
    }
</style>
<header class="header-area">
            <div class="header-large-device">
               
                <div class="header-middle mt-30">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="/"><img width="70%" src="{{ asset('frontend/assets/images/logo/lgr2.png')}}" alt="logo"></a>
                                </div>
                            </div>
                            @if(Auth::check())
                            <div class="col-lg-5">
                                <div class="categori-search-wrap categori-search-wrap-modify">
                                    <!-- <div class="categori-style-1">
                                        <select class="nice-select nice-select-style-1">
                                            <option>Tất cả danh mục</option>
                                            @foreach($category as $item)
                                                <option>{{$item->category_name}} </option>
                                            @endforeach
                                        </select>
                                    </div> -->
                                    <div class="search-wrap-3">
                                        <form action="{{ route('product.search')}}" method="GET" id="search_form">
                                            @csrf
                                            <input placeholder="Bạn muốn tìm kiếm gì" id="search1" name="searchproduct" type="text">
                                            <button><i class="lnr lnr-magnifier"></i></button>
                                        </form>
                                    </div>
                                </div>
                                 <ul class="list-group" id="resultlive" style="position: absolute; background-color: #fff; width: 94%; z-index: 1">
                                        <!-- <li>ấdasdasd</li> -->
                                        <!-- <li class="col-lg-12" style="display: flex;">
                                            <div class="col-lg-4 div1" style="position: relative;">
                                                <a href=""><img width="100%" style="position: absolute; top: 0; bottom: 0; margin: auto;" src="{{ asset('frontend/assets/images/logo/logo.png')}}" alt=""></a>
                                            </div>
                                            <div class="col-lg-8 ml-4" >
                                                <h5><a href="">Iphone 12</a></h5>
                                                <h5><span>7.000.000 VND</span> <span>6.000.000 VND</span></h5>
                                            </div>
                                            
                                        </li> -->
                                    </ul>
                            </div>
                            @else
                            <div class="col-lg-6">
                                <div class="categori-search-wrap categori-search-wrap-modify">
                                    <!-- <div class="categori-style-1">
                                        <select class="nice-select nice-select-style-1">
                                            <option>Tất cả danh mục</option>
                                            @foreach($category as $item)
                                                <option>{{$item->category_name}} </option>
                                            @endforeach
                                        </select>
                                    </div> -->
                                    <div class="search-wrap-3">
                                        <form action="{{ route('product.search')}}" method="GET" id="search_form">
                                            @csrf
                                            <input placeholder="Bạn muốn tìm kiếm gì" id="search1" name="searchproduct" type="text">
                                            <button><i class="lnr lnr-magnifier"></i></button>
                                        </form>
                                    </div>
                                </div>
                                    <ul class="list-group" id="resultlive" style="position: absolute; background-color: #fff; width: 94%; z-index: 1">
                                        <!-- <li>ấdasdasd</li> -->
                                        <!-- <li class="col-lg-12" style="display: flex;">
                                            <div class="col-lg-4 div1" style="position: relative;">
                                                <a href=""><img width="100%" style="position: absolute; top: 0; bottom: 0; margin: auto;" src="{{ asset('frontend/assets/images/logo/logo.png')}}" alt=""></a>
                                            </div>
                                            <div class="col-lg-8 ml-4" >
                                                <h5><a href="">Iphone 12</a></h5>
                                                <h5><span>7.000.000 VND</span> <span>6.000.000 VND</span></h5>
                                            </div>
                                            
                                        </li> -->
                                    </ul>
                            </div>
                            @endif
                            @if(Auth::check())
                            <div class="col-xl-4 col-lg-3">
                                <div class="header-action header-action-flex">
                                        <div class="same-style-2 same-style-2-font-inc">
                                            <!-- <div class="dropdown">
                                                <a href="{{route('home')}}" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-user"></i> Profile
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Danh sách Yêu Thích</a>
                                                    <a class="dropdown-item" href="#">Thanh Toánn</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </div> -->
                                            <!-- <ul class="standard_dropdown top_bar_dropdown">
                                                <li>
                                                    <a href="{{route('home')}}"><i class="icon-user"></i>Profile <i class="fas fa-chevron-down"></i></a>
                                                    <ul>
                                                        <li><a href="#">Danh sách yêu thích</a></li>
                                                        <li><a href="#">Thanh toán</a></li>
                                                        <li><a href="#">Khác</a></li>{{Auth::user()->name}}
                                                    </ul>
                                                </li>
                                            </ul> -->
                                            <a href="{{ route('login') }}">
                                                <i class="icon-user"></i>
                                                <i class="pro-badge"></i><span style="font-size: 16px;">Hồ Sơ</span>
                                            </a>
                                        </div>
                                        <div class="same-style-2 same-style-2-font-inc">
                                            @php
                                                $wishlist = DB::table('wishlists')->where('user_id',Auth::id())->get();
                                            @endphp
                                            <a href="{{ route('user.wishlist') }}"><i class="icon-heart"></i><span class="pro-count red">{{count($wishlist)}}</span></a>
                                        </div>
                                        <div class="same-style-2 same-style-2-font-inc header-cart">
                                            <a class="cart-active" href="{{ route('show.cart')}}">
                                                <i class="icon-basket-loaded"></i><span class="pro-count red">{{Cart::count()}}</span>
                                                <!-- <span class="cart-amount">{{Cart::subtotal()}} ₫</span> -->
                                            </a>
                                        </div>
                                        <!-- <i class="pro-badge" style="font-size: 14px;">{{Auth::user()->name}}</i> -->
                                    
                                    
                                </div>
                            </div>
                            @else
                            <div class="col-xl-3 col-lg-3">
                                <div class="header-action header-action-flex">
                                        <div class="same-style-2 same-style-2-font-inc">
                                            <a href="{{ route('login') }}">
                                                <i class="icon-user"></i> <span style="font-size: 18px;">Đăng Nhập</span>
                                            </a>
                                        </div>
                                        <div class="same-style-2 same-style-2-font-inc header-cart">
                                            <a class="cart-active" href="{{ route('show.cart')}}">
                                                <i class="icon-basket-loaded"></i><span class="pro-count red">{{Cart::count()}}</span>
                                                <!-- <span class="cart-amount">{{Cart::subtotal()}} ₫</span> -->
                                            </a>
                                        </div>
                                </div>

                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="header-bottom header-bottom-ptb mt-20">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-3">
                                <div class="main-categori-wrap main-categori-wrap-modify">
                                    <a class="categori-show" href="#"><i class="lnr lnr-menu"></i> Tất cả danh mục <i class="icon-arrow-down icon-right"></i></a>
                                    <div class="category-menu categori-hide categori-not-visible">
                                        <nav>
                                            <ul>
                                                @foreach($category as $item)
                                                <li class="cr-dropdown"><a href="{{asset('/products/cat/'.$item->id)}}">{{$item->category_name }}<span class="icon-arrow-right"></span></a>
                                                    <div class="category-menu-dropdown ct-menu-res-height-1">
                                                        @php
                                                            $subcat = DB::table('subcategories')->where('category_id',$item->id)->get();
                                                            $brand = DB::table('brands')->where('category_id',$item->id)->get();
                                                        @endphp
                                                        @foreach($brand as $row2)
                                                        <div class="single-category-menu ct-menu-mrg-bottom category-menu-border">
                                                            <h4><a href="{{asset('/products/brands/'.$row2->id)}}">{{ $row2->brand_name }}</a></h4>
                                                        </div>
                                                        @endforeach
                                                        @foreach($subcat as $row)
                                                        <div class="single-category-menu ct-menu-mrg-bottom category-menu-border">
                                                            <h4><a href="{{asset('/products/subs/'.$row->id)}}">{{ $row->subcategory_name }}</a></h4>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                                @endforeach
                                                <!-- <li class="cr-dropdown"><a href="#">Women <span class="icon-arrow-right"></span></a>
                                                    <div class="category-menu-dropdown ct-menu-res-height-2">
                                                        <div class="single-category-menu">
                                                            <h4>Men Clothing</h4>
                                                            <ul>
                                                                <li><a href="shop.html">Sleeveless shirt</a></li>
                                                                <li><a href="shop.html">Cotton T-shirt</a></li>
                                                                <li><a href="shop.html">Trench coat</a></li>
                                                                <li><a href="shop.html">Cargo pants</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="single-category-menu ct-menu-mrg-left">
                                                            <h4>Women Clothing</h4>
                                                            <ul>
                                                                <li><a href="shop.html">Wedding dress</a></li>
                                                                <li><a href="shop.html">Gym clothes</a></li>
                                                                <li><a href="shop.html">Cotton T-shirt </a></li>
                                                                <li><a href="shop.html">Long coat</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="cr-dropdown"><a href="#">Men <span class="icon-arrow-right"></span></a>
                                                    <div class="category-menu-dropdown ct-menu-res-height-1">
                                                        <div class="single-category-menu ct-menu-mrg-bottom category-menu-border">
                                                            <h4>Men Clothing</h4>
                                                            <ul>
                                                                <li><a href="shop.html">Sleeveless shirt</a></li>
                                                                <li><a href="shop.html">Cotton T-shirt</a></li>
                                                                <li><a href="shop.html">Trench coat</a></li>
                                                                <li><a href="shop.html">Cargo pants</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="single-category-menu ct-menu-mrg-bottom ct-menu-mrg-left">
                                                            <h4>Women Clothing</h4>
                                                            <ul>
                                                                <li><a href="shop.html">Wedding dress</a></li>
                                                                <li><a href="shop.html">Gym clothes</a></li>
                                                                <li><a href="shop.html">Cotton T-shirt </a></li>
                                                                <li><a href="shop.html">Long coat</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="single-category-menu">
                                                            <h4>Kids Clothing</h4>
                                                            <ul>
                                                                <li><a href="shop.html">Winter Wear </a></li>
                                                                <li><a href="shop.html">Occasion Gowns</a></li>
                                                                <li><a href="shop.html">Birthday Tailcoat</a></li>
                                                                <li><a href="shop.html">Stylish Unicorn</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="single-category-menu">
                                                            <a href="#"><img src="assets/images/menu/menu-categori-1.png" alt=""></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="cr-dropdown"><a href="#">Baby Girl <span class="icon-arrow-right"></span></a>
                                                    <div class="category-menu-dropdown ct-menu-res-height-2">
                                                        <div class="single-category-menu">
                                                            <h4>Men Clothing</h4>
                                                            <ul>
                                                                <li><a href="shop.html">Sleeveless shirt</a></li>
                                                                <li><a href="shop.html">Cotton T-shirt</a></li>
                                                                <li><a href="shop.html">Trench coat</a></li>
                                                                <li><a href="shop.html">Cargo pants</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="single-category-menu ct-menu-mrg-left">
                                                            <h4>Women Clothing</h4>
                                                            <ul>
                                                                <li><a href="shop.html">Wedding dress</a></li>
                                                                <li><a href="shop.html">Gym clothes</a></li>
                                                                <li><a href="shop.html">Cotton T-shirt </a></li>
                                                                <li><a href="shop.html">Long coat</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="cr-dropdown"><a href="shop.html">Baby Boy </a></li>
                                                <li class="cr-dropdown"><a href="shop.html">Accessories </a></li>
                                                <li class="cr-dropdown"><a href="shop.html">Shoes</a></li>
                                                <li class="cr-dropdown"><a href="shop.html">Shirt</a></li>
                                                <li class="cr-dropdown"><a href="shop.html">T-Shirt</a></li>
                                                <li class="cr-dropdown"><a href="shop.html">Coat</a></li>
                                                <li class="cr-dropdown"><a href="shop.html">Jeans</a></li>
                                                <li class="cr-dropdown"><a href="shop.html">Collection </a></li> -->
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6">
                                <div class="main-menu main-menu-padding-1 main-menu-lh-2 pl-80">
                                    <nav>
                                        <ul>
                                            <li><a href="index.html">HOME <span class="bg-red">HOT</span></a>
                                                <ul class="sub-menu-style">
                                                    <li><a href="index.html">Home version 1 </a></li>
                                                    <li><a href="index-2.html">Home version 2</a></li>
                                                    <li><a href="index-3.html">Home version 3</a></li>
                                                    <li><a href="index-4.html">Home version 4</a></li>
                                                    <li><a href="index-5.html">Home version 5</a></li>
                                                    <li><a href="index-6.html">Home version 6</a></li>
                                                    <li><a href="index-7.html">Home version 7</a></li>
                                                    <li><a href="index-8.html">Home version 8</a></li>
                                                    <li><a href="index-9.html">Home version 9</a></li>
                                                    <li><a href="index-10.html">Home version 10</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="shop.html">SHOP </a>
                                                <ul class="mega-menu-style mega-menu-mrg-1">
                                                    <li>
                                                        <ul>
                                                            <li>
                                                                <a class="dropdown-title" href="#">Shop Layout</a>
                                                                <ul>
                                                                    <li><a href="shop.html">standard style</a></li>
                                                                    <li><a href="shop-list.html">shop list style</a></li>
                                                                    <li><a href="shop-fullwide.html">shop fullwide</a></li>
                                                                    <li><a href="shop-no-sidebar.html">grid no sidebar</a></li>
                                                                    <li><a href="shop-list-no-sidebar.html">list no sidebar</a></li>
                                                                    <li><a href="shop-right-sidebar.html">shop right sidebar</a></li>
                                                                    <li><a href="store-location.html">store location</a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-title" href="#">Products Layout</a>
                                                                <ul>
                                                                    <li><a href="product-details.html">tab style 1</a></li>
                                                                    <li><a href="product-details-2.html">tab style 2</a></li>
                                                                    <li><a href="product-details-sticky.html">sticky style</a></li>
                                                                    <li><a href="product-details-gallery.html">gallery style </a></li>
                                                                    <li><a href="product-details-affiliate.html">affiliate style</a></li>
                                                                    <li><a href="product-details-group.html">group style</a></li>
                                                                    <li><a href="product-details-fixed-img.html">fixed image style </a></li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="shop.html"><img src="assets/images/banner/banner-12.png" alt=""></a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="#">PAGES </a>
                                                <ul class="sub-menu-style">
                                                    <li><a href="about-us.html">about us </a></li>
                                                    <li><a href="cart.html">cart page</a></li>
                                                    <li><a href="checkout.html">checkout </a></li>
                                                    <li><a href="my-account.html">my account</a></li>
                                                    <li><a href="wishlist.html">wishlist </a></li>
                                                    <li><a href="compare.html">compare </a></li>
                                                    <li><a href="contact.html">contact us </a></li>
                                                    <li><a href="order-tracking.html">order tracking</a></li>
                                                    <li><a href="login-register.html">login / register </a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('blog.post')}}">BLOG <span class="bg-green">NEW</span></a>
                                                <ul class="sub-menu-style">
                                                    <li><a href="blog.html">blog standard </a></li>
                                                    <li><a href="blog-no-sidebar.html">blog no sidebar </a></li>
                                                    <li><a href="blog-right-sidebar.html">blog right sidebar</a></li>
                                                    <li><a href="blog-details.html">blog details</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('contact.page')}}">LIÊN HỆ</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="hotline">
                                    @if(Auth::check())
                                    <a type="button" class="btn" data-toggle="modal" data-target="#modaltracking"><p style="font-size: 16px;">Theo Dõi Đơn Hàng </p></a>
                                    @else
                                    <p><i class="icon-call-end"></i> <span>Hotline</span> (364) 106 7572 </p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="header-small-device small-device-ptb-1">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <div class="mobile-logo">
                                <a href="/">
                                    <img alt="" src="{{ asset('frontend/assets/images/logo/logo.png')}}">
                                </a>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="header-action header-action-flex">
                                @if(Auth::check())
                                <div class="same-style-2 same-style-2-font-inc">
                                    <a href="{{ route('login') }}"><i class="icon-user"></i></a>
                                </div>
                                <div class="same-style-2 same-style-2-font-inc">
                                    <a href="{{ route('user.wishlist') }}"><i class="icon-heart"></i><span class="pro-count purple">{{count($wishlist)}}</span></a>
                                </div>
                                <div class="same-style-2 same-style-2-font-inc header-cart">
                                    <a class="cart-active" href="{{ route('show.cart')}}">
                                        <i class="icon-basket-loaded"></i><span class="pro-count purple">{{Cart::count()}}</span>
                                    </a>
                                </div>
                                @else
                                <div class="same-style-2 same-style-2-font-inc">
                                    <a href="{{ route('login') }}"><i class="icon-user"></i></a>
                                </div>
                                @endif
                                <div class="same-style-2 main-menu-icon">
                                    <a class="mobile-header-button-active" href="#"><i class="icon-menu"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- mini cart start -->
        <div class="sidebar-cart-active">
            <div class="sidebar-cart-all">
                <a class="cart-close" href="#"><i class="icon_close"></i></a>
                <div class="cart-content">
                    <h3>Giỏ Hàng</h3>
                    <ul>
                        @php
                            $cart = Cart::content();
                        @endphp
                        @if(Cart::count() == 0)
                        <li class="single-product-cart">Không Có Sản Phẩm Nào</li>
                        @else
                        @foreach($cart as $item)
                        <li class="single-product-cart">
                            <div class="cart-img">
                                <a href="{{asset('/product/details/'.$item->id.'/'.$item->name)}}"><img src="{{ asset($item->options->image)}}" alt=""></a>
                            </div>
                            <div class="cart-title">
                                <h4><a href="{{asset('/product/details/'.$item->id.'/'.$item->name)}}">{{ $item->name}}</a></h4>
                                <p style="text-transform: capitalize;">{{ $item->options->color}}</p>
                                <span>{{ $item->qty}} × </span><span>{{ number_format($item->price) }}</span>
                            </div>
                            <div class="cart-delete">
                                <a href="{{asset('/remove/cart/'.$item->rowId)}}">×</a>
                            </div>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    <div class="cart-total">
                        <h4>Tạm Tính: <span>{{Cart::subtotal()}} ₫</span></h4>
                    </div>
                    <div class="cart-checkout-btn">
                        <a class="btn-hover cart-btn-style" href="{{ route('show.cart')}}">Chi Tiết Giỏ Hàng</a>
                        <a class="no-mrg btn-hover cart-btn-style" href="checkout.html">Thanh Toán</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile header start -->
        <div class="mobile-header-active mobile-header-wrapper-style">
            <div class="clickalbe-sidebar-wrap">
                <a class="sidebar-close"><i class="icon_close"></i></a>
                <div class="mobile-header-content-area">
                    <div class="header-offer-wrap-2 mrg-none mobile-header-padding-border-4">
                        <p><span>FREE SHIPPING</span> world wide for all orders over $199</p>
                    </div>
                    <div class="mobile-search mobile-header-padding-border-1">
                        <form class="search-form" action="#">
                            <input type="text" placeholder="Search here…">
                            <button class="button-search"><i class="icon-magnifier"></i></button>
                        </form>
                    </div>
                    <div class="mobile-menu-wrap mobile-header-padding-border-2">
                        <!-- mobile menu start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children"><a href="index.html">Home</a>
                                    <ul class="dropdown">
                                        <li><a href="index.html">Home version 1 </a></li>
                                        <li><a href="index-2.html">Home version 2</a></li>
                                        <li><a href="index-3.html">Home version 3</a></li>
                                        <li><a href="index-4.html">Home version 4</a></li>
                                        <li><a href="index-5.html">Home version 5</a></li>
                                        <li><a href="index-6.html">Home version 6</a></li>
                                        <li><a href="index-7.html">Home version 7</a></li>
                                        <li><a href="index-8.html">Home version 8</a></li>
                                        <li><a href="index-9.html">Home version 9</a></li>
                                        <li><a href="index-10.html">Home version 10</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children "><a href="#">shop</a>
                                    <ul class="dropdown">
                                        <li class="menu-item-has-children"><a href="#">shop layout</a>
                                            <ul class="dropdown">
                                                <li><a href="shop.html">standard style</a></li>
                                                <li><a href="shop-list.html">shop list style</a></li>
                                                <li><a href="shop-fullwide.html">shop fullwide</a></li>
                                                <li><a href="shop-no-sidebar.html">grid no sidebar</a></li>
                                                <li><a href="shop-list-no-sidebar.html">list no sidebar</a></li>
                                                <li><a href="shop-right-sidebar.html">shop right sidebar</a></li>
                                                <li><a href="store-location.html">store location</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Products Layout</a>
                                            <ul class="dropdown">
                                                <li><a href="product-details.html">tab style 1</a></li>
                                                <li><a href="product-details-2.html">tab style 2</a></li>
                                                <li><a href="product-details-sticky.html">sticky style</a></li>
                                                <li><a href="product-details-gallery.html">gallery style </a></li>
                                                <li><a href="product-details-affiliate.html">affiliate style</a></li>
                                                <li><a href="product-details-group.html">group style</a></li>
                                                <li><a href="product-details-fixed-img.html">fixed image style </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><a href="#">Pages</a>
                                    <ul class="dropdown">
                                        <li><a href="about-us.html">about us </a></li>
                                        <li><a href="cart.html">cart page</a></li>
                                        <li><a href="checkout.html">checkout </a></li>
                                        <li><a href="my-account.html">my account</a></li>
                                        <li><a href="wishlist.html">wishlist </a></li>
                                        <li><a href="compare.html">compare </a></li>
                                        <li><a href="contact.html">contact us </a></li>
                                        <li><a href="order-tracking.html">order tracking</a></li>
                                        <li><a href="login-register.html">login / register </a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children "><a href="{{ route('blog.post')}}">Blog</a>
                                    <ul class="dropdown">
                                        <li><a href="blog.html">blog standard </a></li>
                                        <li><a href="blog-no-sidebar.html">blog no sidebar </a></li>
                                        <li><a href="blog-right-sidebar.html">blog right sidebar</a></li>
                                        <li><a href="blog-details.html">blog details</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html">Contact us</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu end -->
                    </div>
                    <div class="main-categori-wrap mobile-menu-wrap mobile-header-padding-border-3">
                        <a class="categori-show purple" href="#">
                            <i class="lnr lnr-menu"></i> All Department <i class="icon-arrow-down icon-right"></i>
                        </a>
                        <div class="categori-hide-2">
                            <nav>
                                <ul class="mobile-menu">
                                    <li class="menu-item-has-children "><a href="#">Clothing </a>
                                        <ul class="dropdown">
                                            <li class="menu-item-has-children"><a href="#">Men Clothing</a>
                                                <ul class="dropdown">
                                                    <li><a href="shop.html">Sleeveless shirt</a></li>
                                                    <li><a href="shop.html">Cotton T-shirt</a></li>
                                                    <li><a href="shop.html">Trench coat</a></li>
                                                    <li><a href="shop.html">Cargo pants</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children"><a href="#">Women Clothing</a>
                                                <ul class="dropdown">
                                                    <li><a href="shop.html">Wedding dress</a></li>
                                                    <li><a href="shop.html">Gym clothes</a></li>
                                                    <li><a href="shop.html">Cotton T-shirt </a></li>
                                                    <li><a href="shop.html">Long coat</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children"><a href="#">Kids Clothing</a>
                                                <ul class="dropdown">
                                                    <li><a href="product-details.html">Winter Wear </a></li>
                                                    <li><a href="product-details-2.html">Occasion Gowns</a></li>
                                                    <li><a href="product-details-tab1.html">Birthday Tailcoat</a></li>
                                                    <li><a href="product-details-tab2.html">Stylish Unicorn</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children "><a href="#">Women</a>
                                        <ul class="dropdown">
                                            <li class="menu-item-has-children"><a href="#">Men Clothing</a>
                                                <ul class="dropdown">
                                                    <li><a href="shop.html">Sleeveless shirt</a></li>
                                                    <li><a href="shop.html">Cotton T-shirt</a></li>
                                                    <li><a href="shop.html">Trench coat</a></li>
                                                    <li><a href="shop.html">Cargo pants</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children"><a href="#">Women Clothing</a>
                                                <ul class="dropdown">
                                                    <li><a href="shop.html">Wedding dress</a></li>
                                                    <li><a href="shop.html">Gym clothes</a></li>
                                                    <li><a href="shop.html">Cotton T-shirt </a></li>
                                                    <li><a href="shop.html">Long coat</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children "><a href="#">Men </a>
                                        <ul class="dropdown">
                                            <li class="menu-item-has-children"><a href="#">Men Clothing</a>
                                                <ul class="dropdown">
                                                    <li><a href="shop.html">Sleeveless shirt</a></li>
                                                    <li><a href="shop.html">Cotton T-shirt</a></li>
                                                    <li><a href="shop.html">Trench coat</a></li>
                                                    <li><a href="shop.html">Cargo pants</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children"><a href="#">Women Clothing</a>
                                                <ul class="dropdown">
                                                    <li><a href="shop.html">Wedding dress</a></li>
                                                    <li><a href="shop.html">Gym clothes</a></li>
                                                    <li><a href="shop.html">Cotton T-shirt </a></li>
                                                    <li><a href="shop.html">Long coat</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children"><a href="#">Kids Clothing</a>
                                                <ul class="dropdown">
                                                    <li><a href="product-details.html">Winter Wear </a></li>
                                                    <li><a href="product-details-2.html">Occasion Gowns</a></li>
                                                    <li><a href="product-details-tab1.html">Birthday Tailcoat</a></li>
                                                    <li><a href="product-details-tab2.html">Stylish Unicorn</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children "><a href="#">Baby Girl </a>
                                        <ul class="dropdown">
                                            <li class="menu-item-has-children"><a href="#">Men Clothing</a>
                                                <ul class="dropdown">
                                                    <li><a href="shop.html">Sleeveless shirt</a></li>
                                                    <li><a href="shop.html">Cotton T-shirt</a></li>
                                                    <li><a href="shop.html">Trench coat</a></li>
                                                    <li><a href="shop.html">Cargo pants</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children"><a href="#">Women Clothing</a>
                                                <ul class="dropdown">
                                                    <li><a href="shop.html">Wedding dress</a></li>
                                                    <li><a href="shop.html">Gym clothes</a></li>
                                                    <li><a href="shop.html">Cotton T-shirt </a></li>
                                                    <li><a href="shop.html">Long coat</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="shop.html">Baby Boy </a></li>
                                    <li><a href="shop.html">Accessories </a></li>
                                    <li><a href="shop.html">Shoes </a></li>
                                    <li><a href="shop.html">Shirt </a></li>
                                    <li><a href="shop.html">T-Shirt </a></li>
                                    <li><a href="shop.html">Coat </a></li>
                                    <li><a href="shop.html">Jeans </a></li>
                                    <li><a href="shop.html">Collection </a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="mobile-header-info-wrap mobile-header-padding-border-3">
                        <div class="single-mobile-header-info">
                            <a href="store-location.html"><i class="lastudioicon-pin-3-2"></i> Store Location </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a class="mobile-language-active" href="#">Language <span><i class="icon-arrow-down"></i></span></a>
                            <div class="lang-curr-dropdown lang-dropdown-active">
                                <ul>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Spanish</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-mobile-header-info">
                            <a class="mobile-currency-active" href="#">Currency <span><i class="icon-arrow-down"></i></span></a>
                            <div class="lang-curr-dropdown curr-dropdown-active">
                                <ul>
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">EUR</a></li>
                                    <li><a href="#">Real</a></li>
                                    <li><a href="#">BDT</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-contact-info mobile-header-padding-border-4">
                        <ul>
                            <li><i class="icon-phone "></i> (+612) 2531 5600</li>
                            <li><i class="icon-envelope-open "></i> norda@domain.com</li>
                            <li><i class="icon-home"></i> PO Box 1622 Colins Street West Australia</li>
                        </ul>
                    </div>
                    <div class="mobile-social-icon">
                        <a class="facebook" href="#"><i class="icon-social-facebook"></i></a>
                        <a class="twitter" href="#"><i class="icon-social-twitter"></i></a>
                        <a class="pinterest" href="#"><i class="icon-social-pinterest"></i></a>
                        <a class="instagram" href="#"><i class="icon-social-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
<div class="modal fade" id="modaltracking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Trạng Thái Đơn Hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="form_tracking">
            @csrf
                <label style="font-size: 16px; font-weight: bold;">Mã Đơn Hàng</label>
                <input type="text" onclick="removete()" name="status_code" id="status_code" class="form-control" placeholder="Điền Mã Đơn Hàng Của Bạn">
                <span class="text-danger" id="status_code_error"></span>
                <p class="text-danger" id="message_error1"></p>
                <button class="btn btn-info float_right mt-3" type="button" onclick="tracking()">Theo Dõi</button>
            
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    
function tracking() {
    axios.post('/order/tracking', $('#form_tracking').serialize())
    .then(function(response){
        var code = response.data.code;
        console.log(code);
        window.location.href = '/order/tracking/view/'+code;
        // Swal.fire({
        //     icon: 'success',
        //     title: 'Thông báo',
        //     text: response.data.messages,
        // })
        // .then(function(response) {
            // axios.get('/order/tracking/view', {tracking:tracking}, {
            //     headers: {
            //         'X-CSRF-Token': $('input[name="_token"]').val()
            //     }
            // })
            // window.location.href = '/order/tracking/view';
        // });
    }).catch(function(error){
        var data = error.response.data;
        if (data.status == 'validator_fail') {
            var messages = data.messages;
            Object.keys(messages).forEach(key => {
                $('#'+key+'_error').text(messages[key][0]);
            });
        } else{
            $('#message_error1').text(data.messages);
        } 
    })
}


function removete(){
    $('#message_error1').text('');
    $('#status_code_error').text('');
    // var input_name = obj.attr('name');
    // $('#'+input_name+'_error').text('');
}
// function removeMessage(obj){
//     $('#message_error').text('');
//     var input_name = obj.attr('name');
//     $('#'+input_name+'_error').text('');
// }
</script>