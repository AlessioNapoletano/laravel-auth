<?php

use App\Http\Controllers\admin\DashboardController as DashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController as WelcomeController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/posts/trashed', [AdminPostController::class, 'trashed'])->name('trashed');
    Route::post('/posts/{id}/restore', [AdminPostController::class, 'restore'])->name('restore');
    Route::post('/restore-all', [AdminPostController::class, 'restoreAll'])->name('restore-all');
    Route::delete('/posts/{id}/force-delete', [AdminPostController::class, 'forceDelete'])->name('force-delete');
    Route::resource('posts', AdminPostController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
