<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\InvoicesController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');

Route::post('/create-language', [App\Http\Controllers\LanguageController::class, 'createLanguage'])->name('create-language');
Route::get('/edit-language/{id}', [App\Http\Controllers\LanguageController::class, 'editLanguage'])->name('edit-language');
Route::post('/update-language', [App\Http\Controllers\LanguageController::class, 'updateLanguage'])->name('update-language');
Route::post('/delete_language', [App\Http\Controllers\LanguageController::class, 'deleteLanguage'])->name('delete-language');
Route::post('/change-password', [App\Http\Controllers\AccountController::class, 'changePassword'])->name('change-password');
Route::post('/update_tools', [App\Http\Controllers\AccountController::class, 'updateTools'])->name('update-tools');


Route::get('/show_pdf', [App\Http\Controllers\InvoicesController::class, 'showPDF'])->name('show-pdf');
// Route::get('/make_pdf', [App\Http\Controllers\InvoicesController::class, 'makePDF'])->name('make-pdf');

Route::get('pdfview',array('as'=>'pdfview','uses'=>'App\Http\Controllers\InvoicesController@makePDF'));

Route::get('/file-upload', [App\Http\Controllers\FileController::class, 'index'])->name('file-upload');

Route::get('/stages', [App\Http\Controllers\FileController::class, 'stages'])->name('stages');

Route::post('/edit-milage', [App\Http\Controllers\FileController::class, 'EditMilage'])->name('edit-milage');
Route::post('/add-customer-note', [App\Http\Controllers\FileController::class, 'addCustomerNote'])->name('add-customer-note');

Route::post('/post-file', [App\Http\Controllers\FileController::class, 'postFile'])->name('post-file');
Route::post('/request-file', [App\Http\Controllers\FileController::class, 'requestFile'])->name('request-file');
Route::post('/file-engineers-notes', [App\Http\Controllers\FileController::class, 'fileEngineersNotes'])->name('file-engineers-notes');
Route::post('/file-events-notes', [App\Http\Controllers\FileController::class, 'fileEventsNotes'])->name('file-events-notes');
Route::post('/file-url', [App\Http\Controllers\FileController::class, 'fileURL'])->name('file-url');
Route::post('/file_feedback', [App\Http\Controllers\FileController::class, 'fileFeedback'])->name('file-feedback');
Route::post('/get_models', [App\Http\Controllers\FileController::class, 'getModels'])->name('get-models');
Route::post('/get_versions', [App\Http\Controllers\FileController::class, 'getVersions'])->name('get-versions');
Route::post('/get_engines', [App\Http\Controllers\FileController::class, 'getEngines'])->name('get-engines');
Route::post('/get_ecus', [App\Http\Controllers\FileController::class, 'getECUs'])->name('get-ecus');
Route::post('/make_payment', [App\Http\Controllers\PaymentController::class, 'makePayment'])->name('make-payment');
Route::post('/add_to_cart', [App\Http\Controllers\PaymentController::class, 'addToCart'])->name('add-to-cart');
Route::post('/post_stages', [App\Http\Controllers\FileController::class, 'postStages'])->name('post-stages');
Route::post('/add_credits_to_file', [App\Http\Controllers\FileController::class, 'addCredits'])->name('add-credits-to-file');

// Route::get('/cart', [App\Http\Controllers\PaymentController::class, 'getCart'])->name('get-cart');
Route::get('/clear_cart', [App\Http\Controllers\PaymentController::class, 'clearCart'])->name('clear-cart');

Route::get('/price-list', [App\Http\Controllers\AccountController::class, 'priceList'])->name('price-list');

Route::post('/cart_quantity', [App\Http\Controllers\PaymentController::class, 'getCartQuantity'])->name('get-cart');
Route::get('/shop-product', [App\Http\Controllers\ShoppingController::class, 'shopProduct'])->name('shop-product');
Route::get('/bosch-ecu', [App\Http\Controllers\AccountController::class, 'boschECU'])->name('bosch-ecu');

Route::get('/invoices', [App\Http\Controllers\InvoicesController::class, 'index'])->name('invoices');

Route::post('/upload-file', [App\Http\Controllers\FileController::class, 'uploadFile'])->name('upload-file');
Route::get('/file-history', [App\Http\Controllers\FileController::class, 'fileHistory'])->name('file-history');
Route::get('/file/{id}', [App\Http\Controllers\FileController::class, 'showFile'])->name('file');

Route::get('/download/{file}', [App\Http\Controllers\FileController::class,'download'])->name('download');
Route::get('phpinfo', function(){ phpinfo(); });

