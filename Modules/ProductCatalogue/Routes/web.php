<?php

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
use App\Http\Controllers\Cataloguecontroller;
use App\Http\Controllers\ContactController;


Route::get('/search-customers', [ContactController::class, 'searchContacts']);
Route::post('/catalogue/store', [Cataloguecontroller::class, 'store'])->name('catalogue.store');
Route::get('/catalogue/{business_id}/{location_id}', [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'index']);
Route::get('/checkout', [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'checkout']);
Route::post('/checkout', [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'store']);
Route::get('/show-catalogue/{business_id}/{product_id}', [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'show']);

Route::middleware('web', 'authh', 'auth', 'SetSessionData', 'language', 'timezone', 'AdminSidebarMenu')->prefix('product-catalogue')->group(function () {
    Route::get('catalogue-qr', [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'generateQr'])->name('catalogue.qr');
    Route::post('cart/add', [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'add'])->name('cart.add');

    Route::get('install', [\Modules\ProductCatalogue\Http\Controllers\InstallController::class, 'index']);
    Route::post('install', [\Modules\ProductCatalogue\Http\Controllers\InstallController::class, 'install']);
    Route::get('install/uninstall', [\Modules\ProductCatalogue\Http\Controllers\InstallController::class, 'uninstall']);
    Route::get('install/update', [\Modules\ProductCatalogue\Http\Controllers\InstallController::class, 'update']);
});
