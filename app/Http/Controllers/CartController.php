<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;
use Auth;
use Session;




class CartController extends Controller
{
	// public function __construct()
 //    {
 //        $this->middleware('auth');
 //        // $this->middleware('verified');
 //    }
	public function addCart($id)
	{
		$product = DB::table('products')->where('id',$id)->first();
		$color = $product->product_color;
    	$product_color = explode(',', $color);
		$data = [];
		$image = json_decode($product->image);
		// if (Auth::check()) {
			if ($product->discount_price == NULL) {
				$data = [
					'id'   		=> $product->id,
					'name' 		=> $product->product_name,
					'qty' 		=> 1,
					'weight' 	=> 1,
					'price' 	=> $product->selling_price,
					'options' 	=> ['image' =>$image[0], 'color' => $product_color[0]]
				];
				Cart::add($data);
				return response()->json([
					'status' => true,
					'message' => 'Thêm Vào Giỏ Hàng Thành Công'
				], 200); 
			} 
			else {
				$data = [
					'id'   		=> $product->id,
					'name' 		=> $product->product_name,
					'qty' 		=> 1,
					'weight' 	=> 1,
					'price' 	=> $product->discount_price,
					'options' 	=> ['image' =>$image[0], 'color' => $product_color[0] ]
				];
				Cart::add($data);
				return response()->json([
					'status' => true,
					'message' => 'Thêm Vào Giỏ Hàng Thành Công'
				], 200); 
			}
		// }
		// else {
		// 	return response()->json([
		// 		'status' => 'must_login',
		// 		'message' => 'Cần Phải Đăng Nhập'
		// 	], 400); 
		// }
		
	}

	public function checkCart()
	{
		$check = Cart::content();
		return response()->json($check);
	}

	public function showCart()
	{
		$cart = Cart::content();
		return view('pages.cart',['cart'=>$cart]);
	}

	public function removeCart($rowId)
	{
		Cart::remove($rowId);
		$notification=array(
			'message'=>'Xóa Sản Phẩm Khỏi Giỏ Hàng Thành Công',
			'alert-type'=>'success'
		);
		return Redirect()->back()->with($notification); 
	}

	public function updateCart(Request $request)
	{
		$row = $request->productid;
		// $qty   = $request->qtybutton;
		$color = $request->color_product;
		$image = $request->imgproduct;
		foreach ($row as $rowId) {
			$s1 	= 'qtybutton'.$rowId;
			$qty    = $request->$s1;
			$s2 	= 'color_product'.$rowId;
			$color  = $request->$s2;
			$s3 	= 'imgproduct'.$rowId;
			$image  = $request->$s3;
			Cart::update($rowId, ['qty'=> $qty,'options' => ['image' =>$image,'color' => $color ] ]);
		// 	foreach ($qty as $quanty) {
				// foreach ($color as $clor) {
				// 	foreach ($image as $img) {
						
				// 	}
				// }
			// }
			
		} 
	// 	$data = [
	// 		'qty' 		=> $qty,
	// 		'options' 	=> ['color' => $color ]
	// 	];
		// Cart::update($rowId, ['qty'=> $qty,'options' => ['image' =>$image,'color' => $color ] ]);
		return response()->json([
				'status' => true,
				'message' => 'Cập Nhật Giỏ Hàng Thành Công'
		], 200); 
	}

	public function quickViewProduct($id)
	{
		$product = DB::table('products')
    				->leftJoin('categories','products.category_id','categories.id')
    				->leftJoin('subcategories','products.subcategory_id','subcategories.id')
    				->leftJoin('brands','products.brand_id','brands.id')
    				->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
    				->where('products.id',$id)
    				->first();
    	$color = $product->product_color;
    	$product_color = explode(',', $color);
    	return response()->json([
                  'product' => $product,
                  'color' 	=> $product_color
              ], 200); 
	}

	public function insertCart(Request $request)
	{
		$id = $request->productid;
		$product = DB::table('products')->where('id',$id)->first();
		$product_color = $request->productcolor;
        $quantity = $request->qtybutton;
        $image = json_decode($product->image);
		if ($product->discount_price == NULL) {
            $data = [
                'id'        => $product->id,
                'name'      => $product->product_name,
                'qty'       => $quantity,
                'weight'    => 1,
                'price'     => $product->selling_price,
                'options'   => ['image' =>$image[0], 'color' => $product_color]
            ];
            Cart::add($data);
            return response()->json([
                  'status' => true,
                  'message' => 'Thêm Vào Giỏ Hàng Thành Công'
              ], 200); 
        } 
        else {
            $data = [
                'id'        => $product->id,
                'name'      => $product->product_name,
                'qty'       => $quantity,
                'weight'    => 1,
                'price'     => $product->discount_price,
                'options'   => ['image' =>$image[0], 'color' => $product_color]
            ];
            Cart::add($data);
            return response()->json([
                  'status' => true,
                  'message' => 'Thêm Vào Giỏ Hàng Thành Công'
              ], 200); 
        }
	}

	public function checkout()
	{
		if (Auth::check()) {
			$cart = Cart::content();
			return view('pages.checkout',['cart'=>$cart]);
		} else {
			$notification=array(
				'message'=>'Đăng Nhập Tài Khoản Trước',
				'alert-type'=>'warning'
			);
			return Redirect()->route('login')->with($notification);
		}
	}

	public function wishlist()
	{
		$userid = Auth::id();
		$product = DB::table('wishlists')
				   ->join('products','wishlists.product_id','products.id')
				   ->select('products.*','wishlists.user_id')
				   ->where('wishlists.user_id',$userid)
				   ->get();
		return view('pages.wishlist',['product'=>$product]);
	}
	public function coupon(Request $request)
	{
		$coupon = $request->coupon;
		$check = DB::table('coupons')->where('coupon',$coupon)->first();
		if ($check) {
			Session::put('coupon',[
				'name' => $check->coupon,
				'discount' => $check->discount,
				'balance' => Cart::subtotal(0, '.', '') - ($check->discount*Cart::subtotal(0, '.', '')/100)
			]);
			return response()->json([
                  'status' => true,
                  'message' => 'Đã Thêm Mã Giảm Giá'
              ], 200); 
		} else {
			return response()->json([
                  'status' => 'fail',
                  'message' => 'Mã Không Hợp Lệ'
              ], 400); 
		}
	}

	public function couponRemove()
	{
		Session::forget('coupon');
		$notification=array(
				'message'=>'Đã Gỡ Mã Giảm Giá',
				'alert-type'=>'success'
			);
			return Redirect()->back()->with($notification);
	}

	public function paymentPage(Request $request)
	{
		
	}
}
