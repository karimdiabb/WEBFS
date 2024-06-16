<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderOverviewController;
use Illuminate\Support\Facades\Route;
use App\Models\RestaurantTable;


require __DIR__ . '/auth.php';

Route::get('/api/tables', function () {
    return RestaurantTable::all();
});

Route::get('/', function () {
    return view('home.start');
})->name('start');

Route::get('/menu', [MenuController::class, 'show'])->name('menu');
Route::get('/menu/download', [MenuController::class, 'downloadPdf'])->name('menu.download');

Route::get('/tables/{tableId}/customer', [TableSessionController::class, 'showCustomer'])->name('table_sessions.customer');

Route::get('/news', function () {
    return view('home.news');

})->name('news');
Route::get('/contact', function () {

    return view('home.contact');
})->name('contact');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/menu/index', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/createOrEdit', [MenuController::class, 'createOrEdit'])->name('menu.createOrEdit');
    Route::post('/menu/storeOrUpdate', [MenuController::class, 'storeOrUpdate'])->name('menu.storeOrUpdate');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/order', [OrderController::class, 'create'])->name('order');
    Route::post('/submit-order', [OrderController::class, 'processOrder'])->name('submit-order');
    Route::get('/order/summary', [OrderOverviewController::class, 'index'])->name('order.overview');
    Route::get('/order/download/{filename}', [OrderOverviewController::class, 'download'])->name('order-summary.download');
    Route::post('/order/generate-summary', [OrderOverviewController::class, 'generate'])->name('order-summary.generate');

    Route::get('/dishes', [DishController::class, 'index'])->name('dishes.index');

    Route::get('/tables', [TableSessionController::class, 'index'])->name('tables');
    Route::post('/tables', [TableSessionController::class, 'store']);
    Route::get('/tables/create', [TableSessionController::class, 'create'])->name('tables.create');
    Route::delete('/table-sessions/{id}', [TableSessionController::class, 'destroy'])->name('table_sessions.destroy');

    Route::get('/help-requests', [TableSessionController::class, 'index'])->name('help_requests.index');
    Route::post('/help-requests/{id}/resolve', [TableSessionController::class, 'resolveHelp'])->name('help_requests.resolve');

    Route::resource('pages', PageController::class);
    Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');
});





