<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Danh sách danh mục';
        $categories = Category::orderBy('category_id', 'DESC')->paginate(10);
        return view('backend.category.index', compact('categories','title'));
    }

    public function create()
    {
        $title = 'Thêm danh mục';
        return view('backend.category.add',compact('title'));
    }

    public function store(Request $request)
    {
        Category::create([
            'category_name' => $request->name,
            'category_desc' => $request->description,
            'category_status' => $request->status,
        ]);
        Session::put('success', 'Thêm danh mục sản phẩm thành công');
        return redirect()->route('all_category');
    }

    public function unactive_category($id)
    {
        Category::find($id)->update([
            'category_status' => 0
        ]);
        Session::put('success', 'Không kích hoạt danh mục sản phẩm thành công');
        return redirect()->route('all_category');
    }

    public function active_category($id)
    {
        Category::find($id)->update([
            'category_status' => 1
        ]);
        Session::put('success', 'Kích hoạt danh mục sản phẩm thành công');
        return redirect()->route('all_category');

    }

    public function edit($id)
    {
        $title = 'Sửa danh mục';
        $category = Category::find($id);
        return view('backend.category.update', compact('category','title'));
    }

    public function update(Request $request, $id)
    {
        Category::find($id)->update([
            'category_name' => $request->name,
            'category_desc' => $request->description,
            'category_status' => $request->status
        ]);
        Session::put('success', 'Sửa danh mục sản phẩm thành công');
        return redirect()->route('all_category');

    }

    public function delete($id)
    {
        Category::find($id)->delete();
        Session::put('success', 'Xóa danh mục sản phẩm thành công');
        return redirect()->route('all_category');

    }
}
