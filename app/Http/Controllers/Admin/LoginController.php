<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = 'admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    
    public function showLoginForm()
    {
         if (Auth::id()) {
             return redirect()->back();
         }else{
            return view('admin.auth.login');
         }
        
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function postLogin(Request $request)
    {
        // dd($request->all());
        $rules = [
            'email'       => 'required|email',
            'password'       => 'required|min:8|max:64'
        ];
        $messages = [
            'email.required'    => 'Vui lòng nhập email',
            'email.email'       => 'Vui lòng nhập đúng định dạng email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min'      => 'Vui lòng nhập password tối thiểu 8 ký tự',
            'password.max'      => 'Vui lòng nhập password tối đa 64 ký tự',
            
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
        $email = $request->email;
        $password = $request->password;

        $valid = Auth::guard('admin')->attempt(['email'=>$email, 'password'=>$password]);
        // var_dump ($valid);

        // die();
        if ($valid) {
            $details = Auth::guard('admin')->user();
            $user = $details['original'];
            return response()->json([
                'status' => true
            ], 200);
        } else {
            return response()->json([
                'status' => 'auth_fail',
                'messages' => 'Username hoặc mật khẩu chưa đúng'
            ], 400);
        }
        // $data = [
        //  'avatar' => $request->email,
     //        'password' => $request->password
        // ];
        // if (Auth::attempt($data)) {
        //  return redirect()->route('register');
        // } else {
        //  return redirect()->route('login');
        // }
    }
}
