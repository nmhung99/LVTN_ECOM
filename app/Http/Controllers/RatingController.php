<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;

class RatingController extends Controller
{
    public function postRate(Request $request)
    {
    	if (Auth::check()) {
    		$rules = [
    			'ratingstar'    => 'required',
    			'contentreview' => 'required'
    		];
    		$messages = [
    			'ratingstar.required'     => 'Vui lòng chọn đánh giá trước khi đăng',
    			'contentreview.required'  => 'Vui lòng viết đánh giá trước khi đăng'
    		];
    		$validator = validator::make($request->all(), $rules, $messages);
    		if ($validator->errors()->messages()) {
    			return response()->json([
    				'status' => 'validator_fail',
    				'messages' => $validator->errors()->messages()
    			], 400);
    		}

    		$data = [
    			'product_id' => $request->ipproduct,
    			'user_id' 	 => Auth::id(),
    			'rate' 		 => $request->ratingstar,
    			'content' 	 => $request->contentreview
    		];
    		DB::table('ratings')->insert($data);
    		return response()->json([
    				'status' => true,
    				'messages' => 'Đánh Giá Thành Công'
    			], 200);
    	} else {
    		return response()->json([
    			'status' => 'login_invalid',
    			'messages' => 'Hãy Đăng Nhập Để Gửi Đánh Giá'
    		], 400);
    	}
    	
    }
}
