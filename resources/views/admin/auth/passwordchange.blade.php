@extends('admin.admin_layouts')
@section('admin-content')
<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Thay Đổi Mật Khẩu</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <!-- <li class="breadcrumb-item"> -->
                            <!-- <a href="javascript:void(0);">Sản Phẩm</a> -->
                        <!-- </li> -->
                        <!-- <li class="breadcrumb-item active">Thêm Mới</li> -->
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Admin</strong> Thay Đổi Mật Khẩu</div>

                <div class="card-body">
                    <form method="POST" action="#" id="form_change_pass" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <!--  -->

                        <div class="form-group row">
                            <label for="oldpass" class="col-md-4 col-form-label text-md-right">{{ __('Mật Khẩu Cũ') }}</label>

                            <div class="col-md-6">
                                <input id="oldpass" onkeypress="removeMessage($(this))" type="password" class="form-control{{ $errors->has('oldpass') ? ' is-invalid' : '' }}" name="oldpass" value="{{ $oldpass ?? old('oldpass') }}" required autofocus>
                                <span class="text-danger" id="oldpass_error"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mật Khẩu Mới') }}</label>

                            <div class="col-md-6">
                                <input id="password" onkeypress="removeMessage($(this))" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <span class="text-danger" id="password_error"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Xác Nhận Mật Khẩu Mới') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" onkeypress="removeMessage($(this))" type="password" class="form-control" name="password_confirmation" required>
                                <span class="text-danger" id="password_confirmation_error"></span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" onclick="updatePass()" class="btn btn-primary">
                                    {{ __('Đổi Mật Khẩu') }}
                                </button>
                            </div>
                        </div>
                        <p class="text-danger" id="message_error"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('/js/backend/dashboard.js') }}"></script>
@endpush