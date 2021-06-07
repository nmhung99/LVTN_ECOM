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
                    <h4 class="page-title">Chỉnh Sửa Người Dùng</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Phân Quyền</a>
                        </li>
                        <li class="breadcrumb-item active">Chỉnh Sửa Người Dùng</li>
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
                        Chỉnh Sửa Người Dùng
                        <a href="{{ route('admin.all.user')}}" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Danh Sách Người Dùng</a>
                        <!-- <a href="#" data-toggle="modal" data-target=".bs-example-modal-center" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Mới</a> -->
                    </h4>
                    <form action="" method="post" id="form_update_admin">
                        <input type="hidden" name="adminid" value="{{$user->id}}">
                        @csrf
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="product_name" class="col-form-label">Tên Tài Khoản</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Nhập Tên Tài Khoản" name="name" type="text" value="{{$user->name}}" id="name">
                                        <span class="text-danger" id="name_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="product_code" class="col-form-label">Số Điện Thoại</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Nhập Số Điện Thoại" name="phone" type="text" value="{{$user->phone}}" id="phone">
                                        <span class="text-danger" id="phone_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="product_quantity" class="col-form-label">Email</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Nhập Email" name="email" type="text" value="{{$user->email}}" id="email">
                                        <span class="text-danger" id="email_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-12">
                            <label for="">Chọn Quyền</label>
                                <div class="row" id="role">
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Danh Mục Sản Phẩm</label>
                                        <label class="switch">
                                            <input type="checkbox" name="category" checked="true" id="category">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="category_insert" id="category_insert" value="{{$user->category}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Mã Giảm Giá</label>
                                        <label class="switch">
                                            <input type="checkbox" name="coupon" checked="true" id="coupon">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="coupon_insert" id="coupon_insert" value="{{$user->coupon}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Sản Phẩm</label>
                                        <label class="switch">
                                            <input type="checkbox" name="product" checked="true" id="product">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="product_insert" id="product_insert" value="{{$user->product}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Blog</label>
                                        <label class="switch">
                                            <input type="checkbox" name="blog" checked="true" id="blog">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="blog_insert" id="blog_insert" value="{{$user->blog}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Đơn Hàng</label>
                                        <label class="switch">
                                            <input type="checkbox" name="order" checked="true" id="order">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="order_insert" id="order_insert" value="{{$user->order}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Khác</label>
                                        <label class="switch">
                                            <input type="checkbox" name="other" checked="true" id="other">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="other_insert" id="other_insert" value="{{$user->other}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Báo Cáo</label>
                                        <label class="switch">
                                            <input type="checkbox" name="report" checked="true" id="report">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="report_insert" id="report_insert" value="{{$user->report}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Phân Quyền</label>
                                        <label class="switch">
                                            <input type="checkbox" name="role1" checked="true" id="role1">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="role1_insert" id="role1_insert" value="{{$user->role}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Đơn Hàng Trả Lại</label>
                                        <label class="switch">
                                            <input type="checkbox" name="return" checked="true" id="return">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="return_insert" id="return_insert" value="{{$user->return}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Liên Hệ</label>
                                        <label class="switch">
                                            <input type="checkbox" name="contact" checked="true" id="contact">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="contact_insert" id="contact_insert" value="{{$user->contact}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Bình Luận</label>
                                        <label class="switch">
                                            <input type="checkbox" name="comment" checked="true" id="comment">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="comment_insert" id="comment_insert" value="{{$user->comment}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Cài Đặt</label>
                                        <label class="switch">
                                            <input type="checkbox" name="setting" checked="true" id="setting">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="setting_insert" id="setting_insert" value="{{$user->setting}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Kho</label>
                                        <label class="switch">
                                            <input type="checkbox" name="stock" checked="true" id="stock">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="stock_insert" id="stock_insert" value="{{$user->stock}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <div>
                                <button type="button" onclick="updateAdmin()" class="btn-lg btn-primary waves-effect waves-light">
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
    <script src="{{ asset('tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('js/backend/role.js') }}"></script>


    @endpush