<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\Gallery;
use App\Models\Pages;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Trang chủ';
        $category = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $productNews = Product::where('product_status', '1')->orderby('product_id', 'desc')->limit(6)->get();
        $productSolds = Product::where('product_status', '1')->orderby('product_sold', 'desc')->limit(12)->get();
        $productLimit = Product::where('product_status', '1')->orderby('product_price', 'desc')->limit(1)->first();
        $productView = Product::where('product_status', '1')->orderby('product_view', 'desc')->limit(1)->first();
        $bestSellers = Product::latest()->limit(4)->get();
        $sliders = Slider::where('slider_status', '1')->get();
        $categories = Category::latest()->take(5)->get(); // Lấy 4 danh mục mới nhất
        $categorypost = CategoryPost::where('cate_post_status', '1')->orderby('cate_post_id', 'desc')->get();
        $pages = Pages::all();
        $coupon = Coupon::whereDate('coupon_date_start', '<=', now())
            ->whereDate('coupon_date_end', '>=', now())
            ->first();
        $products = Product::latest()->take(8)->get();
        return view('pages.home', compact('category', 'brand', 'products', 'sliders', 'productView', 'productLimit', 'categorypost',
            'title', 'productNews', 'pages', 'productSolds', 'categories', 'coupon', 'bestSellers'));
    }

    public function searchProduct(Request $request)
    {
        $title = 'Kết quả tìm kiếm sản phẩm';
        $query = $request->input('query');

        $category = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $categorypost = CategoryPost::where('cate_post_status', '1')->orderby('cate_post_id', 'desc')->get();
        $pages = Pages::all();
        $slider = Slider::where('slider_status', '1')->take(4)->get();

        $products = Product::where('product_status', '1')
            ->where('product_name', 'LIKE', '%' . $query . '%')
            ->paginate(12);

        $products->appends(['query' => $query]);

        return view('pages.product.search_results', compact('category', 'brand', 'products', 'categorypost', 'title', 'pages', 'query', 'slider'));
    }

    public function shop()
    {
        $title = 'Danh sách sản phẩm';
        $category = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $products = Product::where('product_status', '1')->get();
        $price_increases = Product::where('product_status', '1')->orderby('product_price', 'desc')->get();
        $price_reduces = Product::where('product_status', '1')->orderby('product_price', 'ASC')->get();
        $product_populars = Product::where('product_status', '1')->orderby('product_view', 'DESC')->get();

        $slider = Slider::where('slider_status', '1')->take(4)->get();
        $categorypost = CategoryPost::where('cate_post_status', '1')->orderby('cate_post_id', 'desc')->get();
        $pages = Pages::all();
        return view('pages.product.index', compact('price_reduces', 'price_increases', 'product_populars', 'category', 'brand', 'products', 'slider', 'categorypost', 'title', 'pages'));
    }

    public function list_wistList($customerId)
    {
        $title = 'Sản phẩm yêu thích';
        $category = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $slider = Slider::where('slider_status', '1')->take(4)->get();
        $categorypost = CategoryPost::where('cate_post_status', '1')->orderby('cate_post_id', 'desc')->get();
        $pages = Pages::all();
        return view('pages.product.wistlist', compact('category', 'brand', 'slider', 'categorypost', 'title', 'pages', 'customerId'));
    }

    public function detailCategory($id)
    {
        $title = 'Sản phẩm theo danh mục';
        $slider = Slider::where('slider_status', '1')->take(4)->get();
        $category = Category::where('category_status', '1')
            ->withCount('product') // Lưu ý: 'products' theo tên function
            ->orderBy('category_id', 'desc')
            ->get();
        $brand = Brand::where('brand_status', '1')->withCount('product')->orderby('brand_id', 'desc')->get();
        $products = Product::where('product_status', '1')->where('category_id', $id)->orderby('product_id', 'desc')->paginate(8);
        $category_name = Category::find($id);
        $categorypost = CategoryPost::where('cate_post_status', '1')->orderby('cate_post_id', 'desc')->get();
        $pages = Pages::all();
        // Lấy sản phẩm bán chạy nhất (giả sử cột `product_sold` lưu số lượng đã bán)
        $best_sellers = Product::where('product_status', '1')->orderBy('product_sold', 'desc')->take(8)->get();
        return view('pages.category.show_category', compact('category','brand', 'products', 'category_name', 'slider', 'categorypost', 'title', 'pages', 'best_sellers'));
    }

    public function detailBrand($id)
    {
        $title = 'Sản phẩm theo thương hiệu';
        $brand_name = Brand::find($id)->brand_name;
        $slider = Slider::where('slider_status', '1')->take(4)->get();
        $category = Category::where('category_status', '1')
            ->withCount('product') // Lưu ý: 'products' theo tên function
            ->orderBy('category_id', 'desc')
            ->get();
        $brand = Brand::where('brand_status', '1')->withCount('product')->orderby('brand_id', 'desc')->get();
        $products = Product::where('product_status', '1')->where('brand_id', $id)->orderby('product_id', 'desc')->paginate(8);

        $categorypost = CategoryPost::where('cate_post_status', '1')->orderby('cate_post_id', 'desc')->get();
        $pages = Pages::all();
        $best_sellers = Product::where('product_status', '1')->orderBy('product_sold', 'desc')->take(8)->get();

        return view('pages.brand.show_brand', compact( 'category', 'brand', 'products', 'brand_name', 'slider', 'categorypost', 'title', 'pages', 'best_sellers'));
    }

    public function detailProduct($id)
    {
        $title = 'Chi tiết sản phẩm';
        $slider = Slider::where('slider_status', '1')->take(4)->get();
        $category = Category::where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $productDetail = Product::find($id);
        $view = $productDetail->product_view;
        $productDetail->product_view = $view + 1;
        $productDetail->save();
        $category_id = $productDetail->category_id;
        $related_products = Product::where('category_id', $category_id)->whereNotIn('tbl_product.product_id', [$id])->get();
        $gallery = Gallery::where('product_id', $id)->get();
        $categorypost = CategoryPost::where('cate_post_status', '1')->orderby('cate_post_id', 'desc')->get();
        $pages = Pages::all();
        return view('pages.product.detail_product', compact('category', 'gallery', 'title', 'brand', 'productDetail', 'related_products', 'slider', 'categorypost', 'pages'));
    }

    public function search(Request $request)
    {
        $title = 'Tìm kiếm';
        $category = Category::where('category_status', '1')
            ->withCount('product') // Lưu ý: 'products' theo tên function
            ->orderBy('category_id', 'desc')
            ->get();
        $brand = Brand::where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $keywords = $request->keywords_submit;
        $categorypost = CategoryPost::where('cate_post_status', '1')->orderby('cate_post_id', 'desc')->get();
        $products = Product::where('product_name', 'like', '%' . $keywords . '%')->get();
        $slider = Slider::where('slider_status', '1')->take(4)->get();
        $pages = Pages::all();
        return view('pages.product.search', compact('category', 'brand', 'products', 'categorypost', 'title', 'slider', 'pages'));

    }

    public function tag($product_tag)
    {
        echo $product_tag;
    }

    public function load_comments(Request $request)
    {
        $product = $request->product_id;
        $comments = Comment::where('product_id', $product)->where('comment_status', 1)->get();
        $replycomments = Comment::all();
        $output = '';
        foreach ($comments as $comment) {

            $output = '';
            foreach ($comments as $comment) {
                $output .= '<div class="review_item">'
                    . '<div class="media">'
                    . '<div class="d-flex">'
                    . '<img src="' . url('frontend/assets/img/comment/comment_1.png') . '" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">'
                    . '</div>'
                    . '<div class="media-body">'
                    . '<h4>' . $comment->comment_name . '</h4>'
                    . '<div class="d-flex mb-3">';

                // Hiển thị số sao đánh giá
                for ($i = 1; $i <= 5; $i++) {
                    $output .= '<i class="fa ' . ($i <= $comment->rating ? 'fa-star text-secondary' : 'fa-star text-muted') . '"></i>';
                }

                $output .= '</div>' // Đóng phần đánh giá sao
                    . '<p>' . $comment->comment . '</p>'
                    . '<p class="mb-2" style="font-size: 14px;">' . $comment->comment_date . '</p>'
                    . '</div>' // Đóng media-body
                    . '</div>' // Đóng media
                    . '</div>'; // Đóng review_item

                // Hiển thị phản hồi bình luận
                foreach ($replycomments as $replycomment) {
                    if ($replycomment->comment_parent === $comment->comment_id) {
                        $output .= '<div class="review_item" style="margin-left: 40px">'
                            . '<div class="media">'
                            . '<div class="d-flex">'
                            . '<img src="' . url('frontend/assets/img/comment/user.png') . '" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">'
                            . '</div>'
                            . '<div class="media-body">'
                            . '<h4>' . $replycomment->comment_name . '</h4>'
                            . '<div class="d-flex mb-3">';

                        for ($i = 1; $i <= 5; $i++) {
                            $output .= '<i class="fa ' . ($i <= $replycomment->rating ? 'fa-star text-secondary' : 'fa-star text-muted') . '"></i>';
                        }

                        $output .= '</div>' // Đóng phần đánh giá sao
                            . '<p>' . $replycomment->comment . '</p>'
                            . '<p class="mb-2" style="font-size: 14px;">' . $replycomment->comment_date . '</p>'
                            . '</div>' // Đóng media-body
                            . '</div>' // Đóng media
                            . '</div>'; // Đóng review_item
                    }
                }
            }

        }
        echo $output;
    }

    public function send_comments(Request $request)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;

        $comment = new Comment();
        $comment->comment_name = $comment_name;
        $comment->comment = $comment_content;
        $comment->product_id = $product_id;
        $comment->comment_date = $date->toDateTimeString();
        $comment->comment_status = 0;
        $comment->save();
    }
}
