<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use Illuminate\Support\Facades\Validator;
use DB;
class SubCategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('authadmin');
        $this->middleware('authrole:category');
	}

	public function subCategory()
	{
		$category = DB::table('categories')->get();
		$subcategory = DB::table('subcategories')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->select('subcategories.*', 'categories.category_name')
            ->get();

		return view('admin.category.subcategory',['category'=>$category, 'subcategory'=>$subcategory]);
	}

	public function storesubCategory(Request $request)
	{
		$rules = [
            'subcategory_name'     => 'required|unique:subcategories,subcategory_name|max:255'
        ];
        $messages = [
            'subcategory_name.required'  => 'Vui lòng nhập tên danh mục con',
            'subcategory_name.unique'    => 'Danh mục con đã tồn tại',
            'subcategory_name.max'    	 => 'Tên danh mục con vượt quá 255 ký tự',
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
        $category_id = $request->category_id;
        $subcategory_name = $request->subcategory_name;
        $data = [
            'category_id' => $category_id,
            'subcategory_name' => $subcategory_name
        ];
        Subcategory::insert($data);
        return response()->json([
            'status' => true,
            'message' => 'Thêm Danh Mục Con Thành Công'
        ], 200);
	}

	public function deletesubCategory(Request $request)
	{
		$id = $request->id;
        if (!empty($id)) {
            Subcategory::where('id',$id)->delete();
        }
        // $info = User::find($id);
        // $info->delete();
        // return back();
        return response()->json([
            'status' => true,
            'message' => 'Xóa thành công'
        ], 200);
	}

    public function updatesubCategory($id)
    {
        $category = DB::table('categories')->get();
        $info = Subcategory::find($id);
        // $subcategory = DB::table('subcategories')
        //     ->join('categories', 'subcategories.category_id', '=', 'categories.id')
        //     ->select('subcategories.*', 'categories.category_name')
        //     ->get();

        return view('admin.category.edit_subcategory',['category'=>$category, 'info'=>$info]);
    }

    public function postupdatesubCategory($id, Request $request)
    {
        $rules = [
            'subcategory_name'     => 'required|max:255'
        ];
        $messages = [
            'subcategory_name.required'  => 'Vui lòng nhập tên danh mục con',
            'subcategory_name.max'       => 'Tên danh mục con vượt quá 255 ký tự',
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $category_id = $request->category_id;
        $subcategory_name = $request->subcategory_name;
        $data = [
            'category_id' => $category_id,
            'subcategory_name' => $subcategory_name
        ];

        $update = DB::table('subcategories')->where('id',$id)->update($data);
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
