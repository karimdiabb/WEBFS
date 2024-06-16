<?php

use App\Http\Controllers\TableSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;
use App\Models\RestaurantTable;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/api/tables', function () {
    return RestaurantTable::all();
});

Route::get('/', function () {
    return view('home.start')->name('start');
});

Route::get('/menu', function () {
    return view('home.menu');
})->name('menu');
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/order', function () {
        $menuItems = [
            ['id' => 1, 'number' => '001', 'name' => 'Item 1', 'price' => 10.00],
            ['id' => 2, 'number' => '002', 'name' => 'Item 2', 'price' => 20.00],
            ['id' => 3, 'number' => '003', 'name' => 'Item 3', 'price' => 15.00],
            ['id' => 4, 'number' => '004', 'name' => 'Item 4', 'price' => 25.00],
            ['id' => 5, 'number' => '005', 'name' => 'Item 5', 'price' => 30.00],
        ];
        return view('orders.index', compact('menuItems'));
    })->name('order');
    Route::get('/dishes', function () {
        return view('dishes');
    })->name('dishes');
    Route::get('/sales', function () {
        return view('sales');
    })->name('sales');

    Route::post('/submit-order', function () {
        return view('dashboard');
    })->name('submit-order');
});

Route::get('/tables/create', [TableSessionController::class, 'create'])->name('tables.create');
Route::get('/tables', [TableSessionController::class, 'index'])->name('tables');
Route::post('/tables', [TableSessionController::class, 'store']);
Route::get('/help-requests', [TableSessionController::class, 'index'])->name('help_requests.index');
Route::post('/help-requests/{id}/resolve', [TableSessionController::class, 'resolveHelp'])->name('help_requests.resolve');
Route::get('/tables/{tableId}/customer', [TableSessionController::class, 'showCustomer'])->name('table_sessions.customer');
Route::delete('/table-sessions/{id}', [TableSessionController::class, 'destroy'])->name('table_sessions.destroy');

Route::get('/menu/download', [MenuController::class, 'downloadPdf'])->name('menu.download');


require __DIR__ . '/auth.php';