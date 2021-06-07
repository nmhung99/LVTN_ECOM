<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use Auth;



class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('authadmin');
        $this->middleware('authrole:role');
    }

    public function UserRole()
    {
    	$user = DB::table('admins')->where('type',2)->get();
    	return view('admin.role.all_role',['user'=>$user]);
    }

    public function UserCreate()
    {
    	return view('admin.role.create_role');
    }

    public function UserStore(Request $request)
    {
    	$rules = [
            'name'     		=> 'required|unique:admins,name|min:8|max:255',
            'phone'   	 	=> 'required|unique:admins,phone|numeric|digits_between:10,12',
            'email'    		=> 'required|email|unique:admins,email',
            'passworduser'	=> 'required|min:8|max:64'
        ];
        $messages = [
        	'name.required' 		=> 'Không được bỏ trống',
        	'name.unique' 			=> 'Tên đã tồn tại',
        	'name.min' 				=> 'Không dưới 8 ký tự',
        	'name.max' 				=> 'Không vượt quá 255 ký tự',
        	'phone.required' 		=> 'Không được bỏ trống',
        	'phone.unique' 			=> 'Số điện thoại đã tồn tại',
        	'phone.numeric' 		=> 'Không hợp lệ',
        	'phone.digits_between' 	=> 'Không hợp lệ',
        	'email.required' 		=> 'Không được bỏ trống',
        	'email.email' 			=> 'Sai định dạng email',
        	'email.unique' 			=> 'Email đã tồn tại',
        	'passworduser.required' => 'Không được bỏ trống',
        	'passworduser.min' 		=> 'Tối thiểu 8 ký tự',
        	'passworduser.max' 		=> 'Tối đa 64 ký tự'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

    	$data = [
    		'name'     			=> $request->name,
            'phone'   	 		=> $request->phone,
            'email'    			=> $request->email,
            'password'  	=> Hash::make($request->passworduser),
            'category'	=> $request->category_insert,
            'coupon'		=> $request->coupon_insert,
            'product'	=> $request->product_insert,
            'blog'		=> $request->blog_insert,
            'order'		=> $request->order_insert,
            'other'		=> $request->other_insert,
            'report'		=> $request->report_insert,
            'role'		=> $request->role1_insert,
            'return'		=> $request->return_insert,
            'contact'	=> $request->contact_insert,
            'comment'	=> $request->comment_insert,
            'setting'	=> $request->setting_insert,
            'stock'   => $request->stock_insert,
            'type'				=> 2,
    	];
    	$check = $request->category_insert+$request->coupon_insert+$request->product_insert+$request->blog_insert+$request->order_insert+$request->other_insert+$request->report_insert+$request->role1_insert+$request->return_insert+$request->contact_insert+$request->setting_insert+$request->comment_insert+$request->stock_insert;
    	// var_dump ($check);
    	// die();
    	if ($check === 0) {
    		return response()->json([
    			'status' => 'invalidrole',
    			'message' => 'Chọn ít nhất một quyền'
    		], 400);
    	} else {
    		DB::table('admins')->insert($data);
    		return response()->json([
    			'status' => true,
    			'message' => 'Thêm Người Dùng Mới Thành Công'
    		], 200);
    	}
    }

    public function deleteAdmin(Request $request)
    {
        $id = $request->id;
        DB::table('admins')->where('id',$id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Xóa Người Dùng Thành Công'
        ], 200);
    }

    public function editAdmin($id)
    {
        $user = DB::table('admins')->where('id',$id)->first();
        return view('admin.role.edit_role',['user'=>$user]);
    }

    public function updateAdmin(Request $request)
    {
        $id = $request->adminid;
        $admi = Admin::find($id);
        // dd ($id);
        // die();
        $rules = [
            'name'          => 'required|min:8|max:255|unique:admins,name,'.$admi->id,
            'phone'         => 'required|numeric|digits_between:10,12|unique:admins,phone,'.$admi->id,
            'email'         => 'required|email|unique:admins,email,'.$admi->id
        ];
        $messages = [
            'name.required'         => 'Không được bỏ trống',
            'name.unique'           => 'Tên đã tồn tại',
            'name.min'              => 'Không dưới 8 ký tự',
            'name.max'              => 'Không vượt quá 255 ký tự',
            'phone.required'        => 'Không được bỏ trống',
            'phone.unique'          => 'Số điện thoại đã tồn tại',
            'phone.numeric'         => 'Không hợp lệ',
            'phone.digits_between'  => 'Không hợp lệ',
            'email.required'        => 'Không được bỏ trống',
            'email.email'           => 'Sai định dạng email',
            'email.unique'          => 'Email đã tồn tại'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $data = [
            'name'              => $request->name,
            'phone'             => $request->phone,
            'email'             => $request->email,
            'category'  => $request->category_insert,
            'coupon'        => $request->coupon_insert,
            'product'   => $request->product_insert,
            'blog'      => $request->blog_insert,
            'order'     => $request->order_insert,
            'other'     => $request->other_insert,
            'report'        => $request->report_insert,
            'role'      => $request->role1_insert,
            'return'        => $request->return_insert,
            'contact'   => $request->contact_insert,
            'comment'   => $request->comment_insert,
            'setting'   => $request->setting_insert,
            'stock'   => $request->stock_insert
        ];
        $check = $request->category_insert+$request->coupon_insert+$request->product_insert+$request->blog_insert+$request->order_insert+$request->other_insert+$request->report_insert+$request->role1_insert+$request->return_insert+$request->contact_insert+$request->setting_insert+$request->comment_insert+$request->stock_insert;
        // var_dump ($check);
        // die();
        if ($check === 0) {
            return response()->json([
                'status' => 'invalidrole',
                'message' => 'Chọn ít nhất một quyền'
            ], 400);
        } else {
            DB::table('admins')->where('id',$id)->update($data);
            return response()->json([
                'status' => true,
                'message' => 'Cập Nhật Thành Công'
            ], 200);
        }
    }


    public function productStock()
    {
        $product = DB::table('products')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->leftJoin('brands','products.brand_id','brands.id')
                    ->select('products.*','categories.category_name','brands.brand_name')
                    ->get();
        return view('admin.stock.stock',['product'=>$product]);
    }
}
