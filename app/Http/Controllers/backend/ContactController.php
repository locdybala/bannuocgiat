<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index() {
        $contact = Contact::first();
        return view('backend.contact.index', compact('contact'));
    }

    public function create() {
        $title = 'Cấu hình website';
        $contact = Contact::first();
        return view('backend.contact.update', compact('contact', 'title'));
    }

    public function update(Request $request, $id) {
        try {
            $contact = Contact::findOrFail($id);
            
            $contact->info_facebook = $request->info_facebook;
            $contact->info_youtobe = $request->info_youtobe;
            $contact->info_instagram = $request->info_instagram;
            $contact->info_tiktok = $request->info_tiktok;
            $contact->info_contact = $request->info_name;
            $contact->info_map = $request->info_map;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    // Xóa ảnh cũ
                    if ($contact->info_image && file_exists(public_path('upload/info/' . $contact->info_image))) {
                        unlink(public_path('upload/info/' . $contact->info_image));
                    }

                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $new_image = $filename . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/info'), $new_image);
                    $contact->info_image = $new_image;
                }
            }

            if ($contact->save()) {
                Session::flash('success', 'Cập nhật thông tin thành công');
            } else {
                Session::flash('error', 'Cập nhật thông tin thất bại');
            }

            // Clear cache nếu bạn đang sử dụng cache
            \Cache::forget('contact_info');
            
            return redirect()->route('add_infomation')->with('contact', $contact);

        } catch (\Exception $e) {
            \Log::error('Lỗi cập nhật contact: ' . $e->getMessage());
            Session::flash('error', 'Có lỗi xảy ra khi cập nhật thông tin');
            return redirect()->route('add_infomation');
        }
    }
}
