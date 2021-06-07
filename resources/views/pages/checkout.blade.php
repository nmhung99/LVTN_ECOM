@extends('layouts.main')

@section('content')
<div class="checkout-main-area pt-20 pb-120">
            <div class="container">
                <div class="customer-zone mb-20">
                    <p class="cart-page-title">Bạn Có Mã Giảm Giá? <a class="checkout-click3" href="#">Click Vào Đây Để Nhập</a></p>
                    <div class="checkout-login-info3 discount-code">
                        <form action="#" method="POST" id="form_coupon">
                            <input type="text" name="coupon" placeholder="Mã Giảm Giá">
                            <button type="button" onclick="addCoupon()">Áp dụng mã</button> 
                        </form>
                    </div>
                </div>
                <form action="#" method="POST" id="form_payment">
                <div class="checkout-wrap pt-30">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="billing-info-wrap mr-50">
                                <h3>Chi Tiết Hóa Đơn</h3>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20">
                                            <label>Họ <abbr class="required" title="required">*</abbr></label>
                                            <input onchange="removeMessage($(this))" type="text" name="first_name">
                                            <span class="text-danger" id="first_name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20">
                                            <label>Tên <abbr class="required" title="required">*</abbr></label>
                                            <input onchange="removeMessage($(this))" type="text" name="last_name">
                                            <span class="text-danger" id="last_name_error"></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <div class="billing-info mb-20">
                                            <label>Company Name <abbr class="required" title="required">*</abbr></label>
                                            <input type="text">
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-lg-12">
                                        <div class="billing-select mb-20">
                                            <label>Country <abbr class="required" title="required">*</abbr></label>
                                            <select>
                                                <option>Select a country</option>
                                                <option>Azerbaijan</option>
                                                <option>Bahamas</option>
                                                <option>Bahrain</option>
                                                <option>Bangladesh</option>
                                                <option>Barbados</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20">
                                            <label>Địa Chỉ <abbr class="required" title="required">*</abbr></label>
                                            <input onchange="removeMessage($(this))" class="billing-address" placeholder="Số nhà và tên đường, thôn, xóm" type="text" name="address">
                                            <span class="text-danger" id="address_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20">
                                            <label>Tỉnh/Thành Phố <abbr class="required" title="required">*</abbr></label>
                                            <input onchange="removeMessage($(this))" type="text" name="city">
                                            <span class="text-danger" id="city_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-info mb-20">
                                            <label>Quận/Huyện <abbr class="required" title="required">*</abbr></label>
                                            <input onchange="removeMessage($(this))" type="text" name="state">
                                            <span class="text-danger" id="state_error"></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-12 col-md-12">
                                        <div class="billing-info mb-20">
                                            <label>Postcode / ZIP <abbr class="required" title="required">*</abbr></label>
                                            <input type="text">
                                        </div>
                                    </div> -->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-info mb-20">
                                            <label>Số Điện Thoại <abbr class="required" title="required">*</abbr></label>
                                            <input onchange="removeMessage($(this))" type="text" name="phone">
                                            <span class="text-danger" id="phone_error"></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-12 col-md-12">
                                        <div class="billing-info mb-20">
                                            <label>Email Address <abbr class="required" title="required">*</abbr></label>
                                            <input type="text">
                                        </div>
                                    </div> -->
                                </div>
                                <!-- <div class="checkout-account mb-25">
                                    <input class="checkout-toggle2" type="checkbox">
                                    <span>Create an account?</span>
                                </div> -->
                                <!-- <div class="checkout-account-toggle open-toggle2 mb-30">
                                    <label>Email Address</label>
                                    <input placeholder="Password" type="password">
                                </div> -->
                                <div class="additional-info-wrap">
                                    <label>Ghi Chú</label>
                                    <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="ordernote"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="your-order-area">
                                <h3>Đơn Hàng Của Bạn</h3>
                                <div class="your-order-wrap gray-bg-4">
                                    <div class="your-order-info-wrap">
                                        <div class="your-order-info">
                                            <ul>
                                                <li>Sản Phẩm <span>Giá Tiền</span></li>
                                            </ul>
                                        </div>
                                        <div class="your-order-middle">
                                                @foreach($cart as $item)
                                            <div class="row mb-3">
                                                <div class="col-7">
                                                    <p>{{$item->name}} x {{$item->qty}}</p>
                                                </div>
                                                <div class="col-5">
                                                    <span class="float-right" >{{number_format($item->price*$item->qty)}} vnđ</span>
                                                </div>
                                            </div>
                                            @endforeach
                                            <!-- <ul>
                                                <li><p class="col-7 mr-0 p-0">{{$item->name}}</p><span>{{number_format($item->price)}} vnđ</span></li>
                                                
                                            </ul> -->
                                        </div>
                                        @php
                                            $setting = DB::table('settings')->first();
                                            $ship = $setting->shipping_charge;
                                            $vat  = ($setting->vat)/100;
                                        @endphp
                                        <div class="your-order-info order-subtotal">
                                            <ul>
                                                <li>Tạm Tính <span>{{Cart::subtotal()}} vnđ </span></li>
                                            </ul>
                                        </div>
                                        <div class="your-order-info order-shipping">
                                            <ul>
                                                <li>Phí Vận Chuyển <span>{{number_format($ship)}} vnđ</span>
                                                </li>
                                            </ul>
                                        </div>
                                        @if(Session::has('coupon'))
                                        <div class="your-order-info order-shipping">
                                            <ul>
                                                <li>Mã Giảm Giá ({{Session::get('coupon')['name']}})<p> - {{Session::get('coupon')['discount']}} %</p> <a href="{{ route('remove.coupon')}}" class="btn btn-danger">X</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="your-order-info order-shipping">
                                            <ul>
                                                <li>Thuế <p> {{$vat*100}} %</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="your-order-info order-total">
                                            <ul>
                                                <li>Tổng Tiền 
                                                    <span>
                                                        @php
                                                            $code = Session::get('coupon')['name'];
                                                            $coupon = DB::table('coupons')->where('coupon',$code)->first();
                                                            $discount = Cart::subtotal(0, '.', '') - ($coupon->discount*Cart::subtotal(0, '.', '')/100);
                                                        @endphp
                                                        {{number_format($discount + $ship + $discount*$vat)}} vnđ
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        @else
                                        <div class="your-order-info order-shipping">
                                            <ul>
                                                <li>Mã Giảm Giá<p></p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="your-order-info order-shipping">
                                            <ul>
                                                <li>Thuế <p> {{$vat*100}} %</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="your-order-info order-total">
                                            <ul>
                                                <li>Tổng Tiền <span>{{number_format( Cart::subtotal(0,'.','') + $ship + Cart::subtotal(0,'.','')*$vat)}} vnđ</span></li>
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="payment-method">
                                        <div class="pay-top sin-payment">
                                            <input id="payment_method_1" class="input-radio" type="radio" value="stripe" checked="checked" name="payment_method">
                                            <label for="payment_method_1"> MasterCard </label>
                                            <div class="payment-box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.</p>
                                                <img width="50%" src="{{asset('frontend/assets/images/payment/mastercard.png')}}" alt="">
                                            </div>
                                        </div>
                                        <!-- <div class="pay-top sin-payment">
                                            <input id="payment-method-2" class="input-radio" type="radio" value="cheque" name="payment_method">
                                            <label for="payment-method-2">PayPal</label>
                                            <div class="payment-box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.</p>
                                            </div>
                                        </div> -->
                                        <div class="pay-top sin-payment">
                                            <input id="payment-method-3" class="input-radio" type="radio" value="cod" name="payment_method">
                                            <label for="payment-method-3">Vận Chuyển COD </label>
                                            <div class="payment-box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.</p>
                                                <img width="50%" src="{{asset('frontend/assets/images/payment/cod.png')}}" alt="">
                                            </div>
                                        </div>
                                        <div class="pay-top sin-payment sin-payment-3">
                                            <input id="payment-method-4" class="input-radio" type="radio" value="paypal" name="payment_method">
                                            <label for="payment-method-4">PayPal <a href="#">What is PayPal?</a></label>
                                            <div class="payment-box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.</p>
                                                <img width="50%" src="{{asset('frontend/assets/images/payment/paypal.png')}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="Place-order">
                                    <a type="button" onclick="payment()">Thanh Toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
@endsection
@push('js')
<script src="{{ asset('js/frontend/checkout.js')}}"></script>
@endpush