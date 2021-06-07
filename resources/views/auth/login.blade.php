@extends('layouts.main')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="/">Trang chủ</a>
                </li>
                <li class="active">Đăng Nhập - Đăng Ký </li>
            </ul>
        </div>
    </div>
</div>
@if(!empty($success))
  <div class="alert alert-success"> {{ $success }}</div>
@endif
<div class="login-register-area pt-115 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> Đăng nhập </h4>
                        </a>
                        <a data-toggle="tab" href="#lg2">
                            <h4> Đăng ký </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <span id="veri_fail" class="alert" style="color: red;"></span>
                                    <form action="#" method="POST" id="form_login">
                                        @csrf
                                        <span class="text-danger" id="user_name_error"></span>
                                        <input type="text" onchange="removeMessage($(this))" name="user_name" placeholder="Username">

                                        <span class="text-danger" id="user_password_error"></span>
                                        <input type="password" onchange="removeMessage($(this))" name="user_password" placeholder="Mật khẩu">
                                        <p class="text-danger" id="message_error"></p>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox">
                                                <label>Nhớ tài khoản</label>
                                                <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                                            </div>
                                            <button type="button" onclick="loginUser()">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="lg2" class="tab-pane">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="#" method="POST" id="form_register">
                                        @csrf
                                        <span class="text-danger" id="user_name_error"></span>
                                        <input type="text" onchange="removeMessage($(this))" name="user_name" placeholder="Username">

                                        <span class="text-danger" id="email_error"></span>
                                        <input name="email" onchange="removeMessage($(this))" placeholder="Email" type="email">

                                        <span class="text-danger" id="phone_error"></span>
                                        <input name="phone" onchange="removeMessage($(this))" placeholder="Số điện thoại" type="text">

                                        <span class="text-danger" id="user_password_error"></span>
                                        <input type="password" onchange="removeMessage($(this))" name="user_password" placeholder="Mật khẩu">

                                        <span class="text-danger" id="confirm_password_error"></span>
                                        <input type="password" onchange="removeMessage($(this))" name="confirm_password" placeholder="Xác nhận mật khẩu">

                                        <div class="button-box">
                                            <button type="button" onclick="registerUser()">Đăng ký</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('js/frontend/login_regis.js')}}"></script>
@endpush
