@extends('layouts.main')
@section('slider')
@include('layouts.slider')
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('css/frontend/shoppage.css')}}">
@endpush
@section('content')
    @php
        $site = DB::table('sitesetting')->first();
    @endphp
        <div class="contact-area pt-40 pb-40">
            <div class="container">
                <div class="contact-info-wrap-3 pb-85">
                    <h3>Thông Tin Liên Hệ</h3>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="single-contact-info-3 text-center mb-30">
                                <i class="icon-location-pin "></i>
                                <h4>Địa Chỉ</h4>
                                <p>{{$site->company_address}}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-contact-info-3 extra-contact-info text-center mb-30">
                                <ul>
                                    <li><i class="icon-screen-smartphone"></i> {{$site->phone_one}} </li>
                                    <li><i class="icon-envelope "></i> <a href="#"> {{$site->email}}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-contact-info-3 text-center mb-30">
                                <i class="icon-clock "></i>
                                <h4>Giờ Mở Cửa</h4>
                                <p>Thứ 2 - Chủ Nhật. 9:00am - 5:00pm </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="get-in-touch-wrap">
                    <h3>Để Lại Tin Nhắn</h3>
                    <div class="contact-from contact-shadow">
                        <form id="contact_form" action="#" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <input class="mb-0" onchange="removeMessage($(this))" name="name" type="text" placeholder="Tên">
                                    <span class="text-danger" id="name_error"></span>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <input class="mb-0" onchange="removeMessage($(this))" name="email" type="email" placeholder="Email">
                                    <span class="text-danger" id="email_error"></span>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <input class="mb-0" onchange="removeMessage($(this))" name="phone" type="number" placeholder="Điện Thoại">
                                    <span class="text-danger" id="phone_error"></span>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <input class="mt-4" name="subject" type="text" placeholder="Tiêu Đề">
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <textarea class="mb-0"  onchange="removeMessage($(this))" name="message" placeholder="Nội Dung"></textarea>
                                    <span class="text-danger" id="message_error"></span>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <button class="submit" type="button" onclick="sendContact()">Gửi</button>
                                </div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                </div>

            </div>
        </div>
@endsection
@push('js')
<script src="{{ asset('js/frontend/contact.js')}}"></script>
@endpush