<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use Illuminate\Support\Facades\Validator;
use DB;


class CategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('authadmin');
        $this->middleware('authrole:category');
	}

	public function category()
	{
		$category = Category::all();
		return view('admin.category.category',['category'=>$category]);
	}
	public function storecategory(Request $request)
	{
		$rules = [
            'category_name'     => 'required|unique:categories,category_name|max:255'
        ];
        $messages = [
            'category_name.required'  => 'Vui lòng nhập tên danh mục',
            'category_name.unique'    => 'Danh mục đã tồn tại',
            'category_name.max'    	  => 'Tên danh mục vượt quá 255 ký tự',
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
        $data = [
            'category_name'    => $request->category_name
        ];
        Category::insert($data);
        // update
        // User::where('id', $id)->where('...',...)->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Thêm Danh Mục Thành Công'
        ], 200);
	}

	public function deleteCategory(Request $request)
	{
		$id = $request->id;
        if (!empty($id)) {
            Category::where('id',$id)->delete();
        }
        // $info = User::find($id);
        // $info->delete();
        // return back();
        return response()->json([
            'status' => true,
            'message' => 'Xóa thành công'
        ], 200);
	}

    public function updateCategory($id)
    {
        $info = Category::find($id);
        return view('admin.category.edit_category',['info'=>$info]);
    }

    public function postupdateCategory($id, Request $request)
    {
        $rules = [
            'category_name'     => 'required|max:255'
        ];
        $messages = [
            'category_name.required'  => 'Vui lòng nhập tên danh mục',
            'category_name.max'       => 'Tên danh mục vượt quá 255 ký tự',
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $data = [
            'category_name'    => $request->category_name
        ];
        $update = DB::table('categories')->where('id',$id)->update($data);
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
