<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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

// Auth controller
Route::get('/',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'AuthLogin'])->name('AuthLogin');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');


Route::post('/editors',[AdminController::class,'editors'])->name('editors');
Route::post('/add_user',[AdminController::class,'add_user'])->name('add_user');


Route::get('auth/login',function(){
return view('auth.login');
});

Route::group(['middleware'=>'admin'],function(){
    Route::get('admin/dashboard', [AdminController::class, 'geteditor'])->name('admin.dashboard');

        });
    


Route::group(['middleware'=>'editor'],function(){
    Route::get('editor/dashboard',function(){
        return view('editor.dashboard');
        });
});
