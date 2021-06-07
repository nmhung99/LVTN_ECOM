@extends('admin.admin_layouts')
    @push('css')
    <link href="{{ asset('css/backend/slider.css') }}" rel="stylesheet">
    @endpush
@section('admin-content')

<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Thêm Mới Banner</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Banner</a>
                        </li>
                        <li class="breadcrumb-item active">Thêm Mới Banner</li>
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
                        Thêm Mới Banner
                        <a href="{{ route('admin.slider')}}" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Danh Sách Banner</a>
                        <!-- <a href="#" data-toggle="modal" data-target=".bs-example-modal-center" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Mới</a> -->
                    </h4>
                    <form action="" method="post" id="form_update_slider_extra">
                        @csrf
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="col-form-label">Vị Trí</label><span class="text-danger">*</span>
                                        <select name="locationextra" onchange="removeMessage($(this))" class="form-control" id="locationextra">
                                            @if($slider->location == 2)
                                            <option value="2" class="extra1" selected="">Banner Phụ 1</option>
                                            <option value="3" class="extra2" >Banner Phụ 2</option>
                                            @else
                                            <option value="2" class="extra1">Banner Phụ 1</option>
                                            <option value="3" class="extra2"  selected="">Banner Phụ 2</option>
                                            @endif
                                        </select>
                                        <span class="text-danger" id="location_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="extra1" class="extra1">
                            <div class="col-lg-12">
                                <label class="col-form-label title">
                                    Ảnh {{$slider->location == 2 ? 'Banner Phụ 1' : 'Banner Phụ 2'}} (370x190)
                                </label><span class="text-danger">*</span>
                                <div class="row">
                                    <div class="imgUp">
                                        <div class="imagePreview">
                                            <img width="370px" height="190px" src="{{ $slider->image }}"/>
                                            <input type="hidden" class="url" name="url_img" value="{{ $slider->image }}"/>
                                            <input type="hidden" name=" old_img" value="{{ $slider->image }}"/>
                                        </div>
                                        <label class="btn btn-primary" id="btn-upload">
                                            Upload
                                            <input type="file" name="image" class="uploadFile img" accept="image/*">
                                        </label>
                                        <span class="text-danger" id="image_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="product_code" class="col-form-label">Tên Banner</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Tiêu Đề Bài Viết" name="name_banner" type="text" value="{{ $slider->name }}" id="name_banner">
                                        <span class="text-danger" id="name_banner_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Mô Tả</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Tiêu Đề Bài Viết" name="desc" type="text" value="{{ $slider->desc }}" id="desc">
                                        <span class="text-danger" id="desc_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Liên Kết</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Tiêu Đề Bài Viết" name="link" type="text" value="{{ $slider->link }}" id="link">
                                        <span class="text-danger" id="link_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <div>
                                <button type="button" id="{{$slider->id}}" onclick="updateBannerExtra(this.id)" class="btn-lg btn-primary waves-effect waves-light">
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
    <script src="{{ asset('js/backend/slider.js') }}"></script>
    @endpush