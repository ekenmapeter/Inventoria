<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Inventory\AdjustmentController;
use App\Http\Controllers\Inventory\BarcodeController;
use App\Http\Controllers\Inventory\StockCountController;
use App\Http\Controllers\Inventory\BrandController;
use App\Http\Controllers\Inventory\UnitController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::get('/locations', [LocationController::class, 'index']);

    // Dashboard API routes
    Route::get('/dashboard/stats', [DashboardController::class, 'getStats']);
    Route::get('/dashboard/recent-transactions', [DashboardController::class, 'getRecentTransactions']);
    Route::get('/dashboard/best-sellers/{period}/{type}', [DashboardController::class, 'getBestSellers']);
    Route::get('/dashboard/cash-flow-matrix', [DashboardController::class, 'getCashFlowMatrix']);
    Route::get('/dashboard/revenue-expense-matrix', [DashboardController::class, 'getRevenueExpenseMatrix']);
    Route::get('/dashboard/yearly-report', [DashboardController::class, 'getYearlyReport']);

    // Inventory API routes
    Route::get('/products', [ProductController::class, 'apiIndex']);
    Route::get('/latest-products', [ProductController::class, 'apiLatest']);
    Route::post('/products', [ProductController::class, 'apiStore']);

    // Adjustments API routes
    Route::get('/adjustments', [AdjustmentController::class, 'apiIndex']);
    Route::post('/adjustments', [AdjustmentController::class, 'apiStore']);

    // Barcode API routes
    Route::post('/barcodes/generate', [BarcodeController::class, 'generate']);

    // Stock Count API routes
    Route::post('/stock-counts', [StockCountController::class, 'apiStore']);

    // Brand API routes
    Route::get('/brands', [BrandController::class, 'apiIndex']);
    Route::post('/brands', [BrandController::class, 'apiStore']);
    Route::put('/brands/{brand}', [BrandController::class, 'apiUpdate']);
    Route::delete('/brands/{brand}', [BrandController::class, 'apiDestroy']);

    // Unit API routes
    Route::get('/units', [UnitController::class, 'apiIndex']);
    Route::post('/units', [UnitController::class, 'apiStore']);
    Route::put('/units/{unit}', [UnitController::class, 'apiUpdate']);
    Route::delete('/units/{unit}', [UnitController::class, 'apiDestroy']);

    // Financial API routes
    Route::get('/financial/overview', [DashboardController::class, 'getFinancialOverview']);
    Route::get('/financial/yearly-stats', [DashboardController::class, 'getYearlyStats']);
});
