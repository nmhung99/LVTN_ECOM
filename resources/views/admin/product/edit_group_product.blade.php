@extends('admin.admin_layouts')
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
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Nhóm Sản Phẩm</a>
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
                    Chỉnh Sửa Nhóm Sản Phẩm
                    <!-- <a href="#" data-toggle="modal" data-target=".bs-example-modal-center" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Mới</a> -->
                </h4>
                                    <!-- <p class="sub-title">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                    </p> -->

                                    <!--  -->
                                    <form class="" method="POST" id="form_group_product">
                                        @csrf
                                        <div class="form-group">
                                            <label>Tên Nhóm</label>
                                            <input type="text" onkeypress="removeMessage($(this))" name="group_name" class="form-control" value="{{$info->group_name}}" required placeholder="Tên Nhóm" />
                                            <span class="text-danger" id="group_name_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Danh Mục</label>
                                            <select name="category_id" class="form-control" id="category_id">
                                                <option label="Chọn Danh Mục"></option>
                                                @foreach($cate as $item)
                                                <option value="{{$item->id}}" {{ $item->id == $info->category_id ? 'selected' : '' }}>{{$item->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nhãn Hàng</label>
                                            <select name="brand_id" class="form-control" id="brand_id">
                                                <option value="">Chọn Nhãn Hàng</option>
                                                @foreach($brand as $item)
                                                    @if($item->category_id === $info->category_id)
                                                    <option value="{{$item->id}}" {{ $item->id == $info->brand_id ? 'selected' : '' }} >{{$item->brand_name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="{{$info->id}}" onclick="updateGroup(this.id)" class="btn btn-primary">Cập Nhật</button>
                                        <a href="{{ url()->previous()}}" class="btn btn-secondary">Trở Về</a>
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
                    <script src="{{ asset('/js/backend/edit_group_product.js') }}"></script>

                    @endpush