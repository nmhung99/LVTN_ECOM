<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('authadmin');
        $this->middleware('authrole:order');
    }

    public function newOrder()
    {
    	$order = DB::table('orders')->where('status',0)->get();
    	// dd($order);
        $title = 'Đơn Hàng Chờ Xác Nhận';
    	return view('admin.order.pending',['order'=>$order,'title'=>$title]);
    }

    public function viewOrder($id)
    {
    	$order = DB::table('orders')
    			->join('users','orders.user_id','users.id')
    			->select('orders.*','users.name','users.phone')
    			->where('orders.id',$id)
    			->first();
    			// dd($order);
    	$shipping = DB::table('shipping')->where('order_id',$id)->first();
    	// dd($order);
    	$details = DB::table('orders_details')
    			->join('products','orders_details.product_id','products.id')
    			->select('orders_details.*','products.product_code','products.image')
    			->where('orders_details.order_id',$id)->get();
    			// dd($details);
    	return view('admin.order.view_order',['order'=>$order, 'shipping'=>$shipping, 'details'=>$details]);
    }

    public function acceptPayment($id)
    {
        DB::table('orders')->where('id',$id)->update(['status'=>1]);
        return response()->json([
                'status' => true,
                'message' => 'Đã Chấp Nhận Thanh Toán'
            ], 200);
    }

    public function cancelPayment($id)
    {
        DB::table('orders')->where('id',$id)->update(['status'=>4]);
        return response()->json([
                'status' => true,
                'message' => 'Đã Hủy Đơn Hàng'
            ], 200);
    }

    public function PaymentAccept()
    {
        $order = DB::table('orders')->where('status',1)->get();
        // dd($order);
        $title = 'Đơn Hàng Chấp Nhận Thanh Toán';
        return view('admin.order.pending',['order'=>$order,'title'=>$title]);
    }

    public function OrderCancel()
    {
        $order = DB::table('orders')->where('status',4)->get();
        // dd($order);
        $title = 'Đơn Hàng Bị Hủy';
        return view('admin.order.pending',['order'=>$order,'title'=>$title]);
    }

    public function ProcessPayment()
    {
        $order = DB::table('orders')->where('status',2)->get();
        // dd($order);
        $title = 'Đơn Hàng Đang Vận Chuyển';
        return view('admin.order.pending',['order'=>$order,'title'=>$title]);
    }

    public function SuccessPayment()
    {
        $order = DB::table('orders')->where('status',3)->get();
        // dd($order);
        $title = 'Đơn Hàng Vận Chuyển Thành Công';
        return view('admin.order.pending',['order'=>$order,'title'=>$title]);
    }

    public function deliveryProcess($id)
    {
        DB::table('orders')->where('id',$id)->update(['status'=>2]);
        // dd($order);
        return response()->json([
                'status' => true,
                'message' => 'Đã Chuyển Tới Vận Chuyển'
            ], 200);
    }

    public function deliveryDone($id)
    {
        $product = DB::table('orders_details')->where('order_id',$id)->get();
        foreach ($product as $item) {
             DB::table('products')
                    ->where('id',$item->product_id)
                    ->update(['product_quantity' => DB::raw('product_quantity-'.$item->quantity)]);
        }

        DB::table('orders')->where('id',$id)->update(['status'=>3]);
        // dd($order);
        return response()->json([
                'status' => true,
                'message' => 'Hoàn Thành Vận Chuyển'
            ], 200);
    }


    public function seo()
    {
        $seo = DB::table('seo')->first();
        return view('admin.coupon.seo',['seo'=>$seo]);
    }

    public function seoUpdate(Request $request)
    {
        $rules = [
            'meta_title'        => 'required',
            'meta_author'       => 'required',
            'meta_tag'          => 'required',
            'meta_description'  => 'required',
            'google_analytics'  => 'required',
            'bing_analytics'    => 'required'
        ];
        $messages = [
            'meta_title.required'        => 'Không được bỏ trống',
            'meta_author.required'       => 'Không được bỏ trống',
            'meta_tag.required'          => 'Không được bỏ trống',
            'meta_description.required'  => 'Không được bỏ trống',
            'google_analytics.required'  => 'Không được bỏ trống',
            'bing_analytics.required'    => 'Không được bỏ trống'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $id = $request->idseo;
        $data = [
            'meta_title'        => $request->meta_title,
            'meta_author'       => $request->meta_author,
            'meta_tag'          => $request->meta_tag,
            'meta_description'  => $request->meta_description,
            'google_analytics'  => $request->google_analytics,
            'bing_analytics'    => $request->bing_analytics
        ];
        DB::table('seo')->where('id',$id)->update($data);
        return response()->json([
                'status' => true,
                'message' => 'Cập Nhật Thông Tin Thành Công'
            ], 200);

    }

}
