<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Admin\GroupProduct;
use DB;

class GroupProductController extends Controller
{
	public function __construct()
	{
		$this->middleware('authadmin');
        $this->middleware('authrole:product');
	}

	public function groupProduct()
	{
		$brand = DB::table('brands')->get();
        $cate = DB::table('categories')->get();
		$groupproduct = DB::table('group_products')
            ->join('categories', 'group_products.category_id', '=', 'categories.id')
            ->join('brands', 'group_products.brand_id', '=', 'brands.id')
            ->select('group_products.*', 'categories.category_name', 'brands.brand_name')
            ->get();
		return view('admin.product.group_product',['brand'=>$brand, 'cate'=>$cate, 'groupproduct'=>$groupproduct]);
	}

	public function storeGroup(Request $request)
	{
		$rules = [
            'group_name'     => 'required|unique:group_products,group_name|max:255',
            'category_id'    => 'required',
            'brand_id'       => 'required'
        ];
        $messages = [
            'group_name.required'  => 'Vui lòng nhập tên nhóm sản phẩm',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'brand_id.required'    => 'Vui lòng nhãn hàng',
            'group_name.unique'    => 'Nhóm sản phẩm đã tồn tại',
            'group_name.max'       => 'Nhóm sản phẩm vượt quá 255 ký tự',
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
        $brand_id = $request->brand_id;
        $category_id = $request->category_id;
        $group_name = $request->group_name;
        $data = [
            'category_id' => $category_id,
            'brand_id'    => $brand_id,
            'group_name'  => $group_name
        ];
        GroupProduct::insert($data);
        return response()->json([
            'status' => true,
            'message' => 'Thêm Nhóm Sản Phẩm Thành Công'
        ], 200);
	}

	public function deletegroupProduct(Request $request)
	{
		$id = $request->id;
        if (!empty($id)) {
            GroupProduct::where('id',$id)->delete();
        }
        // $info = User::find($id);
        // $info->delete();
        // return back();
        return response()->json([
            'status' => true,
            'message' => 'Xóa thành công'
        ], 200);
	}

    public function updategroupProduct($id)
    {
        $cate = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $info = GroupProduct::find($id);
        // $subcategory = DB::table('subcategories')
        //     ->join('categories', 'subcategories.category_id', '=', 'categories.id')
        //     ->select('subcategories.*', 'categories.category_name')
        //     ->get();

        return view('admin.product.edit_group_product',['brand'=>$brand, 'cate'=>$cate, 'info'=>$info]);
    }
    public function postupdategroupProduct($id, Request $request)
    {
        $rules = [
            'group_name'   => 'required|max:255',
            'category_id'  => 'required',
            'brand_id'     => 'required'
        ];
        $messages = [
            'group_name.required'  => 'Vui lòng nhập tên nhóm sản phẩm',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'brand_id.required'    => 'Vui lòng nhãn hàng',
            'group_name.max'       => 'Tên nhóm sản phẩm vượt quá 255 ký tự',
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $brand_id = $request->brand_id;
        $category_id = $request->category_id;
        $group_name = $request->group_name;
        $data = [
            'category_id' => $category_id,
            'brand_id'    => $brand_id,
            'group_name'  => $group_name
        ];

        $update = DB::table('group_products')->where('id',$id)->update($data);
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
}
