<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class PostController extends Controller
{
	public function __construct()
	{
		$this->middleware('authadmin');
        $this->middleware('authrole:blog');
	}

	public function blogCat()
	{
		$blogcat = DB::table('post-category')->get();
		return view('admin.blog.category.index',['blogcat'=>$blogcat]);
	}

	public function storeBlogCat(Request $request)
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
        DB::table('post-category')->insert($data);
        // update
        // User::where('id', $id)->where('...',...)->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Thêm Danh Mục Thành Công'
        ], 200);
	}

	public function deleteBlogCategory(Request $request)
	{
		$id = $request->id;
        if (!empty($id)) {
            DB::table('post-category')->where('id',$id)->delete();
        }
        // $info = User::find($id);
        // $info->delete();
        // return back();
        return response()->json([
            'status' => true,
            'message' => 'Xóa thành công'
        ], 200);
	}

    public function updateBlogCat($id)
    {
        $info =  DB::table('post-category')->where('id',$id)->first();
        return view('admin.blog.category.edit',['info'=>$info]);
    }

    public function postupdateBlogCat($id, Request $request)
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
        $update = DB::table('post-category')->where('id',$id)->update($data);
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

    public function addPost()
    {
    	$blogcat = DB::table('post-category')->get();
        return view('admin.blog.create',['blogcat'=>$blogcat]);
    }
    public function upImage(Request $request)
    {
		$image = $request->file('file');
        $url = $this->uploadImage('/media/posts/',$image);
        return response()->json([
            'status' => true,
            'path' => $url
        ], 200);
    }


	public function indexPost()
	{
		$post = DB::table('posts')
					->join('post-category', 'posts.category_id', '=', 'post-category.id')
					->select('posts.*', 'post-category.category_name')
					->get();
		return view('admin.blog.index',['post'=>$post]);
	} 

    public function storeBlogPost(Request $request)
    {
    	
		$rules = [
            'category_id'     => 'required',
            'post_title'      => 'required|unique:posts,post_title',
            'details'         => 'required',
        ];
        $messages = [
            'category_id.required'  => 'Vui lòng chọn danh mục',
            'post_title.required'  	=> 'Vui lòng nhập tiêu đề',
            'post_title.unique'     => 'Tiêu đề bài viết đã tồn tại',
            'details.required' 		=> 'Vui lòng nhập nội dung bài viết',
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }
        $image 			= $request->url_img;
        $category_id 	= $request->category_id;
        $post_title 	= $request->post_title;
        $details 		= $request->details;
        $data = [
            'post_image' 	=> $image,
            'category_id' 	=> $category_id,
            'post_title' 	=> $post_title,
            'details' 		=> $details,
        ];
        DB::table('posts')->insert($data);
        // update
        // User::where('id', $id)->where('...',...)->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Thêm Bài Viết Thành Công'
        ], 200);
    }

    public function deleteBlogPost(Request $request)
    {
        $id = $request->id;
        if (!empty($id)) {
            $data = DB::table('posts')->where('id',$id)->first();
            $image = public_path().$data->post_image;
            if ($image !== public_path().'/media/default2.png') {
                unlink($image);
            }
            DB::table('posts')->where('id',$id)->delete();
        }
        // $info = User::find($id);
        // $info->delete();
        // return back();
        return response()->json([
            'status' => true,
            'message' => 'Xóa thành công'
        ], 200);
    }

    public function updatePost($id)
    {
        $post = DB::table('posts')->where('id',$id)->first();
        $blogcat = DB::table('post-category')->get();
        return view('admin.blog.edit',['post'=>$post, 'blogcat'=>$blogcat]);
    }

    public function postupdatePost($id, Request $request)
    {
        $rules = [
            'category_id'     => 'required',
            'post_title'      => 'required',
            'details'         => 'required',
        ];
        $messages = [
            'category_id.required'  => 'Vui lòng chọn danh mục',
            'post_title.required'   => 'Vui lòng nhập tiêu đề',
            'post_title.unique'     => 'Tiêu đề bài viết đã tồn tại',
            'details.required'      => 'Vui lòng nhập nội dung bài viết',
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $image          = $request->url_img;
        $category_id    = $request->category_id;
        $post_title     = $request->post_title;
        $details        = $request->details;
        $data = [
            'post_image'    => $image,
            'category_id'   => $category_id,
            'post_title'    => $post_title,
            'details'       => $details,
        ];

        $update = DB::table('posts')->where('id',$id)->update($data);
        if ($update) {
            $old_img1 = $request->old_img;
            if ($old_img1 !== $image) {
                $old_img = public_path().$request->old_img;
                if ($old_img !== public_path().'/media/default2.png') {
                    unlink($old_img);
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
