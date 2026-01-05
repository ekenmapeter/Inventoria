<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShipByController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Inventory\BrandController;
use App\Http\Controllers\Inventory\UnitController;
use App\Http\Controllers\Inventory\BarcodeController;
use App\Http\Controllers\Inventory\AdjustmentController;
use App\Http\Controllers\Inventory\StockCountController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Purchase\PurchaseReturnController;
use App\Http\Controllers\Sale\SaleController;
use App\Http\Controllers\Sale\PosController;
use App\Http\Controllers\Sale\PackingSlipController;
use App\Http\Controllers\Sale\ChallanController;
use App\Http\Controllers\Sale\DeliveryController;
use App\Http\Controllers\Sale\GiftCardController;
use App\Http\Controllers\Sale\CouponController;
use App\Http\Controllers\Sale\CourierController;
use App\Http\Controllers\Sale\SaleReturnController;
use App\Http\Controllers\Quotation\QuotationController;
use App\Http\Controllers\Transfer\TransferController;
use App\Http\Controllers\Finance\ExpenseCategoryController;
use App\Http\Controllers\Finance\ExpenseController;
use App\Http\Controllers\Finance\IncomeCategoryController;
use App\Http\Controllers\Finance\IncomeController;
use App\Http\Controllers\People\CustomerController;
use App\Http\Controllers\People\UserManagementController;
use App\Http\Controllers\People\AgentController;
use App\Http\Controllers\People\BillerController;
use App\Http\Controllers\Accounting\AccountController;
use App\Http\Controllers\Accounting\MoneyTransferController;
use App\Http\Controllers\Accounting\BalanceSheetController;
use App\Http\Controllers\Accounting\AccountStatementController;
use App\Http\Controllers\Manufacturing\ProductionController;
use App\Http\Controllers\Manufacturing\RecipeController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Home redirect
    Route::get('/home', function () {
        return redirect('/dashboard');
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/api/dashboard-stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');

    // Products
    Route::resource('products', ProductController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Locations
    Route::resource('locations', LocationController::class);

    // Suppliers
    Route::resource('suppliers', SupplierController::class);

    /*
     * Inventory
     */
    Route::resource('brands', BrandController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('units', UnitController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::get('barcodes', [BarcodeController::class, 'index'])->name('barcodes.index');
    Route::get('barcodes/print', [BarcodeController::class, 'print'])->name('barcodes.print');

    Route::resource('adjustments', AdjustmentController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('stock-counts', StockCountController::class)->only(['index', 'create', 'store', 'show']);

    /*
     * Purchase
     */
    Route::resource('purchases', PurchaseController::class);
    Route::get('purchases/import/csv', [PurchaseController::class, 'showImportForm'])->name('purchases.import.csv');
    Route::post('purchases/import/csv', [PurchaseController::class, 'importCsv'])->name('purchases.import.csv.store');

    Route::resource('purchase-returns', PurchaseReturnController::class)->only(['index', 'create', 'store', 'show']);

    /*
     * Sales
     */
    Route::resource('sales', SaleController::class);
    Route::get('sales/import/csv', [SaleController::class, 'showImportForm'])->name('sales.import.csv');
    Route::post('sales/import/csv', [SaleController::class, 'importCsv'])->name('sales.import.csv.store');

    Route::get('pos', [PosController::class, 'index'])->name('pos.index');

    Route::resource('packing-slips', PackingSlipController::class)->only(['index', 'show']);
    Route::resource('challans', ChallanController::class)->only(['index', 'show']);
    Route::resource('deliveries', DeliveryController::class)->only(['index', 'show']);
    Route::resource('gift-cards', GiftCardController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('couriers', CourierController::class);
    Route::resource('sale-returns', SaleReturnController::class)->only(['index', 'create', 'store', 'show']);

    /*
     * Quotation
     */
    Route::resource('quotations', QuotationController::class);

    /*
     * Transfer
     */
    Route::resource('transfers', TransferController::class);
    Route::get('transfers/import/csv', [TransferController::class, 'showImportForm'])->name('transfers.import.csv');
    Route::post('transfers/import/csv', [TransferController::class, 'importCsv'])->name('transfers.import.csv.store');

    /*
     * Expense & Income
     */
    Route::resource('expense-categories', ExpenseCategoryController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('income-categories', IncomeCategoryController::class);
    Route::resource('incomes', IncomeController::class);

    /*
     * People
     */
    Route::resource('customers', CustomerController::class);
    Route::resource('users', UserManagementController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('agents', AgentController::class);
    Route::resource('billers', BillerController::class);

    /*
     * Accounting
     */
    Route::resource('accounts', AccountController::class);
    Route::resource('money-transfers', MoneyTransferController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('balance-sheet', [BalanceSheetController::class, 'index'])->name('balance-sheet.index');
    Route::get('account-statements', [AccountStatementController::class, 'index'])->name('account-statements.index');

    /*
     * Manufacturing
     */
    Route::resource('productions', ProductionController::class);
    Route::resource('recipes', RecipeController::class);

    // Reports
    Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
    Route::get('/reports/export/{format}', [ReportController::class, 'export']);

    // Orders
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}/print', [OrderController::class, 'print']);
    Route::post('/orders/{id}/email', [OrderController::class, 'email']);

    // Shipping Methods
    Route::get('/ship-by', [ShipByController::class, 'index']);
    Route::post('/ship-by', [ShipByController::class, 'store'])->name('ship-by.store');
});

Route::get('/api/products', function() {
    return App\Models\Product::select('id', 'item_code', 'description', 'sales_price')
        ->orderBy('item_code')
        ->get();
});

// require __DIR__.'/auth.php';
