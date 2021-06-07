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
                        <li class="breadcrumb-item active">Nhãn Hàng</li>
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
                    Danh sách nhãn hàng
                    <a href="#" data-toggle="modal" data-target=".bs-example-modal-center" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Mới</a>
                </h4>
                                    <!-- <p class="sub-title">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                    </p> -->

                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>ID</th>
                                                <th>Tên Nhãn Hàng</th>
                                                <th>Logo</th>
                                                <th>Danh Mục</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            @foreach ($brand as $key => $item)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$item->brand_name}}</td>
                                                <td style="width: 300px;">
                                                    <img src="{{$item->brand_logo}}" alt="" width="100%" >
                                                    <!-- {{ !empty($item->img) && file_exists(public_path($item->img)) ? asset($item->img) : '/image/default.jpg' }} -->
                                                </td>
                                                <td>{{$item->category_name}}</td>
                                                <td>
                                                    <a href="{{ asset('/admin/brands/edit/'.$item->id)}}" class="btn btn-info waves-effect waves-light">Chỉnh Sửa</a>
                                                    <a href="#" id="{{$item->id}}" onclick="deleteBrand(this.id)" class="btn btn-danger waves-effect waves-light">Xóa</a>
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

                    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0">Thêm Nhãn Hàng</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="" method="POST" id="form_brand">
                                        @csrf
                                        <div class="form-group">
                                            <label>Tên Nhãn Hàng</label>
                                            <input type="text" onkeypress="removeMessage($(this))" name="brand_name" class="form-control" required placeholder="Tên Nhãn Hàng" />
                                            <span class="text-danger" id="brand_name_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label>Danh Mục Sản Phẩm</label>
                                            <select name="category_id" onchange="removeMessage($(this))" class="form-control" id="">
                                                @foreach($category as $item)
                                                <option value="{{$item->id}}">{{$item->category_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="category_id_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label>Logo Nhãn Hàng</label>
                                            <!-- <input type="file" name="brand_logo" class="form-control" required placeholder="Logo Nhãn Hàng" /> -->
                                            <div class="logo_wrapper">
                                                <img src="{{ !empty($info->img) ? $info->img : '/media/default2.png' }}" value="{{ !empty($info) ? $info->img : '' }}" class="logo-pic">
                                                <div class="upload-button">
                                                    <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                                </div>
                                                <input type="file" id="logo" name="logo" class="file-upload" accept="image/*">
                                                <input type="hidden" name="url_logo" id="url_logo" value="{{ !empty($info) ? $info->img : '/media/default2.png' }}">
                                            </div>
                                            <!-- <span class="text-danger" id="brand_name_error"></span> -->
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" onclick="addBrand()" class="btn btn-primary">Thêm Mới</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
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
                    <script src="{{ asset('/js/backend/brand.js') }}"></script>
                    @endpush