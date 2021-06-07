 <!-- @if(Session::has('coupon'))
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
                                    <h4 class="grand-totall-title">Tổng: <span> {{number_format(Session::get('coupon')['balance'] + $ship + Session::get('coupon')['balance']*$vat)}} ₫</span></h4>
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
                                    @endif -->
                                    
                                    <!-- <h4 class="grand-totall-title">Tổng: <span>{{number_format( Cart::subtotal(0,'.','') + $ship + Cart::subtotal(0,'.','')*$vat)}} ₫</span></h4> -->
                                <!-- </div>
                                @endif -->