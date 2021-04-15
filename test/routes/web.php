<?php

// BE CONTROLLER
use App\Http\Controllers\Admin_OrderController;
use App\Http\Controllers\Admin_ProductController;

// FE CONTROLLER
use App\Http\Controllers\User_HomeController;    //use
use App\Http\Controllers\User_AccountController;    //use
use App\Http\Controllers\User_ProductsController;
use App\Http\Controllers\User_CartController;
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


// AUTHENTICATE
Route::get('/', function () {
    return redirect('/home');
});

Auth::routes(['verify' => true]); //Auth để kiểm tra có verify email của user if not -> trang login, else -> trang home

Route::resource('/home/user/account', User_AccountController::class); //trả về User Acccount trên trang Home


//FRONT END
// Select CITY - DISTRICT - WARD -> FEE
Route::post('select-delivery',[User_CartController::class, 'select_delivery']);

Route::post('calculate-fee',[User_CartController::class, 'calculate_fee']);

//Add Product to cart
Route::post('check/coupon', [User_CartController::class, 'check_coupon']);

Route::post('/add-to-cart',[User_CartController::class, 'add_to_cart']);

Route::get('/cart',[User_CartController::class, 'view_cart']);

Route::post('/update-cart-quantity',[User_CartController::class, 'update_cart_quantity']);

Route::post('/delete-cart-product', [User_CartController::class, 'delete_cart_product']);

Route::prefix('home')->name('home.')->group(function () {
     //trả về trang home có list item đầy đủ
    Route::get('/', [User_HomeController::class, 'index'])
        ->name('index');

    //Show chi tiết sản phẩm bên trang products của home
    Route::get('products/{id?}', [User_ProductsController::class, 'index'])
        ->name('products.index'); //Show chi tiết sản phẩm bên trang products của home

    Route::post('products/search_price', [User_ProductsController::class, 'search_price'])
    ->name('products.search_price');

    Route::get('single-product/{id}', [User_ProductsController::class, 'single_product'])
    ->name('single_product');
        ->name('products.index');

});

//BACK END

//Có VErify
// Route::prefix('admin')->name('admin.')->middleware(['auth' , 'verified', 'checkRoles:staff'])->group(function () {
//     Route::resource('product', Admin_ProductController::class); //Thêm sửa xóa trang products bên Admin

//     Route::resource('order', Admin_OrderController::class); //Thêm sửa xóa trang orders bên Admin
// });



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



// Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
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



