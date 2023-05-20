<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;

//frontend
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/product/details/{product_id}', [FrontendController::class, 'details'])->name('details');
Route::post('/getSize', [FrontendController::class, 'getSize']);
Route::post('/getQuantity', [FrontendController::class, 'getQuantity']);
Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');

//others
Auth::routes();
Route::get('/adad', [HomeController::class, 'custom_logout'])->name('admin.logout');
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Users
Route::get('/users', [UserController::class, 'users'])->name('users');
Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete');
Route::get('/user/edit', [UserController::class, 'user_edit'])->name('user.edit');
Route::post('/user/profile/update', [UserController::class, 'user_profile_update'])->name('update.profile.info');
Route::post('/user/password/update', [UserController::class, 'user_password_update'])->name('update.password');
Route::post('/user/photo/update', [UserController::class, 'user_photo_update'])->name('update.photo');
Route::get('/user/excel/download', [UserController::class, 'export'])->name('user.excel.download');
Route::get('/changeStatus', [UserController::class, 'changeStatus']);

//Category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/delete/{category_id}', [CategoryController::class, 'category_delete'])->name('category.delete');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update');
Route::get('/category/restore/{category_id}', [CategoryController::class, 'category_restore'])->name('category.restore');
Route::get('/category/permanent/delete/{category_id}', [CategoryController::class, 'category_del'])->name('category.del');
Route::post('/category/checked/delete', [CategoryController::class, 'category_checked_delete'])->name('check.delete');

//Sub Category
Route::get('/subcategory', [SubCategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/subcategory/store', [SubCategoryController::class, 'subcategory_store'])->name('subcategory.store');
Route::get('/subcategory/edit/{subcategory_id}', [SubCategoryController::class, 'subcategory_edit'])->name('subcategory.edit');
Route::post('/subcategory/update', [SubCategoryController::class, 'subcategory_update'])->name('subcategory.update');

//Brand
Route::get('/brand', [BrandController::class, 'brand'])->name('brand');
Route::post('/brand/store', [BrandController::class, 'brand_store'])->name('brand.store');
Route::post('/brand/store', [BrandController::class, 'brand_store'])->name('brand.store');

//Product
Route::get('/add/product', [ProductController::class, 'add_product'])->name('add.product');
Route::post('/getSubcategory', [ProductController::class, 'getSubcategory']);
Route::post('/product/store', [ProductController::class, 'product_store'])->name('product.store');
Route::get('/product/list', [ProductController::class, 'product_list'])->name('product.list');
Route::get('/product/edit', [ProductController::class, 'product_edit'])->name('product.edit');
Route::post('/product/update', [ProductController::class, 'product_update'])->name('product.update');


//Variation
Route::get('/variation', [InventoryController::class, 'variation'])->name('variation');
Route::post('/variation/store', [InventoryController::class, 'variation_store'])->name('variation.store');

//Inventory
Route::get('/product/inventory/{product_id}', [InventoryController::class, 'product_inventory'])->name('product.inventory');
Route::post('/inventory/store', [InventoryController::class, 'inventory_store'])->name('inventory.store');

//Cart
Route::post('/cart/store', [CartController::class, 'cart_store'])->name('cart.store');
Route::get('/remove/cart/{cart_id}', [CartController::class, 'remove_cart'])->name('remove.cart');
Route::post('/cart/update', [CartController::class, 'cart_update'])->name('cart.update');

//Coupon
Route::get('/coupon', [CouponController::class, 'coupon'])->name('coupon');
Route::post('/coupon/store', [CouponController::class, 'coupon_store'])->name('coupon.store');


//Customer
Route::get('/customer/register/login', [CustomerController::class, 'customer_reg_log'])->name('customer.register.login');
Route::post('/customer/register/store', [CustomerController::class, 'customer_register_store'])->name('customer.register.store');
Route::post('/customer/login', [CustomerController::class, 'customer_login'])->name('customer.login');
Route::get('/customer/logout', [CustomerController::class, 'customer_logout'])->name('customer.logout');
Route::get('/customer/profile', [CustomerController::class, 'customer_profile'])->name('customer.profile');
Route::post('/customer/profile/update', [CustomerController::class, 'customer_profile_update'])->name('customer.update');

//checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/getCity', [CheckoutController::class, 'getCity']);
Route::post('/order/store', [CheckoutController::class, 'order_store'])->name('order.store');
Route::get('/order/success/{order_id}', [CheckoutController::class, 'order_success'])->name('order.success');

//Api Request
Route::get('/request/api', [FrontendController::class, 'api_request'])->name('api.request');
Route::post('/api/token/create', [FrontendController::class, 'api_token_create'])->name('api.token.create');
Route::get('/show/data/req', [FrontendController::class, 'show_data_req'])->name('show.data.req');

//location
Route::get('ip_details', [UserController::class, 'ip_details'])->name('ip_details');
