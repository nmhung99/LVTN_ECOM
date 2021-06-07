<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Brand;
use Illuminate\Support\Facades\Validator;
use DB;

class BrandController extends Controller
{
	public function __construct()
	{
		$this->middleware('authadmin');
        $this->middleware('authrole:category');
	}

	public function brand()
	{
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')
            ->join('categories', 'brands.category_id', '=', 'categories.id')
            ->select('brands.*', 'categories.category_name')
            ->get();
		return view('admin.category.brand',['brand'=>$brand, 'category'=>$category]);
	}

	public function upLoadLogo(Request $request)
	{
		$image = $request->file('file');
        $url = $this->uploadImage('/media/brands/',$image);
        return response()->json([
            'status' => true,
            'path' => $url
        ], 200);
	}

	public function storebrand(Request $request)
	{
		$rules = [
            'brand_name'     => 'required|max:255',
            'category_id'    => 'required'
        ];
        $messages = [
            'brand_name.required'  => 'Vui lòng nhập tên nhãn hàng',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'brand_name.max'       => 'Tên nhãn hàng vượt quá 255 ký tự',
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
        $image = $request->url_logo;
        $brand_name = $request->brand_name;
        $category_id = $request->category_id;
        $data = [
            'brand_logo'  => $image,
            'brand_name'  => $brand_name,
            'category_id' => $category_id
        ];
        Brand::insert($data);
        // update
        // User::where('id', $id)->where('...',...)->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Thêm Nhãn Hàng Thành Công'
        ], 200);
	}
    public function deleteBrand(Request $request)
    {
        $id = $request->id;
        if (!empty($id)) {
            $data = Brand::find($id);
            $image = public_path().$data->brand_logo;
            if ($image !== public_path().'/media/default2.png') {
                unlink($image);
            }
            Brand::where('id',$id)->delete();
        }
        // $info = User::find($id);
        // $info->delete();
        // return back();
        return response()->json([
            'status' => true,
            'message' => 'Xóa thành công'
        ], 200);
    }

    public function updateBrand($id)
    {
        $category = DB::table('categories')->get();
        $info = Brand::find($id);
        return view('admin.category.edit_brand',['info'=>$info, 'category'=>$category]);
    }

    public function postupdateBrand($id, Request $request)
    {
        $rules = [
            'brand_name'     => 'required|max:255'
        ];
        $messages = [
            'brand_name.required'  => 'Vui lòng nhập tên nhãn hàng',
            'brand_name.max'       => 'Tên nhãn hàng vượt quá 255 ký tự'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
        $image = $request->url_logo;
        $brand_name = $request->brand_name;
        $category_id = $request->category_id;
        $data = [
            'brand_logo'  => $image,
            'brand_name'  => $brand_name,
            'category_id' => $category_id
        ];
        $update = DB::table('brands')->where('id',$id)->update($data);
        if ($update) {
            $old_logo1 = $request->old_logo;
            if ($old_logo1 !== $image) {
                $old_logo = public_path().$request->old_logo;
                if ($old_logo !== public_path().'/media/default2.png') {
                    unlink($old_logo);
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
