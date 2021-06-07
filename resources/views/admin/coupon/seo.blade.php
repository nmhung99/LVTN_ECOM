@extends('admin.admin_layouts')
    @push('css')
    <link href="{{ asset('css/backend/create_post.css') }}" rel="stylesheet">
    @endpush
@section('admin-content')

<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Cài Đặt SEO</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Khác</a>
                        </li>
                        <li class="breadcrumb-item active">Cài Đặt SEO</li>
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
                        Cài Đặt SEO
                        <!-- <a href="{{ route('admin.blogpost')}}" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Danh Sách Bài Viết</a> -->
                        <!-- <a href="#" data-toggle="modal" data-target=".bs-example-modal-center" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Mới</a> -->
                    </h4>
                    <form action="" method="post" id="form_seo">
                        @csrf
                        <!-- <div class="form-group">
                            <div class="col-lg-12">
                                <label class="col-form-label">Ảnh Đại Diện Bài Viết</label><span class="text-danger">*</span>
                                <div class="row">
                                    <div class="col-6 imgUp">
                                        <div class="imagePreview">
                                            <img width="100%" src="{{ '/media/default2.png' }}"/>
                                            <input type="hidden" class="url" name="url_img" value="{{ '/media/default2.png' }}"/>
                                        </div>
                                        <label class="btn btn-primary" id="btn-upload">
                                            Upload
                                            <input type="file" name="image" class="uploadFile img" accept="image/*">
                                        </label>
                                        <span class="text-danger" id="image_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="product_code" class="col-form-label">Tiêu Đề (Meta Title)</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Tiêu Đề" name="meta_title" type="text" value="{{$seo->meta_title}}" id="meta_title">
                                        <span class="text-danger" id="meta_title_error"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="product_code" class="col-form-label">Meta Author</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Tiêu Đề" name="meta_author" type="text" value="{{$seo->meta_author}}" id="meta_author">
                                        <span class="text-danger" id="meta_author_error"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="product_code" class="col-form-label">Thẻ Meta (Meta Tag)</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Tiêu Đề" name="meta_tag" type="text" value="{{$seo->meta_tag}}" id="meta_tag">
                                        <span class="text-danger" id="meta_tag_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Mô Tả (Meta Description)</label><span class="text-danger">*</span>
                                        <!-- <input class="form-control form-control-lg" placeholder="Giá Bán" name="selling_price" type="text" value=""> -->
                                        <textarea class="form-control" required id="elm1" name="meta_description">{{$seo->meta_description}}</textarea>
                                        <span class="text-danger" id="meta_description_error"></span>
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
                                        <label class="col-form-label">Google Analytics</label><span class="text-danger">*</span>
                                        <!-- <input class="form-control form-control-lg" placeholder="Giá Bán" name="selling_price" type="text" value=""> -->
                                        <textarea class="form-control" required id="elm2" name="google_analytics">{{$seo->google_analytics}}</textarea>
                                        <span class="text-danger" id="google_analytics_error"></span>
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
                                        <label class="col-form-label">Bing Analytics</label><span class="text-danger">*</span>
                                        <!-- <input class="form-control form-control-lg" placeholder="Giá Bán" name="selling_price" type="text" value=""> -->
                                        <textarea class="form-control" required id="elm3" name="bing_analytics">{{$seo->bing_analytics}}</textarea>
                                        <span class="text-danger" id="bing_analytics_error"></span>
                                    </div>
                                    <!-- <div class="card-body">
                                        <h4 class="mt-0 header-title">Chi Tiết Sản Phẩm</h4>
                                        <textarea id="elm1" name="area"></textarea>
                                    </div> -->
                                    <input type="hidden" value="{{$seo->id}}" name="idseo">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <div>
                                <button type="button" onclick="updateSeo()" class="btn-lg btn-primary waves-effect waves-light">
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
    <script src="{{ asset('js/backend/seo.js') }}"></script>
    <script src="{{ asset('plugins/tinymce/tinymce.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            if ($("#elm1").length > 0) {
                tinymce.init({
                    selector: "textarea#elm1",
                    setup: function(editor) {
                        editor.on('change', function(e) {
                          $('#meta_description_error').text('');
                          editor.save();
                      });
                    },
                    theme: "modern",
                    plugins : "paste",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                });
            }
            if ($("#elm2").length > 0) {
                tinymce.init({
                    selector: "textarea#elm2",
                    setup: function(editor) {
                        editor.on('change', function(e) {
                          $('#google_analytics_error').text('');
                          editor.save();
                      });
                    },
                    theme: "modern",
                    plugins : "paste",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                });
            }
            if ($("#elm3").length > 0) {
                tinymce.init({
                    selector: "textarea#elm3",
                    setup: function(editor) {
                        editor.on('change', function(e) {
                          $('#bing_analytics_error').text('');
                          editor.save();
                      });
                    },
                    theme: "modern",
                    plugins : "paste",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                });
            }
        });
    </script>

    @endpush