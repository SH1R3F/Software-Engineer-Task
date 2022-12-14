<?php

use App\Http\Controllers\UserController;
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


/* Only admins & employees can get in here. Normal users can't */
Route::middleware(['auth', 'role:Admin,Employee'])->group(function () {
    /* Manage trashed users */
    // See: App\Providers\RouteServiceProvider
    Route::softDeletes('users', 'UserController');

    Route::resource('users', UserController::class);
});
