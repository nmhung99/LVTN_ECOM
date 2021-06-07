@extends('layouts.main')

@section('content')
@php
    $order = DB::table('orders')->where('user_id',Auth::id())->where('status','!=',5)->orderBy('id','DESC')->limit(10)->get();
@endphp
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="breadcrumb-area bg-gray">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="active">Tài Khoản Của Tôi</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- my account wrapper start -->
        <div class="my-account-wrapper pt-120 pb-120">
            <div class="container-fluid pl-5 pr-5">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <div class="avatar">
                                            <img src="{{ asset('frontend/assets/images/logo/logo.png')}}" alt="">
                                        </div>
                                        <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                            Bảng Điều Khiển</a>
                                        <!-- <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Đơn Hàng</a> -->
                                        <!-- <a href="#download" data-toggle="tab"><i class="fa fa-cloud-download"></i> Download</a> -->
                                        <!-- <a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i> Payment
                                            Method</a> -->
                                        <!-- <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> address</a> -->
                                        <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Cập Nhật Thông Tin Tài Khoản </a>
                                        <a href="#password-info" data-toggle="tab"><i class="fa fa-lock"></i> Đổi Mật Khẩu </a>
                                        <a href="{{ route('success.orderlist')}}"><i class="fa fa-lock"></i> Hoàn Trả Đơn Hàng </a>
                                        <a href="{{ route('user.logout')}}"><i class="fa fa-sign-out"></i> Đăng Xuất</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->
                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Trung tâm điều khiển</h3>
                                                <h4>Thông tin cá nhân</h4>
                                                <div class="form-group">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <label class="col-form-label"><strong>User Name: </strong></label>
                                                                {{Auth::user()->name}}
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <label class="col-form-label"><strong>Số Điện Thoại:</strong></label>
                                                                {{Auth::user()->phone}}
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <label class="col-form-label"><strong>Email:</strong></label>
                                                                {{Auth::user()->email}}
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <label class="col-form-label"><strong>Ngày Tham Gia:</strong></label>
                                                                {{
                                                                    date('d-m-Y H:i:s', strtotime(Auth::user()->created_at))
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4>Lịch Sử Đơn Hàng</h4>
                                                <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Hình Thức Thanh Toán</th>
                                                                <th>Mã Thanh Toán</th>
                                                                <th>Tổng Tiền</th>
                                                                <th>Ngày</th>
                                                                <th>Trạng Thái</th>
                                                                <th>Mã Đơn Hàng</th>
                                                                <th>Hành Động</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($order as $item)
                                                            <tr>
                                                                <td>{{$item->payment_type}}</td>
                                                                <td>{{$item->payment_id}}</td>
                                                                <td>{{number_format($item->total)}} vnd</td>
                                                                <td>{{$item->date}}</td>
                                                                <td>
                                                                    @if($item -> status == 0)
                                                                    <span style="font-size: 12px;" class="badge badge-pill badge-warning">Đang Chờ</span>
                                                                    @elseif($item -> status == 1)
                                                                    <span style="font-size: 12px;" class="badge badge-pill badge-info">Chấp Nhận Thanh Toán</span>
                                                                    @elseif($item -> status == 2)
                                                                    <span style="font-size: 12px;" class="badge badge-pill badge-warning">Đang Vận Chuyển</span>
                                                                    @elseif($item -> status == 3)
                                                                    <span style="font-size: 12px;" class="badge badge-pill badge-success">Hoàn Thành</span>
                                                                    @else
                                                                    <span style="font-size: 12px;" class="badge badge-pill badge-danger">Từ Chối</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{$item->status_code}}</td>
                                                                <td><button class="btn btn-info">Xem</button></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <!-- <div class="tab-pane fade" id="orders" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Đơn Hàng</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Aug 22, 2018</td>
                                                                <td>Pending</td>
                                                                <td>$3000</td>
                                                                <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>July 22, 2018</td>
                                                                <td>Approved</td>
                                                                <td>$200</td>
                                                                <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>June 12, 2017</td>
                                                                <td>On Hold</td>
                                                                <td>$990</td>
                                                                <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- Single Tab Content End -->
                                        
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Chi Tiết Tài Khoản</h3>
                                                <div class="account-details-form">
                                                    <form action="#">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="first-name" class="required">User Name</label>
                                                                    <input value="{{Auth::user()->name}}" type="text" id="first-name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="last-name" class="required">Số Điện Thoại</label>
                                                                    <input value="{{Auth::user()->phone}}" type="text" id="last-name" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="single-input-item">
                                                            <label for="display-name" class="required">Display Name</label>
                                                            <input type="text" id="display-name" />
                                                        </div> -->
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">Địa Chỉ Email</label>
                                                            <input value="{{Auth::user()->email}}" type="email" id="email" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <button class="check-btn sqr-btn ">Cập Nhật</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="password-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <div class="account-details-form">
                                                    <form action="#" method="POST" id="form_change_pass">
                                                        <fieldset>
                                                            <legend>Thay Đổi Mật Khẩu</legend>
                                                            <div class="single-input-item">
                                                                <label for="current-pwd" class="required">Mật Khẩu Cũ</label>
                                                                <input type="password" onchange="removeMessage($(this))" name="oldpass" id="oldpass" />
                                                                <span class="text-danger" id="oldpass_error"></span>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="new-pwd" class="required">Mật Khẩu Mới</label>
                                                                        <input type="password" onchange="removeMessage($(this))" name="newpassword" id="newpassword" />
                                                                    <span class="text-danger" id="newpassword_error"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="confirm-pwd" class="required">Xác Nhận Mật Khẩu Mới</label>
                                                                        <input type="password" onchange="removeMessage($(this))" name="password_confirmation" id="password_confirmation" />
                                                                    <span class="text-danger" id="password_confirmation_error"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <p id="message_error" class="text-danger"></p>
                                                        <div class="single-input-item">
                                                            <button class="check-btn sqr-btn" type="button" onclick="updatePass()">Cập Nhật</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('js')
<script src="{{ asset('js/frontend/account.js')}}"></script>
@endpush