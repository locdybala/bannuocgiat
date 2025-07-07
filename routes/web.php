<?php

use App\Http\Controllers\backend\PagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\PostFrontendController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\LoginController;

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\DeliveryController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\CategoryPostController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\GalleryController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\MailController;
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\backend\PartnerController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend
Route::get('/', function () {
    return view('layout');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('search', [HomeController::class, 'search'])->name('search');


//Frontend
Route::get('/shop/index', [HomeController::class, 'shop'])->name('shop');
Route::get('/shop/list_wistList/{customerId}', [HomeController::class, 'list_wistList'])->name('list_wistList');
Route::get('/detailBrand/{id}', [HomeController::class, 'detailBrand'])->name('detailBrand');
Route::get('/detailCategory/{id}', [HomeController::class, 'detailCategory'])->name('detailCategory');
Route::get('/detailProduct/{id}', [HomeController::class, 'detailProduct'])->name('detailProduct');
Route::get('/tag/{product_tags}', [HomeController::class, 'tag'])->name('tag');
Route::post('/load-comments', [HomeController::class, 'load_comments'])->name('load-comments');
Route::post('/send-comments', [HomeController::class, 'send_comments'])->name('send-comments');


Route::get('/categoryPost', [PostFrontendController::class, 'index'])->name('categoryPostIndex');
Route::get('/detaiCategoryPost/{slug}', [PostFrontendController::class, 'detaiCategoryPost'])->name('detaiCategoryPost');
Route::get('/postDetail/{slug}', [PostFrontendController::class, 'postDetail'])->name('postDetail');
Route::get('/pages/{slug}', [\App\Http\Controllers\frontend\ContactController::class, 'page'])->name('pages');


Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax'])->name('add-cart-ajax');
Route::get('/cart', [CartController::class, 'show_cart'])->name('cart');
Route::post('/update_cart', [CartController::class, 'update_cart'])->name('update_cart');
Route::get('/delete_product_cart/{session_id}', [CartController::class, 'delete_product_cart'])->name('delete_product_cart');
Route::get('/delete_all_cart', [CartController::class, 'delete_all_cart'])->name('delete_all_cart');
Route::post('/check_coupon', [CartController::class, 'check_coupon'])->name('check_coupon');
Route::get('/delete_coupon', [CartController::class, 'delete_coupon'])->name('delete_coupon');
Route::get('/history', [CartController::class, 'history'])->name('history');
Route::get('/view-order-history/{order_code}', [CartController::class, 'view_order_history'])->name('view_order_history');
Route::get('/payment-success', [CheckoutController::class, 'paymentSuccess'])->name(('payment-success'));
Route::get('/onepay/response', [CheckoutController::class, 'onepayResponse'])->name('onepay.response');

Auth::routes();

//Backend
Route::prefix('admin')->group(function () {
    Route::post('/filter-by-date', [AdminController::class, 'filter_by_date']);
    Route::post('/days-order', [AdminController::class, 'days_order']);

    Route::post('/dashboard-filter', [AdminController::class, 'dashboard_filter']);

    Route::get('/', [LoginController::class, 'index'])->name('dashboard');
    Route::post('/', [LoginController::class, 'login'])->name('login');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('auth');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('category')->group(function () {
        Route::get('/all_category', [CategoryController::class, 'index'])->name('all_category');
        Route::get('/add_category', [CategoryController::class, 'create'])->name('add_category');
        Route::get('/updateCategory/{id}', [CategoryController::class, 'edit'])->name('updateCategory');
        Route::post('/addCategory', [CategoryController::class, 'store'])->name('addCategory');
        Route::get('/unactive_category/{id}', [CategoryController::class, 'unactive_category'])->name('unactive_category');
        Route::get('/active_category/{id}', [CategoryController::class, 'active_category'])->name('active_category');
        Route::post('/updateCategory/{id}', [CategoryController::class, 'update'])->name('update_category');
        Route::get('/deleteCategory/{id}', [CategoryController::class, 'delete'])->name('deleteCategory');
    });

    Route::prefix('brand')->group(function () {
        Route::get('/all_brand', [BrandController::class, 'index'])->name('all_brand');
        Route::get('/add_brand', [BrandController::class, 'create'])->name('add_brand');
        Route::get('/updateBrand/{id}', [BrandController::class, 'edit'])->name('updateBrand');
        Route::post('/addBrand', [BrandController::class, 'store'])->name('addBrand');
        Route::get('/unactive_brand/{id}', [BrandController::class, 'unactive_brand'])->name('unactive_brand');
        Route::get('/active_brand/{id}', [BrandController::class, 'active_brand'])->name('active_brand');
        Route::post('/updateBrand/{id}', [BrandController::class, 'update'])->name('update_brand');
        Route::get('/deleteBrand/{id}', [BrandController::class, 'delete'])->name('deleteBrand');
    });

    Route::prefix('product')->group(function () {
        Route::get('/all_product', [ProductController::class, 'index'])->name('all_product');
        Route::get('/add_product', [ProductController::class, 'create'])->name('add_product');
        Route::get('/updateproduct/{id}', [ProductController::class, 'edit'])->name('updateproduct');
        Route::post('/addproduct', [ProductController::class, 'store'])->name('addProduct');
        Route::get('/unactive_product/{id}', [ProductController::class, 'unactive_product'])->name('unactive_product');
        Route::get('/active_product/{id}', [ProductController::class, 'active_product'])->name('active_product');
        Route::post('/updateproduct/{id}', [ProductController::class, 'update'])->name('update_product');
        Route::post('/reply_comment', [ProductController::class, 'reply_comment'])->name('reply_comment');
        Route::get('/deleteProduct/{id}', [ProductController::class, 'delete'])->name('deleteproduct');
    });
    Route::prefix('infomation')->group(function () {
        Route::get('/add_infomation', [ContactController::class, 'create'])->name('add_infomation');
        Route::post('/updateinfomation/{id}', [ContactController::class, 'update'])->name('update_info');
        Route::get('/deletecontact/{id}', [ContactController::class, 'delete'])->name('deletecontact');
    });
    Route::prefix('comment')->group(function () {
        Route::get('/all_comment', [ProductController::class, 'index_comment'])->name('index_comment');
        Route::get('/unactive_comment/{id}', [ProductController::class, 'unactive_comment'])->name('unactive_comment');
        Route::get('/active_comment/{id}', [ProductController::class, 'active_comment'])->name('active_comment');
        Route::post('/updateproduct/{id}', [ProductController::class, 'update'])->name('update_product');
        Route::delete('/deletecomment/{id}', [ProductController::class, 'deleteComment'])->name('deleteComment');

    });


    Route::prefix('gallery')->group(function () {
        Route::get('/add_gallery/{product_id}', [GalleryController::class, 'create'])->name('add_gallery');
        Route::post('/addgallery', [GalleryController::class, 'store'])->name('addGallery');
        Route::post('/select-gallery', [GalleryController::class, 'select_gallery'])->name('select_gallery');
        Route::post('/insert-gallery/{product_id}', [GalleryController::class, 'insert_gallery'])->name('insert_gallery');
        Route::post('/update_gallery_name', [GalleryController::class, 'update_gallery_name'])->name('update_gallery_name');
        Route::post('/delete_gallery_name', [GalleryController::class, 'delete_gallery_name'])->name('delete_gallery_name');


    });
    Route::get('/send_coupon,{id}', [MailController::class, 'send_coupon'])->name('send_coupon');
    Route::get('/send_coupon_vip,{id}', [MailController::class, 'send_coupon_vip'])->name('send_coupon_vip');


    Route::prefix('slider')->group(function () {
        Route::get('/all_slider', [SliderController::class, 'index'])->name('all_slider');
        Route::get('/add_slider', [SliderController::class, 'create'])->name('add_slider');
        Route::get('/updateslider/{id}', [SliderController::class, 'edit'])->name('updateslider');
        Route::post('/addslider', [SliderController::class, 'store'])->name('addSlider');
        Route::get('/unactive_slider/{id}', [SliderController::class, 'unactive_slider'])->name('unactive_slider');
        Route::get('/active_slider/{id}', [SliderController::class, 'active_slider'])->name('active_slider');
        Route::post('/updateslider/{id}', [SliderController::class, 'update'])->name('update_slider');
        Route::get('/deleteslider/{id}', [SliderController::class, 'delete'])->name('deleteslider');
    });

    Route::prefix('coupon')->group(function () {
        Route::get('/all_coupon', [CouponController::class, 'index'])->name('all_coupon');
        Route::get('/add_coupon', [CouponController::class, 'create'])->name('add_coupon');
        Route::get('/updatecoupon/{id}', [CouponController::class, 'edit'])->name('updatecoupon');
        Route::post('/addcoupon', [CouponController::class, 'store'])->name('addcoupon');
        Route::post('/updatecoupon/{id}', [CouponController::class, 'update'])->name('update_coupon');
        Route::get('/deletecoupon/{id}', [CouponController::class, 'delete'])->name('deletecoupon');
    });

    Route::prefix('fee')->group(function () {
        Route::get('/all_fee', [DeliveryController::class, 'index'])->name('all_fee');
        Route::get('/add_fee', [DeliveryController::class, 'create'])->name('add_fee');
        Route::get('/updatefee/{id}', [DeliveryController::class, 'edit'])->name('updatefee');
        Route::post('/addfee', [DeliveryController::class, 'store'])->name('addfee');
        Route::post('/updatefee/{id}', [DeliveryController::class, 'update'])->name('update_fee');
        Route::get('/deletefee/{id}', [DeliveryController::class, 'delete'])->name('deletefee');
    });

    Route::prefix('order')->group(function () {
        Route::get('/all_order', [OrderController::class, 'index'])->name('all_order');
        Route::get('/view-order/{order_code}', [OrderController::class, 'view_order'])->name('view_order');
        Route::get('/print-order/{order_code}', [OrderController::class, 'print_order'])->name('print_order');
        Route::post('/cancel_order/{order_code}', [OrderController::class, 'cancel_order'])->name('cancel_order');
        Route::get('/delete-order/{order_code}', [OrderController::class, 'delete_order'])->name('delete_order');
        Route::post('/update-order-qty', [OrderController::class, 'update_order_qty']);
        Route::post('/update-qty', [OrderController::class, 'update_qty']);
    });

    //Authencation
    Route::get('/register_auth', [AuthController::class, 'register_auth'])->name('register_auth');
    Route::get('/login', [AuthController::class, 'login'])->name('login_auth');
    Route::get('/logout_auth', [AuthController::class, 'logout_auth'])->name('logout_auth');
    Route::post('/registerAuth', [AuthController::class, 'registerAuth'])->name('registerAuth');
    Route::post('/loginAuth', [AuthController::class, 'loginAuth'])->name('loginAuth');
    Route::get('/impersonate_destroy', [UserController::class, 'impersonate_destroy'])->name('impersonate_destroy');


    Route::prefix('users')->group(function () {
        Route::post('assign-roles', [UserController::class, 'assign_roles'])->name('assign_roles');
    });
    Route::get('/all_user', [UserController::class, 'index'])->name('all_user');
    Route::get('/add_user', [UserController::class, 'create'])->name('add_user');
    Route::post('/addUsers', [UserController::class, 'store'])->name('addUsers');

    Route::post('assign-roles', [UserController::class, 'assign_roles'])->name('assign_roles');
    Route::get('/deleteUser_role/{id}', [UserController::class, 'deleteUser_role'])->name('deleteUser_role');
    Route::get('/editUser/{id}', [UserController::class, 'edit'])->name('editUser');
    Route::get('/impersonate/{id}', [UserController::class, 'impersonate'])->name('impersonate');
    Route::post('/updateUser/{id}', [UserController::class, 'update'])->name('updateUser');


    Route::prefix('category_post')->group(function () {
        Route::get('/all_category_post', [CategoryPostController::class, 'index'])->name('all_category_post')->middleware('auth');
        Route::get('/add_PostCategory', [CategoryPostController::class, 'create'])->name('add_PostCategory')->middleware('auth');
        Route::get('/updatecategory_post/{id}', [CategoryPostController::class, 'edit'])->name('updatecategory_post')->middleware('auth');
        Route::get('/unactive_category_post/{id}', [CategoryPostController::class, 'unactive_category'])->name('unactive_category_post')->middleware('auth');
        Route::get('/active_category_post/{id}', [CategoryPostController::class, 'active_category'])->name('active_category_post')->middleware('auth');
        Route::post('/addCategoryPost', [CategoryPostController::class, 'store'])->name('addCategoryPost')->middleware('auth');
        Route::post('/editCategoryPost/{id}', [CategoryPostController::class, 'update'])->name('editCategoryPost')->middleware('auth');
        Route::get('/deleteCategoryPost/{id}', [CategoryPostController::class, 'delete'])->name('deleteCategoryPost')->middleware('auth');
    });

    Route::prefix('post')->group(function () {
        Route::get('/all_post', [PostController::class, 'index'])->name('all_post')->middleware('auth');
        Route::get('/add_post', [PostController::class, 'create'])->name('add_post')->middleware('auth');
        Route::get('/updatepost/{id}', [PostController::class, 'edit'])->name('updatepost')->middleware('auth');
        Route::post('/addPost', [PostController::class, 'store'])->name('addPost')->middleware('auth');
        Route::get('/unactive_post/{id}', [PostController::class, 'unactive_post'])->name('unactive_post')->middleware('auth');
        Route::get('/active_post/{id}', [PostController::class, 'active_post'])->name('active_post')->middleware('auth');
        Route::post('/updatePost/{id}', [PostController::class, 'update'])->name('update_Post')->middleware('auth');
        Route::get('/deletePost/{id}', [PostController::class, 'delete'])->name('deletePost')->middleware('auth');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/all_customer', [CustomerController::class, 'index'])->name('all_customer');
        Route::get('/add_Customer', [CustomerController::class, 'create'])->name('add_customer');
        Route::post('/addCustomer', [CustomerController::class, 'store'])->name('addCustomers');
        Route::get('/update_customer/{id}', [CustomerController::class, 'edit'])->name('update_customer');
        Route::post('/updateCustomer/{id}/{admin}', [CustomerController::class, 'update'])->name('updateCustomer');
        Route::get('/deleteCustomer/{id}', [CustomerController::class, 'delete'])->name('deletecustomer');

    });

    Route::post('/export-csv', [ProductController::class, 'export_csv'])->name('export_csv');
    Route::post('/import-csv', [ProductController::class, 'import_csv'])->name('import_csv');

    Route::prefix('pages')->group(function () {
        Route::get('/all_pages', [\App\Http\Controllers\backend\PagesController::class, 'index'])->name('all_pages');
        Route::get('/add_pages', [PagesController::class, 'create'])->name('add_pages');
        Route::get('/updatePages/{id}', [PagesController::class, 'edit'])->name('updatePages');
        Route::post('/addPages', [PagesController::class, 'store'])->name('addPages');
        Route::post('/updatePages/{id}', [PagesController::class, 'update'])->name('update_pages');
        Route::get('/deletePages/{id}', [PagesController::class, 'delete'])->name('deletePages');
    });
});

// phí vận chuyển
Route::post('/select-delivery', [DeliveryController::class, 'select_delivery'])->name('select_delivery');
Route::post('/insert-delivery', [DeliveryController::class, 'insert_delivery']);
Route::post('/select-feeship', [DeliveryController::class, 'select_feeship']);
Route::post('/update-delivery', [DeliveryController::class, 'update_delivery']);


// check out
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout'])->name('logout_checkout');
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout'])->name('loginCustomer');
Route::get('/registerCustomer', [CheckoutController::class, 'register'])->name('registerCustomer');
Route::post('/addCustomer', [CheckoutController::class, 'add_customer'])->name('addCustomer');
Route::post('/loginCustomer', [CheckoutController::class, 'login_customer'])->name('login_customer');
Route::get('/forgot_pass', [CheckoutController::class, 'forgot_pass'])->name('forgot_pass');
Route::post('/send_mail_forgot_pass', [CheckoutController::class, 'send_mail_forgot_pass'])->name('send_mail_forgot_pass');
Route::get('/update-new-password', [CheckoutController::class, 'update_new_password'])->name('update_new_password');
Route::post('/update_pass', [CheckoutController::class, 'update_pass'])->name('update_pass');
Route::get('/login_customer_google', [CheckoutController::class, 'login_customer_google'])->name('login_customer_google');
Route::get('/google_callback', [CheckoutController::class, 'google_callback'])->name('google_callback');


Route::post('/calculate-fee', [CheckoutController::class, 'calculate_fee']);
Route::get('/del-fee', [CheckoutController::class, 'del_fee']);
Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);
Route::get('/contact', [\App\Http\Controllers\frontend\ContactController::class, 'index'])->name('contact');

Route::get('/success/{order_code}', [CheckoutController::class, 'success'])->name('paymentOrderSuccess');

Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/edit-customer/{id}', [CheckoutController::class, 'edit_customer'])->name('edit_customer');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home1');
