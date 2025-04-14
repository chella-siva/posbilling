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

Route::post('/catalogue/store', [Cataloguecontroller::class, 'store'])->name('catalogue.store');
Route::get('/search-customers', [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'searchContacts']);
Route::get('/clear-storage-redirect', function () {
    return view('clear-storage-redirect');
})->name('clear.localstorage.and.redirect');


Route::get('/catalogue/{business_id}/{location_id}', 
    [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'index']
)->name('catalogue.qr');
Route::get('/checkout', [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'checkout']);
Route::post('/checkout', [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'store']);
Route::get('/show-catalogue/{business_id}/{product_id}', [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'show']);

Route::middleware('web', 'authh', 'auth', 'SetSessionData', 'language', 'timezone', 'AdminSidebarMenu')->prefix('product-catalogue')->group(function () {
    Route::get('catalogue-qr', [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'generateQr']);
    Route::post('product-catalogue-setting', [\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'productCatalogueSetting']);

    Route::get('install', [\Modules\ProductCatalogue\Http\Controllers\InstallController::class, 'index']);
    Route::post('install', [\Modules\ProductCatalogue\Http\Controllers\InstallController::class, 'install']);
    Route::get('install/uninstall', [\Modules\ProductCatalogue\Http\Controllers\InstallController::class, 'uninstall']);
    Route::get('install/update', [\Modules\ProductCatalogue\Http\Controllers\InstallController::class, 'update']);
});
