<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Contact;
use App\Models\Pages;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        $title = 'Liên hệ';
        $contact = Contact::find('1');
        $category = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $slider = Slider::where('slider_status', '1')->take(4)->get();
        $categorypost = CategoryPost::where('cate_post_status', '1')->orderby('cate_post_id', 'desc')->get();
        $pages = Pages::all();
        return view('pages.contact.info',compact('category','brand','slider','categorypost','contact','title', 'pages'));
    }

    public function page($slug)
    {
        $title = 'Trang';
        $category = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $page = Pages::where('slug', '=',$slug)->first();
        $pages = Pages::all();
        $pagess = Pages::all();
        return view('pages.contact.page', compact('title','category', 'brand', 'page', 'pages', 'pagess'));

    }

}
