@extends('layouts.main')

@section('content')
@php
    $order = DB::table('orders')->where('user_id',Auth::id())->where('status','!=',5)->orderBy('id','DESC')->limit(10)->get();
@endphp
<style>
	.card1 {
		/*margin-left: 140px;*/
		z-index: 0;
		border-right: 1px solid #F5F5F5;
	}
	#progressbar {
    position: relative;
    left: -130px;
    overflow: hidden;
    color: #E53935
}

#progressbar li {
    list-style-type: none;
    font-size: 8px;
    font-weight: 400;
    margin-bottom: 36px
}

#progressbar li:nth-child(3) {
    margin-bottom: 88px
}

#progressbar .step0:before {
    content: "";
    color: #fff
}

#progressbar li:before {
    width: 40px;
    height: 40px;
    line-height: 36px;
    display: block;
    font-size: 20px;
    background: #fff;
    border: 2px solid #E53935;
    border-radius: 50%;
    margin: auto
}

#progressbar li:last-child:before {
    width: 40px;
    height: 40px
}

#progressbar li:after {
    content: '';
    width: 3px;
    height: 66px;
    background: #BDBDBD;
    position: absolute;
    left: 234px;
    top: 15px;
    z-index: -1
}

#progressbar li:last-child:after {
    top: 150px;
    height: 132px
}

#progressbar li:nth-child(3):after {
    top: 90px
}

#progressbar li:nth-child(2):after {
    top: 12px;	
}

#progressbar li:first-child:after {
    position: absolute;
    top: 35px;
}

#progressbar li.active:after {
    background: #E53935
}

#progressbar li.active:before {
    background: #E53935;
    font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f007";
    content: "\f0d1"
}
#progressbar li.active.loading:before {
    background: #E53935;
    font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f007";
    content: "\f110"
}
#progressbar li.active.payment:before {
    background: #E53935;
    font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f007";
    content: "\f09d"
}
#progressbar li.active.done:before {
    background: #E53935;
    font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f007";
    content: "\f058"
}
#infoprogress{
	position: relative;
	top: -350px;
	left: 160px;
	font-size: 18px;
	color: #E53935;
}
#infoprogress h4{
	color: #E53935;
}
#infoprogress li:nth-child(2){
	position: absolute;
	top: 75px;
}
#infoprogress li:nth-child(3){
	position: absolute;
	top: 152px;
}
#infoprogress li:last-child{
	position: absolute;
	bottom: -290px;
}
.list-group span{
	font-weight: bold; font-size: 18px;
}
.list-group li{
	font-size: 16px;
}
</style>
<!-- <div class="contact_form"> -->
	<div class="container  pt-20 pb-30">
		<div class="row">
			<div class="col-5 offset-lg-1">
				<div class="contact_form_title text-center"><h3>Trạng Thái Đơn Hàng</h3></div>

				<div class="card1 pt-20">
					<ul id="progressbar" class="text-center">
						@if($infotrack -> status == 0)
							<li class="active step0 loading"></li> 
							<li class="step0 payment"></li>
							<li class="step0"></li>
							<li class="step0 done"></li>
						@elseif($infotrack -> status == 1)
							<li class="active step0 loading"></li>
							<li class="active step0 payment"></li>
							<li class="step0"></li>
							<li class="step0 done"></li>
						@elseif($infotrack -> status == 2)
							<li class="active step0 loading"></li>
							<li class="active step0 payment"></li>
							<li class="active step0"></li>
							<li class="step0 done"></li>
						@elseif($infotrack -> status == 3)
							<li class="active step0 loading"></li>
							<li class="active step0 payment"></li>
							<li class="active step0"></li>
							<li class="active step0 done"></li>
						@else
						@endif
					</ul>
					<ul id="infoprogress" class="">
						@if($infotrack -> status == 0)
							<li><h4>Đang Xác Nhận Đơn Hàng</h4></li>
						@elseif($infotrack -> status == 1)
							<li><h4>Đã Xác Nhận Đơn Hàng</h4></li>
							<li><h4>Chấp Nhận Thanh Toán</h4></li>
						@elseif($infotrack -> status == 2)
							<li><h4>Đã Xác Nhận Đơn Hàng</h4></li>
							<li><h4>Chấp Nhận Thanh Toán</h4></li>
							<li><h4>Đang Vận Chuyển Đơn Hàng</h4></li>
						@elseif($infotrack -> status == 3)
							<li><h4>Đã Xác Nhận Đơn Hàng</h4></li>
							<li><h4>Chấp Nhận Thanh Toán</h4></li>
							<li><h4>Đã Vận Chuyển Đơn Hàng</h4></li>
							<li><h4>Hoàn Thành</h4></li>
						@else
						@endif
					</ul>
				</div>

			</div>

			<div class="col-6">
				<div class="contact_form_title text-center"><h3>Chi Tiết Đơn Hàng</h3></div>
				<ul class="list-group col-lg-12">
					<li class="list-group-item"><span>Hình Thức Thanh Toán:</span> {{$infotrack->payment_type}}</li>
					<li class="list-group-item"><span>Mã Thanh Toán:</span> {{$infotrack->payment_id}}</li>
					<li class="list-group-item"><span>Mã Giao Dịch:</span> {{$infotrack->balance_transaction}}</li>
					<li class="list-group-item">
						@if($infotrack -> coupon == NULL)
						<span>Tạm Tính:</span> {{number_format($infotrack -> subtotal)}} vnd
						@else
							@php
							$check = DB::table('coupons')->where('coupon',$infotrack->coupon)->first();
							$dis = $check->discount;
							@endphp
						<span>Tạm Tính:</span> {{number_format(($infotrack->subtotal*100)/(100-$dis))}} vnd</th>
						@endif
					</li>
					@if($infotrack->coupon !== NULL)
						@php
						$check = DB::table('coupons')->where('coupon',$infotrack->coupon)->first();
						$total = ($infotrack->subtotal*100)/(100-$check->discount)
						@endphp
					<li class="list-group-item"><span>Mã Giảm Giá</span> <span style="text-transform: uppercase;">({{$infotrack->coupon}}): </span> - {{$check -> discount}} % (-{{number_format($check->discount*$total/100)}})  vnd</li>
					@else
					@endif
					<li class="list-group-item"><span>Phí Ship:</span> {{number_format($infotrack->shipping) }} vnd</li>
					<li class="list-group-item"><span>Thuế: </span> {{number_format($infotrack->vat) }} vnd</li>
					
					<li class="list-group-item"><span>Tổng Tiền:</span> {{number_format($infotrack->total) }} vnd</li>
					<li class="list-group-item"><span>Ngày:</span> {{$infotrack->date}}</li>
					<!-- <li class="list-group-item"><span>Tháng:</span> {{$infotrack->month}}</li> -->
					<li class="list-group-item"><span>Năm:</span> {{$infotrack->year}}</li>
				</ul>
			</div>

		</div>
	</div>
<!-- </div> -->

<!-- <h1>Trang Theo Dõi Đơn Hàng {{$infotrack->status_code}}</h1> -->
@endsection
@push('js')
<script src="{{ asset('js/frontend/account.js')}}"></script>
@endpush