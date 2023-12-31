<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'web'], function () {
    Route::resource('categories', CategoriesController::class)->except('destroy');
    Route::get('categories/{id}/delete', [CategoriesController::class, 'destroy'])->name('delete.category');
    Route::get('data/categories', [CategoriesController::class, 'data'])->name('categories.data');

    Route::resource('/products-reseller', ProductsController::class);
    Route::get('data/products', [ProductsController::class, 'data'])->name('products.data');
});

require __DIR__ . '/auth.php';
