@extends('layouts.main')

@push('css')
<!-- <script src="{{ asset('js/frontend/checkout.js')}}"></script> -->
<link rel="stylesheet" href="{{ asset('css/frontend/payment.css') }}">
@endpush
@section('content')
<div class="checkout-main-area pt-20 pb-120">
            <div class="container">
                <div class="checkout-wrap pt-30">
                    <div class="row">
                        <div class="col-lg-6">
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
                                            @php
                                                $cart  = Cart::content();
                                            @endphp
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
                                                <li>Mã Giảm Giá ({{Session::get('coupon')['name']}})<p> - {{Session::get('coupon')['discount']}} %</p> 
                                                    <!-- <a href="{{ route('remove.coupon')}}" class="btn btn-danger">X</a> -->
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
                                                        {{number_format(Session::get('coupon')['balance'] + $ship + Session::get('coupon')['balance']*$vat)}} vnđ
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        @else
                                        <!-- <div class="your-order-info order-shipping">
                                            <ul>
                                                <li>Mã Giảm Giá<p></p>
                                                </li>
                                            </ul>
                                        </div> -->
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
                                    <!-- <div class="payment-method">
                                        <div class="pay-top sin-payment">
                                            <input id="payment_method_1" class="input-radio" type="radio" value="stripe" checked="checked" name="payment_method">
                                            <label for="payment_method_1"> MasterCard </label>
                                            <div class="payment-box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.</p>
                                                <img width="50%" src="{{asset('frontend/assets/images/payment/mastercard.png')}}" alt="">
                                            </div>
                                        </div>
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
                                    </div> -->
                                </div>
                                <!-- <h3 class="pt-30">Thông Tin Nhận Hàng</h3>
                                <div class="your-order-wrap gray-bg-4">
                                    <div class="your-order-info-wrap">
                                        <label class="col-lg-4">a</label>
                                        <label class="col-lg-4">sdf</label>
                                        <label class="col-lg-4">sdf</label>
                                        <label class="col-lg-4">shghg</label>
                                    </div>
                                </div> -->
                                <!-- <div class="Place-order">
                                    <a type="button" onclick="payment()">Thanh Toán</a>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="your-order-area">
                                <h3>Thông Tin Thanh Toán Của Bạn</h3>
                                <div class="your-order-wrap gray-bg-4">
                                    <form action="{{url('/user/stripe/charge')}}" method="POST" id="payment-form">
                                        @csrf
                                        <div class="form-row">
                                            <label for="card-element">
                                                Điền Thông Tin Thẻ
                                            </label>
                                            <div id="card-element">
                                          <!-- A Stripe Element will be inserted here. -->
                                            </div>

                                            <!-- Used to display Element errors. -->
                                            <div id="card-errors" role="alert"></div>
                                        </div>
                                            <input type="hidden" name="shipping" value="{{$ship}}">
                                            <input type="hidden" name="vat" value="{{ Session::has('coupon') ? Session::get('coupon')['balance']*$vat :  $vat*Cart::subtotal(0,'.','')}}">
                                            <input type="hidden" name="total" value="{{
                                            Session::has('coupon') ? Session::get('coupon')['balance'] + $ship + Session::get('coupon')['balance']*$vat : Cart::subtotal(0,'.','') + $ship + Cart::subtotal(0,'.','')*$vat
                                            }}">

                                            <input type="hidden" name="ship_name" value="{{Session::get('infoship')['name']}}">
                                            <input type="hidden" name="ship_phone" value="{{Session::get('infoship')['phone']}}">
                                            <input type="hidden" name="ship_address" value="{{Session::get('infoship')['address']}}">
                                            <input type="hidden" name="ship_city" value="{{Session::get('infoship')['city']}}">
                                            <input type="hidden" name="ship_state" value="{{Session::get('infoship')['state']}}">
                                            <input type="hidden" name="payment_type" value="{{Session::get('infoship')['payment']}}">
                                        <div class="form-row">
                                            <button type="submit" class="btn btn-info mt-3">Thanh Toán</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- <div class="Place-order">
                                    <a type="button" onclick="payment()">Thanh Toán</a>
                                </div> -->
                                <h3 class="pt-30">Thông Tin Nhận Hàng</h3>
                                <div class="your-order-wrap gray-bg-4">
                                    @if(Session::has('infoship'))
                                    <div class="your-order-info-wrap row" style="font-size: 16px;">
                                        <label class="col-6 name mb-3">Họ Tên: {{Session::get('infoship')['name']}}</label>
                                        <label class="col-6 adress mb-3">Địa Chỉ: {{Session::get('infoship')['address']}}</label>
                                        <label class="col-6 city mb-3">Tỉnh/Thành Phố: {{Session::get('infoship')['city']}}</label>
                                        <label class="col-6 state mb-3">Quận/Huyện: {{Session::get('infoship')['state']}}</label>
                                        <label class="col-6 phone">Điện Thoại: {{Session::get('infoship')['phone']}}</label>
                                    </div>
                                    @else
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('js')
<!-- <script src="{{ asset('js/frontend/checkout.js')}}"></script> -->
<script type="text/javascript">
(function(){
                // Create a Stripe client
                var stripe = Stripe('pk_test_51IcoQgJYHi9ugH5xUyJlVIEf6jTWnmoPHfbPTLg3nKz3gppKbrzwHgF5UOPFENG0EZ5zJmh5Tpx9c5iaumgTnkp800fzBzDiNR');
                // Create an instance of Elements
                var elements = stripe.elements();
                // Custom styling can be passed to options when creating an Element.
                // (Note that this demo uses a wider set of styles than the guide below.)
                var style = {
                  base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Raleway", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                      color: '#aab7c4'
                    }
                  },
                  invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                  }
                };
                // Create an instance of the card Element
                var card = elements.create('card', {
                    style: style,
                    hidePostalCode: true
                });
                // Add an instance of the card Element into the `card-element` <div>
                card.mount('#card-element');
                // Handle real-time validation errors from the card Element.
                card.addEventListener('change', function(event) {
                  var displayError = document.getElementById('card-errors');
                  if (event.error) {
                    displayError.textContent = event.error.message;
                  } else {
                    displayError.textContent = '';
                  }
                });
                // Handle form submission
                var form = document.getElementById('payment-form');
                form.addEventListener('submit', function(event) {
                  event.preventDefault();
                  // var options = {
                  //   name: document.getElementById('name_on_card').value,
                  // }
                  stripe.createToken(card).then(function(result) {
                    if (result.error) {
                      // Inform the user if there was an error
                      var errorElement = document.getElementById('card-errors');
                      errorElement.textContent = result.error.message;
                    } else {
                      // Send the token to your server
                      stripeTokenHandler(result.token);
                    }
                  });
                });
                function stripeTokenHandler(token) {
                  // Insert the token ID into the form so it gets submitted to the server
                  var form = document.getElementById('payment-form');
                  var hiddenInput = document.createElement('input');
                  hiddenInput.setAttribute('type', 'hidden');
                  hiddenInput.setAttribute('name', 'stripeToken');
                  hiddenInput.setAttribute('value', token.id);
                  form.appendChild(hiddenInput);
                  // Submit the form
                  form.submit();
                }
            })();
</script>
@endpush