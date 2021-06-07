<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class CouponController extends Controller
{
	public function __construct()
	{
		$this->middleware('authadmin');
        $this->middleware('authrole:coupon');
	}


	public function Coupon()
	{
		$coupon = DB::table('coupons')->get();
		return view('admin.coupon.coupon',['coupon'=>$coupon]);
	}

	public function storeCoupon(Request $request)
	{
		$rules = [
            'coupon'     => 'required|unique:coupons,coupon|max:255',
            'discount'   => 'required|max:255'
        ];
        $messages = [
            'coupon.required'  => 'Vui lòng nhập mã giảm giá',
            'coupon.unique'    => 'Mã giảm giá đã tồn tại',
            'coupon.max'       => 'Mã giảm giá vượt quá 255 ký tự',
            'discount.required'=> 'Vui lòng nhập phần trăm giảm',
            'discount.max'     => 'Phần trăm giảm vượt quá 255 ký tự'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
        $coupon = $request->coupon;
        $discount = $request->discount;
        $data = [
            'coupon'    => $coupon,
            'discount'  => $discount
        ];
        DB::table('coupons')->insert($data);
        // update
        // User::where('id', $id)->where('...',...)->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Thêm Mã Giảm Giá Thành Công'
        ], 200);
	}

	public function deleteCoupon(Request $request)
	{
		$id = $request->id;
        if (!empty($id)) {
            DB::table('coupons')->where('id',$id)->delete();
        }
        // $info = User::find($id);
        // $info->delete();
        // return back();
        return response()->json([
            'status' => true,
            'message' => 'Xóa thành công'
        ], 200);
	}

	public function updateCoupon($id)
    {
        $info = DB::table('coupons')->find($id);
        return view('admin.coupon.edit_coupon',['info'=>$info]);
    }

    public function postupdateCoupon($id, Request $request)
    {
        $rules = [
            'coupon'     => 'required|max:255',
            'discount'   => 'required|max:255'
        ];
        $messages = [
            'coupon.required'  => 'Vui lòng nhập mã giảm giá',
            'coupon.max'       => 'Mã giảm giá vượt quá 255 ký tự',
            'discount.required'=> 'Vui lòng nhập phần trăm giảm',
            'discount.max'     => 'Phần trăm giảm vượt quá 255 ký tự'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $coupon = $request->coupon;
        $discount = $request->discount;
        $data = [
            'coupon'    => $coupon,
            'discount'  => $discount
        ];

        $update = DB::table('coupons')->where('id',$id)->update($data);
        if ($update) {
            return response()->json([
            'status' => true,
            'message' => 'Cập nhật thành công'
        ], 200);
        } else {
            return response()->json([
            'status' => 'update_fail',
            'message' => 'Không có gì đề cập nhật'
        ], 400);
        }
    }


    public function Newsletter()
    {
        $newsletter = DB::table('newsletters')->get();
        return view('admin.coupon.newsletter',['newsletter'=>$newsletter]);
    }

    public function deletenewsletter(Request $request)
    {
        $id = $request->id;
        if (!empty($id)) {
            DB::table('newsletters')->where('id',$id)->delete();
        }
        // $info = User::find($id);
        // $info->delete();
        // return back();
        return response()->json([
            'status' => true,
            'message' => 'Xóa thành công'
        ], 200);
    }
}
