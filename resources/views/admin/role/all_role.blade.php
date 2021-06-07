@extends('admin.admin_layouts')
@section('admin-content')
@csrf
<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Tất Cả Người Dùng</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Phân Quyền</a>
                        </li>
                        <li class="breadcrumb-item active">Tất Cả Người Dùng</li>
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
                    Danh sách người dùng
                    <a href="{{ route('create.admin')}}" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Mới</a>
                </h4>
                                    <!-- <p class="sub-title">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                    </p> -->

                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Tên</th>
                                                <th>Điện Thoại</th>
                                                <th>Email</th>
                                                <th>Quyền Truy Cập</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($user as $key => $item)
                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->phone}}</td>
                                                <td>{{$item->email}}</td>
                                                <td style="font-size: 16px; white-space:normal;">
                                                    @if($item->category == 1)
                                                    <span class="badge badge-success">Danh Mục Sản Phẩm</span>
                                                    @endif
                                                    @if($item->coupon == 1)
                                                    <span class="badge badge-primary">Mã Giảm Giá</span>
                                                    @endif
                                                    @if($item->product == 1)
                                                    <span class="badge badge-info">Sản Phẩm</span>
                                                    @endif
                                                    @if($item->blog == 1)
                                                    <span class="badge badge-warning">Blog</span>
                                                    @endif
                                                    @if($item->order == 1)
                                                    <span class="badge badge-danger">Đơn Hàng</span>
                                                    @endif
                                                    @if($item->other == 1)
                                                    <span class="badge badge-success">Khác</span>
                                                    @endif
                                                    @if($item->role == 1)
                                                    <span class="badge badge-primary">Phân Quyền</span>
                                                    @endif
                                                    @if($item->return == 1)
                                                    <span class="badge badge-info">Đơn Hàng Trả Lại</span>
                                                    @endif
                                                    @if($item->contact == 1)
                                                    <span class="badge badge-warning">Liên Hệ</span>
                                                    @endif
                                                    @if($item->comment == 1)
                                                    <span class="badge badge-danger">Bình Luận</span>
                                                    @endif
                                                    @if($item->setting == 1)
                                                    <span class="badge badge-success">Cài Đặt</span>
                                                    @endif
                                                    @if($item->stock == 1)
                                                    <span class="badge badge-success">Kho</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ asset('/admin/role/edit/'.$item->id)}}" class="btn btn-info waves-effect waves-light">Chỉnh Sửa</a>
                                                    <a href="#" id="{{$item->id}}" onclick="deleteAdmin(this.id)" class="btn btn-danger waves-effect waves-light">Xóa</a>
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
                    <script src="{{ asset('/js/backend/role.js') }}"></script>

                    @endpush