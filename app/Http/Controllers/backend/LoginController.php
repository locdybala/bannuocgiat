<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

session_start();
class LoginController extends Controller
{
    public function index(){
        return view('backend.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required|max:255',
        ]);

        $data=$request->all();
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return Redirect::to('admin/dashboard')->with('message','Đăng nhập thành công');
        }else{
            return Redirect::to('admin/')->with('message','Tài khoản hoặc mật khẩu không chính xác');
        }
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('admin')->with('message','Đăng xuất thành công');
    }
}
