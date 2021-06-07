<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{
    public function blog()
    {
    	$post = DB::table('posts')
    			->join('post-category','posts.category_id','post-category.id')
    			->select('posts.*','post-category.category_name')->paginate(9);
    	// $paginate =	DB::table('posts');
    	return view('pages.blog',['post'=>$post]);
    }

    public function blogDetails($id)
    {
    	$post = DB::table('posts')->where('id',$id)->first();
    	return view('pages.blog_details',['post'=>$post]);
    }
}
