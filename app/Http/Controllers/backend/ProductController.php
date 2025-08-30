<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;


class ProductController extends Controller
{
    public function index()
    {
        $title = 'Danh sách sản phẩm';
        $products = Product::orderByDesc('product_id')->paginate(15);
        return view('backend.product.index', compact('products', 'title'));

    }

    public function search(Request $request)
    {
        $title = 'Kết quả tìm kiếm sản phẩm';
        $query = $request->input('query');

        $products = Product::orderByDesc('product_id')
            ->where('product_name', 'LIKE', '%' . $query . '%')
            ->paginate(15);
        
        // Append the search query to pagination links
        $products->appends(['query' => $query]);

        return view('backend.product.index', compact('products', 'title'));
    }

    public function create()
    {
        $title = 'Thêm sản phẩm';
        $brand = Brand::all();
        $category = Category::all();
        return view('backend.product.add', compact('category', 'brand', 'title'));
    }

    public function store(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->name;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_sold'] = $request->product_quantity;
        $data['product_tags'] = $request->product_tags;
        $data['product_content'] = $request->product_content;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->price;
        $data['product_desc'] = $request->description;
        $data['product_status'] = $request->status;
        $file = $request->file('image');
        $path = 'upload/product/';
        $pathGallery = 'upload/gallery/';
        if ($file) {
            $getnameimage = $file->getClientOriginalName();
            $nameimage = current(explode('.', $getnameimage));
            $new_image = $nameimage . rand(0, 99) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $new_image);
            File::copy($path . $new_image, $pathGallery . $new_image);
            $data['product_image'] = $new_image;
        }
        $product = Product::insertGetId($data);
        $gellery = new Gallery();
        $gellery->gallery_name = $new_image;
        $gellery->gallery_image = $new_image;
        $gellery->product_id = $product;
        $gellery->save();
        Session::put('success', 'Thêm sản phẩm thành công');
        return redirect()->route('all_product');
    }

    public function unactive_product($id)
    {
        Product::find($id)->update([
            'product_status' => 0
        ]);
        Session::put('success', 'Không kích hoạt sản phẩm thành công');
        return redirect()->route('all_product');
    }

    public function active_product($id)
    {
        Product::find($id)->update([
            'product_status' => 1
        ]);
        Session::put('success', 'Kích hoạt sản phẩm thành công');
        return redirect()->route('all_product');

    }

    public function edit($id)
    {
        $title = 'Sửa sản phẩm';
        $product = Product::find($id);
        $category = Category::all();
        $brand = Brand::all();
        return view('backend.Product.update', compact('product', 'category', 'brand', 'title'));
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['product_name'] = $request->name;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_tags'] = $request->product_tags;
        $data['product_content'] = $request->product_content;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->price;
        $data['product_desc'] = $request->description;
        $file = $request->file('image');
        if ($file) {
            $getnameimage = $file->getClientOriginalName();
            $nameimage = current(explode('.', $getnameimage));
            $new_image = $nameimage . rand(0, 99) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/Product', $new_image);
            $data['product_image'] = $new_image;
            Product::find($id)->update($data);
            Session::put('success', 'Cập nhập sản phẩm thành công');
            return redirect()->route('all_product');

        }
        Product::find($id)->update($data);
        Session::put('success', 'Cập nhập sản phẩm thành công');
        return redirect()->route('all_product');

    }

    public function delete($id)
    {
        Product::find($id)->delete();
        Session::put('success', 'Xóa sản phẩm thành công');
        return redirect()->route('all_product');

    }

    public function export_csv()
    {
        return Excel::download(new ExcelExports, 'category_product.xlsx');
    }

    public function import_csv(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();
    }

    public function index_comment()
    {
        $title = 'Danh sách nhận xét';
        $comments = Comment::with('product')->where('comment_parent', '0')->orderByDesc('comment_status')->paginate(5);
        $replycoments = Comment::all();
        return view('backend.comment.index', compact('comments', 'replycoments', 'title'));
    }

    public function unactive_comment($id)
    {
        Comment::find($id)->update([
            'comment_status' => 0
        ]);
        Session::put('success', 'Bỏ duyệt thành công');
        return redirect()->route('index_comment');
    }

    public function active_comment($id)
    {
        Comment::find($id)->update([
            'comment_status' => 1
        ]);
        Session::put('success', 'Duyệt thành công');
        return redirect()->route('index_comment');

    }

    public function reply_comment(Request $request)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['reply_comment'];
        $comment->product_id = $data['product_id'];
        $comment->comment_name = 'Admin';
        $comment->comment_parent = $data['comment_id'];
        $comment->comment_date = $date->toDateTimeString();
        $comment->save();
    }

    public function deleteComment($id)
    {

        Comment::find($id)->delete();
        Session::put('success', 'Xóa nhận xét thành công');
        return redirect()->route('index_comment');
    }
}
