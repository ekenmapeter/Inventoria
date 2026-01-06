<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DepositController as AdminDepositController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');

// Public Forum Routes
Route::resource('forums', ForumController::class)->only(['index', 'show'])->middleware('auth');

// Topic Routes
Route::get('forums/{forum}/topics/create', [TopicController::class, 'create'])
    ->middleware('auth')
    ->name('topics.create');
Route::post('forums/{forum}/topics', [TopicController::class, 'store'])
    ->middleware('auth')
    ->name('topics.store');
Route::resource('topics', TopicController::class)->only(['show', 'edit', 'update', 'destroy']);

// Post Routes
Route::post('topics/{topic}/posts', [PostController::class, 'store'])
    ->middleware('auth')
    ->name('posts.store');
Route::get('posts/{post}/edit', [PostController::class, 'edit'])
    ->middleware('auth')
    ->name('posts.edit');
Route::put('posts/{post}', [PostController::class, 'update'])
    ->middleware('auth')
    ->name('posts.update');
Route::delete('posts/{post}', [PostController::class, 'destroy'])
    ->middleware('auth')
    ->name('posts.destroy');

// User Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Payment routes
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

    // Stop impersonation (if admin is impersonating)
    Route::post('/stop-impersonating', [AdminUserController::class, 'stopImpersonating'])->name('stop-impersonating');
});

// Admin Login Routes (public)
Route::prefix('admin')->name('admin.')->middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'create'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'store'])->name('login.store');
});

// Admin Routes (protected)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Settings
    Route::get('/settings', [SiteSettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SiteSettingController::class, 'update'])->name('settings.update');

    // Forums
    Route::resource('forums', AdminForumController::class);

    // Members (Users)
    Route::get('users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('users', [AdminUserController::class, 'store'])->name('users.store');
    Route::resource('users', AdminUserController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::post('users/{user}/suspend', [AdminUserController::class, 'suspend'])->name('users.suspend');
    Route::post('users/{user}/unsuspend', [AdminUserController::class, 'unsuspend'])->name('users.unsuspend');
    Route::post('users/{user}/impersonate', [AdminUserController::class, 'impersonate'])->name('users.impersonate');
    Route::post('users/{user}/assign-package', [AdminUserController::class, 'assignPackage'])->name('users.assign-package');
    Route::delete('users/{user}/packages/{package}', [AdminUserController::class, 'removePackage'])->name('users.remove-package');

    // Payments
    Route::get('payments/monthly-dues', [AdminPaymentController::class, 'monthlyDues'])->name('payments.monthly-dues');
    Route::get('payments/monthly-dues/create', [AdminPaymentController::class, 'createMonthlyDue'])->name('payments.monthly-dues.create');
    Route::post('payments/monthly-dues', [AdminPaymentController::class, 'storeMonthlyDue'])->name('payments.monthly-dues.store');
    Route::get('payments/subscriptions', [AdminPaymentController::class, 'subscriptions'])->name('payments.subscriptions');
    Route::get('payments/subscriptions/create', [AdminPaymentController::class, 'createSubscription'])->name('payments.subscriptions.create');
    Route::post('payments/subscriptions', [AdminPaymentController::class, 'storeSubscription'])->name('payments.subscriptions.store');
    Route::get('payments', [AdminPaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/{payment}', [AdminPaymentController::class, 'show'])->name('payments.show');
    Route::post('payments/{payment}/approve', [AdminPaymentController::class, 'approve'])->name('payments.approve');
    Route::post('payments/{payment}/reject', [AdminPaymentController::class, 'reject'])->name('payments.reject');

    // Deposits
    Route::get('deposits/create', [AdminDepositController::class, 'create'])->name('deposits.create');
    Route::post('deposits', [AdminDepositController::class, 'store'])->name('deposits.store');
    Route::resource('deposits', AdminDepositController::class)->only(['index', 'show']);
    Route::post('deposits/{deposit}/approve', [AdminDepositController::class, 'approve'])->name('deposits.approve');
    Route::post('deposits/{deposit}/approve', [AdminDepositController::class, 'approve'])->name('deposits.approve');
    Route::post('deposits/{deposit}/reject', [AdminDepositController::class, 'reject'])->name('deposits.reject');

    // Packages
    Route::resource('packages', \App\Http\Controllers\Admin\PackageController::class);

    // Database Reset
    Route::post('/database/reset', function () {
        // This is dangerous - only allow in development or with proper confirmation
        if (app()->environment('production')) {
            abort(403, 'Database reset not allowed in production');
        }

        \Artisan::call('db:reset', ['--confirm' => true]);
        return redirect()->route('admin.dashboard')->with('success', 'Database reset successfully!');
    })->name('database.reset');

    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'destroy'])->name('logout');
});

require __DIR__.'/auth.php';
