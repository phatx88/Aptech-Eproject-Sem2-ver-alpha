<?php
use App\Http\Controllers\HomeController;    //use
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home',[HomeController::class,'index']);

// Route::get('/product', function () {
//     return view('pages.product');
// });
Route::get('/product', [ProductsController::class, 'index']);

Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/blog', function () {
    return view('pages.blog');
});

Route::get('/single-blog', function () {
    return view('pages.single_blog');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/single-product', function () {
    return view('pages.single_product');
});

Route::get('/cart', function () {
    return view('pages.cart');
});

Route::get('/check-out', function () {
    return view('pages.checkout');
});

Route::get('/my-profile', function () {
    return view('pages.user');
});

//Admin
Route::get('/admin-login', function () {
    return view('admin.login');
});

Route::get('/admin-dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/order-list', function () {
    return view('admin.order.list');
});

Route::get('/order-add', function () {
    return view('admin.order.add');
});

//customer
Route::get('/customer-list', function () {
    return view('admin.customer.list');
});
Route::get('/customer-add', function () {
    return view('admin.customer.add');
});
Route::get('/customer-edit', function () {
    return view('admin.customer.edit');
});

//product
Route::get('/product-add', function () {
    return view('admin.product.add');
});
Route::get('/product-list', function () {
    return view('admin.product.list');
});
Route::get('/product-edit', function () {
    return view('admin.product.edit');
});

//comment
Route::get('/comment-list', function () {
    return view('admin.comment.list');
});

//admin
Route::get('/image-list', function () {
    return view('admin.image.list');
});

//category
Route::get('/category-add', function () {
    return view('admin.category.add');
});
Route::get('/category-list', function () {
    return view('admin.category.list');
});
Route::get('/category-edit', function () {
    return view('admin.category.edit');
});

//staff
Route::get('/staff-add', function () {
    return view('admin.staff.add');
});
Route::get('/staff-list', function () {
    return view('admin.staff.list');
});
Route::get('/staff-edit', function () {
    return view('admin.staff.edit');
});

//promotion
Route::get('/promotion-add', function () {
    return view('admin.promotion.add');
});
Route::get('/promotion-list', function () {
    return view('admin.promotion.list');
});
Route::get('/promotion-edit', function () {
    return view('admin.promotion.edit');
});

//transport
Route::get('/transport-add', function () {
    return view('admin.transport.add');
});
Route::get('/transport-list', function () {
    return view('admin.transport.list');
});
Route::get('/transport-edit', function () {
    return view('admin.transport.edit');
});

//newsletter
Route::get('/newsletter-list', function () {
    return view('admin.newsletter.list');
});
Route::get('/newsletter-send', function () {
    return view('admin.newsletter.send');
});

// order_status
Route::get('/order_status-list', function () {
    return view('admin.order_status.list');
});
Route::get('/order_status-edit', function () {
    return view('admin.order_status.edit');
});

// permission

// roles
Route::get('/permission-roles-list', function () {
    return view('admin.permission..roles.roles');
});
Route::get('/permission-roles-add', function () {
    return view('admin.permission.roles.add_role');
});
Route::get('/permission-roles-edit', function () {
    return view('admin.permission.roles.edit_role');
});

// actions
Route::get('/permission-actions-list', function () {
    return view('admin.permission.action.actions');
});
Route::get('/permission-actions-edit', function () {
    return view('admin.permission.action.edit_action');
});

// role_action
Route::get('/permission-role_action-list', function () {
    return view('admin.permission.role_action.role_action');
});
Route::get('/permission-role_action-add', function () {
    return view('admin.permission.role_action.add_role_action');
});
