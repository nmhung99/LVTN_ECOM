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
                    <h4 class="page-title">Sản Phẩm</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Sản Phẩm</a>
                        </li>
                        <li class="breadcrumb-item active">Trang chi tiết thông tin sản phẩm</li>
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
                        Thông tin sản phẩm 
                    </h4>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <label class="col-form-label">Ảnh Sản Phẩm</label><span class="text-danger">*</span>
                            <div class="row">
                                <?php 
                                $image = json_decode($product->image);
                                ?>
                                @foreach ($image as $item)
                                <div class="col-2 imgUp">
                                    <!-- <div class="imagePreview"> -->
                                        <img width="100%" src="{{ asset($item) }}"/>
                                        <!-- <input type="hidden" name="url_img[]" value="{{ '/media/default2.png' }}"/> -->
                                    <!-- </div> -->
                                    <!-- <label class="btn btn-primary" id="btn-upload"> -->
                                        <!-- Upload -->
                                        <!-- <input type="file" name="image" class="uploadFile img" accept="image/*"> -->
                                    <!-- </label> -->
                                </div>
                                @endforeach
                                <!-- <span class="imgAdd"><i class="fas fa-plus"></i></span> -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="product_name" class="col-form-label">Tên Sản Phẩm</label><span class="text-danger">*</span>
                                    <br>
                                    <p>{{ $product->product_name }}</p>
                                </div>
                                <div class="col-sm-3">
                                    <label for="product_code" class="col-form-label">Mã Sản Phẩm</label><span class="text-danger">*</span>
                                    <br>
                                    <p>{{ $product->product_code }}</p>
                                </div>
                                <div class="col-sm-4">
                                    <label for="product_quantity" class="col-form-label">Số Lượng</label><span class="text-danger">*</span>
                                    <br>
                                    <p>{{ $product->product_quantity }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Danh Mục Cha</label><span class="text-danger">*</span>
                                    <br>
                                    <p>{{ $product->category_name }}</p>
                                </div>
                                <div class="col-sm-3">
                                    <label class="col-form-label">Danh Mục Con</label>
                                    <br>
                                    <p>{{ $product->subcategory_id == null ? 'Không Có' : $product->subcategory_name }}</p>
                                </div>
                                <div class="col-sm-3">
                                    <label class="col-form-label">Nhãn Hàng</label>
                                    <br>
                                    <p>{{ $product->brand_name }}</p>
                                </div>
                                <div class="col-sm-3">
                                    <label class="col-form-label">Nhóm Sản Phẩm</label>
                                    <br>
                                    <p>{{ $product->group_product_id == null ? 'Không Có' : $product->group_name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Dung Lượng</label>
                                        <br>
                                        <p>{{ $product->product_size }}</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Màu Sắc</label><span class="text-danger">*</span>
                                        <br>
                                        <p>{{ $product->product_color }}</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Giá Bán</label><span class="text-danger">*</span>
                                        <br>
                                        <p>{{ $product->selling_price }}</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Giá Giảm</label>
                                        <br>
                                        <p>{{ $product->discount_price == null ? 'Không có' : $product->discount_price}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Chi Tiết Sản Phẩm</label><span class="text-danger">*</span>
                                        <br>
                                        <p>
                                            {!! $product->product_details !!}
                                            <!-- {!! $product->product_details !!} -->
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Mô Tả Sản Phẩm</label><span class="text-danger">*</span>
                                        <br>
                                        <table>{!! $product->product_desc !!}</table>
                                    </div>
                                    <!-- <div class="card-body">
                                        <h4 class="mt-0 header-title">Chi Tiết Sản Phẩm</h4>
                                        <textarea id="elm1" name="area"></textarea>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Link Video Sản Phẩm</label><span class="text-danger">*</span>
                                        <br>
                                        <p>{{ $product->video_link == null ? 'Không có' : $product->video_link }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        @if($product->main_slider == 1)
                                            <span class="badge badge-success font-14">Có</span>
                                        @else
                                            <span class="badge badge-danger font-14">Không</span>
                                        @endif
                                        <label class="col-form-label">Slider Chính</label>
                                    </div>
                                    <div class="col-sm-4">
                                        @if($product->flash_deal == 1)
                                            <span class="badge badge-success font-14">Có</span>
                                        @else
                                            <span class="badge badge-danger font-14">Không</span>
                                        @endif
                                        <label class="col-form-label">Flash Deal</label>
                                    </div>
                                    <div class="col-sm-4">
                                        @if($product->hot_deal == 1)
                                            <span class="badge badge-success font-14">Có</span>
                                        @else
                                            <span class="badge badge-danger font-14">Không</span>
                                        @endif
                                        <label class="col-form-label">Sản Phẩm Hot</label>
                                        <!-- <label class="switch">
                                            <input type="checkbox" name="hot_deal" disabled="" checked="true" id="hot_deal">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="hot_deal_insert" id="hot_deal_insert" value="{{ $product->hot_deal }}"> -->
                                    </div>
                                    <div class="col-sm-4">
                                        @if($product->best_rated == 1)
                                            <span class="badge badge-success font-14">Có</span>
                                        @else
                                            <span class="badge badge-danger font-14">Không</span>
                                        @endif
                                        <label class="col-form-label">Đánh Giá Cao</label>
                                        <!-- <label class="switch">
                                            <input type="checkbox" name="best_rated" disabled="" checked="true" id="best_rated">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="best_rated_insert" id="best_rated_insert" value="{{ $product->best_rated }}"> -->
                                    </div>
                                    <div class="col-sm-4">
                                        @if($product->trend == 1)
                                            <span class="badge badge-success font-14">Có</span>
                                        @else
                                            <span class="badge badge-danger font-14">Không</span>
                                        @endif
                                        <label class="col-form-label">Sản Phẩm Xu Hướng</label>
                                        <!-- <label class="switch">
                                            <input type="checkbox" name="trend" disabled="" checked="true" id="trend">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="trend_insert" id="trend_insert" value="{{ $product->trend }}"> -->
                                    </div>
                                    <div class="col-sm-4">
                                        @if($product->hot_new == 1)
                                            <span class="badge badge-success font-14">Có</span>
                                        @else
                                            <span class="badge badge-danger font-14">Không</span>
                                        @endif
                                        <label class="col-form-label">Sản Phẩm Mới Và Hot</label>
                                        <!-- <label class="switch">
                                            <input type="checkbox" name="hot_new" disabled="" checked="true" id="hot_new">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="hot_new_insert" id="hot_new_insert" value="{{ $product->hot_new }}"> -->
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