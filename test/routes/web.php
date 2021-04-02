<?php

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
    return view('pages.home');
});

Route::get('/home', function () {
    return view('pages.home');
});
Route::get('/product', function () {
    return view('pages.product');
});

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