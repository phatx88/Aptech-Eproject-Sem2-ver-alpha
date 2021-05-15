<?php

// BE CONTROLLER
use App\Http\Controllers\Admin_DashboardController;
use App\Http\Controllers\Admin_CategoryController;
use App\Http\Controllers\Admin_OrderController;
use App\Http\Controllers\Admin_OrderItemController;
use App\Http\Controllers\Admin_ProductController;
use App\Http\Controllers\Admin_BrandController;
use App\Http\Controllers\Admin_CouponController;
use App\Http\Controllers\Admin_StaffController;
use App\Http\Controllers\Admin_BlogController;
use App\Http\Controllers\Admin_CategoryBlogController;
use App\Http\Controllers\Admin_CommentController;
use App\Http\Controllers\Admin_UserController;
use App\Http\Controllers\Admin_ImageItemController;
use App\Http\Controllers\Admin_TransportController;
use App\Http\Controllers\Admin_WardController;
use App\Http\Controllers\Admin_RoleController;
use App\Http\Controllers\Admin_NewsletterController;
use App\Http\Controllers\Admin_DistrictController;
use App\Http\Controllers\Admin_ProvinceController;
// FE CONTROLLER
use App\Http\Controllers\User_HomeController;
use App\Http\Controllers\User_AccountController;
use App\Http\Controllers\User_ProductsController;
use App\Http\Controllers\User_CartController;
use App\Http\Controllers\User_CheckOutController;
use App\Http\Controllers\User_BlogController;
use App\Http\Controllers\User_CommentBlogController;
use App\Http\Controllers\User_WishListController;
use Illuminate\Routing\RouteUri;
// OTHERS
use App\Http\Controllers\PasswordSetupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\FetchChartDataController;
use App\Http\Controllers\ShippingController;

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
})->middleware(['countVisitor']);

Route::get('/admin', function () {
    return redirect('/admin/dashboard');
});

Auth::routes(['verify' => true]); //Auth để kiểm tra có verify email của user if not -> trang login, else -> trang home

//Github routes
Route::get('login/github', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallback']);


// Google login
Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

// Twitter login
Route::get('login/twitter', [App\Http\Controllers\Auth\LoginController::class, 'redirectToTwitter'])->name('login.twitter');
Route::get('login/twitter/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleTwitterCallback']);


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

//SETUP PASSWORD FOR STAFF
Route::get('/auth/passwordset/{token}', [PasswordSetupController::class,'passwordset']);

// FETCH DATA FOR CHART
Route::get('/fetch-order-data', [FetchChartDataController::class,'fetchOrderByProvince']);
Route::get('/fetch-daily-order-data', [FetchChartDataController::class,'fetchDailyOrder']);
Route::get('/fetch-product-sale-data', [FetchChartDataController::class,'fetchSalesPerProduct']);
Route::get('/fetch-users-value-data', [FetchChartDataController::class,'fetchValuePerUser']);

// FETCH DATA FOR DATATABLE
Route::post('/fetch-order', [FetchChartDataController::class,'fetchOrder']);
Route::post('/fetch-user', [FetchChartDataController::class,'fetchUser']);
Route::post('/fetch-ward', [FetchChartDataController::class,'fetchWard']);
Route::post('/fetch-district', [FetchChartDataController::class,'fetchDistrict']);
Route::post('/fetch-province', [FetchChartDataController::class,'fetchProvince']);


//BACK END

// Có VErify
// User Dashboard
Route::prefix('home')->middleware(['auth' , 'verified', 'checkRoles:user,staff'])->group(function() {
    Route::get('user/account', [User_AccountController::class , 'index'])->name('account.index');
    Route::post('user/account/upload', [User_AccountController::class , 'upload'])->name('account.upload');
    Route::post('user/account/update', [User_AccountController::class , 'update'])->name('account.update');
});


//Admin Dashboard
Route::prefix('admin')->name('admin.')->middleware(['auth' , 'checkRoles:staff'])->group(function () {
    // Dash Board
    Route::resource('dashboard' , Admin_DashboardController::class);

    // Product
    Route::get('product/export', [Admin_ProductController::class, 'export'])->name('product.export');
    Route::get('product/status/{id}', [Admin_ProductController::class, 'status'] );
    Route::get('product/restore/{id}', [Admin_ProductController::class, 'restore'] );
    Route::get('product/trash', [Admin_ProductController::class, 'showTrash'] );
    Route::resource('product', Admin_ProductController::class);
    Route::resource('category', Admin_CategoryController::class);
    Route::resource('brand', Admin_BrandController::class);
    Route::get('coupon/export', [Admin_CouponController::class, 'export'])->name('coupon.export');
    Route::resource('coupon', Admin_CouponController::class);

    // Image Item
    Route::get('ImageItem/{id}', [Admin_ImageItemController::class, 'index']);
    Route::post('ImageItem', [Admin_ImageItemController::class, 'store']);
    // Route::post('ImageItem/destroy', [Admin_ImageItemController::class, 'destroy']);

    // Order
    Route::get('order/export', [Admin_OrderController::class, 'export'])->name('order.export');
    Route::get('order/restore/{id}', [Admin_OrderController::class, 'restore'] );
    Route::get('order/trash', [Admin_OrderController::class, 'showTrash'] );
    Route::resource('order', Admin_OrderController::class);
    Route::resource('order.item', Admin_OrderItemController::class);

    // Staff
    Route::post('staff/calendar/action', [Admin_StaffController::class, 'action']); //FullCalender Action
    Route::resource('staff', Admin_StaffController::class);

    // User
    Route::resource('user', Admin_UserController::class);


    // Blog
    Route::get('comment/{id}', [Admin_CommentController::class, 'index']);
    Route::get('delete/{id}', [Admin_BlogController::class, 'destroy']);
    Route::get('blog/restore/{id}', [Admin_BlogController::class, 'restore'] );
    Route::get('blog/trash', [Admin_BlogController::class, 'showTrash'] );
    Route::get('published-blog/{id}', [Admin_BlogController::class, 'published_blog']);
    Route::get('unhidden/{id}', [Admin_BlogController::class, 'unhidden'] );
    Route::get('hidden/{id}', [Admin_BlogController::class, 'hidden'] );
    Route::get('ImageItem/{id}', [Admin_ImageItemController::class, 'index']);

    Route::post('ImageItem', [Admin_ImageItemController::class, 'store']);
    Route::get('ImageItem/edit/{id}/{ImageItems}', [Admin_ImageItemController::class, 'edit']);
    Route::post('ImageItem/update/{id}/{ImageItems}', [Admin_ImageItemController::class, 'update']);
    Route::resource('blog', Admin_BlogController::class);


    // Transport
    Route::get('transport/restore/{id}', [Admin_TransportController::class, 'restore'] );
    Route::get('transport/trash', [Admin_TransportController::class, 'showTrash'] );
    Route::resource('transport', Admin_TransportController::class);

    //ward
    Route::resource('ward', Admin_WardController::class );

    //District
    Route::resource('district', Admin_DistrictController::class );

    //Province
    Route::resource('province', Admin_ProvinceController::class );

    // Role
    Route::resource('role', Admin_RoleController::class);

    //Newsletter
    Route::resource('newsletter', Admin_NewsletterController::class);


    // Misc
    Route::post('order/calculate-fee',[Admin_OrderController::class, 'shipping_fee']);
    Route::post('fetch/product', Admin_ProductControlle ::class.'@fetchProduct');
});




// KO Verify - Development Only
// User Dashboard
// Route::prefix('home')->group(function() {
//     Route::get('user/account', [User_AccountController::class , 'index'])->name('account.index');
//     Route::post('user/account/upload', [User_AccountController::class , 'upload'])->name('account.upload');
//     Route::post('user/account/update', [User_AccountController::class , 'update'])->name('account.update');
// });

// Admin Dashboard
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('order/export', [Admin_OrderController::class, 'export'])->name('order.export'); //must be before route resource
//     Route::get('coupon/export', [Admin_CouponController::class, 'export'])->name('coupon.export');
//     Route::get('product/export', [Admin_ProductController::class, 'export'])->name('product.export');
//     //must be before route resource
//     Route::resource('dashboard' , Admin_DashboardController::class);
//     Route::get('product/status/{id}', [Admin_ProductController::class, 'status'] );
//     Route::resource('product', Admin_ProductController::class);
//     Route::resource('order', Admin_OrderController::class);
//     Route::resource('order.item', Admin_OrderItemController::class);
//     Route::resource('category', Admin_CategoryController::class);
//     Route::resource('brand', Admin_BrandController::class);
//     Route::resource('coupon', Admin_CouponController::class);
//     Route::post('staff/calendar/action', [Admin_StaffController::class, 'action']); //FullCalender Action
//     Route::resource('staff', Admin_StaffController::class);
//     Route::resource('user', Admin_UserController::class);
//     Route::post('order/calculate-fee',[Admin_OrderController::class, 'shipping_fee']);
//     Route::post('fetch/product', Admin_ProductController::class.'@fetchProduct');
//     Route::resource('blog', Admin_BlogController::class);
//     Route::get('comment/{id}', [Admin_CommentController::class, 'index']);
//     Route::get('delete/{id}', [Admin_BlogController::class, 'delete']);
//     Route::get('published-blog/{id}', [Admin_BlogController::class, 'published_blog']);
//     Route::get('unhidden/{id}', [Admin_BlogController::class, 'unhidden'] );
//     Route::get('hidden/{id}', [Admin_BlogController::class, 'hidden'] );

// });

Route::get('clear-cache', function () {
    Artisan::call('cache:clear');
    return back()->with('success', "Cache Cleared");
})->name('clear-cache');

//URL TRẢ VỀ VIEW -> Cho development thôi

Route::get('/about', function () {
    return view('pages.about');
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


//Category/Tag BLOG ADMIN
Route::post('/add-to-category-blog-by-input', [Admin_CategoryBlogController::class, 'add_category_blog_by_input']);

Route::post('/show-list-category-blog', [Admin_CategoryBlogController::class, 'show_list_category_blog']);


Route::post('/add-to-tag-blog-by-input', [Admin_CategoryBlogController::class, 'add_to_tag_blog_by_input']);

Route::post('/show-list-tag-blog', [Admin_CategoryBlogController::class, 'show_list_tag_blog']);

Route::post('/add-tag', [Admin_CategoryBlogController::class, 'add_tag']);

 Route::post('/show-tag-blog', [Admin_CategoryBlogController::class, 'show_tag_blog']);

 Route::post('/delete-tag-blog', [Admin_CategoryBlogController::class, 'delete_tag_blog']);

//---------------------BLOG--------------------------//
//BLOG USER

Route::get('/blog',[User_BlogController::class, 'index']);

Route::get('/blog/details/{slug}', [User_BlogController::class, 'blog_details']);

Route::post('/comment/blog', [User_CommentBlogController::class, 'comment_blog']);

Route::get('blog/category/{id}', [User_BlogController::class, 'blog_category']);


//WISH LIST
Route::post('/add-to-wishlist', [User_WishListController::class, 'add_to_wishlist']);

Route::post('/roll-button-wishlist', [User_WishListController::class, 'roll_button_wishlist']);

Route::post('/delete-button-wishlist', [User_WishListController::class, 'delete_button_wishlist']);

Route::get('email-success', function () {
    view('sendmail.email_order_success');
});

//Subscribe Email Address
Route::post('/subscribe-email', [User_HomeController::class, 'subscribe_email']);
