@extends('admin.admin_layouts')
@section('admin-content')
@csrf
<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Chi Tiết Đơn Hàng</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Đơn Hàng</a>
                        </li>
                        <!-- <li class="breadcrumb-item active">Đơn Hàng Chờ Xác Nhận</li> -->
                        <li class="breadcrumb-item active">Chi Tiết Đơn Hàng</li>
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
         <div class="col-md-6">
            <div class="card">
                <div class="card-header"><strong>Chi tiết</strong> đơn hàng</div>
                <div class="card_body">
                    <table class="table">
                        <tr>
                            <th>Tên Tài Khoản:</th>
                            <th>{{$order -> name}}</th>
                        </tr>
                        <tr>
                            <th>Điện Thoại:</th>
                            <th>{{$order -> phone}}</th>
                        </tr>
                        <tr>
                            <th>Mã Đơn Hàng:</th>
                            <th>{{$order -> status_code}}</th>
                        </tr>
                        <tr>
                            <th>Hình Thức Thanh Toán:</th>
                            <th>{{$order -> payment_type}}</th>
                        </tr>
                        <tr>
                            <th>Mã Thanh Toán:</th>
                            <th>{{$order -> payment_id}}</th>
                        </tr>
                        <tr>
                            <th>Tạm Tính:</th>
                            @if($order -> coupon == NULL)
                                <th>{{number_format($order -> subtotal)}} vnd</th>
                            @else
                            @php
                                $check = DB::table('coupons')->where('coupon',$order->coupon)->first();
                                $dis = $check->discount;
                            @endphp
                                <th>{{number_format(($order->subtotal*100)/(100-$dis))}} vnd</th>
                            @endif
                        </tr>
                        <tr>
                            @if($order -> coupon == NULL)
                            <th>Mã Giảm Giá:</th>
                                <th>Không Có</th>
                            @else
                            <th>Mã Giảm Giá: <span style="text-transform: uppercase;">({{$order -> coupon}})</span></th>
                            @php
                                $check = DB::table('coupons')->where('coupon',$order->coupon)->first();
                                $total = ($order->subtotal*100)/(100-$dis)
                            @endphp
                                <th>- {{$check -> discount}} % <span>(- {{number_format($check->discount*$total/100)}} vnd)</span></th>
                            @endif
                        </tr>
                        <tr>
                            <th>Phí Ship:</th>
                            <th>{{number_format($order -> shipping)}} vnd</th>
                        </tr>
                        <tr>
                            <th>Thuế:</th>
                            <th>{{number_format($order -> vat)}} vnd</th>
                        </tr>
                        <tr>
                            <th>Tổng Tiền:</th>
                            <th>{{number_format($order -> total)}} vnd</th>
                        </tr>
                        <tr>
                            <th>Tháng:</th>
                            <th>
                                @php
                                    $month = $order->month;
                                    switch ($month) {
                                    case 'January':
                                       $month1 = 'Tháng 1';
                                    break;
                                    case 'February':
                                        $month1 = 'Tháng 2';
                                    break;
                                    case 'March':
                                        $month1 = 'Tháng 3';
                                    break;
                                    case 'April':
                                        $month1 = 'Tháng 4';
                                    break;
                                    case 'May':
                                        $month1 = 'Tháng 5';
                                    break;
                                    case 'June':
                                        $month1 = 'Tháng 6';
                                    break;
                                    case 'July':
                                        $month1 = 'Tháng 7';
                                    break;
                                    case 'August':
                                        $month1 = 'Tháng 8';
                                    break;
                                    case 'September':
                                        $month1 = 'Tháng 9';
                                    break;
                                    case 'October':
                                        $month1 = 'Tháng 10';
                                    break;
                                    case 'November':
                                        $month1 = 'Tháng 11';
                                    break;
                                    case 'December':
                                        $month1 = 'Tháng 12';
                                    default:
                                        $month1 = 'Không tìm thấy';
                                    break;
                                }
                                @endphp
                                {{ $month1
                                }}
                            </th>
                        </tr>
                        <tr>
                            <th>Ngày:</th>
                            <th>{{$order -> date}}</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>    

         <div class="col-md-6">
            <div class="card">
                <div class="card-header"><strong>Thông tin</strong> vận chuyển</div>
                <table class="table">
                        <tr>
                            <th>Tên Người Nhận:</th>
                            <th>{{$shipping -> ship_name}}</th>
                        </tr>
                        <tr>
                            <th>Điện Thoại:</th>
                            <th>{{$shipping -> ship_phone}}</th>
                        </tr>
                        <tr>
                            <th>Địa Chỉ:</th>
                            <th>{{$shipping -> ship_address}}</th>
                        </tr>
                        <tr>
                            <th>Tỉnh/Thành Phố:</th>
                            <th>{{$shipping -> ship_city}}</th>
                        </tr>
                        <tr>
                            <th>Quận/Huyện:</th>
                            <th>{{$shipping -> ship_state}}</th>
                        </tr>
                        <tr>
                            <th>Trạng Thái:</th>
                            <th>
                                @if($order -> status == 0)
                                    <span style="font-size: 14px;" class="badge badge-pill badge-warning">Đang Chờ</span>
                                @elseif($order -> status == 1)
                                    <span style="font-size: 14px;" class="badge badge-pill badge-info">Chấp Nhận Thanh Toán</span>
                                @elseif($order -> status == 2)
                                    <span style="font-size: 14px;" class="badge badge-pill badge-warning">Đang Vận Chuyển</span>
                                @elseif($order -> status == 3)
                                    <span style="font-size: 14px;" class="badge badge-pill badge-success">Hoàn Thành Vận Chuyển</span>
                                @else
                                    <span style="font-size: 14px;" class="badge badge-pill badge-danger">Từ Chối</span>
                                @endif
                            </th>
                        </tr>
                    </table>
            </div>
        </div>    
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 clearfix header-title mb-3">
                        Chi Tiết Sản Phẩm
                    </h4>
                    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 60px;">Mã Sản Phẩm</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Ảnh Sản Phẩm</th>
                                <th>Màu Sắc</th>
                                <th>Số Lượng</th>
                                <th>Đơn Giá</th>
                                <th>Tổng Tiền</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @foreach ($details as $key => $item)
                            <tr>
                                <td width="100px">{{$item->product_code}}</td>
                                <td style="white-space:normal;">{{$item->product_name}}</td>
                                <?php $image = json_decode($item->image) ?>
                                <td width="200px">
                                    <img src="{{asset($image[0])}}" alt="" width="100%" >
                                    <!-- {{ !empty($item->img) && file_exists(public_path($item->img)) ? asset($item->img) : '/image/default.jpg' }} -->
                                </td>
                                <td style="text-transform: capitalize;">{{$item->color}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{number_format($item->singleprice)}}</td>
                                <td>{{number_format($item->totalprice)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            @if($order->status == 0)
                <a type="button" id="{{$order->id}}" onclick="accept(this.id)" style="font-size: 20px !important; color: white;" class="col-12 mb-2 btn btn-info">Chấp Nhận Thanh Toán</a>
                <a type="button" id="{{$order->id}}" onclick="cancel(this.id)" style="font-size: 20px !important; color: white;" class="col-12 btn btn-danger">Hủy Đơn Hàng</a>
            @elseif($order->status == 1)
                <a type="button" id="{{$order->id}}" onclick="delivery(this.id)"  style="font-size: 20px !important; color: white;" class="col-12 mb-2 btn btn-info">Vận Chuyển Giao Hàng</a>
            @elseif($order->status == 2)
                <a type="button" id="{{$order->id}}" onclick="deliverydone(this.id)"  style="font-size: 20px !important; color: white;" class="col-12 mb-2 btn btn-success">Hoàn Thành Vận Chuyển</a>
            @elseif($order->status == 4)
                <span  style="font-size: 20px !important;" class="col-12 p-3 badge badge-pill badge-danger">Đơn Hàng Đã Bị Hủy</span>
            @else
                <span  style="font-size: 20px !important;" class="col-12 p-3 badge badge-pill badge-success">Đơn Hàng Đã Được Vận Chuyển Thành Công</span>
            @endif
        </div>
        <!-- end col -->
    </div>

    @endsection
    @push('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{ asset('plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{ asset('backend/assets/pages/datatables.init.js')}}"></script>
    <script src="{{ asset('/js/backend/order.js') }}"></script>
    @endpush