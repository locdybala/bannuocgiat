<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    public function index()
    {
        $title = 'Danh sách sliders';
        $sliders = Slider::paginate(5);
        return view('backend.slider.index', compact('sliders','title'));

    }

    public function create()
    {
        $title = 'Thêm sliders';

        return view('backend.slider.add',compact('title'));
    }

    public function store(Request $request)
    {
        $data = array();
        $data['slider_name'] = $request->name;
        $data['slider_desc'] = $request->description;
        $data['slider_status'] = $request->status;
        $file = $request->file('image');
        if ($file) {
            $getnameimage = $file->getClientOriginalName();
            $nameimage = current(explode('.', $getnameimage));
            $new_image = $nameimage . rand(0, 99) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/slider', $new_image);
            $data['slider_image'] = $new_image;
            $slider = Slider::create($data);
            if ($slider) {
                Session::put('success', 'Thêm ảnh slider thành công');
                return redirect()->route('all_slider');
            } else {
                Session::put('message', 'Thêm ảnh slider thất bại');
                return redirect()->route('all_slider');
            }
        }
        $data['slider_image'] = '';
        $slider = Slider::create($data);
        if ($slider) {
            Session::put('success', 'Thêm ảnh slider thành công');
            return redirect()->route('all_slider');
        } else {
            Session::put('message', 'Thêm ảnh slider thất bại');
            return redirect()->route('all_slider');
        }
    }

    public function unactive_slider($id)
    {
        Slider::find($id)->update([
            'slider_status' => 0
        ]);
        Session::put('success', 'Không kích hoạt ảnh slider thành công');
        return redirect()->route('all_slider');
    }

    public function active_slider($id)
    {
        Slider::find($id)->update([
            'slider_status' => 1
        ]);
        Session::put('success', 'Kích hoạt ảnh slider thành công');
        return redirect()->route('all_slider');

    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        $title = 'Sửa sliders';

        return view('backend.slider.update', compact('slider','title'));
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['slider_name'] = $request->name;
        $data['slider_desc'] = $request->description;
        $file = $request->file('image');
        if ($file) {
            $getnameimage = $file->getClientOriginalName();
            $nameimage = current(explode('.', $getnameimage));
            $new_image = $nameimage . rand(0, 99) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/slider', $new_image);
            $data['slider_image'] = $new_image;
            Slider::find($id)->update($data);
            Session::put('success', 'Cập nhập ảnh slider thành công');
            return redirect()->route('all_slider');

        }
        Slider::find($id)->update($data);
        Session::put('success', 'Cập nhập ảnh slider thành công');
        return redirect()->route('all_slider');

    }

    public function delete($id)
    {
        Slider::find($id)->delete();
        Session::put('success', 'Xóa ảnh slider thành công');
        return redirect()->route('all_slider');

    }
}
