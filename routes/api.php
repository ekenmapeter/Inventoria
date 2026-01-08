<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::get('/brands', [CategoryController::class, 'getBrands']);
    Route::get('/units', [CategoryController::class, 'getUnits']);
    Route::get('/adjustments', [CategoryController::class, 'getAdjustments']);

    // Dashboard API routes
    Route::get('/dashboard/stats', [DashboardController::class, 'getStats']);
    Route::get('/dashboard/recent-transactions', [DashboardController::class, 'getRecentTransactions']);
    Route::get('/dashboard/best-sellers/{period}/{type}', [DashboardController::class, 'getBestSellers']);
    Route::get('/dashboard/cash-flow-matrix', [DashboardController::class, 'getCashFlowMatrix']);
    Route::get('/dashboard/revenue-expense-matrix', [DashboardController::class, 'getRevenueExpenseMatrix']);
    Route::get('/dashboard/yearly-report', [DashboardController::class, 'getYearlyReport']);
});
