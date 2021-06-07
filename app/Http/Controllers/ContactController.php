<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;
use Auth;

class ContactController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('verified');
    // }
	// public function __construct()
 //    {
 //        $this->middleware('authadmin');
 //    }
    
    public function contact()
    {
    	return view('pages.contact');
    }

    public function contactSend(Request $request)
    {
    	$rules = [
            'name'     => 'required|min:2|max:255',
            'phone'    => 'required|numeric|digits_between:10,12',
            'email'    => 'required|email',
            'message'  => 'required'
        ];
        $messages = [
            'name.required' 		=> 'Không được bỏ trống',
        	'name.min' 				=> 'Không dưới 2 ký tự',
        	'name.max' 				=> 'Không vượt quá 255 ký tự',
        	'phone.required' 		=> 'Không được bỏ trống',
        	'phone.numeric' 		=> 'Không hợp lệ',
        	'phone.digits_between' 	=> 'Không hợp lệ',
        	'email.required' 		=> 'Không được bỏ trống',
        	'email.email' 			=> 'Sai định dạng email',
        	'message.required' 		=> 'Không được bỏ trống',
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $data = [
    		'name'   	=> $request->name,
            'phone'  	=> $request->phone,
            'email'  	=> $request->email,
            'subject'   => $request->subject,
            'message'  	=> $request->message
    	];

    	DB::table('contact')->insert($data);
    		return response()->json([
    			'status' => true,
    			'message' => 'Tin Nhắn Đã Được Gửi. Chúng Tôi Sẽ Sớm Phản Hồi'
    		], 200);
    }

    public function allMessage()
    {
		$mess = DB::table('contact')->get();
    	return view('admin.contact.all_messsage',['mess'=>$mess]);
    }

    public function viewMessage($id)
    {
        $mess = DB::table('contact')->where('id',$id)->first();
        return view('admin.contact.view_messsage',['mess'=>$mess]);
    }
}
