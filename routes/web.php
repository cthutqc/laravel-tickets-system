<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/tickets', \App\Http\Controllers\TicketController::class);
    Route::put('/tickets/{ticket}/add_message', [\App\Http\Controllers\TicketController::class, 'addMessage'])->name('tickets.add_message');
    Route::patch('/tickets/{ticket}/change_status', [\App\Http\Controllers\TicketController::class, 'changeStatus'])->name('tickets.change_status');
    Route::post('/tickets/upload',  [\App\Http\Controllers\TicketController::class, 'upload'])->name('tickets.upload');

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('/users', \App\Http\Controllers\UserController::class);
        Route::resource('/categories', \App\Http\Controllers\CategoryController::class);
        Route::resource('/labels', \App\Http\Controllers\LabelController::class);
        Route::resource('/statuses', \App\Http\Controllers\StatusController::class);
        Route::resource('/priorities', \App\Http\Controllers\PriorityController::class);

        Route::patch('/tickets/{ticket}/assign_to_agent', [\App\Http\Controllers\TicketController::class, 'assignToAgent'])->name('tickets.assign_to_agent');

    });

});

require __DIR__.'/auth.php';
