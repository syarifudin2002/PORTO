<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Public Portfolio Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [PortfolioController::class, 'sendMessage'])->name('portfolio.contact');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Login & Logout Admin)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Dashboard CMS Routes (Wajib Login terlebih dahulu via middleware auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Settings, Hero Stats, Background Theme, Education, Quotes & GitHub
    Route::put('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    Route::post('/github-repos', [AdminController::class, 'storeGithubRepo'])->name('github.store');
    Route::delete('/github-repos/{index}', [AdminController::class, 'destroyGithubRepo'])->name('github.destroy');

    // Projects CRUD (Tambah, Edit, Hapus)
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('projects.store');
    Route::put('/projects/{project}', [AdminController::class, 'updateProject'])->name('projects.update');
    Route::delete('/projects/{project}', [AdminController::class, 'destroyProject'])->name('projects.destroy');

    // Skills CRUD (Tambah, Edit, Hapus)
    Route::post('/skills', [AdminController::class, 'storeSkill'])->name('skills.store');
    Route::put('/skills/{skill}', [AdminController::class, 'updateSkill'])->name('skills.update');
    Route::delete('/skills/{skill}', [AdminController::class, 'destroySkill'])->name('skills.destroy');

    // Experiences CRUD (Tambah, Edit, Hapus)
    Route::post('/experiences', [AdminController::class, 'storeExperience'])->name('experiences.store');
    Route::put('/experiences/{experience}', [AdminController::class, 'updateExperience'])->name('experiences.update');
    Route::delete('/experiences/{experience}', [AdminController::class, 'destroyExperience'])->name('experiences.destroy');

    // Certificates CRUD (Tambah, Edit, Hapus)
    Route::post('/certificates', [AdminController::class, 'storeCertificate'])->name('certificates.store');
    Route::put('/certificates/{certificate}', [AdminController::class, 'updateCertificate'])->name('certificates.update');
    Route::delete('/certificates/{certificate}', [AdminController::class, 'destroyCertificate'])->name('certificates.destroy');

    // Blog Posts CRUD (Tambah, Edit, Hapus)
    Route::post('/posts', [AdminController::class, 'storePost'])->name('posts.store');
    Route::put('/posts/{post}', [AdminController::class, 'updatePost'])->name('posts.update');
    Route::delete('/posts/{post}', [AdminController::class, 'destroyPost'])->name('posts.destroy');

    // Messages Management
    Route::patch('/messages/{message}/read', [AdminController::class, 'markMessageRead'])->name('messages.read');
    Route::delete('/messages/{message}', [AdminController::class, 'destroyMessage'])->name('messages.destroy');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');
