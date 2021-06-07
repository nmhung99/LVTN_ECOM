@extends('admin.admin_layouts')
@section('admin-content')

<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Tìm Kiếm</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Báo Cáo</a>
                        </li> 
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Tìm Kiếm</a>
                        </li>
                        <!-- <li class="breadcrumb-item active">Chỉnh Sửa</li> -->
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
        <div class="col-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 clearfix header-title mb-3">
                        Tìm Kiếm Theo Ngày
                    </h4>
                    <form class="" action="/admin/report/search/date" method="POST" id="form_brand">
                        @csrf
                        <div class="form-group">
                            <label>Ngày</label>
                            <input type="date" id="datepi" onkeypress="removeMessage($(this))" name="date" class="form-control form-control-lg" value="" required placeholder="Ngày Đơn Hàng" />
                            <span class="text-danger" id="date_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 clearfix header-title mb-3">
                        Tìm Kiếm Theo Tháng
                    </h4>
                    <form class="" action="/admin/report/search/month" method="POST" id="form_search_month">
                        @csrf
                        <div class="form-group">
                            <label>Tháng</label>
                            <select class="form-control form-control-lg" name="month" id="">
                                <option value="january">Tháng 1</option>
                                <option value="february">Tháng 2</option>
                                <option value="march">Tháng 3</option>
                                <option value="april">Tháng 4</option>
                                <option value="may">Tháng 5</option>
                                <option value="june">Tháng 6</option>
                                <option value="july">Tháng 7</option>
                                <option value="august">Tháng 8</option>
                                <option value="september">Tháng 9</option>
                                <option value="october">Tháng 10</option>
                                <option value="november">Tháng 11</option>
                                <option value="december">Tháng 12</option>
                            </select>
                            <label>Năm</label>
                            <select class="form-control form-control-lg" name="year" id="">
                                @php
                                    $year = date('Y');
                                    $infoyear = (int)$year;
                                @endphp
                                <option value="{{$infoyear}}">{{$infoyear}}</option>
                                <option value="{{$infoyear-1}}">{{$infoyear-1}}</option>
                                <option value="{{$infoyear-2}}">{{$infoyear-2}}</option>
                                <option value="{{$infoyear-3}}">{{$infoyear-3}}</option>
                                <option value="{{$infoyear-4}}">{{$infoyear-4}}</option>
                                <option value="{{$infoyear-5}}">{{$infoyear-5}}</option>
                                <option value="{{$infoyear-6}}">{{$infoyear-6}}</option>
                                <option value="{{$infoyear-7}}">{{$infoyear-7}}</option>
                            </select>
                            <!-- <input type="text" onkeypress="removeMessage($(this))" name="brand_name" class="form-control" value="" required placeholder="Tên Nhãn Hàng" />
                            <span class="text-danger" id="brand_name_error"></span> -->
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 clearfix header-title mb-3">
                        Tìm Kiếm Theo Năm
                    </h4>
                    <form action="/admin/report/search/year" method="POST" id="form_search_year">
                        @csrf
                        <div class="form-group">
                            <label>Năm</label>
                            <select class="form-control form-control-lg" name="year" id="">
                                @php
                                    $year = date('Y');
                                    $infoyear = (int)$year;
                                @endphp
                                <option value="{{$infoyear}}">{{$infoyear}}</option>
                                <option value="{{$infoyear-1}}">{{$infoyear-1}}</option>
                                <option value="{{$infoyear-2}}">{{$infoyear-2}}</option>
                                <option value="{{$infoyear-3}}">{{$infoyear-3}}</option>
                                <option value="{{$infoyear-4}}">{{$infoyear-4}}</option>
                                <option value="{{$infoyear-5}}">{{$infoyear-5}}</option>
                                <option value="{{$infoyear-6}}">{{$infoyear-6}}</option>
                                <option value="{{$infoyear-7}}">{{$infoyear-7}}</option>
                            </select>
                            <!-- <input type="text" onkeypress="removeMessage($(this))" name="year" class="form-control" value="" required placeholder="Tên Nhãn Hàng" /> -->
                            <!-- <span class="text-danger" id="year_error"></span> -->
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

                    @endsection
                    @push('js')
                    <!-- category js -->
                    <script src="{{ asset('/js/backend/report_search.js') }}"></script>

                    @endpush