@extends('admin.admin_layouts')
@section('admin-content')


@php
    $date = date('d-m-y');
    $today = DB::table('orders')->where('date',$date)->where('status',3)->sum('total');

    $month = date('F');
    $month = DB::table('orders')->where('month',$month)->where('status',3)->sum('total');

    $year = date('Y');
    $year = DB::table('orders')->where('year',$year)->where('status',3)->sum('total');

    $delyvery = DB::table('orders')->where('date',$date)->where('status',3)->get();

    $return = DB::table('orders')->where('return_order',2)->get();

    $product = DB::table('products')->get();
    $brand = DB::table('brands')->select('brand_name')->groupBy('brand_name')->get();
    $user = DB::table('users')->get();
@endphp
<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <!-- <h1 class="page-title">Trang Chủ</h1> -->
                    <h4>Xin Chào, {{$admin->name}}</h4>
                    <!-- <ol class="breadcrumb"> -->

                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Danh Mục Sản Phẩm</a>
                        </li>
                        <li class="breadcrumb-item active">Nhãn Hàng</li>
                    </ol> -->
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
<!-- start top-Contant -->
                    <div class="row">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-6">
                                            <h5 class="font-16">Doanh Thu Hôm Nay</h5>
                                            <h4 class="text-info pt-1 mb-0">{{number_format($today)}} VND</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div id="chart1"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-6">
                                            <h5 class="font-16">Đơn Hàng Hôm Nay</h5>
                                            <h4 class="text-danger pt-1 mb-0">{{$delyvery->count()}}</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div id="chart4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-7">
                                            <h5 class="font-16">Doanh Thu Tháng Này</h5>
                                            <h5 class="text-warning pt-1 mb-0">{{number_format($month)}} VND</h5>
                                        </div>
                                        <div class="col-lg-5">
                                            <div id="chart2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-7">
                                            <h5 class="font-16">Doanh Thu Năm Nay</h5>
                                            <h5 class="text-primary pt-1 mb-0">{{number_format($year)}} VND</h5>
                                        </div>
                                        <div class="col-lg-5">
                                            <div id="chart3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-6">
                                            <h5 class="font-16">Đơn Hàng Hoàn Trả</h5>
                                            <h4 class="text-info pt-1 mb-0">{{$return->count()}}</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div id="chart8"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-6">
                                            <h5 class="font-16">Số Sản Phẩm</h5>
                                            <h4 class="text-danger pt-1 mb-0">{{$product->count()}}</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div id="chart6"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-7">
                                            <h5 class="font-16">Số Nhãn Hàng</h5>
                                            <h5 class="text-warning pt-1 mb-0">{{$brand->count()}}</h5>
                                        </div>
                                        <div class="col-lg-5">
                                            <div id="chart7"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center p-1">
                                        <div class="col-lg-7">
                                            <h5 class="font-16">Người Dùng</h5>
                                            <h5 class="text-primary pt-1 mb-0">{{$user->count()}}</h5>
                                        </div>
                                        <div class="col-lg-5">
                                            <div id="chart5"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end top-Contant -->

                   <!-- end top-Contant -->

                    <!-- <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Sales Statistics</h4>
                                    <ul class="list-inline widget-chart mt-4 mb-0 text-center">
                                        <li class="list-inline-item">
                                            <h5>3654</h5>
                                            <p class="text-muted">Marketplace</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5>954</h5>
                                            <p class="text-muted">Last week</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5>8462</h5>
                                            <p class="text-muted">Last Month</p>
                                        </li>
                                    </ul>
                                    <div id="morris-bar-stacked" class="text-center" style="height: 350px;"></div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Trends Monthly</h4>
                                    <ul class="list-inline widget-chart mt-4 mb-0 text-center">
                                        <li class="list-inline-item">
                                            <h5>3654</h5>
                                            <p class="text-muted">Marketplace</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5>954</h5>
                                            <p class="text-muted">Last week</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5>8462</h5>
                                            <p class="text-muted">Last Month</p>
                                        </li>
                                    </ul>
                                    <div id="morris-donut-example" class="morris-charts morris-chart-height text-center" style="height: 350px;"></div>

                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- end row -->
@endsection