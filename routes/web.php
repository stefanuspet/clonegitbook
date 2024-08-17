<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PageBlockController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\SpaceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/user-delete/{id}', [ProfileController::class, 'destroyById'])->name('user.destroy');
});


// user
Route::middleware('auth')->group(function () {
    Route::get('/users-dashboard', [DashboardUserController::class, 'index'])->name('users.dashboard');
    Route::post('/space/store', [DashboardUserController::class, 'storeSpace'])->name('space.store');

    // space
    Route::get('/space/{spaceId}', [SpaceController::class, 'index'])->name('user.space.show');
    Route::post('/space/updatetitle/{id}', [SpaceController::class, 'updateTitleSpace'])->name('user.space.updateTitle');
    Route::post('/space/updategenre/{id}', [SpaceController::class, 'updateGenreSpace'])->name('user.space.updateGenre');
    Route::post('/space/storeblankpage/{id}', [PageController::class, 'storeBlankPage'])->name('space.storeBlankPage');
    Route::post('/page/updatetitle/{id}', [PageController::class, 'updateTitle'])->name('page.updateTitle');
    Route::delete('/page/delete/{id}', [PageController::class, 'destroyPage'])->name('page.destroy');
    Route::post('/pages/{id}/add-subpage', [PageController::class, 'addSubpage'])->name('page.addSubpage');
    Route::post('/space/updateImage/{id}', [SpaceController::class, 'uploadImage'])->name('user.space.updateImage');
    Route::delete('/space/delete/{id}', [SpaceController::class, 'destroy'])->name('space.destroy');

    // page
    Route::get('/space/{spaceId}/page/{id}', [PageController::class, 'index'])->name('user.page.index');
    Route::post('/page/updatedescription/{id}', [PageController::class, 'updateDescription'])->name('page.updateDescription');
    Route::post('/page/addcover/{id}', [PageController::class, 'addPageCover'])->name('page.addCover');
    Route::post('/page/updatecover/{id}', [PageController::class, 'updatePageCover'])->name('page.updateCover');
    Route::delete('/page/deletecover/{id}', [PageController::class, 'destroyPageCover'])->name('page.deleteCover');

    // page block
    Route::post('/pageblock/store/{id}', [PageBlockController::class, 'storePageBlock'])->name('pageblock.store');
    Route::post('/pageblock/update/{id}', [PageBlockController::class, 'updatePageBlock'])->name('pageblock.update');
    Route::delete('/pageblock/delete/{id}', [PageBlockController::class, 'destroy'])->name('pageblock.destroy');
    // error
    Route::post('/page/create', [DashboardUserController::class, 'storePage'])->name('page.create');
    Route::get('/page/{id}', [PageController::class, 'show'])->name('user.page.show');
    Route::get('/page/{id}/edit', [PageController::class, 'edit'])->name('user.page.edit');
});

// admin    
Route::middleware('auth')->group(function () {
    Route::get('/admin-dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin-alluser', [DashboardAdminController::class, 'getUser'])->name('admin.alluser');
    Route::get('/admin-profile', [DashboardAdminController::class, 'profile'])->name('admin.profile');
    Route::get('/admin-jenis', [DashboardAdminController::class, 'jenis'])->name('admin.jenis');
});

Route::get('/shared/{spaceId}/{userId}', [ShareController::class, 'index'])->name('share');
Route::get('/shared/{spaceId}/{userId}/page/{id}', [ShareController::class, 'show'])->name('share.page.show');




require __DIR__ . '/auth.php';
