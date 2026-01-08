<?php

<<<<<<< HEAD
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
=======
use App\Http\Controllers\DashboardController;
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
    ->middleware(['auth'])
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
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
