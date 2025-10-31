<?php
// Admin routes link //
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\AdminInventoryController;
// seller routes link//
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Seller\SellerMainController;
use App\Http\Controllers\Seller\SellerStoreController;
use App\Http\Controllers\Seller\InventoryController;
use App\Http\Controllers\Seller\SellerContactController;
use App\Http\Controllers\Seller\SellerHistoryController;
use App\Http\Controllers\Seller\SellerPaymentController;
use App\Http\Controllers\Seller\SellerProductController;


use App\Http\Controllers\Admin\ProductDiscountController;

use App\Http\Controllers\Customer\CustomerMainController;
use App\Http\Controllers\Seller\SellerDiscountController;
use App\Http\Controllers\Admin\ProductAttributeController;

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
        Route::get('/order/sales','sales')->name('admin.order.sales');
        Route::get('/order/total_income','total_income')->name('admin.order.total_income');
        });
        
       

      Route::controller(AdminInventoryController::class)->group(function(){ 
      Route::get('/inventory/add_suplier','index')->name('inventory.add_suplier');
      Route::post('/inventory/add_suplier','store_supplier')->name('inventory.store_supplier');

     // Purchase CRUD Routes
     Route::get('/inventory/purchase',[AdminInventoryController::class,'purchase'])->name('inventory.purchase');
     Route::post('/inventory/store_purchase',[AdminInventoryController::class,'store_purchase'])->name('inventory.store_purchase');
     Route::get('/inventory/purchase_records',[AdminInventoryController::class,'purchase_records'])->name('inventory.purchase_records');
     Route::get('/inventory/edit_purchase/{id}',[AdminInventoryController::class,'edit_purchase'])->name('inventory.edit_purchase');
     Route::post('/inventory/update_purchase/{id}',[AdminInventoryController::class,'update_purchase'])->name('inventory.update_purchase');
     Route::get('/inventory/delete_purchase/{id}',[AdminInventoryController::class,'delete_purchase'])->name('inventory.delete_purchase');

     

    Route::get('/inventory/add_stock', [AdminInventoryController::class,'add_stock'])->name('inventory.add_stock');
    Route::post('/inventory/store_stock', [AdminInventoryController::class,'store_stock'])->name('inventory.store_stock');
    Route::get('/inventory/stock_records', [AdminInventoryController::class,'stock_records'])->name('inventory.stock_records');
    Route::get('/inventory/delete_stock/{id}', [AdminInventoryController::class,'delete_stock'])->name('inventory.delete_stock');

      Route::get('/inventory/purchase_return',[AdminInventoryController::class,'purchase_return'])->name('inventory.purchase_return');
      Route::post('/inventory/store_purchase_return',[AdminInventoryController::class,'store_purchase_return'])->name('inventory.store_purchase_return');
      Route::get('/inventory/return_record',[AdminInventoryController::class,'return_record'])->name('inventory.return_record');
      Route::get('/inventory/delete_return/{id}',[AdminInventoryController::class,'delete_return'])->name('inventory.delete_return');
      Route::get('/inventory/edit_return/{id}',[AdminInventoryController::class,'edit_return'])->name('inventory.edit_return');
      Route::post('/inventory/update_return/{id}',[AdminInventoryController::class,'update_return'])->name('inventory.update_return');


       // Product routes (create, store, records, view, edit, update, delete)
       Route::get('/inventory/product','product')->name('inventory.product');
       Route::post('/inventory/product','store_product')->name('inventory.store_product');
       Route::get('/inventory/product_records','product_records')->name('inventory.product_records');
       Route::get('/inventory/product/view/{id}','view_product')->name('inventory.product.view');
       Route::get('/inventory/product/edit/{id}','edit_product')->name('inventory.product.edit');
       Route::post('/inventory/product/update/{id}','update_product')->name('inventory.product.update');
       Route::get('/inventory/product/delete/{id}','delete_product')->name('inventory.product.delete');
      });



        Route::controller(CategoryController::class)->group(function(){
        Route::get('/category/create_category','index')->name('category.create_category');
        Route::post('/category/store','store')->name('category.store');

        Route::get('/category/manage_category','manage_category')->name('category.manage_category');
        Route::get('/category/edit/{id}','edit')->name('category.edit');
        Route::post('/category/update/{id}','update')->name('category.update');
        Route::get('/category/delete/{id}','delete')->name('category.delete');
        });





        Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/sub_category/create_sub_category','index')->name('sub_category.create_sub_category');
        Route::post('/sub_category/store','store')->name('sub_category.store');
        Route::get('/sub_category/manage_sub_category','manage_sub_category')->name('sub_category.manage_sub_category');
        Route::get('/sub_category/toggle_status/{id}','toggleStatus')->name('sub_category.toggle_status');
        Route::get('/sub_category/delete/{id}','delete')->name('sub_category.delete');
        Route::get('/sub_category/view/{id}','view')->name('sub_category.view');
        });




        Route::controller(ProductController::class)->group(function(){
        Route::get('/product/manage_product_reviews','index')->name('product.manage_product_reviews');
        Route::get('/product/add_product','add_product')->name('product.add_product');
        Route::get('/product/manage_product','manage_product')->name('product.manage_product');
        Route::get('/product/return_product','return_product')->name('product.return_product');
        Route::get('/product/purchase_request','purchase_request')->name('product.purchase_request');
        });

        

        Route::controller(ProductAttributeController::class)->group(function(){
        Route::get('/product_attribute/create_attribute','index')->name('product_attribute.create_attribute');
        Route::post('/product_attribute/store','store')->name('product_attribute.store');
        Route::get('/product_attribute/manage_attribute','manage_attribute')->name('product_attribute.manage_attribute');
        Route::get('/product_attribute/view/{id}','view')->name('product_attribute.view');
        Route::get('/product_attribute/edit/{id}','edit')->name('product_attribute.edit');
        Route::post('/product_attribute/update/{id}','update')->name('product_attribute.update');
        Route::get('/product_attribute/delete/{id}','delete')->name('product_attribute.delete');
        Route::get('/product_attribute/toggle_status/{id}','toggleStatus')->name('product_attribute.toggle_status');
        });


        

Route::controller(ProductDiscountController::class)->group(function(){
    Route::get('/discount/create_discount','index')->name('discount.create_discount');
    Route::post('/discount/store_discount','store_discount')->name('discount.store_discount');

    Route::get('/discount/manage_discount','manage_discount')->name('discount.manage_discount');
    Route::get('/discount/edit_discount/{id}','edit_discount')->name('discount.edit_discount');
    Route::post('/discount/update_discount/{id}','update_discount')->name('discount.update_discount');
    Route::get('/discount/delete_discount/{id}','delete_discount')->name('discount.delete_discount');
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

        Route::controller(InventoryController::class)->group(function(){
        Route::get('/inventory/purchase','index')->name('inventory.vendor_purchase');
        
        Route::get('/inventory/purchase_return','purchase_return')->name('inventory.vendor_purchase_return');
        Route::get('/inventory/manage_stock','manage_stock')->name('inventory.manage_stock');
        Route::get('/inventory/admin_product_list','admin_product_list')->name('inventory.admin_product_list');
        });

        Route::controller(SellerProductController::class)->group(function(){
        Route::get('/product/create','index')->name('product.create');
        Route::get('/product/manage','manage')->name('product.manage');
        Route::get('/product/return_product','return_product')->name('product.return_product_customer');
        });

        Route::controller(SellerStoreController::class)->group(function(){
        Route::get('/store/create','index')->name('store.create');
        Route::get('/store/manage','manage')->name('store.manage');
        });

        Route::controller(SellerDiscountController::class)->group(function(){
        Route::get('/discount/create_discount','index')->name('discount.create_discount_vendor');
        Route::get('/discount/manage_discount','manage_discount')->name('discount.manage_discount_vendor');
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
        Route::get('/profile','profile')->name('customer.profile');
        });
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
