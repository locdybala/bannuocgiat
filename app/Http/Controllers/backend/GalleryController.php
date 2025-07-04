<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GalleryController extends Controller
{
    public function create($product_id) {
        $title = "Thêm thư viện ảnh sản phẩm";
        $product_id = $product_id;
        return view('backend.gallery.add',compact('product_id', 'title'));
    }

    public function select_gallery(Request $request) {
        $product_id = $request->product_id;
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output ='<table class="table table-hover">
                                    <thead>
                                    <tr>
                                    <th>STT</th>
                                        <th>Tên hình ảnh</th>
                                        <th>Ảnh</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">';
        if ($gallery_count>0) {
            $i =0;
            foreach ($gallery as $gallery) {
                $i++;
                $output .='<form method="POST" >'.csrf_field().'<tr>
                                        <td>'.$i.'</td>
                                        <td contenteditable class="edit_gallery_name" data-gallery_id="'.$gallery->gallery_id.'">'.$gallery->gallery_name.'</td>
                                        <td><img src="'.url('upload/gallery/'.$gallery->gallery_image).'" class="thumbnail" width="120" height="100px" alt=""></td>
                                        <td><button type="button" data-gal_id="'.$gallery->gallery_id.'" class="btn btn-xs btn-danger delete-gallery">Xóa</button></td>
                                    </tr></form>
                ';
            }
        } else {
            $output .= '<tr><td colspan="4">Hình ảnh chưa có thư viện ảnh</td></tr
';
        }
        $output.= '</tbody></table>';
        echo $output;
    }

    public function insert_gallery(Request $request, $product_id) {
        $get_image = $request->file('file');
        if ($get_image) {
            foreach ($get_image as $image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image=current(explode('.',$get_name_image));
                $new_image=$name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image->move('upload/gallery',$new_image);
                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $product_id;
                $gallery->save();
            }
        }
        Session::put('success','Thêm thư viện ảnh thành công');
        return redirect()->back();
    }

    public function update_gallery_name(Request $request) {
        $gallery_id = $request->gallery_id;
        $gallery_text = $request->gallery_text;
        $gallery =Gallery::find($gallery_id );
        $gallery->gallery_name = $gallery_text;
        $gallery->save();
    }

    public function delete_gallery_name(Request $request) {
        $gallery_id = $request->gallery_id;
        $gallery =Gallery::find($gallery_id );
        $gallery->delete();
    }
}
