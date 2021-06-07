@extends('admin.admin_layouts')
@section('admin-content')
<div class="accountbg"></div>

    <!-- Begin page -->
    <!-- <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-white"><i class="mdi mdi-home h1"></i></a>
    </div> -->

    <div class="wrapper-page">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5">
                    <div class="card card-pages shadow-none mt-4">
                        <div class="card-body">
                            <div class="text-center mt-0 mb-3">
                                <a href="index.html" class="logo logo-admin">
                                    <img src="{{ asset('backend/assets/images/logo-dark.png')}}" class="mt-3" alt="" height="26"></a>
                                <p class="text-muted w-75 mx-auto mb-4 mt-4">Trang quản trị website ManhZ Store</p>
                            </div>

                            <form class="form-horizontal mt-4" method="POST" id="form_login">
                                @csrf
                                <div class="form-group">
                                    <div class="col-12">
                                        <label for="email">E-Mail</label>
                                        <input class="form-control" onkeypress="removeMessage($(this))" type="text" name="email" id="email" placeholder="E-Mail">
                                        <span class="text-danger" id="email_error"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <label for="password">Mật Khẩu</label>
                                        <input class="form-control" onkeypress="removeMessage($(this))" type="password" name="password" id="password" placeholder="Mật Khẩu">
                                        <span class="text-danger" id="password_error"></span>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <div class="col-12">
                                        <div class="checkbox checkbox-primary">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">Nhớ Tài Khoản</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="form-group text-center mt-4">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" onclick="login()" type="button">Đăng Nhập</button>
                                    </div>
                                </div>

                                <div class="form-group text-center mt-4">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock mr-1"></i> Quên Mật Khẩu?</a>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-danger" id="message_error"></p>

                                <!-- <div class="text-center">
                                    <p class="mt-4 text-muted">Đăng Nhập Với</p>
                                    <ul class="social-list list-inline mb-2">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                                        </li>
                                    </ul>
                                </div> -->

                            </form>

                        </div>

                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
@push('js')
<script src="{{ asset('/js/backend/login.js') }}"></script>
@endpush