<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;


class WishlistController extends Controller
{
    public function addWishlist($id)
    {
    	$user_id = Auth::id();
    	$check = DB::table('wishlists')->where('user_id',$user_id)->where('product_id',$id)->first();
    	$data = [
    		'user_id' 	 => $user_id,
    		'product_id' => $id
    	];
    	if (Auth::check()) {
    		if ($check) {
    			return response()->json([
                  'status' => 'already',
                  'message' => 'Sản Phẩm Đã Có Trong Danh Sách Yêu Thích'
              ], 400);
    		} else {
    			DB::table('wishlists')->insert($data);
    			return response()->json([
                  'status' => true,
                  'message' => 'Thêm Vào Yêu Thích Thành Công'
              ], 200); 
    		}
    	} else {
    		return response()->json([
              'status' => 'must_login',
              'message' => 'Bạn Cần Phải Đăng Nhập'
          ], 400); 
    	}
    }

    public function deleteWishlist(Request $request)
    {
      $id = $request->id;
        DB::table('wishlists')->where('product_id',$id)->delete();
        return response()->json([
                  'status' => true,
                  'message' => 'Đã Xóa Danh Sách Yêu Thích'
              ], 200);
    }
}
