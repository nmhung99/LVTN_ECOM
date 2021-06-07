@extends('admin.admin_layouts')
@section('admin-content')
@csrf
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
                        <li class="breadcrumb-item active">Danh Sách Bài Viết</li>
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
                    Danh sách bài viết
                    <a href="{{ route('add.blogpost')}}" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Mới</a>
                </h4>
                                    <!-- <p class="sub-title">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                    </p> -->

                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th style="width: 60px;">ID</th>
                                                <th>Tiêu Đề</th>
                                                <th>Ảnh Bài Viết</th>
                                                <th>Danh Mục Blog</th>
                                                <th>Thời Gian</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            @foreach ($post as $key => $item)
                                            <tr>
                                                <td >{{$key+1}}</td>
                                                <td>{{mb_strimwidth($item->post_title, 0, 30, '...')}}</td>
                                                <td style="width: 300px;">
                                                    <img src="{{$item->post_image}}" alt="" width="100%" >
                                                    <!-- {{ !empty($item->img) && file_exists(public_path($item->img)) ? asset($item->img) : '/image/default.jpg' }} -->
                                                </td>
                                                <td>{{$item->category_name}}</td>
                                                <td>
                                                    {{
                                                        date('d-m-Y H:i:s', strtotime($item->created_at)) 
                                                    }}
                                                </td>
                                                <td>
                                                    <a href="{{ asset('/admin/blogpost/edit/'.$item->id)}}" class="btn btn-info waves-effect waves-light" title="Chỉnh Sửa">Chỉnh Sửa</a>
                                                    <button id="{{$item->id}}" onclick="deletePost(this.id)" class="btn btn-danger waves-effect waves-light" title="Xóa">Xóa</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    <!-- /.modal -->
                    @endsection
                    @push('js')
                    <!-- Required datatable js -->
                    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
                    <!-- Buttons examples -->
                    <script src="{{ asset('plugins/datatables/dataTables.buttons.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/jszip.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/pdfmake.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/vfs_fonts.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/buttons.html5.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/buttons.print.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/buttons.colVis.min.js')}}"></script>
                    <!-- Responsive examples -->
                    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

                    <!-- Datatable init js -->
                    <script src="{{ asset('backend/assets/pages/datatables.init.js')}}"></script>
                    <!-- category js -->
                    <script src="{{ asset('/js/backend/index_post.js') }}"></script>
                    @endpush