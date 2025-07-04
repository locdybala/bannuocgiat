<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function register_auth()
    {
        return view('backend.users.register');
    }

    public function registerAuth(Request $request)
    {
        $this->validation($request);
        $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = md5($data['password']);
        $user->save();
        $user->roles()->attach(Roles::where('name', 'user')->first());
        return redirect('admin/all_users')->with('message', 'Đăng ký thành công');

    }

    public function loginAuth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ]);
        $data = $request->all();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return Redirect::to('admin/dashboard')->with('message', 'Đăng nhập thành công');
        } else {
            return Redirect::to('admin/login')->with('message', 'Sai');
        }

    }

    public function logout_auth()
    {
        Auth::logout();
        return Redirect::to('backend/login')->with('message', 'Đăng xuất thành công');
    }

    public function validation($request)
    {
        return $this->validate($request, [
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',

        ]);
    }

    public function login()
    {
        return view('backend.users.login');
    }
}
