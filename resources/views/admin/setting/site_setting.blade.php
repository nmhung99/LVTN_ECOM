@extends('admin.admin_layouts')
    @push('css')
    <!-- c js -->
    <!-- <script src="{{ asset('tagsinput/bootstrap-tagsinput.css') }}"></script> -->
    <!-- <link href="{{ asset('tagsinput/tags/bootstrap.min.css') }}" rel="stylesheet"> -->
    <!-- <link href="{{ asset('tagsinput/bootstrap.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link href="{{ asset('tagsinput/create_product.css') }}" rel="stylesheet">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/> -->
<!-- <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/> -->

    @endpush
@section('admin-content')

<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Cài Đặt</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Cài Đặt</a>
                        </li>
                        <li class="breadcrumb-item active">Cài Đặt Trang Web</li>
                    </ol>
                </div>
            </div>

            <div class="col-md-4">
                <div class="float-right d-none d-md-block app-datepicker">
                    <input type="text" class="form-control" data-date-format="MM dd, yyyy" readonly="readonly" id="datepicker">
                    <i class="mdi mdi-chevron-down mdi-drop"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- end page-title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 clearfix header-title mb-5">
                        Cài Đặt Trang Web
                    </h4>
                    <form action="" method="post" id="form_update_sitesetting">
                        @csrf
                        <input type="hidden" name="settingid" value="{{$setting->id}}">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="product_name" class="col-form-label">Điện Thoại 1</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Nhập Tên Tài Khoản" name="phone_one" type="text" value="{{$setting->phone_one}}" id="phone_one">
                                        <span class="text-danger" id="phone_one_error"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="product_code" class="col-form-label">Điện Thoại 2</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Nhập Số Điện Thoại" name="phone_two" type="text" value="{{$setting->phone_two}}" id="phone_two">
                                        <span class="text-danger" id="phone_two_error"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="product_quantity" class="col-form-label">Email</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Nhập Email" name="email" type="text" value="{{$setting->email}}" id="email">
                                        <span class="text-danger" id="email_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="product_quantity" class="col-form-label">Tên Website</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Nhập Email" name="company_name" type="text" value="{{$setting->company_name}}" id="company_name">
                                        <span class="text-danger" id="company_name_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="product_quantity" class="col-form-label">Địa Chỉ</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Nhập Email" name="company_address" type="text" value="{{$setting->company_address}}" id="company_address">
                                        <span class="text-danger" id="company_address_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="product_quantity" class="col-form-label">Facebook</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Nhập Email" name="facebook" type="text" value="{{$setting->facebook}}" id="facebook">
                                        <span class="text-danger" id="facebook_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="product_quantity" class="col-form-label">Youtube</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Nhập Email" name="youtube" type="text" value="{{$setting->youtube}}" id="youtube">
                                        <span class="text-danger" id="youtube_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="product_quantity" class="col-form-label">Instagram</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Nhập Email" name="instagram" type="text" value="{{$setting->instagram}}" id="instagram">
                                        <span class="text-danger" id="instagram_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="product_quantity" class="col-form-label">Twitter</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Nhập Email" name="twitter" type="text" value="{{$setting->twitter}}" id="twitter">
                                        <span class="text-danger" id="twitter_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <div>
                                <button type="button" onclick="updateSiteSetting()" class="btn-lg btn-primary waves-effect waves-light">
                                    Cập Nhật
                                </button>
                                <a href="{{ url()->previous()}}" class="btn-lg btn-secondary waves-effect">
                                    Trở Về
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    @endsection
    @push('js')
    <!-- c js -->
    <!-- <script src="{{ asset('tagsinput/tags/jquery.min.js') }}"></script> -->
    <!-- <script src="{{ asset('tagsinput/tags/bootstrap.min.js') }}"></script> -->
    <!-- <script src="{{ asset('tagsinput/bootstrap-tagsinput.js') }}"></script> -->
    <script src="{{ asset('js/backend/sitesetting.js') }}"></script>


    @endpush