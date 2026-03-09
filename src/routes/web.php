<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);
Route::get('/thanks', function () {
    return view('contact.thanks');
})->name('thanks');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/search', [AdminController::class, 'index']);
    Route::get('/reset', function () {
        return redirect('/admin');
    });
    Route::delete('/delete', [AdminController::class, 'destroy']);
    Route::get('/export', [AdminController::class, 'export']);
});
