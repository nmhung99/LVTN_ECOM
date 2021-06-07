@php
    $slider = DB::table('products')
    ->leftJoin('brands','products.brand_id','brands.id')
    ->select('products.*','brands.brand_name')
    ->where('main_slider',1)->orderBy('id','DESC')->get();

    $slider1 = DB::table('sliders')->where('status',1)->where('location',1)->get();
@endphp
<!-- <div class="slider-area pt-25 bg-white">
    <div class="container">
        <div class="hero-slider-active-2 nav-style-1 nav-style-1-modify nav-style-1-blue">
            @foreach($slider as $item)
            <div class="single-hero-slider slider-height-4 custom-d-flex custom-align-item-center single-animation-wrap">
                <div class="row align-items-center slider-animated-1">
                    <div class="col-lg-6 col-md-6 col-12 col-sm-6">
                        <div class="hero-slider-content-5">
                            <h5 class="animated">{{strtoupper($item->brand_name)}}</h5>
                            <h1 class="animated">{{ strtoupper($item->product_name)}}</h1>
                            @if($item->discount_price == null)
                            <p class="animated">Giá Bán</p>
                            <h3 class="animated" style="color: red;">{{number_format($item->selling_price)}} ₫</h3>
                            @else
                            <p class="animated">Giá Gốc</p>
                            <h3 class="animated"><del class="animated">{{number_format($item->selling_price)}} ₫</del></h3>
                            <p class="animated">Giá Khuyến Mãi</p>
                            <h3 class="animated" style="color: red;">{{number_format($item->discount_price)}} ₫</h3>
                            @endif
                            <div class="btn-style-1 mt-3">
                                <a class="animated btn-1-padding-4 btn-1-blue btn-1-font-14" href="product-details.html">Mua Ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 col-sm-6">
                        <div class="hm7-hero-slider-img">
                            <?php $image = json_decode($item->image) ?>
                            <img class="animated" src="{{asset($image[0])}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-slider slider-height-4 custom-d-flex custom-align-item-center single-animation-wrap">
                <div class="row align-items-center slider-animated-1">
                    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                        <div class="hm7-hero-slider-img">
                            <?php $image = json_decode($item->image) ?>
                            <img class="animated" src="{{asset('frontend/assets/images/banner/bann1.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div> -->
<style type="text/css">
    .hero-slider-active-3{
        overflow: hidden;
    }
        .slick-prev{
    background:#cccccc4d;
    width:80px;
    height:80px;
    border-radius: 50%;
    border:none;
    position:absolute;
    z-index: 1;
    cursor: pointer !important;
    left:-80px;
    top:50%;
    -ms-transform: translateY(-50%); /* IE 9 */
    -webkit-transform: translateY(-50%); /* Safari */
    transform: translateY(-50%);
    opacity: 0;
    transition: .5s;
    }
        .slick-next{
    background:#cccccc4d;
    width:80px;
    height:80px;
    border-radius: 50%;
    border:none;
    position:absolute;
    right:-80px;
    top:50%;
    -ms-transform: translateY(-50%); /* IE 9 */
    -webkit-transform: translateY(-50%); /* Safari */
    transform: translateY(-50%);
    opacity: 0;
    transition: .5s;
    }
    .slick-prev:before {
      content: "<";
      margin-right: -30px;
      color: red;
      font-size: 30px;
  }

  .slick-next:before {
      content: ">";
      margin-left: -30px;
      color: red;
      font-size: 30px;
  }
    .hero-slider-active-3:hover .slick-next{
        opacity: 1;
        right:-40px;
    }
    .hero-slider-active-3:hover .slick-prev{
        opacity: 1;
        left:-40px;
    }       
</style>
<div class="slider-banner-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                        <div class="slider-area bg-gray mb-30">
                                        <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="hero-slider-content-1 slider-animated-1 hero-slider-content-1-padding1">
                                                @if($item->brand_name !== null)
                                                <h4 class="animated font-dec">{{strtoupper($item->brand_name)}}</h4>
                                                @else
                                                @endif
                                                <h3 class="animated font-dec">{{strtoupper($item->product_name)}}</h3>
                                                @if($item->discount_price == null)
                                                <span class="animated">Giá Bán</span>
                                                <h3 class="animated mb-4" style="color: red;">{{number_format($item->selling_price)}} ₫ </h3>
                                                @else
                                                <span class="animated width-inc">Giá Gốc</span>
                                                <h3 class="animated"><del class="animated">{{number_format($item->selling_price)}} ₫</del></h3>
                                                <span class="animated width-inc">Giá Khuyến Mãi</span>
                                                <h3 class="animated width-inc mb-4" style="color: red;">{{number_format($item->discount_price)}} ₫</h3>
                                                @endif
                                                <div class="btn-style-1">
                                                    <a class="animated btn-1-padding-1 btn-1-bg-red" href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">Mua Ngay</a>
                                                </div>
                                            </div>
                                        </div> -->
                            <div class="hero-slider-active-3 dot-style-2 dot-style-2-position-4 dot-style-2-active-purple">
                                @foreach($slider1 as $item)
                                <div class="single-hero-slider single-animation-wrap">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="hm6-hero-slider-img slider-animated-1">
                                                <a href="{{$item->link}}"><img class="animated" src="{{ asset($item->image)}}" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            
            <div class="col-lg-4">
                <div class="row">
                    @php
                        $banner2 = DB::table('sliders')->where('status',1)->where('location',2)->first();
                        $banner3 = DB::table('sliders')->where('status',1)->where('location',3)->first();
                    @endphp
                    <div class="col-lg-12 col-md-6">
                        <div class="banner-wrap mb-30">
                            <div class="banner-img banner-img-zoom">
                                <a href="{{$banner2->link}}"><img src="{{ !empty($banner2->image) ? asset($banner2->image) : '/media/default2.png'}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="banner-wrap mb-30">
                            <div class="banner-img banner-img-zoom">
                                <a href="{{$banner2->link}}"><img src="{{ !empty($banner3->image) ? asset($banner3->image) : '/media/default2.png'}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>