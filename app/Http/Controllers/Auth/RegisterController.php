<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    public function postRegister(Request $request)
    {
        // dd($request->all());
        $rules = [
            'user_name'          => 'required|max:255|min:6|unique:users,name',
            'email'             => 'required|email|unique:users,email',
            'phone'             => 'required',
            'user_password'          => 'required|min:8|max:64',
            'confirm_password'  => 'required|same:user_password'
        ];
        $messages = [
            'user_name.required'         => 'Vui lòng nhập username',
            'user_name.min'              => 'Username không dưới 6 ký tự',
            'user_name.max'              => 'Username không quá 64 ký tự',
            'user_name.unique'           => 'Username đã tồn tại',

            'email.required'             => 'Vui lòng nhập email',
            'email.email'                => 'Vui lòng nhập đúng định dạng email',
            'email.unique'               => 'Địa chỉ email đã tồn tại',

            'phone.required'             => 'Vui lòng nhập số điện thoại',
            
            'user_password.required'         => 'Vui lòng nhập password',
            'user_password.min'              => 'Vui lòng nhập password tối thiểu 8 ký tự',
            'user_password.max'              => 'Vui lòng nhập password tối đa 64 ký tự',

            'confirm_password.same'      => 'Mật khẩu không khớp',
            'confirm_password.required'  => 'Vui lòng xác nhận mật khẩu',
            
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
        $name     = $request->user_name;
        $password = $request->user_password;
        // $data = [
        //     'email'    => $request->email,
        //     'name'     => $request->user_name,
        //     'phone'    => $request->phone,
        //     'password' => Hash::make($request->user_password)
        // ];
        // $user = User::insert($data);
        $user = User::create([
            'email'    => $request->email,
            'name'     => $request->user_name,
            'phone'    => $request->phone,
            'password' => Hash::make($request->user_password)
        ]);
        event(new Registered($user));
        // Auth::attempt(['name'=>$name, 'password'=>$password]);
        return response()->json([
            'status' => true,
            'message' => 'Đăng ký thành công'
        ], 200);
        // $valid = Auth::guard('admin')->attempt(['email'=>$email, 'password'=>$password]);
        // var_dump ($valid);

        // die();
        // if ($valid) {
        //     $details = Auth::guard('admin')->user();
        //     $user = $details['original'];
        //     return response()->json([
        //         'status' => true
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'status' => 'auth_fail',
        //         'messages' => 'Email hoặc mật khẩu chưa đúng'
        //     ], 400);
        // }
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

    public function successRegister()
    {
        return view('auth.custom_verify');
    }
}
