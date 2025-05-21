<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
// Nieuwsitem routes (publiek toegankelijk)
Route::get('/news', [App\Http\Controllers\NewsItemController::class, 'index'])->name('news.index');
Route::get('/news/{newsItem}', [App\Http\Controllers\NewsItemController::class, 'show'])->name('news.show');

// Admin nieuwsitem routes (alleen voor admins)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('news', App\Http\Controllers\NewsItemController::class, ['except' => ['index', 'show']]);
});
// Publieke FAQ route
Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index'])->name('faq.index');

// Admin FAQ routes (alleen voor admins)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // FAQ Categories
    Route::resource('faq/categories', App\Http\Controllers\FaqCategoryController::class, ['as' => 'faq']);
    // FAQ Questions
    Route::resource('faq/questions', App\Http\Controllers\FaqQuestionController::class, ['as' => 'faq']);
});
// Contact routes
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'show'])
    ->name('contact.show');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])
    ->name('contact.submit');

// Admin contact routes (alleen voor admins)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])
        ->name('contact.index');
    Route::get('/contact/{message}', [App\Http\Controllers\ContactController::class, 'view'])
        ->name('contact.view');
    Route::delete('/contact/{message}', [App\Http\Controllers\ContactController::class, 'destroy'])
        ->name('contact.destroy');
});

require __DIR__.'/auth.php';
