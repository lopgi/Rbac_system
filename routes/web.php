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


Route::post('/roles',[AdminController::class,'roles'])->name('roles');
Route::post('/add_user',[AdminController::class,'add_user'])->name('add_user');

Route::post('addposts', [AdminController::class, 'addposts'])->name('addposts');

Route::get('auth/login',function(){
return view('auth.login');
});

Route::group(['middleware'=>'admin'],function(){
Route::get('admin/dashboard', [AdminController::class, 'getusers'])->name('admin.dashboard');

});



Route::group(['middleware'=>'editor'],function(){
Route::get('editor/dashboard', [AdminController::class, 'geteditorpost'])->name('editor.dashboard');
Route::post('editor/dashboard', [AdminController::class, 'publish_post'])->name('publish_post');


});



