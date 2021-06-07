<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use Session;


use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function changePassword(){
        return view('auth.changepassword');
    }

    public function updatePassword(Request $request)
    {
      $rules = [
            'oldpass'               => 'required|min:8|max:64',
            'newpassword'           => 'required|min:8|max:16',
            'password_confirmation' => 'required|same:newpassword'
        ];
        $messages = [
            'oldpass.required'                => 'Vui lòng nhập mật khẩu cũ',
            'oldpass.min'                     => 'Vui lòng nhập mật khẩu tối thiểu 8 ký tự',
            'oldpass.max'                     => 'Vui lòng nhập mật khẩu tối đa 64 ký tự',
            'newpassword.required'            => 'Vui lòng nhập mật khẩu mới',
            'newpassword.min'                 => 'Vui lòng nhập mật khẩu mới tối thiểu 8 ký tự',
            'newpassword.max'                 => 'Vui lòng nhập mật khẩu mới tối đa 64 ký tự',
            'password_confirmation.same'      => 'Mật khẩu không trùng',
            'password_confirmation.required'  => 'Vui lòng xác nhận mật khẩu',
            
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
      // $request->validate([
      //   'oldpass'     => 'required',
      //   'password'     => 'required',
      //   'password_confirmation'     => 'required'
      // ]);
      // $rules = [
      //   'oldpass'     => 'required',
      //   'password'     => 'required',
      //   'password_confirmation'     => 'required'
      // ];
      // $messages = [
      //   'oldpass'     => 'Cần nhập',
      //   'password'     => 'cần nhập',
      //   'password_confirmation'     => 'Cần nhập'  
      // ];
      // $validator = validator::make($request->all(), $rules, $messages);

      $password=Auth::user()->password;
      $oldpass=$request->oldpass;
      $newpass=$request->newpassword;
      $confirm=$request->password_confirmation;
      if (Hash::check($oldpass,$password)) {
           // if ($newpass === $confirm) {
                      $user=User::find(Auth::id());
                      $user->password=Hash::make($request->newpassword);
                      $user->save();
                      Auth::logout();  
                      // $notification=array(
                      //   'messege'=>'Password Changed Successfully ! Now Login with Your New Password',
                      //   'alert-type'=>'success'
                      //    );
                      //  return Redirect()->route('login')->with($notification); 
                      $message = 'Thay đổi mật khẩu thành công';
                      return response()->json([
                          'status' => true,
                          'message' => $message
                        ], 200);
                 // }else{

                     // $notification=array(
                     //    'messege'=>'New password and Confirm Password not matched!',
                     //    'alert-type'=>'error'
                     //     );
                     //   return Redirect()->back()->with($notification);
                 // }     
      }else{
        $messages = 'Mật khẩu cũ không đúng';
        return response()->json([
          'status' => 'oldpass_fail',
          'messages' => $messages
        ], 400);
      }

    }

    public function Logout()
    {
        // $logout= Auth::logout();
            Auth::logout();
            Session::forget('coupon',['name', 'discount','balance']);
            Session::forget('infoship');
            $notification=array(
                'messege'=>'Successfully Logout',
                'alert-type'=>'success'
                 );
             return Redirect()->route('index')->with($notification);
       

    }
}
