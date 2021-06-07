<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;


class SliderController extends Controller
{
    public function indexSlider()
    {
    	$banner = DB::table('sliders')->get();
    	$title = 'Banner Chính';
    	return view('admin.slider.index',['banner'=>$banner,'title'=>$title]);
    }
    public function addExtraSlider()
    {
    	$banner = DB::table('sliders')->where('location',2)->where('location',3)->get();
    	$title = 'Banner Phụ';
    	return view('admin.slider.add_slider_extra',['banner'=>$banner,'title'=>$title]);
    }

    public function addSlider()
    {
    	return view('admin.slider.add_slider');
    }

    public function upImage(Request $request)
    {
		$image = $request->file('file');
        $url = $this->uploadImage('/media/banner/',$image);
        return response()->json([
            'status' => true,
            'path' => $url
        ], 200);
    }

    public function storeSlider(Request $request)
    {
    	$rules = [
            'name_banner' => 'required',
            'desc'        => 'required',
        ];
        $messages = [
            'name_banner.required'  => 'Vui lòng không để trông',
            'desc.required'  		=> 'Vui lòng không để trông'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $image 	= $request->url_img;
        $name 	= $request->name_banner;
        $desc 	= $request->desc;
        $link 	= $request->link;
        $data = [
            'name' 		=> $name,
            'status' 	=> 1,
            'location' 	=> 1,
            'image' 	=> $image,
            'desc' 		=> $desc,
            'link' 		=> $link
        ];
        DB::table('sliders')->insert($data);
        // update
        // User::where('id', $id)->where('...',...)->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Thêm Banner Thành Công'
        ], 200);
    }

    public function storeExtraSlider(Request $request)
    {
    	$rules = [
            'name_banner' => 'required',
            'desc'        => 'required',
        ];
        $messages = [
            'name_banner.required'  => 'Vui lòng không để trông',
            'desc.required'  		=> 'Vui lòng không để trông'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

        $image 		= $request->url_img;
        $name 		= $request->name_banner;
        $location 	= $request->locationextra;
        $desc 		= $request->desc;
        $link 		= $request->link;
        $data = [
            'name' 		=> $name,
            'status' 	=> 1,
            'location' 	=> $location,
            'image' 	=> $image,
            'desc' 		=> $desc,
            'link' 		=> $link
        ];
        DB::table('sliders')->insert($data);
        // update
        // User::where('id', $id)->where('...',...)->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Thêm Banner Thành Công'
        ], 200);
    }

    public function active(Request $request)
    {
        $id = $request->id;
        DB::table('sliders')->where('id',$id)->update(['status'=>1]);
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật trạng thái thành công'
        ], 200);
    }

    public function inactive(Request $request)
    {
        $id = $request->id;
        DB::table('sliders')->where('id',$id)->update(['status'=>0]);
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật trạng thái thành công'
        ], 200);
    }

    public function deletaSlider(Request $request)
    {
        $id = $request->id;
        if (!empty($id)) {
            $data = DB::table('sliders')->where('id',$id)->first();
            $image1 = public_path().$data->image;
            if ($image1 !== public_path().'/media/default2.png') {
                unlink($image1);
            }
            DB::table('sliders')->where('id',$id)->delete();
        }
        // $info = User::find($id);
        // $info->delete();
        // return back();
        return response()->json([
            'status' => true,
            'message' => 'Xóa thành công'
        ], 200);
    }

    public function updateSlider($id)
    {
        $slider = DB::table('sliders')->where('id',$id)->first();
        return view('admin.slider.edit_main',['slider'=>$slider]);
    }

    public function updateextraSlider($id)
    {
        $slider = DB::table('sliders')->where('id',$id)->first();
        return view('admin.slider.edit_extra',['slider'=>$slider]);
    }

    public function postupdateSlider($id, Request $request)
    {
        $rules = [
            'name_banner' => 'required',
            'desc'        => 'required',
        ];
        $messages = [
            'name_banner.required'  => 'Vui lòng không để trông',
            'desc.required'  		=> 'Vui lòng không để trông'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }


        $image 	= $request->url_img;
        $name 	= $request->name_banner;
        $desc 	= $request->desc;
        $link 	= $request->link;
        $data = [
            'name' 		=> $name,
            'status' 	=> 1,
            'location' 	=> 1,
            'image' 	=> $image,
            'desc' 		=> $desc,
            'link' 		=> $link
        ];

        $update = DB::table('sliders')->where('id',$id)->update($data);
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

    public function postupdateextraSlider($id, Request $request)
    {
        $rules = [
            'name_banner' => 'required',
            'desc'        => 'required',
        ];
        $messages = [
            'name_banner.required'  => 'Vui lòng không để trông',
            'desc.required'  		=> 'Vui lòng không để trông'
        ];
        $validator = validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->messages()) {
            return response()->json([
                'status' => 'validator_fail',
                'messages' => $validator->errors()->messages()
            ], 400);
        }

		$image 		= $request->url_img;
        $name 		= $request->name_banner;
        $location 	= $request->locationextra;
        $desc 		= $request->desc;
        $link 		= $request->link;
        $data = [
            'name' 		=> $name,
            'status' 	=> 1,
            'location' 	=> $location,
            'image' 	=> $image,
            'desc' 		=> $desc,
            'link' 		=> $link
        ];

        $update = DB::table('sliders')->where('id',$id)->update($data);
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
