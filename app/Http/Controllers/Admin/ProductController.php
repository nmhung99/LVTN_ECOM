<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Brand;
use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use App\Model\Admin\GroupProduct;
use Illuminate\Support\Facades\Validator;
use DB;

class ProductController extends Controller
{
	public function __construct()
	{
		$this->middleware('authadmin');
        $this->middleware('authrole:product');
	}

	public function index(Request $request)
	{
		$product = DB::table('products')
					->leftJoin('categories','products.category_id','categories.id')
					->leftJoin('brands','products.brand_id','brands.id')
					->select('products.*','categories.category_name','brands.brand_name')
					->get();
		return view('admin.product.index',['product'=>$product]);
	}

	public function getCategory($category_id)
	{
		$sub = DB::table('subcategories')->where('category_id',$category_id)->get();
		// dd ($category_id);
		// die();
		return response()->json($sub, 200);
	}

    public function getBrand($category_id)
    {
        $brand = DB::table('brands')->where('category_id',$category_id)->get();
        // dd ($category_id);
        // die();
        return response()->json($brand, 200);
    }
    
	public function getGroup($brand_id)
	{
		$group = DB::table('group_products')->where('brand_id',$brand_id)->get();
		// dd ($category_id);
		// die();
		return response()->json($group, 200);
	}

	public function upImage(Request $request)
	{
		$image = $request->file('file');
        $url = $this->uploadImage('/media/products/',$image);
        return response()->json([
            'status' => true,
            'path' => $url
        ], 200);
	}
	// public function unlinkImage()
	// {
	// 	$link = $_POST['string1'];
	// 	$link2 = public_path().$img_link;
	// 	unlink($link2);
	// }

	public function create()
	{
		$category = DB::table('categories')->get();
		$brand = DB::table('brands')->get();
		return view('admin.product.create', ['category'=>$category,'brand'=>$brand]);
	}

	public function storeProduct(Request $request)
	{
		$rules = [
            'category_id'     => 'required',
            'product_name'    => 'required|unique:products,product_name|max:255',
            'product_code'    => 'required|unique:products,product_code|max:255',
            'product_quantity'=> 'required',
            'product_details' => 'required',
            'product_desc' 	  => 'required',
            'product_color'   => 'required',
            'selling_price'   => 'required'
            // 'image'   		  => 'required'
        ];
        $messages = [
        	'category_id.required' 		=> 'Vui lòng chọn danh mục sản phẩm',
        	'product_name.required' 	=> 'Vui lòng nhập tên sản phẩm',
        	'product_name.unique'   	=> 'Tên sản phẩm đã tồn tại',
        	'product_name.max'      	=> 'Tên sản phẩm vượt quá 255 ký tự',
        	'product_code.required'		=> 'Vui lòng nhập mã sản phẩm',
        	'product_code.unique'   	=> 'Mã sản phẩm đã tồn tại',
        	'product_code.max'      	=> 'Mã sản phẩm vượt quá 255 ký tự',
        	'product_quantity.required' => 'Vui lòng nhập số lượng',
        	'product_details.required'  => 'Vui lòng nhập chi tiết sản phẩm',
        	'product_desc.required'  	=> 'Vui lòng nhập mô tả sản phẩm',
        	'product_color.required'  	=> 'Vui lòng nhập màu sắc',
        	'selling_price.required'  	=> 'Vui lòng nhập giá bán'
        	// 'image.required'  			=> 'Vui lòng thêm ảnh sản phẩm',
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $product_name 		= $request->product_name;
        $product_code 		= $request->product_code;
        $product_quantity 	= $request->product_quantity;
        $category_id 		= $request->category_id;
        $subcategory_id 	= $request->subcategory_id;
        $brand_id 			= $request->brand_id;
        $group_product_id   = $request->group_product_id;
        $product_size   	= $request->product_size;
        $product_color   	= $request->product_color;
        $selling_price   	= $request->selling_price;
        $discount_price     = $request->discount_price;
        $product_details   	= $request->product_details;
        $product_desc   	= $request->product_desc;
        $video_link   		= $request->video_link;
        $flash_deal   		= $request->flash_deal_insert;
        $main_slider        = $request->main_slider_insert;
        $hot_deal   		= $request->hot_deal_insert;
        $best_rated   		= $request->best_rated_insert;
        $trend	   			= $request->trend_insert;
        $hot_new   			= $request->hot_new_insert;
        $image   			= $request->url_img;
        if ($request->discount_price == NULL) {
            $final_price = $request->selling_price;
        } else {
            $final_price = $request->discount_price;
        }
        $data = [
        	'product_name' 		=> $product_name,
            'product_code' 		=> $product_code,
            'product_quantity' 	=> $product_quantity,
            'category_id' 		=> $category_id,
            'subcategory_id' 	=> $subcategory_id,
            'brand_id' 			=> $brand_id,
            'group_product_id' 	=> $group_product_id,
            'product_size' 		=> $product_size,
            'product_color' 	=> $product_color,
            'selling_price' 	=> $selling_price,
            'discount_price'    => $discount_price,
            'final_price'       => $final_price,
            'product_details' 	=> $product_details,
            'product_desc' 		=> $product_desc,
            'video_link' 		=> $video_link,
            'flash_deal' 		=> $flash_deal,
            'main_slider'       => $main_slider,
            'hot_deal' 			=> $hot_deal,
            'best_rated' 		=> $best_rated,
            'trend' 			=> $trend,
            'hot_new' 			=> $hot_new,
            'trend' 			=> $trend,
            'status' 			=> 1,
            'image' 			=> json_encode($image)
        ];
        DB::table('products')->insert($data);
        // update
        // User::where('id', $id)->where('...',...)->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Thêm Sản Phẩm Thành Công'
        ], 200);
	}

    public function active(Request $request)
    {
        $id = $request->id;
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật trạng thái thành công'
        ], 200);
    }

    public function inactive(Request $request)
    {
        $id = $request->id;
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật trạng thái thành công'
        ], 200);
    }

    public function deleteProduct(Request $request)
    {
        $id = $request->id;
        if (!empty($id)) {
            $data = DB::table('products')->find($id);
            $image = $data->image;
            foreach (json_decode($image, true) as $key => $value ) {
                if ($value !== '/media/default2.png') {
                    unlink(public_path().$value);
                }
            }
            DB::table('products')->where('id',$id)->delete();
        }
        // $info = User::find($id);
        // $info->delete();
        // return back();
        return response()->json([
            'status' => true,
            'message' => 'Xóa thành công'
        ], 200);
    }

    public function viewProduct($id)
    {
        $product = DB::table('products')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
                    ->leftJoin('brands','products.brand_id','brands.id')
                    ->leftJoin('group_products','products.group_product_id','group_products.id')
                    ->select('products.*','categories.category_name','brands.brand_name','subcategories.subcategory_name','group_products.group_name')
                    ->where('products.id',$id)
                    ->first();
        return view('admin.product.show',['product'=>$product]);
    }

    public function updateProduct($id)
    {
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $sub = DB::table('subcategories')->get();
        $group = DB::table('group_products')->get();
        $product = DB::table('products')->where('id',$id)->first();
        return view('admin.product.edit',['category'=>$category, 'brand'=>$brand, 'sub'=>$sub, 'group'=>$group, 'product'=>$product]);
    }

    public function postupdateProduct($id, Request $request)
    {
        $rules = [
            'category_id'     => 'required',
            'product_name'    => 'required|max:255',
            'product_code'    => 'required|max:255',
            'product_quantity'=> 'required',
            'product_details' => 'required',
            'product_desc'    => 'required',
            'product_color'   => 'required',
            'selling_price'   => 'required'
            // 'image'            => 'required'
        ];
        $messages = [
            'category_id.required'      => 'Vui lòng chọn danh mục sản phẩm',
            'product_name.required'     => 'Vui lòng nhập tên sản phẩm',
            // 'product_name.unique'       => 'Tên sản phẩm đã tồn tại',
            'product_name.max'          => 'Tên sản phẩm vượt quá 255 ký tự',
            // 'product_code.required'     => 'Vui lòng nhập mã sản phẩm',
            'product_code.unique'       => 'Mã sản phẩm đã tồn tại',
            'product_code.max'          => 'Mã sản phẩm vượt quá 255 ký tự',
            'product_quantity.required' => 'Vui lòng nhập số lượng',
            'product_details.required'  => 'Vui lòng nhập chi tiết sản phẩm',
            'product_desc.required'     => 'Vui lòng nhập mô tả sản phẩm',
            'product_color.required'    => 'Vui lòng nhập màu sắc',
            'selling_price.required'    => 'Vui lòng nhập giá bán'
            // 'image.required'             => 'Vui lòng thêm ảnh sản phẩm',
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $product_name       = $request->product_name;
        $product_code       = $request->product_code;
        $product_quantity   = $request->product_quantity;
        $category_id        = $request->category_id;
        $subcategory_id     = $request->subcategory_id;
        $brand_id           = $request->brand_id;
        $group_product_id   = $request->group_product_id;
        $product_size       = $request->product_size;
        $product_color      = $request->product_color;
        $selling_price      = $request->selling_price;
        $discount_price     = $request->discount_price;
        $product_details    = $request->product_details;
        $product_desc       = $request->product_desc;
        $video_link         = $request->video_link;
        $flash_deal         = $request->flash_deal_insert;
        $main_slider        = $request->main_slider_insert;
        $hot_deal           = $request->hot_deal_insert;
        $best_rated         = $request->best_rated_insert;
        $trend              = $request->trend_insert;
        $hot_new            = $request->hot_new_insert;
        $image              = $request->url_img;
        if ($request->discount_price == NULL) {
            $final_price = $request->selling_price;
        } else {
            $final_price = $request->discount_price;
        }
        $data = [
            'product_name'      => $product_name,
            'product_code'      => $product_code,
            'product_quantity'  => $product_quantity,
            'category_id'       => $category_id,
            'subcategory_id'    => $subcategory_id,
            'brand_id'          => $brand_id,
            'group_product_id'  => $group_product_id,
            'product_size'      => $product_size,
            'product_color'     => $product_color,
            'selling_price'     => $selling_price,
            'discount_price'    => $discount_price,
            'final_price'       => $final_price,
            'product_details'   => $product_details,
            'product_desc'      => $product_desc,
            'video_link'        => $video_link,
            'flash_deal'        => $flash_deal,
            'main_slider'       => $main_slider,
            'hot_deal'          => $hot_deal,
            'best_rated'        => $best_rated,
            'trend'             => $trend,
            'hot_new'           => $hot_new,
            'trend'             => $trend,
            'image'             => json_encode($image)
        ];

        $update = DB::table('products')->where('id',$id)->update($data);
        if ($update) {
            $old_img = json_encode($request->old_img);
            $img = json_encode($image);
            foreach (json_decode($img, true) as $key1 => $value1 ) {
                foreach (json_decode($old_img, true) as $key2 => $value2 ) {
                    if ($key1 === $key2) {
                        if ($value1 !== $value2) {
                            $old_logo = public_path().$value2;
                            if ($old_logo !== public_path().'/media/default2.png') {
                                unlink($old_logo);
                            }
                        }
                    }
                }
            }
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
}
