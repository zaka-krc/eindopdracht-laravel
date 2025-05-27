<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsItemController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\FaqQuestionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\GameInterestController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// ===== HOMEPAGE =====
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ===== DASHBOARD =====
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

// ===== CONTACT ROUTES (PUBLIEK) =====
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ===== COMMENT ROUTES (AUTHENTICATED USERS) =====
Route::middleware('auth')->group(function () {
    Route::post('/news/{newsItem}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
});

// ===== ADMIN ROUTES =====
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // ===== USER MANAGEMENT =====
    Route::resource('users', AdminUserController::class);
    Route::post('users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])
        ->name('users.toggle-admin');
    
    // Emergency admin restore (bypass admin middleware for emergencies)
    Route::get('/emergency-admin-restore', [AdminUserController::class, 'emergencyAdminRestore'])
        ->name('emergency-restore')
        ->withoutMiddleware(['admin']);
    
    // ===== NEWS MANAGEMENT =====
    Route::resource('news', NewsItemController::class, ['except' => ['index', 'show']]);
    
    // ===== FAQ MANAGEMENT =====
    Route::resource('faq/categories', FaqCategoryController::class, ['as' => 'faq']);
    Route::resource('faq/questions', FaqQuestionController::class, ['as' => 'faq']);
    
    // ===== GAME INTERESTS MANAGEMENT =====
    Route::resource('game-interests', GameInterestController::class, ['except' => ['show']]);
    
    // ===== CONTACT MANAGEMENT =====
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{message}', [ContactController::class, 'view'])->name('contact.view');
    Route::delete('/contact/{message}', [ContactController::class, 'destroy'])->name('contact.destroy');
    
    // ===== ADMIN COMMENT ROUTES (nu binnen admin groep) =====
    Route::delete('/news/{newsItem}/comments/bulk', [CommentController::class, 'bulkDelete'])
        ->name('comments.bulk-delete');
});

// ===== AUTHENTICATION ROUTES =====
require __DIR__.'/auth.php';