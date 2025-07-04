<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function index()
    {
        $title = 'Danh sách thương hiệu';
        $brands = Brand::orderBy('brand_id','DESC')->paginate(10);
        return view('backend.brand.index', compact('brands','title'));
    }

    public function create()
    {
        $title = 'Thêm thương hiệu';
        return view('backend.brand.add',compact('title'));
    }

    public function store(Request $request)
    {
        $brand = new Brand();
        $brand->brand_name = $request->name;
        $brand->brand_desc = $request->description;
        $brand->brand_status = $request->status;

        $get_image = $request->file('brand_image');
        if ($get_image) {
            $new_image = rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('upload/brand', $new_image);
            $brand->brand_image = $new_image;
        }

        $brand->save();
        Session::put('success', 'Thêm thương hiệu sản phẩm thành công');
        return redirect()->route('all_brand');
    }

    public function unactive_brand($id)
    {
        Brand::find($id)->update([
            'brand_status' => 0
        ]);
        Session::put('success', 'Không kích hoạt thương hiệu sản phẩm thành công');
        return redirect()->route('all_brand');
    }

    public function active_brand($id)
    {
        Brand::find($id)->update([
            'brand_status' => 1
        ]);
        Session::put('success', 'Kích hoạt thương hiệu sản phẩm thành công');
        return redirect()->route('all_brand');
    }

    public function edit($id)
    {
        $title = 'Sửa thương hiệu';
        $brand = Brand::find($id);
        return view('backend.brand.update', compact('brand','title'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $brand->brand_name = $request->name;
        $brand->brand_desc = $request->description;
        $brand->brand_status = $request->status;

        $get_image = $request->file('brand_image');
        if ($get_image) {
            // Xóa ảnh cũ
            $old_image_path = 'upload/brand/' . $brand->brand_image;
            if (File::exists($old_image_path)) {
                File::delete($old_image_path);
            }

            // Thêm ảnh mới
            $new_image = rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('upload/brand', $new_image);
            $brand->brand_image = $new_image;
        }

        $brand->save();
        Session::put('success', 'Sửa thương hiệu sản phẩm thành công');
        return redirect()->route('all_brand');
    }

    public function delete($id)
    {
        $brand = Brand::find($id);

        // Xóa ảnh
        $image_path = 'upload/brand/' . $brand->brand_image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $brand->delete();
        Session::put('success', 'Xóa thương hiệu thành công');
        return redirect()->route('all_brand');
    }
}
