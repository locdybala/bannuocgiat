<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function send_coupon($id) {
        $coupons= Coupon::find($id);
        $coupon = array(
          'coupon_time' => $coupons->coupon_time,
            'coupon_condition' => $coupons->coupon_condition,
            'coupon_number' => $coupons->coupon_number,
            'coupon_code' => $coupons->coupon_code,
            'coupon_date_start' => $coupons->coupon_date_start,
            'coupon_date_end' => $coupons->coupon_date_end,
        );
        $customer = Customer::where('customer_vip','!=',1)->get();
        $now =  Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title = "Mã Khuyến mãi ngày" .' '. $now;
        $data=[];
        foreach ($customer as $customer) {
            $data['email'][] = $customer->customer_email;

        }
        Mail::send('pages.send_coupon',['coupon'=>$coupon],function($message) use ($title,$data) {
            $message->to($data['email'])->subject($title);
            $message->from($data['email'],$title);
        });
        return redirect()->back()->with('success','Gửi mã khuyến mãi thành công');
    }
    public function send_coupon_vip($id) {
        $coupons= Coupon::find($id);
        $coupon = array(
            'coupon_time' => $coupons->coupon_time,
            'coupon_condition' => $coupons->coupon_condition,
            'coupon_number' => $coupons->coupon_number,
            'coupon_code' => $coupons->coupon_code,
            'coupon_date_start' => $coupons->coupon_date_start,
            'coupon_date_end' => $coupons->coupon_date_end,
        );
        $customer = Customer::where('customer_vip',1)->get();
        $now =  Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title = "Mã Khuyến mãi ngày" .' '. $now;
        $data=[];
        foreach ($customer as $customer) {
            $data['email'][] = $customer->customer_email;

        }
        Mail::send('pages.send_coupon_vip',['coupon'=>$coupon],function($message) use ($title,$data) {
           $message->to($data['email'])->subject($title);
           $message->from($data['email'],$title);
        });
        return redirect()->back()->with('success','Gửi mã khuyến mai thành công');
    }
}
