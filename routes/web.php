<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\ImageSliderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/', [App\Http\Controllers\homeController::class, 'categories'])->name('home');

Route::get('/details/{product}', [App\Http\Controllers\homeController::class, 'details'])->name('details');

Route::get('/checkout/{product}/{user_id}', [App\Http\Controllers\homeController::class, 'checkout'])->name('checkout');

Route::get('/cart/{user_id}', [App\Http\Controllers\homeController::class, 'cart'])->name('cart');
Route::get('/cart/delete/{user_id}/{product_id}', [App\Http\Controllers\homeController::class, 'cartDelete'])->name('cartDelete');
Route::get('/cart/update/{user_id}/{product_id}', [App\Http\Controllers\homeController::class, 'cartUpdate'])->name('cartUpdate');

Route::get('/invoice', [App\Http\Controllers\homeController::class, 'invoice'])->name('invoice');
Route::get('/invoiceDownload/{transaction_id}/{product_id}/{quantity}', [App\Http\Controllers\homeController::class, 'invoiceDownload'])->name('invoiceDownload');

Route::get('/productList/{category_id}', [App\Http\Controllers\homeController::class, 'productList'])->name('productList');

Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//dashboard
Route::group(['middleware' => ['auth']], function() {

    
Route::get('/dashboard', function () {
    return view('backend.dashboard');
});

//categories
Route::resource('categories','App\Http\Controllers\CategoryController');
Route::get('/trashed', [App\Http\Controllers\CategoryController::class, 'trashed'])->name('categories.trashed');
Route::get('/trashed/restore/{category}', [App\Http\Controllers\CategoryController::class, 'restore'])->name('categories.trashed.restore');
Route::delete('/trashed/delete/{category}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('categories.trashed.delete');


//products
Route::resource('products','App\Http\Controllers\ProductController');
Route::get('/product/trashed', [App\Http\Controllers\ProductController::class, 'trashed'])->name('products.trashed');
Route::get('/product/trashed/restore/{product}', [App\Http\Controllers\ProductController::class, 'restore'])->name('products.trashed.restore');
Route::delete('/product/trashed/delete/{product}', [App\Http\Controllers\ProductController::class, 'delete'])->name('products.trashed.delete');

//brands
Route::resource('brands','App\Http\Controllers\BrandController');
Route::get('/brand/trashed', [App\Http\Controllers\BrandController::class, 'trashed'])->name('brands.trashed');
Route::get('/brand/trashed/restore/{product}', [App\Http\Controllers\BrandController::class, 'restore'])->name('brands.trashed.restore');
Route::delete('/brand/trashed/delete/{product}', [App\Http\Controllers\BrandController::class, 'delete'])->name('brands.trashed.delete');



});


//role & permission
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::get('/role/trashed', [RoleController::class, 'trashed'])->name('roles.trashed');
    Route::get('/role/trashed/restore/{role}', [RoleController::class, 'restore'])->name('roles.trashed.restore');
    Route::delete('/role/trashed/delete/{role}', [RoleController::class, 'delete'])->name('roles.trashed.delete');

    Route::resource('users', UserController::class);
    Route::get('/user/trashed', [UserController::class, 'trashed'])->name('users.trashed');
    Route::get('/user/trashed/restore/{role}', [UserController::class, 'restore'])->name('users.trashed.restore');
    Route::delete('/user/trashed/delete/{role}', [UserController::class, 'delete'])->name('users.trashed.delete');

    Route::get('/profile/edit/{user_id}', [ProfileController::class, 'profileEdit'])->name('profiles.edit');

    Route::post('profile/passwordChange/{user_id}',[ProfileController::class,'passwordChange'])->name('profiles.password.change');

    Route::post('/update-profile/{user_id}', [ProfileController::class,'updateProfile'])->name('updateProfile');


});


// Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->middleware('auth')
//     ->name('logout');



// Image slider 
Route::get('/imageslider', [ImageSliderController::class, 'index'])->name('imageslider.list');
Route::get('/imageslider/creates',[ImageSliderController::class, 'create'])->name('imageslider.create');
Route::post('/imageslider/create',[ImageSliderController::class, 'store'])->name('imageslider.store');
Route::get('/admin/image_sliders/{image_slider}',[ImageSliderController::class, 'show'])->name('imagesliders.show');
Route::get('/admin/imagesliders/edit/{image_slider}',[ImageSliderController::class, 'edit'])->name('imagesliders.edit');
Route::delete('/admin/imagesliders/{image_slider}', [ImageSliderController::class, 'destroy'])->name('imagesliders.destroy');
Route::get('/admin/trash-image_slider',[ImageSliderController::class, 'trash'])->name('imagesliders.trashed');
Route::patch('/admin/imagesliders/{image_slider}/update',[ImageSliderController::class, 'update'])->name('imagesliders.update');
Route::get('/admin/trash-products/{image_slider}',[ImageSliderController::class, 'restore'])->name('image_slider.restore');
Route::delete('/admin/trash-products/{image_slider}/delete',[ImageSliderController::class, 'delete'])->name('image_slider.delete');
Route::get('/frontend/carosel',[homeController::class, 'index'])->name('carosel.list');