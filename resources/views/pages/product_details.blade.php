@extends('layouts.main')
@push('css')

<link href="{{ asset('plugins/bootstrap-rating/bootstrap-rating.css')}}" rel="stylesheet" type="text/css">

<link href="{{ asset('backend/assets/css/style.css')}}" rel="stylesheet" type="text/css">
@endpush
@section('content')
<style type="text/css">
    body{
        background-color: white !important;
    }
    .rating-symbol-foreground {
      top: 0px;
    }
    .badge:empty {
      padding: 0;
    }
    .text-primary {
        color: #ff2f2f !important;
    }
    .gray{
        color: gray !important;
    }
    .code_product span{
        display: inline-block;
    }
</style>
<div class="product-details-area pt-50 pb-115">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details-tab">
                    <?php 
                        $image = json_decode($product->image);
                     ?>
                    <div class="pro-dec-big-img-slider">
                        @foreach($image as $item)
                        <div class="easyzoom-style">
                            <div class="easyzoom easyzoom--overlay">
                                <a>
                                    <img src="{{asset($item)}}" alt="">
                                </a>
                            </div>
                            <a class="easyzoom-pop-up img-popup" href="{{asset($item)}}"><i class="icon-size-fullscreen"></i></a>
                        </div>
                        @endforeach
                    </div>
                    <div class="product-dec-slider-small product-dec-small-style1">
                        @foreach($image as $item)
                        <div class="product-dec-small active">
                            <img src="{{asset($item)}}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product-details-content pro-details-content-mrg">
                    <h2>{{$product->product_name}}</h2>
                    <div class="product-ratting-review-wrap">
                        <div class="product-ratting-digit-wrap">
                            <?php 
                            $idrate = $product->id;

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
                         <div class="product-ratting">
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
                            <div class="product-digit">
                                ({{$aveg2}})
                            </div>
                        </div>
                        <div class="product-review-order">
                            <span>{{$sum->count()}} Đánh Giá</span>
                            @php
                                $countorder = DB::table('orders_details')->where('product_id',$product->id)->count();
                                $checkqty = DB::table('products')->where('id',$product->id)->first();
                            @endphp
                            <span>{{$countorder}} Đã Bán</span>
                        </div>
                    </div>
                    <div class="code_product">
                        <ul>
                            <li><span class="m-0">Mã Sản Phẩm:</span> <a id="cate">{{$product->product_code}}</a></li>
                            @if($checkqty->product_quantity == 0)
                            <li><span >Tình trạng:</span> <a id="stock"><span class="badge badge-danger" style="font-size: 14px">Hết Hàng</span></a></li>
                            @else
                            <li><span >Tình trạng:</span> <a id="stock"><span class="badge badge-success" style="font-size: 14px">Có Sẵn</span></a></li>
                            @endif
                            
                        </ul>
                    </div>
                    <!-- <p>Seamlessly predominate enterprise metrics without performance based process improvements.</p> -->
                    <div class="pro-details-price">
                        @if($product->discount_price == null)
                        <span class="new-price">{{number_format($product->selling_price)}} ₫</span>
                        <!-- <span class="old-price">ss</span> -->
                        @else
                        <span class="new-price">{{number_format($product->discount_price)}} ₫</span>
                        <span class="old-price">{{number_format($product->selling_price)}} ₫</span>
                        @endif
                        <!-- <span class="new-price">$75.72</span>
                        <span class="old-price">$95.72</span> -->
                    </div>
                    <!-- <div class="pro-details-color-wrap">
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
                    </div> -->
                    <form action="#" method="POST" id="form_cart">
                    <div class="pro-details-size">
                        <span>Màu:</span>
                        <div class="pro-details-size-content">
                            <ul>
                                @foreach($product_color as $item)
                                <li>
                                    <a style="text-transform: capitalize;">{{ $item }}</a>
                                    <input type="hidden" value="{{ $item }}">
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="pro-details-quality">
                        <span>Quantity:</span>
                        <div class="cart-plus-minus">
                            <input class="cart-plus-minus-box" disabled="" type="number" id="quantity" name="qtybutton" value="1">
                        </div>
                    </div>
                    <div class="product-details-meta">
                        <ul>
                            <li><span>Danh Mục:</span> <a href="#">{{$product->category_name}}</a>
                            @if($product->subcategory_name !== NULL)
                            <a href="#">> {{$product->subcategory_name}}</a>
                            @endif  </li>
                            <!-- <li><span>Tag: </span> <a href="#">Fashion,</a> <a href="#">Mentone</a> , <a href="#">Texas</a></li> -->
                        </ul>
                    </div>
                    <div class="pro-details-action-wrap">
                        <div class="pro-details-add-to-cart">
                            <a title="Add to Cart" id="{{$product->id}}" onclick="addProductCart(this.id)" href="#"> Thêm Vào Giỏ </a>
                        </div>
                        <div class="pro-details-action">
                            <button title="Thêm Vào Yêu Thích" type="button" class="addWishlist" data-id="{{$product->id}}"><i class="icon-heart"></i></button>
                            <!-- <a title="Add to Compare" href="#"><i class="icon-refresh"></i></a> -->
                            <!-- <a class="social" title="Social" href="#"><i class="icon-share"></i></a> -->
                            <!-- <div class="product-dec-social"> -->

                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                
                    <!-- <div class="addthis_inline_share_toolbox"></div> -->
                
                            
            
                                <!-- <a class="facebook" title="Facebook" href="#"><i class="icon-social-facebook"></i></a>
                                <a class="twitter" title="Twitter" href="#"><i class="icon-social-twitter"></i></a>
                                <a class="instagram" title="Instagram" href="#"><i class="icon-social-instagram"></i></a>
                                <a class="pinterest" title="Pinterest" href="#"><i class="icon-social-pinterest"></i></a> -->
                            <!-- </div> -->
                        </div>
                        <div class="mt-4">
                            <label class="" for="">Chia Sẻ Sản Phẩm Này: </label>
                        <div class="addthis_inline_share_toolbox"></div>
                        </div>
                        
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="related-product pb-115">
    @php
        $relate = DB::table('products')->where('category_id',$product->category_id)->where('id','!=',$product->id)->orderBy('id','DESC')->limit(6)->get();
    @endphp
    <div class="container">
        <div class="section-title mb-45 text-center">
            <h2>Sản Phẩm Liên Quan</h2>
        </div>
        <div class="related-product-active">
            @foreach($relate as $item)
            <div class="product-plr-1">
                <div class="single-product-wrap">
                    <div class="product-img product-img-zoom mb-15">
                        <?php 
                            $imagerelate = json_decode($item->image)
                        ?>
                        <a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">
                            <img src="{{asset($imagerelate[0])}}" alt="">
                        </a>
                        @if($item->discount_price !== NULL)
                                        @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = $amount/$item->selling_price*100;
                                        @endphp
                                            <span class="pro-badge right bg-red">{{number_format($discount)}}%</span>
                                        @endif
                        <!-- <div class="product-action-2 tooltip-style-2">
                            <button title="Wishlist"><i class="icon-heart"></i></button>
                            <button title="Quick View" data-toggle="modal" data-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                            <button title="Compare"><i class="icon-refresh"></i></button>
                        </div> -->
                    </div>
                    <div class="product-content-wrap-2 text-center">
                        <div class="product-rating-wrap">
                            <?php 
                            $idrate = $product->id;

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
                            <div class="product-rating">
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
                        <h3><a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                        <div class="product-price-2">
                            @if($item->discount_price == null)
                            <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                            <!-- <span class="old-price">ss</span> -->
                            @else
                            <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                            <span style="display: inline-block;" class="old-price">{{number_format($item->selling_price)}} ₫</span>
                            @endif
                        </div>
                    </div>
                    <div class="product-content-wrap-2 product-content-position text-center">
                        <div class="product-rating-wrap">
                            <div class="product-rating">
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
                        <h3><a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                        <div class="product-price-2">
                            @if($item->discount_price == null)
                            <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                            <!-- <span class="old-price">ss</span> -->
                            @else
                            <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                            <span style="display: inline-block;" class="old-price">{{number_format($item->selling_price)}} ₫</span>
                            @endif
                        </div>
                        <div class="pro-add-to-cart">
                            <button title="Thêm Vào Giỏ" class="addcart" data-id="{{($item->id)}}">Thêm Vào Giỏ</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


<div class="description-review-wrapper pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dec-review-topbar nav mb-45">
                    <a class="active" data-toggle="tab" href="#des-details1">Giới Thiệu Sản Phẩm</a>
                    <a data-toggle="tab" href="#des-details2">Chi Tiết Sản Phẩm</a>
                    @if ($product->video_link !== NULL)
                    <a data-toggle="tab" href="#des-details3">Video Sản Phẩm </a>
                    @endif
                    <a data-toggle="tab" href="#des-details4"> Nhận Xét Và Đánh Giá </a>
                </div>
                <div class="tab-content dec-review-bottom">
                    <div id="des-details1" class="tab-pane active">
                        <div class="description-wrap">
                                {!!$product->product_desc!!}
                        </div>
                    </div>
                    <div id="des-details2" class="tab-pane">
                        <div class="specification-wrap table-responsive">
                            {!!$product->product_details!!}
                        </div>
                    </div>
                    <div id="des-details3" class="tab-pane" style="margin: 0 auto;">
                        <div class="specification-wrap table-responsive" style="margin: 0 auto;">
                            <!-- <table>
                                <tbody>
                                    <tr>
                                        <td class="title width1">Top</td>
                                        <td>Cotton Digital Print Chain Stitch Embroidery Work</td>
                                    </tr>
                                    <tr>
                                        <td class="title width1">Bottom</td>
                                        <td>Cotton Cambric</td>
                                    </tr>
                                    <tr>
                                        <td class="title width1">Dupatta</td>
                                        <td>Digital Printed Cotton Malmal With Chain Stitch</td>
                                    </tr>
                                </tbody>
                            </table> -->
                            @php
                                $link = explode('/', $product->video_link);
                                $codeembed = array_pop($link);
                            @endphp
                            <iframe style="margin: 0 auto;" width="100%" height="700px" src="{{asset('https://www.youtube.com/embed/'.$codeembed)}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div id="des-details4" class="tab-pane">
                            <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="5"></div>
                        
                        <div class="ratting-form-wrapper">
                            <span>Thêm Đánh Giá</span>
                            <!-- <p>Your email address will not be published. Required fields are marked <span>*</span></p> -->
                            <div class="ratting-form">
                                <form action="#" id="form_rating" method="POST">
                                    <div class="row">
                                        <!-- <div class="col-lg-6 col-md-6">
                                            <div class="rating-form-style mb-20">
                                                <label>Name <span>*</span></label>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="rating-form-style mb-20">
                                                <label>Email <span>*</span></label>
                                                <input type="email">
                                            </div>
                                        </div> -->
                                        <div class="col-lg-12">
                                            <?php 
                                            $idrate = $product->id;

                                            $five = DB::table('ratings')->where('rate',5)->where('product_id',$idrate)->get();
                                            $four = DB::table('ratings')->where('rate',4)->where('product_id',$idrate)->get();
                                            $three = DB::table('ratings')->where('rate',3)->where('product_id',$idrate)->get();
                                            $two = DB::table('ratings')->where('rate',2)->where('product_id',$idrate)->get();
                                            $one = DB::table('ratings')->where('rate',1)->where('product_id',$idrate)->get();

                                            $sum = DB::table('ratings')->where('product_id',$idrate)->get();

                                            if($sum->count() !== 0){
                                               $perfive = $five->count()*100/$sum->count();
                                               $perfour = $four->count()*100/$sum->count();
                                               $perthree = $three->count()*100/$sum->count();
                                               $pertwo = $two->count()*100/$sum->count();
                                               $perone = $one->count()*100/$sum->count();

                                               $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                               $aveg = round($sumstar/$sum->count(),1); 
                                           } else {
                                               $perfive = 0;
                                               $perfour = 0;
                                               $perthree = 0;
                                               $pertwo = 0;
                                               $perone = 0;

                                               $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                               $aveg = 0; 
                                           }


                                           ?>
                                            <div class="star-box-wrap">
                                                <div class="col-md-3 col-xl-3">
                                                    <h4 style="margin:0">Sao Trung Bình</h4>
                                                    <div class="mt-20">
                                                        @if($five->count() == 0)
                                                        <span>5<i class="fas fa-star" style="color: red;"></i></span>
                                                        @else
                                                        <span>5<i class="fas fa-star" style="color: red;"></i> ({{$five->count()}})</span>
                                                        @endif
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$perfive}}%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        @if($four->count() == 0)
                                                        <span>4<i class="fas fa-star" style="color: red;"></i></span>
                                                        @else
                                                        <span>4<i class="fas fa-star" style="color: red;"></i> ({{$four->count()}})</span>
                                                        @endif
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$perfour}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        @if($three->count() == 0)
                                                        <span>3<i class="fas fa-star" style="color: red;"></i></span>
                                                        @else
                                                        <span>3<i class="fas fa-star" style="color: red;"></i> ({{$three->count()}})</span>
                                                        @endif
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$perthree}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        @if($two->count() == 0)
                                                        <span>2<i class="fas fa-star" style="color: red;"></i></span>
                                                        @else
                                                        <span>2<i class="fas fa-star" style="color: red;"></i> ({{$two->count()}})</span>
                                                        @endif
                                                        <div class="progress mb-2">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$pertwo}}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        @if($one->count() == 0)
                                                        <span>1<i class="fas fa-star" style="color: red;"></i></span>
                                                        @else
                                                        <span>1<i class="fas fa-star" style="color: red;"></i> ({{$one->count()}})</span>
                                                        @endif
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$perone}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-20">
                                                        <span style="color: red; font-size: 50px;">{{$aveg}}</span><i class="fas fa-star" style="color: red; font-size: 45px;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-xl-3">
                                                    <h4 style="margin:0">Đánh Giá Sao</h4>
                                                    <div class="mt-20">
                                                        <input type="hidden" onkeypress="removeMessage($(this))" name="ratingstar" class="rating" data-filled="mdi mdi-star font-32 text-primary" data-empty="mdi mdi-star-outline font-32 text-muted" />
                                                        <span class="text-danger" id="ratingstar_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4  style="margin:0">Nội dung đánh giá<span>*</span></h4>
                                                    <div class="rating-form-style mb-20 mt-20">
                                                        <textarea onkeypress="removeMessage($(this))" name="contentreview"></textarea>
                                                        <span class="text-danger" id="contentreview_error"></span>
                                                    </div>
                                                    <input type="hidden" name="ipproduct" value="{{$product->id}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-submit">
                                                <button type="button" class="btn btn-danger" onclick="postRate()">Đăng</button>
                                                <!-- <input type="submit" value="Submit"> -->
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="review-wrapper pt-30">
                            <h2>Tất Cả Đánh Giá</h2>
                                @php
                                    $rating = DB::table('ratings')->where('product_id',$product->id)->get();
                                @endphp
                                @foreach($rating as $item)
                            <div class="single-review">
                                <div class="review-img">
                                    <img width="100%" src="{{ asset('frontend/assets/images/user/account.png')}}" alt="">
                                </div>
                                <div class="review-content">
                                    @php
                                        $name_user = DB::table('users')->where('id',$item->user_id)->first();
                                    @endphp
                                    <div class="review-top-wrap">
                                        <div class="review-name">
                                            <h5><span>{{$name_user->name}}</span> {{$item->created_at}}</h5>
                                        </div>
                                        <div class="review-rating pl-4">
                                            @if($item->rate == 1)
                                            <i class="yellow icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            @elseif($item->rate == 2)
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            @elseif($item->rate == 3)
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            @elseif($item->rate == 4)
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            <i class="icon_star"></i>
                                            @else
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            <i class="yellow icon_star"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <p>{{ $item->content}}</p>
                                </div>
                            </div>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('plugins/bootstrap-rating/bootstrap-rating.min.js')}}"></script>
<script src="{{ asset('backend/assets/pages/rating-init.js')}}"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools --> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-60731c354e0b5cd4"></script>
<script src="{{ asset('js/frontend/product_details.js')}}"></script>
<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="0ONSdqwT"></script> -->
@endpush