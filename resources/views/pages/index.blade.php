@extends('layouts.main')
@push('js')
<link rel="stylesheet" href="{{ asset('css/frontend/index.css')}}">

@endpush
@section('slider')
@include('layouts.slider')
@endsection

@section('content')
    @php
    $featured = DB::table('products')->where('status',1)->orderBy('id','DESC')->limit(8)->get();
    $trend = DB::table('products')->where('products.trend',1)->where('products.status',1)->orderBy('products.id','DESC')->limit(12)->get();
    $hot = DB::table('products')->where('products.hot_deal',1)->where('products.status',1)->orderBy('products.id','DESC')->limit(12)->get();
    $trendwatch = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->select('products.*','categories.category_name')
                    ->where('products.status',1)->where('products.trend',1)->where('categories.category_name','Đồng Hồ Thông Minh')->orderBy('products.id','DESC')->limit(8)->get();
    $bestrate = DB::table('products')->where('best_rated',1)->where('status',1)->orderBy('id','DESC')->limit(8)->get();
    $phone = DB::table('products')
                ->join('categories','products.category_id','categories.id')
                ->select('products.*','categories.category_name')
                ->where('categories.category_name','Điện thoại')->where('products.status',1)->orderBy('products.id','ASC')->limit(8)->get();
    $tablet = DB::table('products')
                ->join('categories','products.category_id','categories.id')
                ->select('products.*','categories.category_name')
                ->where('categories.category_name','Tablet')->where('products.status',1)->orderBy('products.id','ASC')->limit(8)->get();
    $flashdeal = DB::table('products')->where('flash_deal',1)->where('status',1)->orderBy('id','DESC')->limit(8)->get();
    $sound = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->select('products.*','categories.category_name')
                    ->where('products.status',1)->where('products.trend',1)->where('categories.category_name','Âm thanh')->orderBy('products.id','DESC')->limit(8)->get();
    @endphp
        <div class="service-area pb-30">
            <div class="container">
                <div class="service-wrap-border service-wrap-padding-3">
                    <div class="row text-center">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 service-border-1">
                            <div class="single-service-wrap-2 mb-30">
                                <div class="service-icon-2 icon-red">
                                    <i class="icon-cursor"></i>
                                </div>
                                <div class="service-content-2">
                                    <h3>Miễn Phí Vận Chuyển</h3>
                                    <p>Đối Với Đơn Hàng Trên 5 Triệu</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 service-border-1 service-border-1-none-md">
                            <div class="single-service-wrap-2 mb-30">
                                <div class="service-icon-2 icon-red">
                                    <i class="icon-refresh "></i>
                                </div>
                                <div class="service-content-2">
                                    <h3>Hoàn Trả Trong 30 Ngày</h3>
                                    <p>Đối Với Bất Kỳ Vấn Đề Nào</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 service-border-1">
                            <div class="single-service-wrap-2 mb-30">
                                <div class="service-icon-2 icon-red">
                                    <i class="icon-credit-card "></i>
                                </div>
                                <div class="service-content-2">
                                    <h3>Thanh Toán An Toàn</h3>
                                    <p>100% Bảo Mật Dữ Liệu Khách Hàng</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="single-service-wrap-2 mb-30">
                                <div class="service-icon-2 icon-red">
                                    <i class="icon-earphones "></i>
                                </div>
                                <div class="service-content-2">
                                    <h3>Hỗ Trợ Nhiệt Tình 24h</h3>
                                    <p>Nhân Viên Nhiệt Tình Tư Vấn Hỗ Trợ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-area pb-90 pt-90">
            <div class="container">
                <div class="section-title-btn-wrap border-bottom-3 mb-50 pb-20">
                    <div class="section-title-deal-wrap">
                        <div class="section-title-3">
                            <h2>Flash Deal</h2>
                        </div>
                        <div class="timer-wrap-2">
                            <h4><i class="icon-speedometer"></i> Thời gian còn lại:</h4>
                            <div class="timer-style-2" id="timer-2-active"></div>
                        </div>
                    </div>
                    <!-- <div class="btn-style-7">
                        <a href="shop.html">All Product</a>
                    </div> -->
                </div>
                <div class="product-slider-active-3 nav-style-3">
                    @foreach($flashdeal as $item)
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-15">
                                <?php 
                                $imageflash = json_decode($item->image)
                                ?>
                                <a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">
                                    <img src="{{asset($imageflash[0])}}" alt="">
                                </a>
                                @if($item->discount_price !== NULL)
                                @php
                                $amount = $item->selling_price - $item->discount_price;
                                $discount = $amount/$item->selling_price*100;
                                @endphp
                                <span class="pro-badge left bg-red">{{number_format($discount)}}%</span>
                                <span class="pro-badge right1" style="color: orange; font-size: 18px;"><i class="fas fa-bolt"></i></span>
                                @endif
                                <div class="product-action-2 tooltip-style-2">
                                    <button title="Thêm Vào Yêu Thích" class="addWishlist" data-id="{{$item->id}}"><i class="icon-heart"></i></button>
                                    <button title="Xem Nhanh" data-toggle="modal" data-target="#exampleModal" onclick="productview(this.id)" class="preview" id="{{($item->id)}}"><i class="icon-eye"></i></button>
                                    <!-- <a title="Wishlist" class="btn" href="{{asset('/add/wishlist/'.$item->id)}}"><i class="icon-heart"></i></a> -->
                                    <!-- <button title="Quick View" data-toggle="modal" data-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button> -->
                                    <!-- <button title="Compare"><i class="icon-refresh"></i></button> -->
                                </div>
                            </div>
                            <div class="product-content-wrap-3">
                                <h3><a class="red" href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                                <div class="product-rating-wrap-2">
                                   <?php 
                                   $idrate = $item->id;

                                   $five = DB::table('ratings')->where('rate',5)->where('product_id',$idrate)->get();
                                   $four = DB::table('ratings')->where('rate',4)->where('product_id',$idrate)->get();
                                   $three = DB::table('ratings')->where('rate',3)->where('product_id',$idrate)->get();
                                   $two = DB::table('ratings')->where('rate',2)->where('product_id',$idrate)->get();
                                   $one = DB::table('ratings')->where('rate',1)->where('product_id',$idrate)->get();

                                   $sum = DB::table('ratings')->where('product_id',$idrate)->get();

                                   if($sum->count() != 0){
                                       $perfive = $five->count()*100/$sum->count();
                                       $perfour = $four->count()*100/$sum->count();
                                       $perthree = $three->count()*100/$sum->count();
                                       $pertwo = $two->count()*100/$sum->count();
                                       $perone = $one->count()*100/$sum->count();

                                       $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                       $aveg = round($sumstar/$sum->count()); 
                                             $aveg2 = round($sumstar/$sum->count(),1); 
                                   }else {
                                     $perfive = 0;
                                     $perfour = 0;
                                     $perthree = 0;
                                     $pertwo = 0;
                                     $perone = 0;

                                     $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                     $aveg = 0; 
                                     $aveg2 = 0; 
                                 }


                                 ?>
                                    <div class="product-rating-4">
                                        @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                            </div>
                                            <span>
                                                ({{$aveg2}})
                                            </span>
                                </div>
                                <div class="product-price-4">
                                    @if($item->discount_price == null)
                                    <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                    <!-- <span class="old-price">ss</span> -->
                                    @else
                                    <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                    <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2">
                                <h3><a class="red" href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                            </div>
                                            <span>
                                                ({{$aveg2}})
                                            </span>
                                </div>
                                <div class="product-price-4">
                                    @if($item->discount_price == null)
                                    <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                    <!-- <span class="old-price">ss</span> -->
                                    @else
                                    <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                    <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                    @endif
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Thêm vào giỏ hàng" class="addcart" data-id="{{($item->id)}}">Thêm vào giỏ hàng</button>
                                    <!-- <button title="Add to Cart" data-toggle="modal" data-target="#exampleModal" onclick="productview(this.id)" class="preview" id="{{($item->id)}}">Thêm vào giỏ hàng</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="product-area pt-115 pb-110">
            <div class="container">
                <div class="section-title-tab-wrap border-bottom-3 mb-30 pb-20">
                    <div class="section-title-6">
                        <h2 class="title-product">Sản Phẩm Nổi Bật</h2>
                    </div>
                    <div class="tab-style-3 tab-style-3-blue nav">
                        <a class="active product-click" href="#product-1" data-toggle="tab">Sản Phẩm Nổi Bật</a>
                        <a href="#product-2" class="product-click1" data-toggle="tab">Sản Phẩm Hot</a>
                        <!-- <a href="#product-3" data-toggle="tab">Tablet</a> -->
                        <!-- <a href="#product-4" data-toggle="tab"></a> -->
                        <!-- <a href="#product-5" data-toggle="tab">Accessories </a> -->
                    </div>
                </div>
                <div class="tab-content jump">
                    <div id="product-1" class="tab-pane active">
                        <div class="product-slider-active-2 dot-style-2 dot-style-2-position-static dot-style-2-mrg-2 dot-style-2-active-black">
                            @foreach ($trend as $item)
                            <div class="product-plr-2">
                                <div class="single-product-wrap-2 mb-25">
                                    <div class="product-img-2">
                                        <?php 
                                            $imagetrend = json_decode($item->image)
                                         ?>
                                        <a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}"><img src="{{ asset($imagetrend[0])}}" alt=""></a>
                                        @if($item->discount_price !== NULL)
                                        @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = $amount/$item->selling_price*100;
                                        @endphp
                                            <span class="pro-badge right bg-red">{{number_format($discount)}}%</span>
                                        @endif
                                        
                                    </div>
                                    <div class="product-content-3">
                                        <!-- <span>baby</span> -->
                                        <h4><a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h4>
                                        <div class="product-rating-wrap-2">
                                            <?php 
                                            $idrate = $item->id;

                                            $five = DB::table('ratings')->where('rate',5)->where('product_id',$idrate)->get();
                                            $four = DB::table('ratings')->where('rate',4)->where('product_id',$idrate)->get();
                                            $three = DB::table('ratings')->where('rate',3)->where('product_id',$idrate)->get();
                                            $two = DB::table('ratings')->where('rate',2)->where('product_id',$idrate)->get();
                                            $one = DB::table('ratings')->where('rate',1)->where('product_id',$idrate)->get();

                                            $sum = DB::table('ratings')->where('product_id',$idrate)->get();

                                            if($sum->count() != 0){
                                             $perfive = $five->count()*100/$sum->count();
                                             $perfour = $four->count()*100/$sum->count();
                                             $perthree = $three->count()*100/$sum->count();
                                             $pertwo = $two->count()*100/$sum->count();
                                             $perone = $one->count()*100/$sum->count();

                                             $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                             $aveg = round($sumstar/$sum->count()); 
                                             $aveg2 = round($sumstar/$sum->count(),1); 
                                            }else {
                                               $perfive = 0;
                                               $perfour = 0;
                                               $perthree = 0;
                                               $pertwo = 0;
                                               $perone = 0;

                                               $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                               $aveg = 0; $aveg2 = 0;
                                           }
                                            

                                             ?>
                                                
                                            <div class="product-rating-2">
                                                    @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                            </div>
                                            <span>
                                                ({{$aveg2}})
                                            </span>
                                        </div>
                                        <div class="pro-price-action-wrap">
                                            <div class="product-price-3">
                                                @if($item->discount_price == null)
                                                    <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                                    <!-- <span class="old-price">ss</span> -->
                                                @else
                                                    <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                                    <span style="display: inline-block;" class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                                @endif
                                                
                                            </div>
                                            <div class="product-action-3 pro-action-3-blue mt-4">
                                                <!-- <a title="Thêm vào yêu thích" class="btn" href="{{asset('/add/wishlist/'.$item->id)}}"><i class="icon-heart"></i></a> -->
                                                <button title="Thêm vào yêu thích" class="addWishlist" data-id="{{$item->id}}"><i class="icon-heart"></i></button>
                                                <button title="Thêm vào giỏ hàng" class="addcart" data-id="{{($item->id)}}"><i class="icon-basket-loaded"></i></button>
                                                <button title="Xem Nhanh" data-toggle="modal" data-target="#exampleModal" onclick="productview(this.id)" class="preview" id="{{($item->id)}}"><i class="icon-eye"></i></button>
                                                <!-- <a title="Thêm vào giỏ hàng" class="btn" href="{{asset('/add/wishlist/'.$item->id)}}"><i class="icon-basket-loaded"></i></a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="product-2" class="tab-pane">
                        <div class="product-slider-active-2 dot-style-2 dot-style-2-position-static dot-style-2-mrg-2 dot-style-2-active-black">
                            @foreach($hot as $item)
                            <div class="product-plr-2">
                                <div class="single-product-wrap-2 mb-25">
                                    <div class="product-img-2">
                                        <?php 
                                            $imagew = json_decode($item->image)
                                         ?>
                                        <a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}"><img src="{{ asset($imagew[0])}}" alt=""></a>
                                        @if($item->discount_price !== NULL)
                                        @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = $amount/$item->selling_price*100;
                                        @endphp
                                            <span class="pro-badge right bg-red">{{number_format($discount)}}%</span>
                                        @endif
                                    </div>
                                    <div class="product-content-3">
                                        <h4><a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h4>
                                        <div class="product-rating-wrap-2">
                                            <?php 
                                            $idrate = $item->id;

                                            $five = DB::table('ratings')->where('rate',5)->where('product_id',$idrate)->get();
                                            $four = DB::table('ratings')->where('rate',4)->where('product_id',$idrate)->get();
                                            $three = DB::table('ratings')->where('rate',3)->where('product_id',$idrate)->get();
                                            $two = DB::table('ratings')->where('rate',2)->where('product_id',$idrate)->get();
                                            $one = DB::table('ratings')->where('rate',1)->where('product_id',$idrate)->get();

                                            $sum = DB::table('ratings')->where('product_id',$idrate)->get();

                                            if($sum->count() != 0){
                                             $perfive = $five->count()*100/$sum->count();
                                             $perfour = $four->count()*100/$sum->count();
                                             $perthree = $three->count()*100/$sum->count();
                                             $pertwo = $two->count()*100/$sum->count();
                                             $perone = $one->count()*100/$sum->count();

                                             $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                             $aveg = round($sumstar/$sum->count()); 
                                            }else {
                                               $perfive = 0;
                                               $perfour = 0;
                                               $perthree = 0;
                                               $pertwo = 0;
                                               $perone = 0;

                                               $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                               $aveg = 0; 
                                                $aveg2 = 0;
                                           }
                                            

                                             ?>
                                                
                                            <div class="product-rating-2">
                                                    @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                            </div>
                                            <span>
                                                ({{$aveg}})
                                            </span>
                                        </div>
                                        <div class="pro-price-action-wrap">
                                            <div class="product-price-3">
                                                @if($item->discount_price == null)
                                                    <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                                    <!-- <span class="old-price">ss</span> -->
                                                @else
                                                    <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                                    <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                                @endif
                                            </div>
                                            <div class="product-action-3 pro-action-3-blue">
                                                <button title="Thêm vào yêu thích" class="addWishlist" data-id="{{$item->id}}"><i class="icon-heart"></i></button>
                                                <button title="Thêm vào giỏ hàng" class="addcart" data-id="{{($item->id)}}"><i class="icon-basket-loaded"></i></button>
                                                <button title="Xem Nhanh" data-toggle="modal" data-target="#exampleModal" onclick="productview(this.id)" class="preview" id="{{($item->id)}}"><i class="icon-eye"></i></button>
                                                <!-- <a title="Thêm vào yêu thích" class="btn" href="{{asset('/add/wishlist/'.$item->id)}}"><i class="icon-heart"></i></a>
                                                <a title="Thêm vào giỏ hàng" class="btn" href="{{asset('/add/wishlist/'.$item->product_name)}}"><i class="icon-basket-loaded"></i></a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $cats = DB::table('categories')->first();
            $catid = $cats->id;
            $product = DB::table('products')->where('category_id',$catid)->where('status',1)->limit(10)->orderBy('id', 'DESC')->get();
        @endphp
        <div class="product-area pb-110">
            <div class="container">
                <div class="section-title-tab-wrap border-bottom-3 mb-30 pb-20">
                    <div class="section-title-6">
                        <h2><i class="icon-screen-desktop"></i>{{$cats->category_name}}</h2>
                    </div>
                    <!-- <div class="tab-style-8 nav tab-res-mrg">
                        <a class="active" href="#product-6" data-toggle="tab">Televisions </a>
                        <a href="#product-7" data-toggle="tab"> Air Conditions </a>
                        <a href="#product-8" data-toggle="tab">Washing Machine </a>
                        <a href="#product-9" data-toggle="tab">Laptop </a>
                        <a href="#product-10" data-toggle="tab"> Computer </a>
                    </div> -->
                </div>
                <div class="tab-content jump">
                    <div id="product-6" class="tab-pane active">
                        <div class="product-slider-active-3 nav-style-3">
                            @foreach($product as $item)
                            <div class="product-plr-1">
                                <div class="single-product-wrap">
                                    <div class="product-img product-img-zoom mb-15">
                                        <a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">
                                            <?php 
                                                $imagephone = json_decode($item->image)
                                            ?>
                                            <img src="{{ asset($imagephone[0])}}" alt="">
                                        </a>
                                        @if($item->discount_price !== NULL)
                                        @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = $amount/$item->selling_price*100;
                                        @endphp
                                            <span class="pro-badge left bg-red">{{number_format($discount)}}%</span>
                                        @endif
                                        <div class="product-action-2 tooltip-style-2">
                                            <!-- <a title="Wishlist" class="btn" href="{{asset('/add/wishlist/'.$item->id)}}"><i class="icon-heart"></i></a> -->
                                            <button title="Thêm vào yêu thích" class="addWishlist" data-id="{{$item->id}}"><i class="icon-heart"></i></button>
                                            <button title="Xem Nhanh" data-toggle="modal" data-target="#exampleModal" onclick="productview(this.id)" class="preview" id="{{($item->id)}}"><i class="icon-eye"></i></button>
                                            <!-- <button title="Quick View" data-toggle="modal" data-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button> -->
                                            <!-- <button title="Compare"><i class="icon-refresh"></i></button> -->
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3">
                                        <!-- <div class="product-content-categories">
                                            <a class="blue" href="shop.html">Epson</a>
                                        </div> -->
                                        <h3><a class="red" href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                             <?php 
                                   $idrate = $item->id;

                                   $five = DB::table('ratings')->where('rate',5)->where('product_id',$idrate)->get();
                                   $four = DB::table('ratings')->where('rate',4)->where('product_id',$idrate)->get();
                                   $three = DB::table('ratings')->where('rate',3)->where('product_id',$idrate)->get();
                                   $two = DB::table('ratings')->where('rate',2)->where('product_id',$idrate)->get();
                                   $one = DB::table('ratings')->where('rate',1)->where('product_id',$idrate)->get();

                                   $sum = DB::table('ratings')->where('product_id',$idrate)->get();

                                   if($sum->count() != 0){
                                       $perfive = $five->count()*100/$sum->count();
                                       $perfour = $four->count()*100/$sum->count();
                                       $perthree = $three->count()*100/$sum->count();
                                       $pertwo = $two->count()*100/$sum->count();
                                       $perone = $one->count()*100/$sum->count();

                                       $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                       $aveg = round($sumstar/$sum->count()); 
                                             $aveg2 = round($sumstar/$sum->count(),1); 
                                   }else {
                                     $perfive = 0;
                                     $perfour = 0;
                                     $perthree = 0;
                                     $pertwo = 0;
                                     $perone = 0;

                                     $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                     $aveg = 0;
                                     $aveg2 = 0; 
                                 }


                                 ?>
                                    <div class="product-rating-4">
                                        @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                            </div>
                                            <span>
                                                ({{$aveg2}})
                                            </span>
                                        </div>
                                        <div class="product-price-4">
                                            @if($item->discount_price == null)
                                            <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                            @else
                                            <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                            <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                        <div class="product-content-categories">
                                            <!-- <a class="red" href="shop.html">Epson</a> -->
                                        </div>
                                        <h3><a class="red" href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <div class="product-rating-4">
                                                @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                            </div>
                                            <span>
                                                ({{$aveg2}})
                                            </span>
                                        </div>
                                        <div class="product-price-4">
                                            @if($item->discount_price == null)
                                            <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                            @else
                                            <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                            <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                            @endif
                                        </div>
                                        <div class="pro-add-to-cart-2">
                                            <button title="Add to Cart" class="addcart" data-id="{{($item->id)}}">Thêm vào giỏ hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $cats = DB::table('categories')->skip(1)->first();
            $catid = $cats->id;
            $product = DB::table('products')->where('category_id',$catid)->where('status',1)->limit(15)->orderBy('id', 'DESC')->get();
        @endphp
        <div class="product-area pb-110">
            <div class="container">
                <div class="section-title-tab-wrap border-bottom-3 mb-30 pb-20">
                    <div class="section-title-6">
                        <h2><i class="icon-screen-desktop"></i>{{$cats->category_name}}</h2>
                    </div>
                    <!-- <div class="tab-style-8 nav tab-res-mrg">
                        <a class="active" href="#product-6" data-toggle="tab">Televisions </a>
                        <a href="#product-7" data-toggle="tab"> Air Conditions </a>
                        <a href="#product-8" data-toggle="tab">Washing Machine </a>
                        <a href="#product-9" data-toggle="tab">Laptop </a>
                        <a href="#product-10" data-toggle="tab"> Computer </a>
                    </div> -->
                </div>
                <div class="tab-content jump">
                    <div id="product-6" class="tab-pane active">
                        <div class="product-slider-active-3 nav-style-3">
                            @foreach($product as $item)
                            <div class="product-plr-1">
                                <div class="single-product-wrap">
                                    <div class="product-img product-img-zoom mb-15">
                                        <a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">
                                            <?php 
                                                $imagetablet = json_decode($item->image)
                                            ?>
                                            <img src="{{ asset($imagetablet[0])}}" alt="">
                                        </a>
                                        @if($item->discount_price !== NULL)
                                        @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = $amount/$item->selling_price*100;
                                        @endphp
                                            <span class="pro-badge left bg-red">{{number_format($discount)}}%</span>
                                        @endif
                                        <div class="product-action-2 tooltip-style-2">
                                            <!-- <a title="Wishlist" class="btn" href="{{asset('/add/wishlist/'.$item->id)}}"><i class="icon-heart"></i></a> -->
                                            <button title="Thêm vào yêu thích" class="addWishlist" data-id="{{$item->id}}"><i class="icon-heart"></i></button>
                                            <button title="Xem Nhanh" data-toggle="modal" data-target="#exampleModal" onclick="productview(this.id)" class="preview" id="{{($item->id)}}"><i class="icon-eye"></i></button>
                                            <!-- <button title="Quick View" data-toggle="modal" data-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button> -->
                                            <!-- <button title="Compare"><i class="icon-refresh"></i></button> -->
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3">
                                        <!-- <div class="product-content-categories">
                                            <a class="blue" href="shop.html">Epson</a>
                                        </div> -->
                                        <h3><a class="red" href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <?php 
                                   $idrate = $item->id;

                                   $five = DB::table('ratings')->where('rate',5)->where('product_id',$idrate)->get();
                                   $four = DB::table('ratings')->where('rate',4)->where('product_id',$idrate)->get();
                                   $three = DB::table('ratings')->where('rate',3)->where('product_id',$idrate)->get();
                                   $two = DB::table('ratings')->where('rate',2)->where('product_id',$idrate)->get();
                                   $one = DB::table('ratings')->where('rate',1)->where('product_id',$idrate)->get();

                                   $sum = DB::table('ratings')->where('product_id',$idrate)->get();

                                   if($sum->count() != 0){
                                       $perfive = $five->count()*100/$sum->count();
                                       $perfour = $four->count()*100/$sum->count();
                                       $perthree = $three->count()*100/$sum->count();
                                       $pertwo = $two->count()*100/$sum->count();
                                       $perone = $one->count()*100/$sum->count();

                                       $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                       $aveg = round($sumstar/$sum->count()); 
                                             $aveg2 = round($sumstar/$sum->count(),1); 
                                   }else {
                                     $perfive = 0;
                                     $perfour = 0;
                                     $perthree = 0;
                                     $pertwo = 0;
                                     $perone = 0;

                                     $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                     $aveg = 0;
                                     $aveg2 = 0; 
                                 }


                                 ?>
                                    <div class="product-rating-4">
                                        @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                            </div>
                                            <span>
                                                ({{$aveg2}})
                                            </span>
                                        </div>
                                        <div class="product-price-4">
                                            @if($item->discount_price == null)
                                            <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                            @else
                                            <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                            <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                        <div class="product-content-categories">
                                            <!-- <a class="blue" href="shop.html">Epson</a> -->
                                        </div>
                                        <h3><a class="red" href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <div class="product-rating-4">
                                                @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                            </div>
                                            <span>
                                                ({{$aveg2}})
                                            </span>
                                        </div>
                                        <div class="product-price-4">
                                            @if($item->discount_price == null)
                                            <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                            @else
                                            <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                            <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                            @endif
                                        </div>
                                        <div class="pro-add-to-cart-2">
                                            <button title="Thêm vào giỏ hàng" class="addcart" data-id="{{($item->id)}}">Thêm vào giỏ hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $cats = DB::table('categories')->skip(3)->first();
            $catid = $cats->id;
            $product = DB::table('products')->where('category_id',$catid)->where('status',1)->limit(15)->orderBy('id', 'DESC')->get();
        @endphp
        <div class="product-area pb-110">
            <div class="container">
                <div class="section-title-tab-wrap border-bottom-3 mb-30 pb-20">
                    <div class="section-title-6">
                        <h2><i class="icon-screen-desktop"></i>{{$cats->category_name}}</h2>
                    </div>
                    <!-- <div class="tab-style-8 nav tab-res-mrg-2">
                        <a class="active" href="#product-11" data-toggle="tab">Men </a>
                        <a href="#product-12" data-toggle="tab"> Women </a>
                        <a href="#product-13" data-toggle="tab"> Girls </a>
                        <a href="#product-14" data-toggle="tab"> Boys </a>
                        <a href="#product-15" data-toggle="tab"> Shoes </a>
                    </div> -->
                </div>
                <div class="tab-content jump">
                    <div id="product-11" class="tab-pane active">
                        <div class="product-slider-active-3 nav-style-3">
                            @foreach ($product as $item)
                            <div class="product-plr-1">
                                <div class="single-product-wrap">
                                    <div class="product-img product-img-zoom mb-15">
                                        <a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">
                                            <?php 
                                                $imagew = json_decode($item->image);
                                             ?>
                                            <img src="{{asset($imagew[0])}}" alt="">
                                        </a>
                                        @if($item->discount_price !== NULL)
                                        @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = $amount/$item->selling_price*100;
                                        @endphp
                                            <span class="pro-badge left bg-red">{{number_format($discount)}}%</span>
                                        @endif
                                        <div class="product-action-2 tooltip-style-2">
                                            <!-- <a title="Wishlist" class="btn" href="{{asset('/add/wishlist/'.$item->id)}}"><i class="icon-heart"></i></a> -->
                                            <button title="Thêm Vào Yêu Thích" class="addWishlist" data-id="{{$item->id}}"><i class="icon-heart"></i></button>
                                            <button title="Xem Nhanh" data-toggle="modal" data-target="#exampleModal" onclick="productview(this.id)" class="preview" id="{{($item->id)}}"><i class="icon-eye"></i></button>
                                            <!-- <button title="Quick View" data-toggle="modal" data-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button> -->
                                            <!-- <button title="Compare"><i class="icon-refresh"></i></button> -->
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3">
                                        <h3><a class="red" href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                             <?php 
                                   $idrate = $item->id;

                                   $five = DB::table('ratings')->where('rate',5)->where('product_id',$idrate)->get();
                                   $four = DB::table('ratings')->where('rate',4)->where('product_id',$idrate)->get();
                                   $three = DB::table('ratings')->where('rate',3)->where('product_id',$idrate)->get();
                                   $two = DB::table('ratings')->where('rate',2)->where('product_id',$idrate)->get();
                                   $one = DB::table('ratings')->where('rate',1)->where('product_id',$idrate)->get();

                                   $sum = DB::table('ratings')->where('product_id',$idrate)->get();

                                   if($sum->count() != 0){
                                       $perfive = $five->count()*100/$sum->count();
                                       $perfour = $four->count()*100/$sum->count();
                                       $perthree = $three->count()*100/$sum->count();
                                       $pertwo = $two->count()*100/$sum->count();
                                       $perone = $one->count()*100/$sum->count();

                                       $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                       $aveg = round($sumstar/$sum->count()); 
                                             $aveg2 = round($sumstar/$sum->count(),1); 
                                   }else {
                                     $perfive = 0;
                                     $perfour = 0;
                                     $perthree = 0;
                                     $pertwo = 0;
                                     $perone = 0;

                                     $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                     $aveg = 0; 
                                     $aveg2 = 0;
                                 }


                                 ?>
                                    <div class="product-rating-4">
                                        @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                            </div>
                                            <span>
                                                ({{$aveg2}})
                                            </span>
                                        </div>
                                        <div class="product-price-4">
                                            @if($item->discount_price == null)
                                            <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                            @else
                                            <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                            <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                        <h3><a class="red" href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <div class="product-rating-4">
                                                @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                            </div>
                                            <span>
                                                ({{$aveg2}})
                                            </span>
                                        </div>
                                        <div class="product-price-4">
                                            @if($item->discount_price == null)
                                            <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                            @else
                                            <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                            <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                            @endif
                                        </div>
                                        <div class="pro-add-to-cart-2">
                                            <button title="Thêm Vào Giỏ Hàng" class="addcart" data-id="{{($item->id)}}">Thêm vào giỏ hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $cats = DB::table('categories')->skip(2)->first();
            $catid = $cats->id;
            $product = DB::table('products')->where('category_id',$catid)->where('status',1)->limit(15)->orderBy('id', 'DESC')->get();
        @endphp
        <div class="product-area pb-115">
            <div class="container">
                <div class="section-title-tab-wrap border-bottom-3 mb-30 pb-20">
                    <div class="section-title-6">
                        <h2><i class="icon-home"></i>{{$cats->category_name}}</h2>
                    </div>
                    <!-- <div class="tab-style-8 tab-res-mrg nav">
                        <a class="active" href="#product-16" data-toggle="tab">Home Decor </a>
                        <a href="#product-17" data-toggle="tab"> Furniture </a>
                        <a href="#product-18" data-toggle="tab">Kitchen & Dinning </a>
                        <a href="#product-19" data-toggle="tab">Bedding & Bath </a>
                        <a href="#product-20" data-toggle="tab"> Appliances </a>
                    </div> -->
                </div>
                <div class="tab-content jump">
                    <div id="product-16" class="tab-pane active">
                        <div class="product-slider-active-3 nav-style-3">
                            @foreach($product as $item)
                            <div class="product-plr-1">
                                <div class="single-product-wrap">
                                    <div class="product-img product-img-zoom mb-15">
                                        <a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">
                                            <?php 
                                                $imagew = json_decode($item->image);
                                             ?>
                                            <img src="{{asset($imagew[0])}}" alt="">
                                        </a>
                                        @if($item->discount_price !== NULL)
                                        @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = $amount/$item->selling_price*100;
                                        @endphp
                                            <span class="pro-badge left bg-red">{{number_format($discount)}}%</span>
                                        @endif
                                        <div class="product-action-2 tooltip-style-2">
                                            <!-- <a title="Wishlist" class="btn" href="{{asset('/add/wishlist/'.$item->id)}}"><i class="icon-heart"></i></a> -->
                                            <button title="Thêm Vào Yêu Thích" class="addWishlist" data-id="{{$item->id}}"><i class="icon-heart"></i></button>
                                            <button title="Xem Nhanh" data-toggle="modal" data-target="#exampleModal" onclick="productview(this.id)" class="preview" id="{{($item->id)}}"><i class="icon-eye"></i></button>
                                            <!-- <button title="Quick View" data-toggle="modal" data-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button> -->
                                            <!-- <button title="Compare"><i class="icon-refresh"></i></button> -->
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3">
                                        <h3><a class="red" href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <?php 
                                   $idrate = $item->id;

                                   $five = DB::table('ratings')->where('rate',5)->where('product_id',$idrate)->get();
                                   $four = DB::table('ratings')->where('rate',4)->where('product_id',$idrate)->get();
                                   $three = DB::table('ratings')->where('rate',3)->where('product_id',$idrate)->get();
                                   $two = DB::table('ratings')->where('rate',2)->where('product_id',$idrate)->get();
                                   $one = DB::table('ratings')->where('rate',1)->where('product_id',$idrate)->get();

                                   $sum = DB::table('ratings')->where('product_id',$idrate)->get();

                                   if($sum->count() != 0){
                                       $perfive = $five->count()*100/$sum->count();
                                       $perfour = $four->count()*100/$sum->count();
                                       $perthree = $three->count()*100/$sum->count();
                                       $pertwo = $two->count()*100/$sum->count();
                                       $perone = $one->count()*100/$sum->count();

                                       $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                       $aveg = round($sumstar/$sum->count()); 
                                             $aveg2 = round($sumstar/$sum->count(),1); 
                                   }else {
                                     $perfive = 0;
                                     $perfour = 0;
                                     $perthree = 0;
                                     $pertwo = 0;
                                     $perone = 0;

                                     $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                     $aveg = 0; 
                                     $aveg2 = 0;
                                 }


                                 ?>
                                    <div class="product-rating-4">
                                        @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                            </div>
                                            <span>
                                                ({{$aveg2}})
                                            </span>
                                        </div>
                                        <div class="product-price-4">
                                            @if($item->discount_price == null)
                                            <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                            @else
                                            <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                            <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                        <h3><a class="red" href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                                        <div class="product-rating-wrap-2">
                                            <div class="product-rating-4">
                                                @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                            </div>
                                            <span>
                                                ({{$aveg2}})
                                            </span>
                                        </div>
                                        <div class="product-price-4">
                                            @if($item->discount_price == null)
                                            <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                            @else
                                            <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                            <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                            @endif
                                        </div>
                                        <div class="pro-add-to-cart-2">
                                            <button title="Thêm Vào Giỏ Hàng" class="addcart" data-id="{{($item->id)}}">Thêm vào giỏ hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="download-app-area pb-120">
            <div class="container">
                <div class="bg-img" style="background-image:url(assets/images/bg/bg-3.jpg);">
                    <div class="download-app-content">
                        <h2>Download Norda <br>App Now!</h2>
                        <p>Shopping faster with our app.</p>
                        <div class="app-img">
                            <a href="#"><img src="{{ asset('frontend/assets/images/icon-img/app-1.png')}}" alt=""></a>
                            <a href="#"><img src="{{ asset('frontend/assets/images/icon-img/app-2.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <button title="Add to Cart" data-toggle="modal" data-target="#exampleModal" onclick="productview(this.id)" class="addcart" id="{{($item->id)}}">Thêm vào giỏ hàng</button> -->
        <!-- Modal Product-->
<div class="modal fade cartmodal" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Mua Nhanh Sản Phẩm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12 col-sm-12">
                            <!-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" id="imgpre">

                                <div class="carousel-item active">
                                  <img class="d-block w-100" src="{{ asset('frontend/assets/images/product-details/large-1.jpg')}}">
                                  </div>
                              </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                                </a>
                            </div> -->
                            <div class="tab-content quickview-big-img" id="imgpre">
                                <!-- <div id="pro-1" class="tab-pane fade show active">
                                    <img src="{{ asset('frontend/assets/images/product/product-1.jpg')}}" alt="">
                                </div> -->
                            </div>
                            <div class="quickview-wrap mt-15 ">
                                <div class="quickview-slide-active nav-style-6" id="imgpremini">
                                    <!-- <a class="active" data-toggle="tab" href="#pro-1"><img src="{{ asset('frontend/assets/images/product/quickview-s1.jpg')}}" alt=""></a>
                                    <a data-toggle="tab" href="#pro-2"><img src="{{ asset('frontend/assets/images/product/quickview-s2.jpg')}}" alt=""></a>
                                    <a data-toggle="tab" href="#pro-3"><img src="{{ asset('frontend/assets/images/product/quickview-s3.jpg')}}" alt=""></a>
                                    <a data-toggle="tab" href="#pro-4"><img src="{{ asset('frontend/assets/images/product/quickview-s2.jpg')}}" alt=""></a> -->
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-7 col-md-6 col-12 col-sm-12">
                        <div class="product-details-content pro-details-content-mrg">
                            <h2 id="productname"></h2>
                            <!-- <div class="product-ratting-review-wrap">
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
                            </div> -->
                            <!-- <p id="desc">{!!}</p> -->
                            <div class="product-details-meta">
                                <ul>
                                    <li><span style="width: 115px;">Mã Sản Phẩm:</span> <a id="codeproduct"></a></li>
                                    <li><span style="width: 90px;">Danh Mục:</span> <a id="cate"></a> <a id="subcate"></a></li>
                                    <li><span style="width: 90px;">Tình trạng:</span> <a id="stock"></a></li>
                                </ul>
                            </div>
                            <div class="pro-details-price" id="modalprice">
                                <!-- <span class="new-price" id="newprice"></span><span class="new-price"> ₫</span> -->
                                <!-- <span class="old-price">95.72</span><span class="old-price m-0">₫</span> -->
                            </div>
                            <form action="#" method="POST" id="form_quick_cart">
                                <input type="hidden" name="productid" id="productid">
                            <div class="pro-details-size">
                                <span>Màu:</span>
                                <div class="pro-details-size-content">
                                    <ul>
                                        <!-- <li><a href="#">XS</a></li>
                                        <li><a href="#">S</a></li>
                                        <li><a href="#">M</a></li>
                                        <li><a href="#">L</a></li>
                                        <li><a href="#">XL</a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="pro-details-quality">
                                <span>Số Lượng:</span>
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" disabled="" type="number" id="quantity" name="qtybutton" value="1">
                                </div>
                            </div>
                            <div class="pro-details-action-wrap">
                                <div class="pro-details-add-to-cart mt-2">
                                    <a title="Add to Cart" href="#" type="button" onclick="insertCart()">Thêm Vào Giỏ </a>
                                </div>
                            </form>
                                <div class="pro-details-action">
                                    <button title="Thêm Vào Yêu Thích" type="button" class="addWishlist idproduct" id=""><i class="icon-heart"></i></button>
                                    <!-- <a title="Add to Wishlist" href="#"><i class="icon-heart"></i></a> -->
                                    <!-- <a title="Add to Compare" href="#"><i class="icon-refresh"></i></a> -->
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
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
</div>
</div>
       <!--  <div class="subscribe-area bg-gray-4 pt-95 pb-95">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="section-title-3">
                            <h2>Our Newsletter</h2>
                            <p>Get updates by subscribe our weekly newsletter</p>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div id="mc_embed_signup" class="subscribe-form-2">
                            <form id="mc-embedded-subscribe-form" class="validate subscribe-form-style-2" novalidate="" target="_blank" name="mc-embedded-subscribe-form" method="post" action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef">
                                <div id="mc_embed_signup_scroll" class="mc-form-2">
                                    <input class="email" type="email" required="" placeholder="Enter your email address" name="EMAIL" value="">
                                    <div class="mc-news-2" aria-hidden="true">
                                        <input type="text" value="" tabindex="-1" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef">
                                    </div>
                                    <div class="clear-2 clear-2-blue">
                                        <input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe" value="Subscribe">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
@endsection
@push('js')
<script src="{{ asset('js/frontend/autonumeric.min.js')}}"></script>
<!-- <script src="{{ asset('js/frontend/index.js')}}"></script> -->
<!-- <script type="text/javascript">
    new AutoNumeric('#newprice', {
        decimalPlaces: '2',
        decimalCharacter: ',',
        digitGroupSeparator:'.'
    })
</script> -->
@endpush