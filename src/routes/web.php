<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
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

// お問い合わせフォーム入力ページ
Route::get('/',[ContactController::class, 'index'])->name('contact.index');
// お問い合わせフォーム確認ページ
Route::post('/confirm',[ContactController::class, 'confirm'])->name('contact.confirm');
// サンクスページ
Route::post('/thanks',[ContactController::class, 'thanks'])->name('contact.thanks');
Route::get('/thanks',[ContactController::class, 'thanks'])->name('contact.thanks');
// 管理画面
Route::middleware('auth')->group(function () {
    Route::get('/admin',[AdminController::class, 'index'])->name('admin.index');
});

//詳細画面
Route::get('/admin/{id}',[AdminController::class, 'show'])->name('admin.show');
Route::delete('/admin/{id}',[AdminController::class, 'destroy'])->name('admin.destroy');
