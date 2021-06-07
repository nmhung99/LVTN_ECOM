<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Zegva - Responsive Admin & Dashboard Template | Themesdesign</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico')}}">

    <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css')}}">
     <!-- DataTables -->
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <link href="{{ asset('plugins/sweet-alert2/sweetalert2.css')}}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/icons.css')}}" rel="stylesheet" type="text/css">

    @stack('css')
    <link href="{{ asset('backend/assets/css/style.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    @guest('admin')
    @else
    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="{{ url('admin/home')}}" class="logo">
                    <img src="{{ asset('backend/assets/images/logo-light.png')}}" class="logo-lg" alt="" height="22">
                    <img src="{{ asset('backend/assets/images/logo-sm.png')}}" class="logo-sm" alt="" height="24">
                </a>
            </div>

            <!-- Search input -->
            <div class="search-wrap" id="search-wrap">
                <div class="search-bar">
                    <input class="search-input" type="search" placeholder="Search" />
                    <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                        <i class="mdi mdi-close-circle"></i>
                    </a>
                </div>
            </div>

            <nav class="navbar-custom">
                <ul class="navbar-right list-inline float-right mb-0">

                    <li class="list-inline-item dropdown notification-list d-none d-md-inline-block">
                        <a class="nav-link waves-effect toggle-search" href="#" data-target="#search-wrap">
                            <i class="fas fa-search noti-icon"></i>
                        </a>
                    </li>

                    <!-- language-->
                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ asset('backend/assets/images/flags/us_flag.jpg')}}" class="mr-2" height="12" alt="" /> English <span class="mdi mdi-chevron-down"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                            <a class="dropdown-item" href="#"><img src="{{ asset('backend/assets/images/flags/french_flag.jpg')}}" alt="" height="16" /><span> French </span></a>
                            <a class="dropdown-item" href="#"><img src="{{ asset('backend/assets/images/flags/spain_flag.jpg')}}" alt="" height="16" /><span> Spanish </span></a>
                            <a class="dropdown-item" href="#"><img src="{{ asset('backend/assets/images/flags/russia_flag.jpg')}}" alt="" height="16" /><span> Russian </span></a>
                            <a class="dropdown-item" href="#"><img src="{{ asset('backend/assets/images/flags/germany_flag.jpg')}}" alt="" height="16" /><span> German </span></a>
                            <a class="dropdown-item" href="#"><img src="{{ asset('backend/assets/images/flags/italy_flag.jpg')}}" alt="" height="16" /><span> Italian </span></a>
                        </div>
                    </li>

                    <!-- full screen -->
                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                            <i class="fas fa-expand noti-icon"></i>
                        </a>
                    </li>

                    <!-- notification -->
                    <li class="dropdown notification-list list-inline-item">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fas fa-bell noti-icon"></i>
                            <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                            <!-- item-->
                            <h6 class="dropdown-item-text">
                                        Notifications
                                    </h6>
                            <div class="slimscroll notification-item-list">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                                    <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>
                                    <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It is a long established fact that a reader will</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i></div>
                                    <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                </a>

                            </div>
                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center notify-all text-primary">
                                        View all <i class="fi-arrow-right"></i>
                                    </a>
                        </div>
                    </li>

                    <li class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <b class="pr-2 pt-1 font-18">{{Auth::guard('admin')->user()->name}}</b><img src="{{ asset('backend/assets/images/users/user-1.jpg')}}" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-wallet"></i> My Wallet</a>
                                <a class="dropdown-item d-block" href="{{ route('admin.password.change')}}"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings"></i> Settings</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline"></i> Lock screen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i class="mdi mdi-power text-danger"></i> Logout</a>
                            </div>
                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="{{ route('admin.home')}}" class="waves-effect">
                                <i class="dripicons-meter"></i><span class="badge badge-info badge-pill float-right">9+</span> <span> Trang Điều Khiển </span>
                            </a>
                        </li>
                        @if(Auth::guard('admin')->user()->category)
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ion ion-ios-list-box"></i><span> Danh Mục Sản Phẩm <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('categories')}}">Danh Mục Cha</a></li>
                                <li><a href="{{ route('sub.categories')}}">Danh Mục Con</a></li>
                                <li><a href="{{ route('brands')}}">Nhãn Hàng</a></li>
                            </ul>
                        </li>
                        @else
                        @endif

                        @if(Auth::guard('admin')->user()->coupon)
                        <li>
                            <a href="{{ route('admin.coupon')}}" class="waves-effect"><i class="fas fa-gift"></i><span> Mã Giảm Giá </span></a>
                        </li>
                        @else
                        @endif


                        @if(Auth::guard('admin')->user()->product)
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-box-open"></i><span> Sản Phẩm <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('add.product')}}">Thêm Sản Phẩm</a></li>
                                <li><a href="{{ route('admin.product')}}">Danh Sách Sản Phẩm</a></li>
                                <li><a href="{{ route('group.product')}}">Nhóm Sản Phẩm</a></li>
                            </ul>
                        </li>
                        @else
                        @endif

                        @if(Auth::guard('admin')->user()->blog)
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-newspaper"></i><span> Blog <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('admin.blog.category')}}">Danh Mục Blog</a></li>
                                <li><a href="{{ route('add.blogpost')}}">Thêm Bài Viết</a></li>
                                <li><a href="{{ route('admin.blogpost')}}">Danh Sách Bài Viết</a></li>
                            </ul>
                        </li>
                        @else
                        @endif
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-newspaper"></i><span> Banner <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('add.insert.slider')}}">Thêm Banner Chính</a></li>
                                <li><a href="{{ route('admin.slider')}}">Danh Sách Banner Chính</a></li>
                                <li><a href="{{ route('admin.slider.extra')}}">Banner Phụ</a></li>
                           </ul>
                        </li>
                        @if(Auth::guard('admin')->user()->other)
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-to-do"></i><span> Khác <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('admin.newsletter')}}">Thư Tin</a></li>
                                <li><a href="{{ route('admin.seo')}}">Cài Đặt SEO</a></li>
                                <!-- <li><a href="pages-invoice.html">Invoice</a></li>
                                <li><a href="pages-timeline.html">Timeline</a></li>
                                <li><a href="pages-faqs.html">FAQs</a></li>
                                <li><a href="pages-maintenance.html">Maintenance</a></li>
                                <li><a href="pages-comingsoon.html">Coming Soon</a></li>
                                <li><a href="pages-starter.html">Starter Page</a></li>
                                <li><a href="pages-login.html">Login</a></li>
                                <li><a href="pages-register.html">Register</a></li>
                                <li><a href="pages-recoverpw.html">Recover Password</a></li>
                                <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                                <li><a href="pages-404.html">Error 404</a></li>
                                <li><a href="pages-500.html">Error 500</a></li> -->
                            </ul>
                        </li>
                        @else
                        @endif


                        @if(Auth::guard('admin')->user()->order)
                        <li class="menu-title">Quản Lý Đơn Hàng</li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span> Đơn Hàng <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{ route('admin.neworder')}}">Đơn Hàng Chờ Xác Nhận</a></li>
                                <li><a href="{{ route('admin.accept.payment')}}">Đơn Hàng Chấp Nhận</a></li>
                                <li><a href="{{ route('admin.cancel.payment')}}">Đơn Hàng Hủy</a></li>
                                <li><a href="{{ route('admin.process.payment')}}">Đang Vận Chuyển</a></li>
                                <li><a href="{{ route('admin.success.payment')}}">Vận Chuyển Thành Công</a></li>
                            </ul>
                        </li>
                        @else
                        @endif

                        @if(Auth::guard('admin')->user()->report)
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span> Báo Cáo <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{ route('today.order')}}">Đơn Hàng Trong Ngày</a></li>
                                <li><a href="{{ route('today.delivery')}}">Đơn Hàng Vận Chuyển Trong Ngày</a></li>
                                <li><a href="{{ route('this.month')}}">Báo Cáo Tháng Này</a></li>
                                <li><a href="{{ route('search.report')}}">Tìm Kiếm</a></li>
                            </ul>
                        </li>
                        @else
                        @endif

                        @if(Auth::guard('admin')->user()->role)
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-broadcast"></i> <span> Phân Quyền <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                            <ul class="submenu">
                                <li><a href="{{ route('create.admin')}}">Tạo Mới Người Dùng</a></li>
                                <li><a href="{{ route('admin.all.user')}}">Tất Cả Người Dùng</a></li>
                            </ul>
                        </li>
                        @else
                        @endif

                        @if(Auth::guard('admin')->user()->return)
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-document"></i><span> Đơn Hàng Trả Lại <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('admin.return.request')}}">Yêu Cầu Trả Lại</a></li>
                                <li><a href="{{ route('admin.all.return')}}">Tất Cả Yêu Cầu</a></li>
                            </ul>
                        </li>
                        @else
                        @endif

                        @if(Auth::guard('admin')->user()->contact)
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-graph-bar"></i><span> Quản Lý Liên Hệ<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('all.message')}}">Tất Cả Tin Nhắn</a></li>
                            </ul>
                        </li>
                        @else
                        @endif

                        @if(Auth::guard('admin')->user()->comment)
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-list"></i><span> Bình Luận Sản Phẩm <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="tables-basic.html">Bình Luận Mới</a></li>
                                <li><a href="tables-datatable.html">Tất Cả Bình Luận</a></li>
                            </ul>
                        </li>
                        @else
                        @endif

                        @if(Auth::guard('admin')->user()->setting)
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-brightness-max"></i> <span> Cài Đặt Trang Web  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                            <ul class="submenu">
                                <li><a href="{{ route('admin.site.setting')}}">Cài Đặt</a></li>
                            </ul>
                        </li>
                        @else
                        @endif

                        @if(Auth::guard('admin')->user()->stock)
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-brightness-max"></i> <span> Quản Lý Kho  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                            <ul class="submenu">
                                <li><a href="{{ route('admin.product.stock')}}">Quản Lý Kho</a></li>
                            </ul>
                        </li>
                        @else
                        @endif

                        <!-- <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-location"></i><span> Maps <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="maps-google.html"> Google Map</a></li>
                                <li><a href="maps-vector.html"> Vector Map</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-link"></i><span> Multi Level <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="javascript:void(0);"> Menu 1</a></li>
                                <li>
                                    <a href="javascript:void(0);">Menu 2  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                                    <ul class="submenu">
                                        <li><a href="javascript:void(0);">Menu 2.1</a></li>
                                        <li><a href="javascript:void(0);">Menu 2.1</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->

                    </ul>

                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                    

                @endguest
                @yield('admin-content')

                </div>
                <!-- container-fluid -->

            </div>
            <!-- content -->
            <!-- <footer class="footer">
                © 2019 Zegva <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</span>.
            </footer> -->

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="{{ asset('backend/assets/js/jquery.min.js')}}"></script>
    <!-- <script src="{{ asset('backend/assets/js/bootstrap.min.js')}}"></script> -->
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('backend/assets/js/metismenu.min.js')}}"></script>
    <script src="{{ asset('backend/assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{ asset('backend/assets/js/waves.min.js')}}"></script>

    <script src="{{ asset('plugins/apexchart/apexcharts.min.js')}}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    
    <!--Morris Chart-->
    <script src="{{ asset('plugins/morris/morris.min.js')}}"></script>
    <script src="{{ asset('plugins/raphael/raphael.min.js')}}"></script>

    <script src="{{ asset('backend/assets/pages/dashboard.init.js')}}"></script>
    <!-- Sweet-Alert  -->
    <script src="{{ asset('plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('backend/assets/pages/sweet-alert.init.js')}}"></script>
    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.js')}}"></script>
    <script type="application/javascript" charset="UTF-8" src="{{ asset('backend/assets/lib/loadingoverlay.min.js') }}"></script>
    <script type="application/javascript" charset="UTF-8" src="{{ asset('backend/assets/lib/axios.min.js') }}"></script>
    <script type="application/javascript" charset="UTF-8" src="{{ asset('backend/assets/lib/sweetalert2.all.min.js') }}"></script>
    <!-- <script src="{{ asset('toastr/toastr.min.js')}}"></script> -->
    <script>
        @if (Session::has('message')) {
            var type = "{{Session::get('alert-type','info')}}";
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            switch(type){
                case 'info':
                Toast.fire({
                        icon: 'info',
                        title: "{{Session::get('message')}}"
                    })
                // toastr.info("{{Session::get('message')}}");
                break;

                case 'success':
                Toast.fire({
                        icon: 'success',
                        title: "{{Session::get('message')}}"
                    })
                // toastr.success("{{Session::get('message')}}");
                break;

                case 'warning':
                Toast.fire({
                        icon: 'warning',
                        title: "{{Session::get('message')}}"
                    })
                // toastr.warning("{{Session::get('message')}}");
                break;

                case 'error':
                Toast.fire({
                        icon: 'error',
                        title: "{{Session::get('message')}}"
                    })
                // toastr.error("{{Session::get('message')}}");
                break;
            }
        }
        @endif
    </script>
    @stack('js')
</body>

</html>