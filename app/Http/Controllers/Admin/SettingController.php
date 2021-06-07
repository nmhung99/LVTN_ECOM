<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;


class SettingController extends Controller
{
	public function __construct()
	{
		$this->middleware('authadmin');
        $this->middleware('authrole:setting');
	}

	public function siteSetting()
	{
		$setting = DB::table('sitesetting')->first();
		return view('admin.setting.site_setting',['setting'=>$setting]);
	}

	public function updateSiteSetting(Request $request)
	{
		$id = $request->settingid;

		$rules = [
            'phone_one'        	=> 'required',
            'phone_two'       	=> 'required',
            'email'          	=> 'required|email',
            'company_name'  	=> 'required',
            'company_address'  	=> 'required',
            'facebook'    		=> 'required',
            'youtube'    		=> 'required',
            'instagram'    		=> 'required',
            'twitter'    		=> 'required'
        ];
        $messages = [
            'phone_one.required'        => 'Không được bỏ trống',
            'phone_two.required'       	=> 'Không được bỏ trống',
            'email.required'          	=> 'Không được bỏ trống',
            'email.email'          		=> 'Sai định dạng email',
            'company_name.required'  	=> 'Không được bỏ trống',
            'company_address.required'  => 'Không được bỏ trống',
            'facebook.required'    		=> 'Không được bỏ trống',
            'youtube.required'    		=> 'Không được bỏ trống',
            'instagram.required'    	=> 'Không được bỏ trống',
            'twitter.required'    		=> 'Không được bỏ trống'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $data = [
            'phone_one'        	=> $request->phone_one,
            'phone_two'       	=> $request->phone_two,
            'email'          	=> $request->email,
            'company_name'  	=> $request->company_name,
            'company_address'  	=> $request->company_address,
            'facebook'    		=> $request->facebook,
            'youtube'    		=> $request->youtube,
            'instagram'    		=> $request->instagram,
            'twitter'    		=> $request->twitter
        ];
        DB::table('sitesetting')->where('id',$id)->update($data);
        
        return response()->json([
                'status' => true,
                'message' => 'Cập Nhật Thông Tin Thành Công'
            ], 200);
	}
}
