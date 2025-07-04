<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Pages;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
class CartController extends Controller
{
    public function show_cart()
    {
        $title ='Giỏ hàng';
        $category = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $categorypost = CategoryPost::where('cate_post_status', '1')->orderby('cate_post_id', 'desc')->get();
        $pages = Pages::all();

        return view('pages.cart.show_cart',compact('category','categorypost','title', 'brand', 'pages'));
    }

    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart', $cart);
        }

        Session::save();

    }

    public function delete_product_cart($session_id)
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $value) {
                if ($value['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa sản phẩm thất bại');
        }
    }

    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart) {
            $message='';
            foreach ($data['cart_qty'] as $key => $qty) {
                $i =0;
                foreach ($cart as $session => $val) {
                    $i++;
                    if ($val['session_id'] == $key && $qty<$cart[$session]['product_quantity']) {
                        $cart[$session]['product_qty'] = $qty;
                        $message.='<p style="color: #0f8efe">'.$i.') Cập nhập số lượng: '. $cart[$session]['product_name']. ' thành công</p>';
                    } elseif($val['session_id'] == $key && $qty>$cart[$session]['product_quantity']){
                        $message.='<p style="color: red">'.$i.') Cập nhập số lượng:'. $cart[$session]['product_name']. ' thất bại</p>';
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', $message);
        } else {
            return redirect()->back()->with('error', 'Cập nhập giỏ hàng không thành công');
        }
    }

    public function delete_all_cart() {
        $cart = Session::get('cart');
        if ($cart) {
            Session::forget('cart');
            Session::forget('coupon');

            return redirect()->back()->with('message', 'Xóa giỏ hàng thành công');
        } else {
            return redirect()->back()->with('message', 'Xóa giỏ hàng thất bại');
        }

    }

    public function check_coupon(Request $request) {
        $data = $request->all();
        $today= Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $login = Session::get('customer_id');
        if($login) {
            $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)
                ->where('coupon_used','LIKE','%' .$login.'%')->first();
            if($coupon) {
                return redirect()->back()->with('error','Mã giảm giá đã được sử dụng, vui lòng nhập mã khác');
            } else {
                $coupon_login = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->first();
                if($coupon_login){
                    $count_coupon = $coupon_login->count();
                    if($count_coupon>0){
                        $coupon_session = Session::get('coupon');
                        if($coupon_session==true){
                            $is_avaiable = 0;
                            if($is_avaiable==0){
                                $cou[] = array(
                                    'coupon_code' => $coupon_login->coupon_code,
                                    'coupon_condition' => $coupon_login->coupon_condition,
                                    'coupon_number' => $coupon_login->coupon_number,

                                );
                                Session::put('coupon',$cou);
                            }
                        }else{
                            $cou[] = array(
                                'coupon_code' => $coupon_login->coupon_code,
                                'coupon_condition' => $coupon_login->coupon_condition,
                                'coupon_number' => $coupon_login->coupon_number,

                            );
                            Session::put('coupon',$cou);
                        }
                        Session::save();
                        return redirect()->back()->with('message','Thêm mã giảm giá thành công');
                    }
                }else{
                    return redirect()->back()->with('error','Mã giảm giá không đúng hoặc đã hết hạn');
                }
            }
        } else {
            $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->first();
            if($coupon){
                $count_coupon = $coupon->count();
                if($count_coupon>0){
                    $coupon_session = Session::get('coupon');
                    if($coupon_session==true){
                        $is_avaiable = 0;
                        if($is_avaiable==0){
                            $cou[] = array(
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_condition' => $coupon->coupon_condition,
                                'coupon_number' => $coupon->coupon_number,

                            );
                            Session::put('coupon',$cou);
                        }
                    }else{
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon',$cou);
                    }
                    Session::save();
                    return redirect()->back()->with('message','Thêm mã giảm giá thành công');
                }
            }else{
                return redirect()->back()->with('error','Mã giảm giá không đúng hoặc đã hết hạn');
            }
        }
    }

    public function delete_coupon(){
        $coupon = Session::get('coupon');
        if($coupon==true){
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
    }

    public function history() {
        $title = 'Lịch sử mua hàng';
        $brand = Brand::all();
        $pages = Pages::all();
        $customer_id = Session::get('customer_id');
        if($customer_id == null || $customer_id =='') {
            return redirect('/login-checkout')->with('error','Vui lòng đăng nhập để xem lịch sử mua hàng');
        } else{
            $category = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
            $categorypost = CategoryPost::where('cate_post_status', '1')->orderby('cate_post_id', 'desc')->get();
            $orders = Order::where('customer_id',$customer_id)->orderby('created_at', 'DESC')->paginate(5);

            return view('pages.cart.history',compact('category','categorypost','orders','title', 'brand', 'pages'));

        }
    }

    public function view_order_history($order_code) {
        $title ="Chi tiết đơn hàng";
        $brand = Brand::all();
        $category = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
        $categorypost = CategoryPost::where('cate_post_status', '1')->orderby('cate_post_id', 'desc')->get();
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        $pages = Pages::all();
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

        foreach ($order_details_product as $key => $order_d) {

            $product_coupon = $order_d->product_coupon;
        }
        if ($product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
        }

        return view('pages.cart.order_detail_history')->with(compact('order_details', 'customer', 'shipping', 'pages','brand','order_details', 'coupon_condition', 'coupon_number', 'order', 'order_status','category','categorypost', 'title'));

    }
}
