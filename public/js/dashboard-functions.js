// Dashboard JavaScript Functions

// Sidebar functions
function closeSidebar() {
    document.getElementById('dashboard-sidebar').classList.add('-translate-x-full');
    document.getElementById('sidebar-overlay').classList.add('hidden');
}

// Modal functions
function openViewModal() {
    document.getElementById('viewModal').classList.remove('hidden');
    switchViewTab('categories');
}

function closeViewModal() {
    document.getElementById('viewModal').classList.add('hidden');
}

function openCategoryModal() {
    document.getElementById('viewModal').classList.remove('hidden');
    switchViewTab('categories');
}

function openBrandModal() {
    document.getElementById('viewModal').classList.remove('hidden');
    switchViewTab('brands');
}

function openUnitModal() {
    // Implement unit modal
    console.log('Open unit modal');
    alert('Unit management modal - To be implemented');
}

function openProductListModal() {
    // Implement product list modal
    console.log('Open product list modal');
    alert('Product List modal - To be implemented');
}

function openAddProductModal() {
    document.getElementById('itemModal').classList.remove('hidden');
    document.querySelector('.modal-content').classList.add('show');
}

function openBarcodeModal() {
    // Implement barcode modal
    console.log('Open barcode modal');
    alert('Print Barcode modal - To be implemented');
}

function openAdjustmentListModal() {
    // Implement adjustment list modal
    console.log('Open adjustment list modal');
    alert('Adjustment List modal - To be implemented');
}

function openAddAdjustmentModal() {
    // Implement add adjustment modal
    console.log('Open add adjustment modal');
    alert('Add Adjustment modal - To be implemented');
}

function openStockCountModal() {
    // Implement stock count modal
    console.log('Open stock count modal');
    alert('Stock Count modal - To be implemented');
}

function openReportModal() {
    document.getElementById('reportModal').classList.remove('hidden');
}

function closeReportModal() {
    document.getElementById('reportModal').classList.add('hidden');
}

function openItemModal() {
    document.getElementById('itemModal').classList.remove('hidden');
    document.querySelector('.modal-content').classList.add('show');
}

function closeItemModal() {
    document.getElementById('itemModal').classList.add('hidden');
    document.querySelector('.modal-content').classList.remove('show');
}

function openNewCategoryModal() {
    document.getElementById('categoryModal').classList.remove('hidden');
}

function closeCategoryModal() {
    document.getElementById('categoryModal').classList.add('hidden');
}

function openNewBrandModal() {
    // Implement brand modal
    console.log('Open brand modal');
    alert('Add Brand modal - To be implemented');
}

function openNewUnitModal() {
    // Implement unit modal
    console.log('Open unit modal');
    alert('Add Unit modal - To be implemented');
}

function openNewLocationModal() {
    // Implement location modal
    console.log('Open location modal');
    alert('Add Location modal - To be implemented');
}

function openNewSupplierModal() {
    // Implement supplier modal
    console.log('Open supplier modal');
    alert('Add Supplier modal - To be implemented');
}

function openOrderModal() {
    // Implement order modal
    console.log('Open order modal');
    alert('Order modal - To be implemented');
}

function printBarcodeModal() {
    // Implement barcode modal
    console.log('Open barcode modal');
    alert('Print Barcode modal - To be implemented');
}

function openAdjustmentModal() {
    // Implement adjustment modal
    console.log('Open adjustment modal');
    alert('Adjustment modal - To be implemented');
}

function switchViewTab(tabName) {
    // Hide all tabs
    const tabs = document.querySelectorAll('.view-tab-content');
    tabs.forEach(tab => tab.classList.add('hidden'));

    // Remove active class from all buttons
    const buttons = document.querySelectorAll('.view-tab-button');
    buttons.forEach(button => button.classList.remove('active'));

    // Show selected tab
    document.getElementById(tabName + 'Tab').classList.remove('hidden');

    // Add active class to selected button
    const activeButton = document.querySelector(`[data-tab="${tabName}"]`);
    if (activeButton) {
        activeButton.classList.add('active');
    }
}

function switchTab(tabName) {
    const tabs = ['basicInfo', 'inventoryInfo'];
    const tabButtons = ['basicTab', 'inventoryTab'];

    tabs.forEach(tab => {
        document.getElementById(tab).classList.add('hidden');
    });

    tabButtons.forEach(button => {
        document.getElementById(button).classList.remove('border-b-2', 'border-blue-500');
    });

    document.getElementById(tabName + 'Info').classList.remove('hidden');
    document.getElementById(tabName + 'Tab').classList.add('border-b-2', 'border-blue-500');
}

function closeEditCategoryModal() {
    document.getElementById('editCategoryModal').classList.add('hidden');
}

function closeEditLocationModal() {
    document.getElementById('editLocationModal').classList.add('hidden');
}

function closeEditSupplierModal() {
    document.getElementById('editSupplierModal').classList.add('hidden');
}

// Initialize dashboard when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Load dashboard stats
    loadDashboardStats();

    // Load best sellers
    loadBestSellers();

    // Load cash flow matrix
    loadCashFlowMatrix();

    // Load revenue expense matrix
    loadRevenueExpenseMatrix();

    // Load yearly report
    loadYearlyReport();

    // Initialize tooltips
    tippy('[data-tippy-content]', {
        theme: 'custom',
    });

    // Sidebar toggle for mobile
    const sidebarToggle = document.getElementById('sidebar-toggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            document.getElementById('dashboard-sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        });
    }
});

// API functions for loading data
function loadDashboardStats() {
    fetch('/dashboard/get-stats', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('revenue-stat').textContent = '$' + parseFloat(data.revenue).toLocaleString();
            document.querySelector('[data-stat="total-products"]').textContent = data.total_products;
            document.querySelector('[data-stat="low-stock"]').textContent = data.low_stock;
            document.querySelector('[data-stat="total-value"]').textContent = '$' + parseFloat(data.total_value).toLocaleString();
        }
    })
    .catch(error => console.error('Error loading dashboard stats:', error));
}

function loadBestSellers() {
    // Load January best sellers
    fetch('/dashboard/get-best-sellers/january/quantity', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const container = document.getElementById('january-best-sellers-compact');
            container.innerHTML = data.best_sellers.map(item => `
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">${item.product_details}</span>
                    <span class="text-sm font-medium text-gray-900">${item.qty || 0}</span>
                </div>
            `).join('');
        }
    })
    .catch(error => console.error('Error loading January best sellers:', error));

    // Load yearly quantity best sellers
    fetch('/dashboard/get-best-sellers/year/quantity', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const container = document.getElementById('year-qty-best-sellers-compact');
            container.innerHTML = data.best_sellers.map(item => `
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">${item.product_details}</span>
                    <span class="text-sm font-medium text-gray-900">${item.qty || 0}</span>
                </div>
            `).join('');
        }
    })
    .catch(error => console.error('Error loading yearly quantity best sellers:', error));

    // Load yearly price best sellers
    fetch('/dashboard/get-best-sellers/year/price', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const container = document.getElementById('year-price-best-sellers-compact');
            container.innerHTML = data.best_sellers.map(item => `
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">${item.product_details}</span>
                    <span class="text-sm font-medium text-gray-900">${item.grand_total || '$0.00'}</span>
                </div>
            `).join('');
        }
    })
    .catch(error => console.error('Error loading yearly price best sellers:', error));
}

function loadCashFlowMatrix() {
    fetch('/dashboard/get-cash-flow-matrix', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const tbody = document.getElementById('cash-flow-matrix-tbody');
            tbody.innerHTML = data.cash_flow_matrix.map(item => `
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-900">${item.month}</td>
                    <td class="px-4 py-2 text-sm text-green-600">$${parseFloat(item.payments_received).toLocaleString()}</td>
                    <td class="px-4 py-2 text-sm text-red-600">$${parseFloat(item.payments_sent).toLocaleString()}</td>
                    <td class="px-4 py-2 text-sm font-medium ${item.net_cash_flow >= 0 ? 'text-green-600' : 'text-red-600'}">
                        $${parseFloat(item.net_cash_flow).toLocaleString()}
                    </td>
                </tr>
            `).join('');
        }
    })
    .catch(error => console.error('Error loading cash flow matrix:', error));
}

function loadRevenueExpenseMatrix() {
    fetch('/dashboard/get-revenue-expense-matrix', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const tbody = document.getElementById('revenue-expense-matrix-tbody');
            tbody.innerHTML = data.revenue_expense_matrix.map(item => `
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-900">${item.month}</td>
                    <td class="px-4 py-2 text-sm text-green-600">$${parseFloat(item.revenue).toLocaleString()}</td>
                    <td class="px-4 py-2 text-sm text-red-600">$${parseFloat(item.purchases).toLocaleString()}</td>
                    <td class="px-4 py-2 text-sm font-medium ${item.profit >= 0 ? 'text-green-600' : 'text-red-600'}">
                        $${parseFloat(item.profit).toLocaleString()}
                    </td>
                </tr>
            `).join('');
        }
    })
    .catch(error => console.error('Error loading revenue expense matrix:', error));
}

function loadYearlyReport() {
    fetch('/dashboard/get-yearly-report', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update summary stats
            document.getElementById('yearly-total-revenue').textContent = '$' + parseFloat(data.yearly_report.totals.total_revenue).toLocaleString();
            document.getElementById('yearly-total-purchases').textContent = '$' + parseFloat(data.yearly_report.totals.total_purchases).toLocaleString();
            document.getElementById('yearly-total-profit').textContent = '$' + parseFloat(data.yearly_report.totals.total_profit).toLocaleString();
            document.getElementById('yearly-total-products').textContent = data.yearly_report.totals.total_products;
            document.getElementById('yearly-low-stock').textContent = data.yearly_report.totals.low_stock_items;

            // Update monthly breakdown table
            const tbody = document.getElementById('yearly-report-monthly-tbody');
            tbody.innerHTML = data.yearly_report.monthly_data.map(item => `
                <tr>
                    <td class="px-4 py-3 text-sm text-gray-900">${item.month}</td>
                    <td class="px-4 py-3 text-sm text-green-600">$${parseFloat(item.revenue).toLocaleString()}</td>
                    <td class="px-4 py-3 text-sm text-red-600">$${parseFloat(item.purchases).toLocaleString()}</td>
                    <td class="px-4 py-3 text-sm font-medium ${item.profit >= 0 ? 'text-green-600' : 'text-red-600'}">
                        $${parseFloat(item.profit).toLocaleString()}
                    </td>
                </tr>
            `).join('');
        }
    })
    .catch(error => console.error('Error loading yearly report:', error));
}

// Placeholder functions for report actions
function generateReport() {
    console.log('Generate report function called');
    // Implement report generation
}

function exportReport(type) {
    console.log('Export report as', type);
    // Implement export functionality
}

function printReport() {
    console.log('Print report function called');
    // Implement print functionality
}
