<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{


    public function create()
    {
        $title = 'Cấu hình website';
        $contactUpdate = Contact::first();
        return view('backend.contact.update', compact('contactUpdate', 'title'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->info_contact = $request->info_name;
        $contact->info_map = $request->info_map;

        // Xử lý upload ảnh logo
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/info'), $filename);
            $contact->info_image = $filename;
        }
        if ($contact->save()) {
            Session::put('success', 'Cập nhật thông tin thành công');
        } else {
            Session::put('error', 'Cập nhật thông tin thất bại');
        }

        return redirect()->route('add_infomation')->with('contact', $contact);
    }
}
