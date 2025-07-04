<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CouponController extends Controller
{
    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon==true){

            Session::forget('coupon');
            return redirect()->back()->with('success','Xóa mã khuyến mãi thành công');
        }
    }

    public function edit($id)
    {
        $title = 'Sửa mã giảm giá';
        $coupon = Coupon::find($id);
        return view('backend.coupon.update', compact('title', 'coupon'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $coupon = Coupon::find($id);

        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_date_start = $data['stardate'];
        $coupon->coupon_date_end = $data['enddate'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->update();

        Session::put('success','Sửa mã giảm giá thành công');
        return Redirect::to('admin/coupon/all_coupon');
    }
    public function create(){
        $title = 'Thêm mã giảm giá';
        return view('backend.coupon.add',compact('title'));
    }
    public function delete($id){
        $coupon = Coupon::find($id);
        $coupon->delete();
        Session::put('success','Xóa mã giảm giá thành công');
        return Redirect::to('admin/coupon/all_coupon');
    }
    public function index(){
        $title = 'Danh sách mã giảm giá';
        $today= Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $coupons = Coupon::orderby('coupon_id','DESC')->paginate(5);
        return view('backend.coupon.index')->with(compact('coupons','today','title'));
    }
    public function store(Request $request){
        $data = $request->all();

        $coupon = new Coupon;

        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_date_start = $data['stardate'];
        $coupon->coupon_date_end = $data['enddate'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->save();

        Session::put('success','Thêm mã giảm giá thành công');
        return Redirect::to('admin/coupon/all_coupon');
    }
}
