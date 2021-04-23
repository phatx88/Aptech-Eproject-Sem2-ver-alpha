<?php

// BE CONTROLLER
use App\Http\Controllers\Admin_DashboardController;
use App\Http\Controllers\Admin_CategoryController;
use App\Http\Controllers\Admin_OrderController;
use App\Http\Controllers\Admin_OrderItemController;
use App\Http\Controllers\Admin_ProductController;
use App\Http\Controllers\Admin_BrandController;
use App\Http\Controllers\Admin_CouponController;
// FE CONTROLLER
use App\Http\Controllers\User_HomeController;
use App\Http\Controllers\User_AccountController;
use App\Http\Controllers\User_ProductsController;
use App\Http\Controllers\User_CartController;
use App\Http\Controllers\User_CheckOutController;
// OTHERS
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Luật Chung:
|
| 1) URL tên FE bắt đầu là home rồi level xuống, thí dụ home/products hoặc home/products/detail
|
| 2) Route phải có tên và nên được đặt tên dựa theo thanh truyền URL.
|    (ví dụ tren url home/user thì nên để tên là home.user.'tên hàm' của lớp đó)
|
| 3) Bên Admin phải có prefix là 'admin', còn bên Customer(User) thì phải có prefix là 'home'
|
| 4) Tên của Controller phải có User_ hoặc Admin_ để phân biệt bên BE và FE
|
|
*/


// Trả về Trang ban đầu
Route::get('/', function () {
    return redirect('/home');
});

Route::get('/admin', function () {
    return redirect('/admin/dashboard');
});

Auth::routes(['verify' => true]); //Auth để kiểm tra có verify email của user if not -> trang login, else -> trang home

Route::get('/home/user/account', [User_AccountController::class , 'index'])->name('account.index'); //trả về User Acccount trên trang Home
Route::post('/home/user/account/upload', [User_AccountController::class , 'upload'])->name('account.upload'); //trả về User Acccount trên trang Home
Route::post('/home/user/account/update', [User_AccountController::class , 'update'])->name('account.update'); //trả về User Acccount trên trang Home
//Another Address
Route::get('/another-address', [User_CheckOutController::class, 'another_address']);

//Check-Out-Button
Route::post('/check-out-shopping', [User_CheckOutController::class, 'check_out_shopping']);
//FRONT END
// Select CITY - DISTRICT - WARD -> FEE
Route::post('select-delivery',[User_CartController::class, 'select_delivery']);

Route::post('calculate-fee',[User_CartController::class, 'calculate_fee']);

//Add Product to cart
Route::post('roll-button', [User_CartController::class, 'roll_button']);

Route::post('check/coupon', [User_CartController::class, 'check_coupon']);

Route::post('/add-to-cart',[User_CartController::class, 'add_to_cart']);

Route::get('/cart',[User_CartController::class, 'view_cart']);

Route::post('/update-cart-quantity',[User_CartController::class, 'update_cart_quantity']);

Route::post('/delete-cart-product', [User_CartController::class, 'delete_cart_product']);

//route for autocompleted search bar
Route::get('find', [User_ProductsController::class, 'find'])->name('find');

Route::prefix('home')->name('home.')->group(function () {
     //trả về trang home có list item đầy đủ
    Route::get('/', [User_HomeController::class, 'index'])
        ->name('index');

    //Show chi tiết sản phẩm bên trang products của home
    Route::get('products/{id?}', [User_ProductsController::class, 'index'])
    ->name('products.index'); //Show chi tiết sản phẩm bên trang products của home


    Route::get('single-product/{id}', [User_ProductsController::class, 'single_product'])
    ->name('single_product');

    Route::post('single-product/{id}/post', [User_ProductsController::class, 'postComment'])
    ->name('post');
});


// CHECK OUT
Route::get('/checkout', [User_CheckOutController::class , 'index'])->name('checkout.index'); //Về Trang Check Out


//BACK END

// Có VErify
// Route::prefix('admin')->name('admin.')->middleware(['auth' , 'verified', 'checkRoles:staff'])->group(function () {
//     Route::resource('product', Admin_ProductController::class); //Thêm sửa xóa trang products bên Admin
//     Route::resource('order', Admin_OrderController::class); //Thêm sửa xóa trang orders bên Admin
//     Route::resource('category', Admin_CategoryController::class);
//     Route::resource('brand', Admin_BrandController::class);
//     Route::resource('coupon', Admin_CouponController::class);
// });


// KO Verify
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('dashboard' , Admin_DashboardController::class);
    Route::resource('product', Admin_ProductController::class);
    Route::resource('order', Admin_OrderController::class);
    Route::resource('order.item', Admin_OrderItemController::class);
    Route::resource('category', Admin_CategoryController::class);
    Route::resource('brand', Admin_BrandController::class);
    Route::resource('coupon', Admin_CouponController::class);
    Route::post('order/calculate-fee',[Admin_OrderController::class, 'shipping_fee']);
    Route::post('fetch/product', Admin_ProductController::class.'@fetchProduct');
});


// ROUTE TEST
Route::get('/test', function () {
    return view('auth.verify');
});




//URL TRẢ VỀ VIEW -> Cho development thôi

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



Route::get('/check-out', function () {
    return view('pages.checkout');
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

//comment
Route::get('/comment-list', function () {
    return view('admin.comment.list');
});

//admin
Route::get('/image-list', function () {
    return view('admin.image.list');
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



