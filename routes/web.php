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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');

Route::post('/create-language', [App\Http\Controllers\LanguageController::class, 'createLanguage'])->name('create-language');
Route::post('/change-password', [App\Http\Controllers\AccountController::class, 'changePassword'])->name('change-password');

Route::get('/file-upload', [App\Http\Controllers\FileController::class, 'index'])->name('file-upload');

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
Route::post('/get_ecus', [App\Http\Controllers\FileController::class, 'getECUs'])->name('get-ecus');


Route::post('/upload-file', [App\Http\Controllers\FileController::class, 'uploadFile'])->name('upload-file');
Route::get('/file-history', [App\Http\Controllers\FileController::class, 'fileHistory'])->name('file-history');
Route::get('/file/{id}', [App\Http\Controllers\FileController::class, 'showFile'])->name('file');

Route::get('phpinfo', function(){ phpinfo(); });

