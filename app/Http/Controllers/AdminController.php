<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authadmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Admin::find(Auth::guard('admin')->id());
        return view('admin.home',['admin'=>$admin]);
    }

    public function ChangePassword()
    {
        return view('admin.auth.passwordchange');
    }

    public function Update_pass(Request $request)
    {

      $rules = [
            'oldpass'               => 'required|min:8|max:64',
            'password'              => 'required|min:8|max:16',
            'password_confirmation' => 'required|same:password'
        ];
        $messages = [
            'oldpass.required'  => 'Vui lòng nhập mật khẩu cũ',
            'oldpass.min'       => 'Vui lòng nhập mật khẩu tối thiểu 8 ký tự',
            'oldpass.max'       => 'Vui lòng nhập mật khẩu tối đa 64 ký tự',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.min'      => 'Vui lòng nhập mật khẩu mới tối thiểu 8 ký tự',
            'password.max'      => 'Vui lòng nhập mật khẩu mới tối đa 64 ký tự',
            'password_confirmation.same'     => 'Mật khẩu không trùng',
            'password_confirmation.required'     => 'Vui lòng xác nhận mật khẩu',
            
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
      $password=Auth::guard('admin')->user()->password;
      $oldpass=$request->oldpass;
      $newpass=$request->password;
      $confirm=$request->password_confirmation;
      if (Hash::check($oldpass,$password)) {
           // if ($newpass === $confirm) {
                      $user=Admin::find(Auth::guard('admin')->id());
                      $user->password=Hash::make($request->password);
                      $user->save();
                      Auth::guard('admin')->logout();  
                      $message = 'Thay đổi mật khẩu thành công';
                      return response()->json([
                          'status' => true,
                          'message' => $message
                        ], 200);
                      // $notification=array(
                      //   'messege'=>'Password Changed Successfully ! Now Login with Your New Password',
                      //   'alert-type'=>'success'
                      //    );
                      //  return Redirect()->route('admin.login')->with($notification); 
                 // }else{
                 //     $message = 'Xác nhận mật khẩu không giống mật khẩu mới';
                 //      return response()->json([
                 //          'status' => 'passconfirm_fail',
                 //          'message' => $message
                 //        ], 400);
                 // }     
      }else{
        $messages = 'Mật khẩu cũ không đúng';
                      return response()->json([
                          'status' => 'oldpass_fail',
                          'messages' => $messages
                        ], 400);
      }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
            $notification=array(
                'messege'=>'Successfully Logout',
                'alert-type'=>'success'
                 );
             return Redirect()->route('admin.login')->with($notification);
    }

}
