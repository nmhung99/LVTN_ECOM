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
                        <li class="breadcrumb-item active">Thêm Mới</li>
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
                        Thêm sản phẩm
                        <a href="{{ route('admin.product')}}" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Danh Sách Sản Phẩm</a>
                        <!-- <a href="#" data-toggle="modal" data-target=".bs-example-modal-center" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Mới</a> -->
                    </h4>
                    <form action="" method="post" id="form_product">
                        @csrf
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label class="col-form-label">Ảnh Sản Phẩm</label><span class="text-danger">*</span>
                                <div class="row">
                                    <div class="col-2 imgUp">
                                        <div class="imagePreview">
                                            <img width="100%" src="{{ '/media/default2.png' }}"/>
                                            <input type="hidden" class="url" name="url_img[]" value="{{ '/media/default2.png' }}"/>
                                        </div>
                                        <label class="btn btn-primary" id="btn-upload">
                                            Upload
                                            <input type="file" name="image" class="uploadFile img" accept="image/*">
                                        </label>
                                        <span class="text-danger" id="image_error"></span>
                                    </div>
                                    <span class="imgAdd"><i class="fas fa-plus"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="product_name" class="col-form-label">Tên Sản Phẩm</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Tên Sản Phẩm" name="product_name" type="text" value="" id="product_name">
                                        <span class="text-danger" id="product_name_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="product_code" class="col-form-label">Mã Sản Phẩm</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Mã Sản Phẩm" name="product_code" type="text" value="" id="product_code">
                                        <span class="text-danger" id="product_code_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="product_quantity" class="col-form-label">Số Lượng</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Số Lượng" name="product_quantity" type="text" value="" id="product_quantity">
                                        <span class="text-danger" id="product_quantity_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Màu Sắc</label><span class="text-danger">*</span>
                                        <input placeholder="Màu Sắc" onchange="removeMessage($(this))" class="form-control form-control-lg" name="product_color" type="text" value="" id="product_color" data-role="tagsinput">
                                        <span class="text-danger" id="product_color_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Danh Mục Cha</label><span class="text-danger">*</span>
                                        <select name="category_id" onchange="removeMessage($(this))" class="form-control" id="category_id">
                                            <option label="Chọn Danh Mục Cha"></option>
                                            @foreach($category as $item)
                                            <option value="{{$item->id}}">{{$item->category_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="category_id_error"></span>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Danh Mục Con</label>
                                        <select class="form-control" id="subcategory_id" name="subcategory_id">
                                            <!-- <option label="Chọn Danh Mục Con"></option> -->
                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Nhãn Hàng</label>
                                        <select name="brand_id" class="form-control" id="brand_id">
                                            <!-- <option label="Chọn Nhãn Hàng"></option>
                                            @foreach($brand as $item)
                                            <option value="{{$item->id}}">{{$item->brand_name}}</option>
                                            @endforeach -->
                                        </select>

                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Nhóm Sản Phẩm</label>
                                        <select class="form-control" id="group_product_id" name="group_product_id">
                                            <!-- <option label="Chọn Danh Mục Con"></option> -->
                                            
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="col-form-label">Dung Lượng</label>
                                        <input placeholder="Dung Lượng" class="form-control form-control-lg" name="product_size" type="text" value="" id="product_size" data-role="tagsinput">
                                        <!-- <span class="text-danger" id="product_quantity_error"></span> -->
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label">Giá Bán</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Giá Bán" name="selling_price" type="text" value="">
                                        <span class="text-danger" id="selling_price_error"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label">Giá Giảm</label>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Giá Giảm" name="discount_price" type="text" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Chi Tiết Sản Phẩm</label><span class="text-danger">*</span>
                                        <!-- <input class="form-control form-control-lg" placeholder="Giá Bán" name="selling_price" type="text" value=""> -->
                                        <textarea class="form-control" id="elm1" name="product_details"></textarea>
                                        <span class="text-danger" id="product_details_error"></span>
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
                                        <label class="col-form-label">Mô Tả Sản Phẩm</label><span class="text-danger">*</span>
                                        <!-- <input class="form-control form-control-lg" placeholder="Giá Bán" name="selling_price" type="text" value=""> -->
                                        <textarea class="form-control" id="elm2" name="product_desc"></textarea>
                                        <span class="text-danger" id="product_desc_error"></span>
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
                                        <input placeholder="Link Video Sản Phẩm" class="form-control form-control-lg" name="video_link" type="text" value="" id="video_link">
                                        <!-- <span class="text-danger" id="product_quantity_error"></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Slider Chính</label>
                                        <label class="switch">
                                            <input type="checkbox" name="main_slider" checked="true" id="main_slider">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="main_slider_insert" id="main_slider_insert" value="0">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Flash Deal</label>
                                        <label class="switch">
                                            <input type="checkbox" name="flash_deal" checked="true" id="flash_deal">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="flash_deal_insert" id="flash_deal_insert" value="0">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Sản Phẩm Hot</label>
                                        <label class="switch">
                                            <input type="checkbox" name="hot_deal" checked="true" id="hot_deal">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="hot_deal_insert" id="hot_deal_insert" value="0">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Đánh Giá Cao</label>
                                        <label class="switch">
                                            <input type="checkbox" name="best_rated" checked="true" id="best_rated">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="best_rated_insert" id="best_rated_insert" value="0">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Sản Phẩm Xu Hướng</label>
                                        <label class="switch">
                                            <input type="checkbox" name="trend" checked="true" id="trend">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="trend_insert" id="trend_insert" value="0">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="w-100" for="">Sản Phẩm Mới Và Hot</label>
                                        <label class="switch">
                                            <input type="checkbox" name="hot_new" checked="true" id="hot_new">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="hidden" name="hot_new_insert" id="hot_new_insert" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <div>
                                <button type="button" onclick="addProduct()" class="btn-lg btn-primary waves-effect waves-light">
                                    Thêm Mới
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
    <script src="{{ asset('tagsinput/create_product.js') }}"></script>
    <script src="{{ asset('plugins/tinymce/tinymce.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            if ($("#elm1").length > 0) {
                tinymce.init({
                    selector: "textarea#elm1",
                    // plugins : "paste",
                    // paste_as_text: true,
                    setup: function(editor) {
                        editor.on('change', function(e) {
                          $('#product_details_error').text('');
                          editor.save();
                      });
                    },
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [{
                        title: 'Bold text',
                        inline: 'b'
                    }, {
                        title: 'Red text',
                        inline: 'span',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Red header',
                        block: 'h1',
                        styles: {
                            color: '#ff0000'
                        }
                    },  {
                        title: 'Header 1',
                        block: 'h1',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Header 2',
                        block: 'h2',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Header 3',
                        block: 'h3',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Header 4',
                        block: 'h4',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Header 5',
                        block: 'h5',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Example 1',
                        inline: 'span',
                        classes: 'example1'
                    }, {
                        title: 'Example 2',
                        inline: 'span',
                        classes: 'example2'
                    }, {
                        title: 'Table styles'
                    }, {
                        title: 'Table row 1',
                        selector: 'tr',
                        classes: 'tablerow1'
                    }]
                });
            }
            if ($("#elm2").length > 0) {
                tinymce.init({
                    selector: "textarea#elm2",
                    // plugins : "paste",
                    // paste_as_text: true,
                    setup: function(editor) {
                        editor.on('change', function(e) {
                          $('#product_desc_error').text('');
                          editor.save();
                      });
                    },
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [{
                        title: 'Bold text',
                        inline: 'b'
                    }, {
                        title: 'Red text',
                        inline: 'span',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Header 1',
                        block: 'h1',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Header 2',
                        block: 'h2',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Header 3',
                        block: 'h3',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Header 4',
                        block: 'h4',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Header 5',
                        block: 'h5',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Example 1',
                        inline: 'span',
                        classes: 'example1'
                    }, {
                        title: 'Example 2',
                        inline: 'span',
                        classes: 'example2'
                    }, {
                        title: 'Table styles'
                    }, {
                        title: 'Table row 1',
                        selector: 'tr',
                        classes: 'tablerow1'
                    }]
                });
            }
        });
    </script>

    @endpush