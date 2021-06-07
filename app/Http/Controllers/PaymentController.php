<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Cart;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use Illuminate\Support\Facades\Validator;
use Session;

class PaymentController extends Controller
{
    public function paymentProcess(Request $request)
    {
    	$rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'address'    => 'required',
            'city'       => 'required',
            'state'      => 'required',
            'phone'    	 => 'required|numeric|digits_between:10,12'
        ];
        $messages = [
            'first_name.required' 	=> 'Vui lòng nhập họ',
            'last_name.required'  	=> 'Vui lòng nhập tên',
            'address.required' 	  	=> 'Vui lòng nhập địa chỉ',
            'city.required' 		=> 'Vui lòng nhập tỉnh/thành phố',
            'state.required' 		=> 'Vui lòng nhập quận/huyện',
            'phone.required' 		=> 'Vui lòng nhập số điện thoại',
            'phone.numeric' 		=> 'Vui lòng nhập đúng định dạng số điện thoại',
            'phone.digits_between' 			=> 'Số điện thoại không hợp lệ',
            // 'phone.max' 			=> 'Số điện thoại không hợp lệ',
            
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
    	$payment 	= $request->payment_method;
    	$first_name = $request->first_name;
    	$last_name  = $request->last_name;
    	$name 		= $first_name.' '.$last_name;
    	$address 	= $request->address;
    	$city 		= $request->city;
    	$state 		= $request->state;
    	$phone 		= $request->phone;
    	$data = [
    		'name' 		=> $name,
    		'address' 	=> $address,
    		'city' 		=> $city,
    		'state' 	=> $state,
    		'phone' 	=> $phone,
    		'payment' 	=> $payment
    	];
    	// if ($payment == 'stripe') {
    	// 	// $view = view('pages.payment.stripe',['data'=>$data])->render();
    	// 	// return view('pages.payment.stripe',['data'=>$data]);
     //        // return redirect('/home')->with('data', $data);
     //        // return Redirect()->back();
    	// 	// return response()->json(array('success' => true, 'view'=>$view));
            
    	// } elseif ($payment == 'paypal') {
    		
    	// } else {
    	// 	echo 'COD';
    	// }
        Session::put('infoship',[
            'name'      => $name,
            'address'   => $address,
            'city'      => $city,
            'state'     => $state,
            'phone'     => $phone,
            'payment'   => $payment
        ]);
        // Session::forget('infoship');
        return response()->json([
                    'payment'   => $payment
              ], 200); 
    	// dd($data);
    	// var_dump ($payment);
    	// die();
    }

    public function paymentProcessView()
    {
        if (Cart::count() != 0) {
            if (Session::has('infoship')) {
                return view('pages.payment.stripe');
            } else {
                return redirect('/user/checkout');
            }
        } else {
           return redirect('/'); 
        }
        
    }

    public function stripeCharge(Request $request)
    {
        $total1 = $request->total;
        // Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51IcoQgJYHi9ugH5xiSnVurF95BbV9J66tliR9VFqNtcMPgXVzyjErX62IBaik4MgmdHiU9dfiJUCR7I1Q8lB1Jaf00dFjIXPFt');

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
          'amount' => $total1,
          'currency' => 'vnd',
          'description' => 'Thanh Toán Đơn Mua ManhZ Store',
          'source' => $token,
          'metadata' => ['order_id' => uniqid()],
      ]);
        // $data = array();
        $data = [
            'user_id'               => Auth::id(),
            'payment_id'            => $charge->payment_method,
            'paying_amount'         => $charge->amount,
            'balance_transaction'   => $charge->balance_transaction,
            'stripe_order_id'       => $charge->metadata->order_id,
            'shipping'              => $request->shipping,
            'vat'                   => $request->vat,
            'total'                 => $request->total,
            'payment_type'          => $request->payment_type,
            'status_code'           => mt_rand(1000000,9999999)
        ];
        // dd($charge);

        if (Session::has('coupon')) {
            $data['subtotal'] = Session::get('coupon')['balance'];
            $data['coupon']   = Session::get('coupon')['name'];
        } else {
            $data['subtotal'] = Cart::subtotal(0,'.','');
            // $data['coupon']   = Session::get('coupon')['name'];
        }

        $data['status'] = 0;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $order_id = DB::table('orders')->insertGetId($data);

        //Insert shipping table

        $shipping = [
            'order_id'       => $order_id,
            'ship_name'      => $request->ship_name,
            'ship_phone'     => $request->ship_phone,
            'ship_address'   => $request->ship_address,
            'ship_city'      => $request->ship_city,
            'ship_state'     => $request->ship_state
        ];
        DB::table('shipping')->insert($shipping);

        //Insert order_details table
        $content = Cart::content();
        $details = array();
        foreach ($content as $item) {
            $details = [
                'order_id' => $order_id,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'color' => $item->options->color,
                'quantity' => $item->qty,
                'singleprice' => $item->price,
                'totalprice' => $item->qty*$item->price,
            ];
        DB::table('orders_details')->insert($details);
        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notification=array(
            'message'=>'Mua Hàng Thành Công',
            'alert-type'=>'success'
        );
        return Redirect()->to('/')->with($notification); 

    }

    public function successList()
    {
        $order = DB::table('orders')->where('user_id',Auth::id())->where('status',3)->orderBy('id','DESC')->limit(5)->get();
        return view('pages.returnorder',['order'=>$order]);
    }

    public function requestReturn($id)
    {
        DB::table('orders')->where('id',$id)->update(['return_order'=>1]);
        return response()->json([
            'status'   => true,
            'message'  => 'Đã Gửi Yêu Cầu Hoàn Trả Đơn Hàng'
        ], 200); 
    }
}
