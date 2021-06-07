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
                    <h4 class="page-title">Blog</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Blog</a>
                        </li>
                        <li class="breadcrumb-item active">Thêm Mới Bài Viết</li>
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
                        Thêm Bải Viết
                        <a href="{{ route('admin.blogpost')}}" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Danh Sách Bài Viết</a>
                        <!-- <a href="#" data-toggle="modal" data-target=".bs-example-modal-center" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Mới</a> -->
                    </h4>
                    <form action="" method="post" id="form_post">
                        @csrf
                        <div class="form-group">
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
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Danh Mục Blog</label><span class="text-danger">*</span>
                                        <select name="category_id" onchange="removeMessage($(this))" class="form-control" id="category_id">
                                            <option label="Chọn Danh Mục"></option>
                                            @foreach($blogcat as $item)
                                            <option value="{{$item->id}}">{{$item->category_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="category_id_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="product_code" class="col-form-label">Tiêu Đề Bài Viết</label><span class="text-danger">*</span>
                                        <input class="form-control form-control-lg" onkeypress="removeMessage($(this))" placeholder="Tiêu Đề Bài Viết" name="post_title" type="text" value="" id="post_title">
                                        <span class="text-danger" id="post_title_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Nội Dung Bài Viết</label><span class="text-danger">*</span>
                                        <!-- <input class="form-control form-control-lg" placeholder="Giá Bán" name="selling_price" type="text" value=""> -->
                                        <textarea class="form-control" required id="elm1" name="details"></textarea>
                                        <span class="text-danger" id="details_error"></span>
                                    </div>
                                    <!-- <div class="card-body">
                                        <h4 class="mt-0 header-title">Chi Tiết Sản Phẩm</h4>
                                        <textarea id="elm1" name="area"></textarea>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <div>
                                <button type="button" onclick="addPost()" class="btn-lg btn-primary waves-effect waves-light">
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
    <script src="{{ asset('js/backend/create_post.js') }}"></script>
    <script src="{{ asset('plugins/tinymce/tinymce.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            if ($("#elm1").length > 0) {
                tinymce.init({
                    selector: "textarea#elm1",
                    setup: function(editor) {
                        editor.on('keydown', function(e) {
                          $('#details_error').text('');
                          editor.save();
                      });
                    },
                    theme: "modern",
                    plugins : "paste",
                    paste_as_text: true,
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
        });
    </script>

    @endpush