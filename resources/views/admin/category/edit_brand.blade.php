@extends('admin.admin_layouts')
@section('admin-content')

<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Danh Mục Sản Phẩm</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Danh Mục Sản Phẩm</a>
                        </li> 
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Nhãn Hàng</a>
                        </li>
                        <li class="breadcrumb-item active">Chỉnh Sửa</li>
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

                <h4 class="mt-0 clearfix header-title mb-3">
                    Chỉnh Sửa Nhãn Hàng
                </h4>
                                    <form class="" method="POST" id="form_brand">
                                        @csrf
                                        <div class="form-group">
                                            <label>Tên Nhãn Hàng</label>
                                            <input type="text" onkeypress="removeMessage($(this))" name="brand_name" class="form-control" value="{{$info->brand_name}}" required placeholder="Tên Nhãn Hàng" />
                                            <span class="text-danger" id="brand_name_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label>Danh Mục Sản Phẩm</label>
                                            <select name="category_id" onchange="removeMessage($(this))" class="form-control" id="">
                                                @foreach($category as $item)
                                                <option value="{{$item->id}}" {{ $info->category_id == $item->id ? 'selected' : ''}}>{{$item->category_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="category_id_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label>Logo Nhãn Hàng</label>
                                            <!-- <input type="file" name="brand_logo" class="form-control" required placeholder="Logo Nhãn Hàng" /> -->
                                            <div class="logo_wrapper">
                                                <img src="{{ !empty($info->brand_logo) ? $info->brand_logo : '/media/default2.png' }}" value="{{ !empty($info) ? $info->brand_logo : '' }}" class="logo-pic">
                                                <div class="upload-button">
                                                    <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                                </div>
                                                <input type="file" id="logo" name="logo" class="file-upload" accept="image/*">
                                                <input type="hidden" name="url_logo" id="url_logo" value="{{ !empty($info) ? $info->brand_logo : '/media/default2.png' }}">
                                                <input type="hidden" name="old_logo" id="old_logo" value="{{$info->brand_logo}}">
                                            </div>
                                            <!-- <span class="text-danger" id="brand_name_error"></span> -->
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="{{$info->id}}" onclick="updateBrand(this.id)" class="btn btn-primary">Cập Nhật</button>
                                        <a href="{{ asset('/admin/brands')}}" class="btn btn-secondary">Trở Về</a>
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
                    <!-- category js -->
                    <script src="{{ asset('/js/backend/brand.js') }}"></script>

                    @endpush