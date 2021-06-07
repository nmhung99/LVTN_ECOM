<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('authadmin');
        $this->middleware('authrole:return');
    }

    public function ReturnRequest()
    {
    	$order = DB::table('orders')->where('return_order',1)->get();
    	return view('admin.return.request',['order'=>$order]);
    }

    public function approveReturn($id)
    {
    	 DB::table('orders')->where('id',$id)->update(['return_order'=>2]);
    	 $notification=array(
    	 	'message'=>'Đã Chấp Nhận Yêu Cầu',
    	 	'alert-type'=>'success'
    	 );
    	 return Redirect()->back()->with($notification); 
    }

    public function allReturn()
    {
        $order = DB::table('orders')->where('return_order',2)->get();
        return view('admin.return.all_return',['order'=>$order]);
    }
}
