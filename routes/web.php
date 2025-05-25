<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsItemController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\FaqQuestionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\GameInterestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===== PROFILE ROUTES =====
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== PUBLIC PROFILE ROUTES =====
// Publieke profielpagina (iedereen kan zien)
Route::get('/user/{user}', [ProfileController::class, 'show'])->name('profile.public.show');

// ===== NEWS ROUTES =====
// Publiek toegankelijk
Route::get('/news', [NewsItemController::class, 'index'])->name('news.index');
Route::get('/news/{newsItem}', [NewsItemController::class, 'show'])->name('news.show');

// ===== FAQ ROUTES =====
// Publieke FAQ route
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

// ===== CONTACT ROUTES =====
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ===== ADMIN ROUTES =====
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // User management
    Route::resource('users', AdminUserController::class);
    Route::post('users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])
        ->name('users.toggle-admin');
    Route::get('/emergency-admin-restore', [AdminUserController::class, 'emergencyAdminRestore'])
    ->name('admin.emergency-restore')
    ->withoutMiddleware(['admin']); // Zonder admin check voor noodsituaties
    
    // News management
    Route::resource('news', NewsItemController::class, ['except' => ['index', 'show']]);
    
    // FAQ management
    Route::resource('faq/categories', FaqCategoryController::class, ['as' => 'faq']);
    Route::resource('faq/questions', FaqQuestionController::class, ['as' => 'faq']);
    
    // Game Interests management 
    Route::resource('game-interests', GameInterestController::class, ['except' => ['show']]);
    
    // Contact management
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{message}', [ContactController::class, 'view'])->name('contact.view');
    Route::delete('/contact/{message}', [ContactController::class, 'destroy'])->name('contact.destroy');
});

require __DIR__.'/auth.php';