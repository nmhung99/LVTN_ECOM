<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;


class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('authadmin');
        $this->middleware('authrole:report');
    }

    public function todayOrder()
    {
    	$today = date('d-m-y');
    	$order = DB::table('orders')->where('status',0)->where('date',$today)->get();
    	return view('admin.report.today_order',['order'=>$order]);
    }

    public function todayDelivery()
    {
    	$today = date('d-m-y');
    	$order = DB::table('orders')->where('status',3)->where('date',$today)->get();
    	return view('admin.report.today_delivery',['order'=>$order]);
    }

    public function thisMonth()
    {
        $month = date('F');
        $order = DB::table('orders')->where('status',3)->where('month',$month)->get();
        return view('admin.report.this_month',['order'=>$order]);
    }

    public function Search()
    {
        return view('admin.report.search');
    }

    public function SearchYear(Request $request)
    {
        $year = $request->year;
        $total = DB::table('orders')->where('status',3)->where('year',$year)->sum('total');
        $order = DB::table('orders')->where('status',3)->where('year',$year)->get();
        return view('admin.report.search_year',['order'=>$order, 'total'=>$total, 'year'=>$year]);
    }
    public function SearchMonth(Request $request)
    {
        $month = $request->month;
        switch ($month) {
            case 'january':
            $month1 = 'Tháng 1';
            break;
            case 'february':
            $month1 = 'Tháng 2';
            break;
            case 'march':
            $month1 = 'Tháng 3';
            break;
            case 'april':
            $month1 = 'Tháng 4';
            break;
            case 'may':
            $month1 = 'Tháng 5';
            break;
            case 'june':
            $month1 = 'Tháng 6';
            break;
            case 'july':
            $month1 = 'Tháng 7';
            break;
            case 'august':
            $month1 = 'Tháng 8';
            break;
            case 'september':
            $month1 = 'Tháng 9';
            break;
            case 'pctober':
            $month1 = 'Tháng 10';
            break;
            case 'november':
            $month1 = 'Tháng 11';
            break;
            case 'december':
            $month1 = 'Tháng 12';
            default:
            $month1 = 'Không tìm thấy';
            break;
        }
        $year = $request->year;

        $total = DB::table('orders')->where('status',3)->where('month',$month)->where('year',$year)->sum('total');

        $order = DB::table('orders')->where('status',3)->where('month',$month)->where('year',$year)->get();
        return view('admin.report.search_month',['order'=>$order, 'total'=>$total, 'month1'=>$month1, 'year'=>$year]);
    }

    public function SearchDate(Request $request)
    {
        $date = $request->date;
        $newdate = date('d-m-y', strtotime($date));
        $viewdate = date('d-m-Y', strtotime($date));
        // echo $newdate;

        $total = DB::table('orders')->where('status',3)->where('date',$newdate)->sum('total');

        $order = DB::table('orders')->where('status',3)->where('date',$newdate)->get();
        return view('admin.report.search_date',['order'=>$order, 'total'=>$total, 'viewdate'=>$viewdate]);
    }
}
