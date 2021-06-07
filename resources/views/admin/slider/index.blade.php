@extends('admin.admin_layouts')
@section('admin-content')
@csrf
<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Danh Sách Banner</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Banner</a>
                        </li>
                        <li class="breadcrumb-item active">Danh Sách Banner</li>
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
                    Danh Sách Banner
                    <a href="{{ route('add.insert.slider')}}" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Banner Chính</a>
                    <a href="{{ route('admin.slider.extra')}}" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Banner Phụ</a>
                </h4>
                                    <!-- <p class="sub-title">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                    </p> -->

                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>ID</th>
                                                <th>Tên Banner</th>
                                                <th>Ảnh Banner</th>
                                                <th>Vị Trí</th>
                                                <th>Trạng Thái</th>
                                                <th>Mô Tả</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            @foreach ($banner as $key => $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->name}}</td>
                                                <td style="width: 300px;">
                                                    <img src="{{$item->image}}" alt="" width="100%" >
                                                    <!-- {{ !empty($item->img) && file_exists(public_path($item->img)) ? asset($item->img) : '/image/default.jpg' }} -->
                                                </td>
                                                <td>
                                                    @if($item->location == 1)
                                                    Banneer Chính
                                                    @elseif($item->location == 2)
                                                    Banner Phụ 1
                                                    @else
                                                    Banner Phụ 2
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->status == 1)
                                                        <span class="badge badge-success">Hoạt động</span>
                                                    @else
                                                        <span class="badge badge-danger">Không Hoạt động</span>
                                                    @endif
                                                </td>
                                                <td>{{$item->desc}}</td>
                                                <td>
                                                    @if($item->location == 1)
                                                    <a href="{{ asset('/admin/slider/edit/'.$item->id)}}" class="btn btn-info waves-effect waves-light" title="Chỉnh Sửa"><i class="fas fa-edit"></i></a>
                                                    @else
                                                    <a href="{{ asset('/admin/slider/extra/edit/'.$item->id)}}" class="btn btn-info waves-effect waves-light" title="Chỉnh Sửa"><i class="fas fa-edit"></i></a>
                                                    @endif
                                                    
                                                    <button id="{{$item->id}}" onclick="deleteSlider(this.id)" class="btn btn-danger waves-effect waves-light" title="Xóa"><i class="fas fa-trash"></i></button>
                                                    @if($item->status == 1)
                                                        <button  class="btn btn-warning waves-effect waves-light" id="{{$item->id}}" onclick="inactive(this.id)" title="Hủy Hoạt Động"><i class="fas fa-thumbs-down"></i></button>
                                                    @else
                                                        <button class="btn btn-success waves-effect waves-light" id="{{$item->id}}" onclick="active(this.id)" title="Hoạt Động"><i class="fas fa-thumbs-up"></i></button>
                                                    @endif
                                                    <!-- <a href="{{ asset('/admin/brands/edit/'.$item->id)}}" class="btn btn-info waves-effect waves-light">Chỉnh Sửa</a>
                                                    <a href="#" id="{{$item->id}}" onclick="deleteBrand(this.id)" class="btn btn-danger waves-effect waves-light">Xóa</a> -->
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
                    <script src="{{ asset('/js/backend/slider.js') }}"></script>
                    @endpush