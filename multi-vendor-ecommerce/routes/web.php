<?php
// Admin routes link //
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PaymentController;
// seller routes link//
use App\Http\Controllers\Seller\SellerMainController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerStoreController;
use App\Http\Controllers\Seller\SellerPaymentController;
use App\Http\Controllers\Seller\SellerContactController;
use App\Http\Controllers\Seller\SellerHistoryController;


use App\Http\Controllers\Customer\CustomerMainController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('front_end.home.website');
});
Route::get('/category', function () {
    return view('front_end.home.category.category');
});



// admin routes //
Route::middleware(['auth', 'verified','rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function(){
        Route::controller(AdminMainController::class)->group(function(){
        Route::get('/dashboard','index')->name('admin');
        Route::get('/setting','setting')->name('admin.setting');
        Route::get('/manage/user','manage_user')->name('admin.manage.user');
        Route::get('/manage/store','manage_store')->name('admin.manage.store');
        Route::get('/cart/cart_history','cart_history')->name('admin.cart.cart_history');
        Route::get('/order/order_history','order_history')->name('admin.order.order_history');
        });
        Route::resource('categories', CategoryController::class);
        // Route::controller(CategoryController::class)->group(function(){
        // Route::get('/category/create_category','index')->name('category.create_category');
        // Route::get('/category/manage_category','manage_category')->name('category.manage_category');
        // });
        Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/sub_category/create_sub_category','index')->name('sub_category.create_sub_category');
        Route::get('/sub_category/manage_sub_category','manage_sub_category')->name('sub_category.manage_sub_category');
        });


        Route::controller(ProductController::class)->group(function(){
        Route::get('/product/manage_product_reviews','index')->name('product.manage_product_reviews');
        Route::get('/product/add_product','add_product')->name('product.add_product');
        Route::get('/product/manage_product','manage_product')->name('product.manage_product');
        Route::get('/product/return_product','return_product')->name('product.return_product');
        });

        Route::controller(ProductAttributeController::class)->group(function(){
        Route::get('/product_attribute/create_attribute','index')->name('product_attribute.create_attribute');
        Route::get('/product_attribute/manage_attribute','manage_attribute')->name('product_attribute.manage_attribute');
        });
        Route::controller(ProductDiscountController::class)->group(function(){
        Route::get('/discount/create_discount','index')->name('discount.create_discount');
        Route::get('/discount/manage_discount','manage_discount')->name('discount.manage_discount');
        });

        Route::controller(PaymentController::class)->group(function(){
        Route::get('/payment/vendor_payouts_request','index')->name('payment.vendor_payouts_request');
        Route::get('/payment/approve_payouts','approve_payouts')->name('payment.approve_payouts');
        Route::get('/payment/payment_method','payment_method')->name('payment.payment_method');
        Route::get('/payment/transecton','transecton')->name('payment.transecton');
        Route::get('/payment/report','report')->name('payment.report');
        });
    });
});

// Vendor routes //
Route::middleware(['auth', 'verified','rolemanager:vendor'])->group(function () {
    Route::prefix('vendor')->group(function(){
        Route::controller(SellerMainController::class)->group(function(){
        Route::get('/dashboard','index')->name('vendor');
        Route::get('/order_list','order_list')->name('order.order_list');
        });

        Route::controller(SellerProductController::class)->group(function(){
        Route::get('/product/create','index')->name('product.create');
        Route::get('/product/manage','manage')->name('product.manage');
        Route::get('/product/return_product','return_product')->name('product.return_product');
        });

        Route::controller(SellerStoreController::class)->group(function(){
        Route::get('/store/create','index')->name('store.create');
        Route::get('/store/manage','manage')->name('store.manage');
        Route::get('/store/stock','stock')->name('store.stock');
        });

        Route::controller(SellerPaymentController::class)->group(function(){
        Route::get('/payment/payout_request','index')->name('payment.payout_request');
        Route::get('/payment/payout_paid_list','payout_paid_list')->name('payment.payout_paid_list');
        Route::get('/payment/payout_pending_list','payout_pending_list')->name('payment.payout_pending_list');
        Route::get('/payment/refund','refund')->name('payment.refund');
        });

        Route::controller(SellerContactController::class)->group(function(){
        Route::get('/contact/chat_with_customer','index')->name('contact.chat_with_customer');
        Route::get('/contact/chat_with_admin','chat_with_admin')->name('contact.chat_with_admin');
        });

        Route::controller(SellerHistoryController::class)->group(function(){
        Route::get('/history/total_income','index')->name('history.total_income');
        Route::get('/history/sales_report','sales_report')->name('history.sales_report');
        Route::get('/history/transection','transection')->name('history.transection');
        Route::get('/history/account_setting','account_setting')->name('history.account_setting');
        });
    });
});
// Customer Routes //
Route::middleware(['auth', 'verified','rolemanager:customer'])->group(function () {
    Route::prefix('user')->group(function(){
        Route::controller(CustomerMainController::class)->group(function(){
        Route::get('/dashboard','index')->name('dashboard');
        Route::get('/order/history','history')->name('customer.history');
        Route::get('/setting/payment','payment')->name('customer.payment');
        Route::get('/affiliate','affiliate')->name('customer.affiliate');
        });
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
