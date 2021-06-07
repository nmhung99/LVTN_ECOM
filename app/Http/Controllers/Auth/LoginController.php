<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
        // $this->middleware('verified');
    }

    public function postLogin(Request $request)
    {
        // dd($request->all());
        $rules = [
            'user_name'        => 'required|',
            'user_password'    => 'required|min:8|max:64'
        ];
        $messages = [
            'user_name.required'     => 'Vui lòng nhập email',
            'user_password.required' => 'Vui lòng nhập mật khẩu',
            'user_password.min'      => 'Vui lòng nhập password tối thiểu 8 ký tự',
            'user_password.max'      => 'Vui lòng nhập password tối đa 64 ký tự',
            
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
        $name = $request->user_name;
        $password = $request->user_password;

        // $valid = Auth::attempt(['name'=>$name, 'password'=>$password]);
        $user = User::where('name', $name)->first();
        if ($user->hasVerifiedEmail()) {
            if (Auth::attempt(['name'=>$name, 'password'=>$password])) {
                // return $this->sendLoginResponse($request);
                return response()->json([
                'status' => true
            ], 200);
            } else {
            return response()->json([
                'status' => 'auth_fail',
                'messages' => 'User hoặc mật khẩu chưa đúng'
            ], 400);
            } 
        }else {
            return response()->json([
                'status' => 'veri_fail',
                'messages' => 'Chưa xác minh email'
            ], 400);
            
        }
        // var_dump ($valid);

        // die();
        // if ($valid) {
        //     return response()->json([
        //         'status' => true
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'status' => 'auth_fail',
        //         'messages' => 'Email hoặc mật khẩu chưa đúng'
        //     ], 400);
        // }
    }
}
