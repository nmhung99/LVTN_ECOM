<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;
use Auth;



class FrontController extends Controller
{
    public function storeNewsletter(Request $request)
    {
    	$rules = [
            'email'     => 'required|email|max:255'
        ];
        $messages = [
            'email.required'  => 'Vui lòng nhập email',
            'email.email'     => 'Vui lòng nhập email đúng định dạng',
            'email.max'       => 'Vui lòng nhập email không vượt quá 255 ký tự'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $email = $request->email;
        $data = [
            'email'    => $email
        ];
        DB::table('newsletters')->insert($data);
        // update
        // User::where('id', $id)->where('...',...)->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Đăng Ký Thành Công'
        ], 200);
    }

    public function orderTracking(Request $request)
    {

        $rules = [
            'status_code'           => 'required'
        ];
        $messages = [
            'status_code.required'  => 'Vui lòng nhập mã đơn hàng'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $code = $request->status_code;
        $track = DB::table('orders')->where('status_code',$code)->where('user_id',Auth::id())->first();
        // Session::put('ordertrack',$track);
        Session::put('ordertrack',[
            'track'     => $track,
            'code'      => $code
        ]);
        if ($track) {
            return response()->json([
                'status'  => true,
                'track'   => $track,
                'code'      => $code,
                'messages' => 'Mã Đơn Hàng Hợp Lệ'
            ], 200);
        } else {
            return response()->json([
                'status' => 'invalid',
                'messages' => 'Mã Đơn Hàng Không Tồn Tại'
            ], 400);
        }
    }

    public function orderTrackingView(Request $request, $code)
    {
        $check = DB::table('orders')->where('user_id',Auth::id())->get();
        // dd(session('ordertrack')['code']);
        // die();
        if ($check->count() !== 0) {
            if (Session::has('ordertrack')) {
                // $infotrack = Session::get('ordertrack')['track'];
                // $infotrack = session('ordertrack')['track'];
                $codetrack = session('ordertrack')['code'];
                $infotrack = DB::table('orders')->where('status_code',$codetrack)->first();
                if ($codetrack == $code) {
                    return view('pages.tracking',['infotrack'=>$infotrack]);
                } else {
                    return redirect('/');
                }
                
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
        
        // Session::get('ordertrack');
        // return view('pages.tracking',['infotrack'=>$infotrack]);
    }

    public function searchProduct(Request $request)
    {
        $search = $request->searchproduct;
        $products = DB::table('products')
                        ->where('product_name','LIKE',"%$search%")->paginate(12);
        return view('pages.search',['products'=>$products,'search'=>$search]);
    }
}
