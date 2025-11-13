<?php
// Admin routes link //
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\AdminInventoryController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductDiscountController;
// seller routes link//
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Seller\SellerMainController;
use App\Http\Controllers\Seller\SellerStoreController;
use App\Http\Controllers\Seller\InventoryController;
use App\Http\Controllers\Seller\SellerContactController;
use App\Http\Controllers\Seller\SellerHistoryController;
use App\Http\Controllers\Seller\SellerPaymentController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerDiscountController;



use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\Customer\CustomerMainController;



// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/category', function () {
//     return view('front_end.home.category.category');
// });



// Website home
// Route::get('/', [WebsiteController::class, 'home'])->name('website.home');
Route::controller(WebsiteController::class)->group(function() {
    Route::get('/', 'home')->name('website.home');               
    Route::get('/checkout', 'checkout')->name('website.checkout');            
    Route::get('/view_cart', 'view_cart')->name('website.view_cart');            
    Route::get('/login', 'loginForm')->name('website.login');               
    Route::get('/register', 'registerForm')->name('website.register');
});
// Website login / register
// Route::get('/login', [WebsiteController::class, 'loginForm'])->name('website.login');
// Route::get('/register', [WebsiteController::class, 'registerForm'])->name('website.register');




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
        
// routes/web.php

//... (অন্যান্য uses একই থাকবে) ...

Route::controller(PaymentController::class)->group(function(){
    Route::get('/payment','index')->name('purchase_payment');
    Route::post('/purchase/submit_payment','submit_payment')->name('purchase.submit_payment'); 
    Route::get('/admin_invoice','admin_invoice')->name('admin_invoice');
});

Route::controller(AdminInventoryController::class)->group(function(){ 
    Route::get('/inventory/add_suplier','index')->name('inventory.add_suplier');
    Route::post('/inventory/add_suplier','store_supplier')->name('inventory.store_supplier');
    Route::get('/inventory/purchase_from_suplier','purchase_from_suplier')->name('inventory.purchase_from_suplier');
    Route::post('/inventory/store_purchase','store_purchase')->name('inventory.store_purchase');
    Route::get('/inventory/purchase_record','purchase_record')->name('inventory.purchase_record');
    Route::get('/inventory/delete_purchase/{id}','delete_purchase')->name('inventory.delete_purchase');
    Route::get('/inventory/inventory_list','inventory_list')->name('inventory.inventory_list');
    Route::get('/inventory/suplier_return','suplier_return')->name('inventory.suplier_return');
    Route::post('/inventory/store_supplier_return','store_supplier_return')->name('inventory.store_supplier_return');
    Route::get('/inventory/suplier_return_record','suplier_return_record')->name('inventory.suplier_return_record');
    Route::get('/inventory/delete_supplier_return/{id}','delete_supplier_return')->name('inventory.delete_supplier_return');
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


    // --- 3. PRODUCT MANAGEMENT & PURCHASE APPROVAL ROUTES (ProductController) ---
    Route::controller(ProductController::class)->group(function(){
        
        // Product Management Views
        Route::get('product/manage-reviews', 'index')->name('product.manage_product_reviews');
        Route::get('product/add-product', 'add_product')->name('product.add_product');
        Route::get('product/manage-product', 'manage_product')->name('product.manage_product');
        Route::get('product/return-product', 'return_product')->name('product.return_product');
        
        // Core Purchase Approval Logic
        // [VIEW] Requests waiting for Admin approval
        Route::get('product/purchase-requests', 'purchase_request')->name('product.purchase_request');

        // [ACTION] Accept request (Stock Allocation)
        Route::post('product/purchase-requests/{purchase}/accept', 'acceptPurchase')
             ->name('admin.product.purchase_request.accept');
             
        // [ACTION] Reject request (Cancel)
        Route::post('product/purchase-requests/{purchase}/reject', 'rejectPurchase')
             ->name('admin.product.purchase_request.reject');
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


    // --- 2. INVENTORY ROUTES (InventoryController) ---
    Route::controller(InventoryController::class)->group(function(){
        Route::get('inventory/purchase', 'index')->name('inventory.vendor_purchase');
        Route::post('inventory/purchase/store', 'store_purchase')->name('inventory.vendor_purchase_store');
        
        Route::get('inventory/purchase-return', 'purchase_return')->name('inventory.vendor_purchase_return');
        Route::get('inventory/manage-stock', 'manage_stock')->name('inventory.manage_stock');
        Route::get('inventory/admin-product-list', 'admin_product_list')->name('inventory.admin_product_list');
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
        
        // Payout Views
        Route::get('payment/payout-request','index')->name('payment.payout_request');
        Route::get('payment/payout-paid-list','payout_paid_list')->name('payment.payout_paid_list');
        Route::get('payment/payout-pending-list','payout_pending_list')->name('payment.payout_pending_list');
        Route::get('payment/refund','refund')->name('payment.refund');

        // Core Purchase Payment Logic
        // [VIEW] Pending purchases list for payment
        Route::get('purchase/payment', 'seller_purchase_payment')->name('purchase.payment');
        // [ACTION] Submit payment (updates status from Pending to Completed)
        Route::post('purchase/submit-payment', 'submitPurchasePayment')->name('purchase.submit.payment');
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
