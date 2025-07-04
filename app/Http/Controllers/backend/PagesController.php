<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Danh sách trang';
        $pages = Pages::paginate(5);
        return view('backend.pages.index', compact('pages','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Thêm trang';
        return view('backend.pages.add',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pages::create([
            'name' => $request->name,
            'title' => $request->title,
            'content' => $request->contents,
            'slug' => $request->slug,
        ]);
        Session::put('success', 'Thêm trang thành công');
        return redirect()->route('all_pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Sửa trang';
        $pages = Pages::find($id);
        return view('backend.pages.update', compact('pages','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Pages::find($id)->update([
            'name' => $request->name,
            'title' => $request->title,
            'content' => $request->contents,
            'slug' => $request->slug
        ]);
        Session::put('success', 'Sửa trang thành công');
        return redirect()->route('all_pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Pages::find($id)->delete();
        Session::put('success', 'Xóa trang thành công');
        return redirect()->route('all_pages');
    }
}
