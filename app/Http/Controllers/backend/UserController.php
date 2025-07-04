<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Danh sách user';
        $users = User::paginate(5);
        return view('backend.users.index')->with(compact('users','title'));
    }

    public function assign_roles(Request $request)
    {
        if(Auth::id()==$request->id){
            return redirect()->back()->with('message','Không được phân quyền chính mình');
        }
        $data = $request->all();
        $user = User::where('email', $data['admin_email'])->first();
        $user->roles()->detach();
        if ($request['author_role']) {
            $user->roles()->attach(Roles::where('name', 'author')->first());
        }
        if ($request['user_role']) {
            $user->roles()->attach(Roles::where('name', 'user')->first());
        }
        if ($request['admin_role']) {
            $user->roles()->attach(Roles::where('name', 'admin')->first());
        }
        return redirect()->back()->with('success','Cấp quyền thành công');
    }

    public function deleteUser_role($id){
        if(Auth::id()==$id){
            return redirect()->back()->with('message','Không được xóa chính mình');
        }
        $user=User::find($id);
        if($user){
            $user->roles()->detach();
            $user->delete();
        }

        return redirect()->back()->with('success','Xóa user thành công');

    }

    //Chuyển quyền
    public function impersonate($id){
        $user=User::where('id',$id)->first();
        if($user){
            session()->put('impersonate',$user->id);
        }
        return redirect('/admin/all_user');
    }
    public function impersonate_destroy(){
        session()->forget('impersonate');
        return redirect('/admin/all_user');
    }

    public function create()
    {
        $title = 'Thêm tài khoản';
        return view('backend.users.add', compact('title'));
    }

    public function store(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = md5($request->password);
        $data['phone'] = $request->phone;
        $data['birthday'] = $request->birthday;
        $data['address'] = $request->address;
        $data['avatar'] = '';
        $file = $request->file('avatar');
        $path = 'upload/users/';
        if ($file) {
            $getnameimage = $file->getClientOriginalName();
            $nameimage = current(explode('.', $getnameimage));
            $new_image = $nameimage . rand(0, 99) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $new_image);
            $data['avatar'] = $new_image;
        }
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = ($data['password']);
        $user->phone = $data['phone'];
        $user->birthday = $data['birthday'];
        $user->address = $data['address'];
        $user->avatar = $data['avatar'];
        $user->save();
        $user->roles()->attach(Roles::where('name','user')->first());
        Session::put('success', 'Thêm tài khoản thành công');
        return redirect()->route('all_user');
    }

    public function edit($id)
    {
        $title = 'Sửa tài khoản';
        $user = User::find($id);
        return view('backend.users.update', compact('user', 'title'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        if ($request->password) {
            $data['password'] = md5($request->password);
        }
        $data['phone'] = $request->phone;
        $data['birthday'] = $request->birthday;
        $data['address'] = $request->address;

        $user->name = $data['name'];
        $user->email = $data['email'];
        if ($request->password) {
            $user->password = md5($data['password']);
        }
        $user->phone = $data['phone'];
        $user->birthday = $data['birthday'];
        $user->address = $data['address'];
        $user->update();
        Session::put('success', 'Sửa tài khoản thành công');
        return redirect()->route('all_user');
    }
}
