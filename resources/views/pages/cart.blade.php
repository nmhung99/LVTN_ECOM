@extends('layouts.main')

@section('content')
<div class="cart-main-area pt-15 pb-120 mb-5">
            <div class="container">
                <h3 class="cart-page-title">Giỏ Hàng Của Bạn</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form  action="#" method="POST" id="form_cart_update">
                            <div class="table-content table-responsive cart-table-content">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Ảnh Sản Phẩm</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Đơn Giá</th>
                                            <th>Số Lượng</th>
                                            <th>Màu Sắc</th>
                                            <th>Tổng Tiền</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(Cart::count() == 0)
                                        <td colspan="7">Không Có Sản Phẩm Nào</td>
                                        @else
                                        @foreach($cart as $item)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="{{asset('/product/details/'.$item->id.'/'.$item->name)}}"><img src="{{ asset($item->options->image)}}" width="100%" alt=""></a>
                                                <input type="hidden" name="{{'imgproduct'.$item->rowId}}" value="{{ $item->options->image}}">
                                            </td>
                                            <td class="product-name"><a href="{{asset('/product/details/'.$item->id.'/'.$item->name)}}">{{ $item->name}}</a></td>
                                            <td class="product-price-cart"><span class="amount">{{ number_format($item->price) }}</span></td>
                                            <td class="product-quantity pro-details-quality">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" id="quantity" type="number" name="{{'qtybutton'.$item->rowId}}" value="{{ $item->qty}}">
                                                </div>
                                            </td>
                                            <td>
                                                <select name="{{'color_product'.$item->rowId}}" id="" style="text-transform: capitalize;">
                                                    @php
                                                        $product = DB::table('products')->where('id',$item->id)->first();
                                                        $color = $product->product_color;
                                                        $procolor = explode(',', $color);
                                                    @endphp
                                                    @foreach($procolor as $item2)
                                                    <option style="text-transform: capitalize;" value="{{$item2}}" {{$item2 === $item->options->color ? 'selected' : ''}}>{{$item2}}</option>
                                                    @endforeach
                                                    <input type="hidden" name="productid[]" value="{{$item->rowId}}">
                                                </select>
                                                <!-- {{ $item->options->color}} -->
                                            </td>
                                            <td class="product-subtotal">{{ number_format($item->qty*$item->price)}} ₫</td>
                                            <td class="product-remove">
                                                <a href="{{asset('/remove/cart/'.$item->rowId)}}"><i class="icon_close"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-shiping-update">
                                            <a href="/">Tiếp Tục Mua Sắm</a>
                                        </div>
                                        <div class="cart-clear">
                                            <button type="button" onclick="updateCart()">Cập Nhật Giỏ Hàng</button>
                                            <a href="#">Xóa Toàn Bộ Giỏ Hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <!-- <div class="col-lg-4 col-md-6">
                                <div class="cart-tax">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                                    </div>
                                    <div class="tax-wrapper">
                                        <p>Enter your destination to get a shipping estimate.</p>
                                        <div class="tax-select-wrapper">
                                            <div class="tax-select">
                                                <label>
                                                    * Country
                                                </label>
                                                <select class="email s-email s-wid">
                                                    <option>Bangladesh</option>
                                                    <option>Albania</option>
                                                    <option>Åland Islands</option>
                                                    <option>Afghanistan</option>
                                                    <option>Belgium</option>
                                                </select>
                                            </div>
                                            <div class="tax-select">
                                                <label>
                                                    * Region / State
                                                </label>
                                                <select class="email s-email s-wid">
                                                    <option>Bangladesh</option>
                                                    <option>Albania</option>
                                                    <option>Åland Islands</option>
                                                    <option>Afghanistan</option>
                                                    <option>Belgium</option>
                                                </select>
                                            </div>
                                            <div class="tax-select">
                                                <label>
                                                    * Zip/Postal Code
                                                </label>
                                                <input type="text">
                                            </div>
                                            <button class="cart-btn-2" type="submit">Get A Quote</button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-lg-4 col-md-6 offset-lg-4">
                                <div class="discount-code-wrapper">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gray">Sử Dụng Mã Giảm Giá</h4>
                                    </div>
                                    <div class="discount-code">
                                        <p>Nhập Mã Giảm Giá (Nếu Có).</p>
                                        <form id="form_coupon" method="POST" action="#">
                                            <input type="text" required="" name="coupon">
                                            <button class="cart-btn-2" type="button" onclick="addCoupon()">Áp Dụng Mã Giảm Giá</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                @php
                                    $setting = DB::table('settings')->first();
                                    $ship = $setting->shipping_charge;
                                    $vat  = ($setting->vat)/100;
                                @endphp
                                @if(Session::has('coupon'))
                                <div class="grand-totall">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gary-cart">Tổng Tiền</h4>
                                    </div>
                                    <h5>Tạm Tính <span>{{Cart::subtotal()}} ₫</span></h5>

                                    <h5>Mã Giảm Giá ({{Session::get('coupon')['name']}}) <span>- {{Session::get('coupon')['discount']}} %</span><a href="{{ route('remove.coupon')}}" class="coupon">X</a></h5>
                                    <div class="total-shipping">
                                    @if(Cart::count() == 0)
                                        
                                    @else
                                    <h5>Thuế <span> {{$vat*100}} %</span></h5>
                                    <div class="total-shipping">

                                        <h5>Phí Vận Chuyển<span>{{number_format($ship)}} ₫</span></h5>
                                    </div>
                                    @endif
                                    <h4 class="grand-totall-title">Tổng: 
                                        @php
                                            $code = Session::get('coupon')['name'];
                                            $coupon = DB::table('coupons')->where('coupon',$code)->first();
                                            $discount = Cart::subtotal(0, '.', '') - ($coupon->discount*Cart::subtotal(0, '.', '')/100);
                                        @endphp
                                        <span>  {{number_format($discount + $ship + $discount*$vat)}} ₫</span>
                                    </h4>
                                    <a href="{{ route('user.checkout')}}">Tiến Hành Thanh Toán</a>
                                </div>
                                @else
                                <div class="grand-totall">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gary-cart">Tổng Tiền</h4>
                                    </div>
                                    <h5>Tạm Tính <span>{{Cart::subtotal()}} ₫</span></h5>
                                    @if(Cart::count() == 0)
                                        <h4 class="grand-totall-title">Tổng: <span>{{number_format( Cart::subtotal(0,'.','') + Cart::subtotal(0,'.','')*$vat)}} ₫</span></h4>
                                        <a>Tiến Hành Thanh Toán</a>
                                    @else
                                    <h5>Thuế <span> {{$vat*100}} %</span></h5>
                                    <div class="total-shipping">
                                        <div class="total-shipping">
                                            <h5>Phí Vận Chuyển<span>{{number_format($ship)}} ₫</span></h5>
                                        </div>
                                    </div>
                                    <h4 class="grand-totall-title">Tổng: <span>{{number_format( Cart::subtotal(0,'.','') + $ship + Cart::subtotal(0,'.','')*$vat)}} ₫</span></h4>
                                    <a href="{{ route('user.checkout')}}">Tiến Hành Thanh Toán</a>
                                    @endif
                                    
                                    <!-- <h4 class="grand-totall-title">Tổng: <span>{{number_format( Cart::subtotal(0,'.','') + $ship + Cart::subtotal(0,'.','')*$vat)}} ₫</span></h4> -->
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('js')
<script src="{{ asset('js/frontend/cart.js')}}"></script>
@endpush