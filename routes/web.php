<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Models\User;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::group([
    'middleware' => 'App\Http\Middleware\Authenticate',
], function() {

    // category controller
    Route::get('/categories/all', [CategoryController::class, 'Allcategories'])->name('all.categories');
    Route::post('/categories/add', [CategoryController::class, 'AddCategory'])->name('store.category');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/category/update/{id}', [CategoryController::class, 'update']);
    Route::get('/softdelete/category/{id}', [CategoryController::class, 'softDelete']);
    Route::get('/pdelete/category/{id}', [CategoryController::class, 'permanentDelete']);
    Route::get('/category/restore/{id}', [CategoryController::class, 'restore']);

    //Brand Route
    Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
    Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
    Route::post('/brand/update/{id}', [BrandController::class, 'update']);
    Route::get('/brand/delete/{id}', [BrandController::class, 'delete']);

    // Multi image controller
    Route::get('/multi/image', [BrandController::class, 'multipics'])->name('all.multi');
    Route::post('/multi/add', [BrandController::class, 'storePics'])->name('store.images');

    Route::get('/user/logout', [BrandController::class, 'logout'])->name('user.logout');

});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = User::all();
    return view('admin.index', compact('users'));
})->name('dashboard');


