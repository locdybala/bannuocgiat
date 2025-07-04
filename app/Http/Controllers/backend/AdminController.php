<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Statistical;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $title = 'Trang chủ';
        $product_count = Product::count();
        $order_count = Order::count();
        $customer_count = Customer::count();
        $user_count = User::count();
        $post_count = Post::count();
        $posts = Post::orderBy('post_view','DESC')->paginate('5');
        $products = Product::orderBy('product_view','DESC')->paginate('5');
        return view('backend.dashboard',compact('product_count','order_count','customer_count','user_count','post_count','posts','products','title'));
    }

    public function filter_by_date(Request $request){
        $data = $request->all();

        $form_date = date("Y-m-d", strtotime($data['form_date']));
        $to_date = date("Y-m-d", strtotime($data['to_date']));
//        $form_date = Carbon::createFromFormat('m/d/Y', $data['form_date'])->format('Y-m-d');
//        $to_date = Carbon::createFromFormat('m/d/Y', $data['to_date'])->format('Y-m-d');

        $get=Statistical::whereBetween('order_date',[$form_date,$to_date])->get();
        foreach($get as $val){
            $chart_data[]=array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
            );
        }
        echo $data=json_encode($chart_data);
    }
    public function dashboard_filter(Request $request){
        $title ='Trang chủ';
        $data=$request->all();
        // $today=Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $dauthangnay=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value']=='7ngay'){
            $get=Statistical::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangtruoc'){
            $get=Statistical::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangnay'){
            $get=Statistical::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }else{
            $get=Statistical::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }
        foreach($get as $val){
            $chart_data[]=array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
            );
        }
        echo $data=json_encode($chart_data);

    }
    public function days_order(){
        $sub30days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get=Statistical::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();
        foreach($get as $val){
            $chart_data[]=array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
            );
        }
        echo $data=json_encode($chart_data);
    }
}
