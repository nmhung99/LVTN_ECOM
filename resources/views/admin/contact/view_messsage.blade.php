@extends('admin.admin_layouts')
@section('admin-content')

<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Chi Tiết Tin Nhắn</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Quản Lý Liên Hệ</a>
                        </li>
                        <li class="breadcrumb-item active">Chi Tiết Tin Nhắn</li>
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
                        Chi Tiết Tin Nhắn
                    </h4>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="name" class="col-form-label">Tên</label><span class="text-danger">*</span>
                                    <br>
                                    <p>{{ $mess->name }}</p>
                                </div>
                                <div class="col-sm-3">
                                    <label for="email" class="col-form-label">Email</label><span class="text-danger">*</span>
                                    <br>
                                    <p>{{ $mess->email }}</p>
                                </div>
                                <div class="col-sm-4">
                                    <label for="phone" class="col-form-label">Điện Thoại</label><span class="text-danger">*</span>
                                    <br>
                                    <p>{{ $mess->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Tiêu Đề</label><span class="text-danger">*</span>
                                    <br>
                                    <p>
                                       @if($mess->subject == null)
                                            Không Có
                                        @else
                                            {{$mess->subject}}
                                        @endif 
                                    </p>
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Nội Dung Tin Nhắn</label><span class="text-danger">*</span>
                                        <br>
                                        <p>
                                            {!! $mess->message !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            @endsection
            @push('js')
            <script src="{{ asset('tagsinput/create_product.js') }}"></script>
            @endpush