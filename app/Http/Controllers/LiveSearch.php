<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;
use Auth;


class LiveSearch extends Controller
{
    public function searchLive(Request $request)
    {
    	if ($request->ajax()) {
            $products = DB::table('products')->where('product_name', 'LIKE', '%'.$request->search.'%')->limit(5)->get();
            if ($products->count() !== 0) {
                return response()->json([
					'status' => true,
					'message' => 'Tìm Thấy SP',
					'products' => $products
				], 200); 
            } else {
            	return response()->json([
					'status' => 'invalid',
					'message' => 'Không Tìm Thấy SP'
				], 200); 
            }
        }
    }
}
