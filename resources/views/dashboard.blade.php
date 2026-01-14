<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Inventoria') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1D4ED8', // blue-700
                    }
                }
            }
        }
    </script>
<style>
    /* Existing styles... */

    /* Tooltip Styles */
    .tooltip-trigger {
        @apply cursor-help;
    }

    /* Optional: Add fade in animation */
    .group-hover\:block {
        animation: fadeIn 0.2s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .description-tooltip {
        cursor: help;
        position: relative;
        display: inline-block;
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .tooltip {
        visibility: hidden;
        position: absolute;
        z-index: 1000;
        bottom: 125%;
        left: 50%;
        transform: translateX(-50%);
        background-color: #1f2937;
        color: white;
        text-align: center;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        line-height: 1.4;
        white-space: normal;
        max-width: 300px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .description-tooltip:hover .tooltip {
        visibility: visible;
    }

    .tooltip::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #1f2937 transparent transparent transparent;
    }
</style>
    <!-- Custom Styles -->
    <style type="text/tailwindcss">
        @layer components {
            .nav-link {
                @apply px-4 py-2 text-sm text-gray-700 hover:text-gray-900;
            }

            .btn-primary {
                @apply px-8 py-3 text-sm font-semibold text-white bg-primary rounded-lg
                       hover:bg-blue-600 hover:shadow-lg transform hover:-translate-y-0.5
                       transition-all duration-200;
            }

            .feature-card {
                @apply p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow;
            }

            .form-input, .form-select, .form-textarea {
                @apply mt-1 block w-full rounded-lg border-gray-300
                       shadow-sm focus:border-blue-500 focus:ring-2
                       focus:ring-blue-500 focus:ring-opacity-50
                       hover:border-blue-400
                       transition-all duration-200;
            }

            .form-label {
                @apply block text-sm font-medium text-gray-700 mb-1;
            }

            .form-group {
                @apply space-y-1;
            }

            .modal-content {
                @apply bg-white rounded-lg shadow-xl
                       transform transition-all duration-300
                       scale-95 opacity-0;
            }

            .modal-content.show {
                @apply scale-100 opacity-100;
            }

            .btn-secondary {
                @apply px-6 py-3 text-sm font-semibold text-gray-700 bg-gray-100
                       hover:bg-gray-200 hover:shadow rounded-lg
                       transform hover:-translate-y-0.5
                       transition-all duration-200;
            }

            .input-group {
                @apply flex rounded-lg shadow-sm;
            }

            .input-group-text {
                @apply inline-flex items-center px-3 py-2 text-sm text-gray-700 bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg;
            }

            .view-tab-button {
                @apply px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700
                       border-b-2 border-transparent hover:border-gray-300
                       transition-colors duration-200 -mb-px;
            }

            .view-tab-button.active {
                @apply border-blue-500 text-blue-600;
            }

            .action-button {
                @apply inline-flex items-center justify-center w-8 h-8 rounded-lg
                       transition-all duration-200 mx-1;
            }

            .action-button.edit {
                @apply text-white bg-blue-500 hover:bg-blue-600
                       transform hover:-translate-y-0.5
                       hover:shadow-md;
            }

            .action-button.delete {
                @apply text-white bg-red-500 hover:bg-red-600
                       transform hover:-translate-y-0.5
                       hover:shadow-md;
            }

            /* Add a tooltip style */
            .action-button-tooltip {
                @apply relative group;
            }

            .action-button-tooltip::after {
                @apply content-[attr(data-tooltip)] absolute bottom-full left-1/2
                       -translate-x-1/2 px-2 py-1 rounded text-xs text-white
                       bg-gray-800 opacity-0 invisible transition-all duration-200
                       whitespace-nowrap mb-2;
            }

            .action-button-tooltip:hover::after {
                @apply opacity-100 visible;
            }

            .loading-spinner {
                @apply flex items-center justify-center p-8;
            }

            .loading-spinner-icon {
                @apply animate-spin rounded-full h-12 w-12 border-4 border-gray-200;
                border-top-color: #1D4ED8; /* primary color */
            }

            .loading-text {
                @apply text-gray-600 text-sm mt-4;
            }

            .section-content {
                @apply overflow-hidden transition-all duration-300;
            }

            .section-expanded {
                max-height: 1000px; /* Adjust based on content */
            }

            /* Tooltip Styles */
            .tooltip-trigger {
                @apply cursor-help;
            }

            /* Optional: Add fade in animation */
            .group-hover\:block {
                animation: fadeIn 0.2s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }
        }
    </style>

    <!-- Add these in the <head> section, after Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Add this in your <head> section if not already present -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Pagination Styles */
        .pagination {
            @apply flex justify-center items-center space-x-1;
        }
        .pagination > div {
            @apply flex items-center;
        }
        .pagination span.cursor-default {
            @apply px-3 py-1 rounded-md text-gray-500 bg-gray-100;
        }
        .pagination a {
            @apply px-3 py-1 rounded-md text-blue-600 hover:bg-blue-50;
        }
        .pagination span[aria-current="page"] {
            @apply px-3 py-1 rounded-md bg-blue-600 text-white;
        }
    </style>

    <!-- Add in head section -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    <!-- Add these styles -->
    <style>
        /* Tippy.js Custom Theme */
        .tippy-box[data-theme~='custom'] {
            @apply bg-gray-900 text-white text-sm rounded-lg shadow-lg;
            max-width: 300px;
        }

        .tippy-box[data-theme~='custom'][data-placement^='top'] > .tippy-arrow::before {
            @apply border-t-gray-900;
        }

        .tippy-box[data-theme~='custom'] .tippy-content {
            @apply p-3;
            word-break: break-word;
            white-space: pre-wrap;
        }

        /* Add hover effect to truncated text */
        .max-w-xs.truncate {
            @apply cursor-help hover:text-gray-900 transition-colors duration-200;
        }
    </style>
</head>

<body class="antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/80 backdrop-blur-sm border-b border-gray-100 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-semibold text-gray-800">Inventoria</span>
                </div>
                @if (Route::has('login'))
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link">Sign in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative min-h-screen flex">
        <!-- Sidebar -->
        <!-- Mobile Toggle Button (Visible only on mobile) -->
        <button id="sidebar-toggle" class="lg:hidden fixed bottom-4 right-4 z-50 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Overlay (for mobile) -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

        <!-- Sidebar Container -->
        <div id="sidebar-container" class="fixed lg:static top-0 left-0 h-full w-64 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 lg:z-0 bg-white shadow-xl lg:shadow">
            <div class="w-full h-full overflow-y-auto">
                <!-- Close Button (Mobile only) -->
                <button id="sidebar-close" class="lg:hidden absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>

        <!-- Sidebar Navigation -->
        <div class="bg-white rounded-lg shadow overflow-hidden mt-4 lg:mt-0">
            <nav class="space-y-1 p-2">
                <!-- Product Section -->
                <div class="p-2 bg-gray-50 border-b border-gray-200 cursor-pointer hover:bg-gray-100 transition-colors" onclick="toggleSection('product-section')">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Product</h3>
                        <i id="product-section-chevron" class="fas fa-chevron-down text-gray-600 transform transition-transform duration-300"></i>
                    </div>
                </div>
                <div id="product-section" class="section-content overflow-hidden transition-all duration-300">
                <a href="#" onclick="openItemModal(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    <i class="fas fa-plus w-5 text-gray-400"></i>
                    <span class="ml-2 text-sm">Add Product</span>
                </a>
                <a href="#" onclick="openFindItemModal(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    <i class="fas fa-search w-5 text-gray-400"></i>
                    <span class="ml-2 text-sm">Find Product</span>
                </a>
                <a href="#" onclick="openStockListModal(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    <i class="fas fa-list w-5 text-gray-400"></i>
                    <span class="ml-2 text-sm">Product List</span>
                </a>
                <a href="#" onclick="openTransferStockModal(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    <i class="fas fa-exchange-alt w-5 text-gray-400"></i>
                    <span class="ml-2 text-sm">Transfer Stock</span>
                </a>
                <a href="#" onclick="openViewModal(); switchViewTab('categories'); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    <i class="fas fa-tags w-5 text-gray-400"></i>
                    <span class="ml-2 text-sm">Category</span>
                </a>
                <a href="#" onclick="showBrandManagement(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    <i class="fas fa-copyright w-5 text-gray-400"></i>
                    <span class="ml-2 text-sm">Brand</span>
                </a>
                <a href="#" onclick="showUnitManagement(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    <i class="fas fa-weight w-5 text-gray-400"></i>
                    <span class="ml-2 text-sm">Unit</span>
                </a>
                <a href="#" onclick="printBarcode(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    <i class="fas fa-barcode w-5 text-gray-400"></i>
                    <span class="ml-2 text-sm">Print Barcode</span>
                </a>
                <a href="#" onclick="openAdjustmentListModal(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    <i class="fas fa-clipboard-list w-5 text-gray-400"></i>
                    <span class="ml-2 text-sm">Adjustment List</span>
                </a>
                <a href="#" onclick="openAddAdjustmentModal(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    <i class="fas fa-plus-circle w-5 text-gray-400"></i>
                    <span class="ml-2 text-sm">Add Adjustment</span>
                </a>
                <a href="#" onclick="openStockCountModal(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    <i class="fas fa-calculator w-5 text-gray-400"></i>
                    <span class="ml-2 text-sm">Stock Count</span>
                </a>
                <a href="#" onclick="openReportModal(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                    <i class="fas fa-chart-bar w-5 text-gray-400"></i>
                    <span class="ml-2 text-sm">Product Reports</span>
                </a>
                </div>

                <!-- Purchase Section -->
                        <div class="p-2 bg-gray-50 border-b border-gray-200 cursor-pointer hover:bg-gray-100 transition-colors" onclick="toggleSection('purchase-section')">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-800">Purchase</h3>
                                <i id="purchase-section-chevron" class="fas fa-chevron-down text-gray-600 transform transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="purchase-section" class="section-content overflow-hidden transition-all duration-300">
                            <a href="#" onclick="openOrderModal(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                                <i class="fas fa-shopping-cart w-5 text-gray-400"></i>
                                <span class="ml-2 text-sm">New Purchase</span>
                            </a>
                            <a href="#" onclick="toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                                <i class="fas fa-list-alt w-5 text-gray-400"></i>
                                <span class="ml-2 text-sm">Purchase List</span>
                            </a>
                            <a href="#" onclick="toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                                <i class="fas fa-truck w-5 text-gray-400"></i>
                                <span class="ml-2 text-sm">Suppliers</span>
                            </a>
                        </div>

                        <!-- Sales Section -->
                        <div class="p-2 bg-gray-50 border-b border-gray-200 cursor-pointer hover:bg-gray-100 transition-colors" onclick="toggleSection('sales-section')">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-800">Sales</h3>
                                <i id="sales-section-chevron" class="fas fa-chevron-down text-gray-600 transform transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="sales-section" class="section-content overflow-hidden transition-all duration-300">
                            <a href="#" onclick="toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                                <i class="fas fa-cart-plus w-5 text-gray-400"></i>
                                <span class="ml-2 text-sm">New Sale</span>
                            </a>
                            <a href="#" onclick="toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                                <i class="fas fa-list-ul w-5 text-gray-400"></i>
                                <span class="ml-2 text-sm">Sales List</span>
                            </a>
                            <a href="#" onclick="toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                                <i class="fas fa-users w-5 text-gray-400"></i>
                                <span class="ml-2 text-sm">Customers</span>
                            </a>
                        </div>

                        <!-- Reports Section -->
                        <div class="p-2 bg-gray-50 border-b border-gray-200 cursor-pointer hover:bg-gray-100 transition-colors" onclick="toggleSection('reports-section')">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-800">Reports</h3>
                                <i id="reports-section-chevron" class="fas fa-chevron-down text-gray-600 transform transition-transform duration-300"></i>
                            </div>
                        </div>
                        <div id="reports-section" class="section-content overflow-hidden transition-all duration-300">
                            <a href="#" onclick="openReportModal(); toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                                <i class="fas fa-chart-bar w-5 text-gray-400"></i>
                                <span class="ml-2 text-sm">Inventory Report</span>
                            </a>
                            <a href="#" onclick="toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                                <i class="fas fa-chart-line w-5 text-gray-400"></i>
                                <span class="ml-2 text-sm">Inventory by Location and Category</span>
                            </a>
                            <a href="#" onclick="toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                                <i class="fas fa-chart-pie w-5 text-gray-400"></i>
                                <span class="ml-2 text-sm">Inventory with Image by Category</span>
                            </a>
                            <a href="#" onclick="toggleSidebar(); return false;" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-blue-50 hover:text-blue-700">
                                <i class="fas fa-exclamation-triangle w-5 text-gray-400"></i>
                                <span class="ml-2 text-sm">Low level Stock</span>
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 lg:ml-0 mt-16 lg:mt-0">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8">
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 gap-2 mb-6">
                        <!-- Quick Stats -->
                        <div class="bg-blue-50 rounded-lg p-2">
                            <h3 class="text-sm font-semibold text-blue-800">Total Products</h3>
                            <p class="text-sm font-bold text-blue-600" data-stat="total-products">0</p>
                        </div>

                        <div class="bg-yellow-50 rounded-lg p-2">
                            <h3 class="text-sm font-semibold text-yellow-800">Low Stock Items</h3>
                            <p class="text-sm font-bold text-yellow-600" data-stat="low-stock">0</p>
                        </div>

                        <div class="bg-indigo-50 rounded-lg p-2">
                            <h3 class="text-sm font-semibold text-indigo-800">Total Value</h3>
                            <p class="text-sm font-bold text-indigo-600" data-stat="total-value">$0.00</p>
                        </div>
                    </div>

                    <!-- Financial Overview -->
                    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
                        <!-- Revenue -->
                        <div class="bg-green-50 rounded-lg p-3 sm:p-4 border-l-4 border-green-500">
                            <div class="flex items-center justify-between">
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-xs sm:text-sm font-medium text-green-800 truncate">Revenue</h3>
                                    <p class="text-lg sm:text-2xl font-bold text-green-600" data-financial="revenue">$0.00</p>
                                </div>
                                <div class="text-green-500 ml-2 flex-shrink-0">
                                    <i class="fas fa-arrow-up text-xl sm:text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Sale Return -->
                        <div class="bg-orange-50 rounded-lg p-3 sm:p-4 border-l-4 border-orange-500">
                            <div class="flex items-center justify-between">
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-xs sm:text-sm font-medium text-orange-800 truncate">Sale Return</h3>
                                    <p class="text-lg sm:text-2xl font-bold text-orange-600" data-financial="sale-return">$0.00</p>
                                </div>
                                <div class="text-orange-500 ml-2 flex-shrink-0">
                                    <i class="fas fa-undo text-xl sm:text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Purchase Return -->
                        <div class="bg-red-50 rounded-lg p-3 sm:p-4 border-l-4 border-red-500">
                            <div class="flex items-center justify-between">
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-xs sm:text-sm font-medium text-red-800 truncate">Purchase Return</h3>
                                    <p class="text-lg sm:text-2xl font-bold text-red-600" data-financial="purchase-return">$0.00</p>
                                </div>
                                <div class="text-red-500 ml-2 flex-shrink-0">
                                    <i class="fas fa-reply text-xl sm:text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Cash Flow -->
                        <div class="bg-blue-50 rounded-lg p-3 sm:p-4 border-l-4 border-blue-500">
                            <div class="flex items-center justify-between">
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-xs sm:text-sm font-medium text-blue-800 truncate">Cash Flow</h3>
                                    <p class="text-lg sm:text-2xl font-bold text-blue-600" data-financial="cash-flow">$0.00</p>
                                </div>
                                <div class="text-blue-500 ml-2 flex-shrink-0">
                                    <i class="fas fa-exchange-alt text-xl sm:text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profit Section -->
                    <div class="bg-gradient-to-r from-purple-500 to-indigo-600 rounded-lg p-6 mb-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">Total Profit</h3>
                                <p class="text-3xl font-bold" data-financial="profit">$0.00</p>
                            </div>
                            <div class="text-white opacity-80">
                                <i class="fas fa-chart-line text-4xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 text-sm opacity-90">
                            <span class="inline-block mr-4">
                                <i class="fas fa-calendar-alt mr-1"></i>This Month
                            </span>
                            <span class="inline-block">
                                <i class="fas fa-trending-up mr-1"></i>vs Last Month
                            </span>
                        </div>
                    </div>

                    <!-- Yearly Statistics -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <!-- Purchases -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Yearly Purchases</h3>
                                <div class="bg-red-100 text-red-600 p-2 rounded-full">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-red-600 mb-2" data-yearly="purchases">$0.00</div>
                            <div class="text-sm text-gray-600">
                                <span class="text-green-600">
                                    <i class="fas fa-arrow-up mr-1"></i>+12.5%
                                </span>
                                vs last year
                            </div>
                        </div>

                        <!-- Revenue -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Yearly Revenue</h3>
                                <div class="bg-green-100 text-green-600 p-2 rounded-full">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-green-600 mb-2" data-yearly="revenue">$0.00</div>
                            <div class="text-sm text-gray-600">
                                <span class="text-green-600">
                                    <i class="fas fa-arrow-up mr-1"></i>+8.2%
                                </span>
                                vs last year
                            </div>
                        </div>

                        <!-- Expenses -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Yearly Expenses</h3>
                                <div class="bg-yellow-100 text-yellow-600 p-2 rounded-full">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-yellow-600 mb-2" data-yearly="expenses">$0.00</div>
                            <div class="text-sm text-gray-600">
                                <span class="text-red-600">
                                    <i class="fas fa-arrow-down mr-1"></i>-3.1%
                                </span>
                                vs last year
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="w-full bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Latest Products</h2>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Item Code
                                            </th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Description
                                            </th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Category
                                            </th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Supplier
                                            </th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Location
                                            </th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Quantity
                                            </th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 latest-products-tbody">
                                        @forelse ($latestProducts as $product)
                                            <tr>
                                                <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $product->item_code }}
                                                </td>
                                                <td class="px-2 py-4 text-sm text-gray-500">
                                                    <div class="description-tooltip" title="{{ $product->description }}">
                                                        {{ \Str::limit($product->description, 30) }}
                                                    </div>
                                                </td>
                                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $product->category?->name ?? 'N/A' }}
                                                </td>
                                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $product->supplier?->name ?? 'N/A' }}
                                                </td>
                                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $product->location?->name ?? 'N/A' }}
                                                </td>
                                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $product->quantity }}
                                                </td>
                                                <td class="px-2 py-4 whitespace-nowrap">
                                                    @if($product->quantity <= $product->warn_quantity)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            Low Stock
                                                        </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            In Stock
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    No products found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $latestProducts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                <!-- Item Modal -->
                <div id="itemModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-6 border w-11/12 md:w-3/4 lg:w-1/2 modal-content">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Add New Item</h3>
                            <button onclick="closeItemModal()" class="text-gray-600 hover:text-gray-800">&times;</button>
                        </div>

                        <!-- Tabs -->
                        <div class="mb-4 border-b">
                            <div class="flex">
                                <button onclick="switchTab('basic')" class="px-4 py-2 border-b-2 border-blue-500" id="basicTab">Basic Info</button>
                                <button onclick="switchTab('inventory')" class="px-4 py-2" id="inventoryTab">Inventory</button>
                            </div>
                        </div>

                        <form id="itemForm" class="space-y-6">
                            <!-- Basic Info Tab -->
                            <div id="basicInfo">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label class="form-label">Item Code</label>
                                        <div class="input-group">
                                            <span class="input-group-text">ITM</span>
                                            <input type="text" id="itemCode" name="item_code" readonly class="form-input rounded-l-none">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <input type="text" name="description" class="form-input" placeholder="Enter item description" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Category</label>
                                        <div class="flex gap-2">
                                            <select name="category_id" class="form-select">
                                                <!-- Categories will be populated via AJAX -->
                                            </select>
                                            <button type="button" onclick="openNewCategoryModal()"
                                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Sub Category</label>
                                        <input type="text" name="sub_category" class="form-input">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Unit Purchase Cost</label>
                                        <input type="number" step="0.01" name="purchase_cost" class="form-input">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Unit Sales Price</label>
                                        <input type="number" step="0.01" name="sales_price" class="form-input">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Unit Measure</label>
                                        <select name="unit_measure" class="form-select">
                                            <option value="feet">Feet</option>
                                            <option value="meter">Meter</option>
                                            <option value="pound">Pound</option>
                                            <option value="kg">Kilogram</option>
                                            <option value="sack">Sack</option>
                                            <option value="dozen">Dozen</option>
                                        </select>
                                    </div>

                                    <div class="col-span-2">
                                        <label class="form-label">Notes</label>
                                        <textarea name="notes" rows="3" class="form-textarea" placeholder="Enter any notes about the item"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Inventory Tab -->
                            <div id="inventoryInfo" class="hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="form-group">
                                        <label class="form-label">Location</label>
                                        <select name="location_id" class="form-select">
                                            <!-- Locations will be populated via AJAX -->
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" name="quantity" class="form-input">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Ideal Quantity</label>
                                        <input type="number" name="ideal_quantity" class="form-input">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Warning Quantity</label>
                                        <input type="number" name="warn_quantity" class="form-input">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Default Supplier</label>
                                        <select name="supplier_id" class="form-select">
                                            <!-- Suppliers will be populated via AJAX -->
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Supplier Part Number</label>
                                        <input type="text" name="supplier_part_number" class="form-input">
                                    </div>

                                    <div class="col-span-2">
                                        <label class="form-label">Product Images</label>
                                        <input type="file" name="images[]" multiple class="form-input" accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end gap-4">
                                <button type="button" onclick="closeItemModal()" class="btn-secondary">Cancel</button>
                                <button type="submit" class="btn-primary">Add Item</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Add this after the Item Modal -->
                <div id="categoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-6 border w-96 modal-content">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Add New Category</h3>
                            <button onclick="closeCategoryModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form id="categoryForm" class="space-y-6">
                            <div class="form-group">
                                <label class="form-label">Category Name</label>
                                <input type="text" name="name" required class="form-input" placeholder="Enter category name">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="description" rows="3" class="form-textarea" placeholder="Enter category description"></textarea>
                            </div>

                            <div class="flex justify-end gap-4 mt-6">
                                <button type="button" onclick="closeCategoryModal()" class="btn-secondary">
                                    Cancel
                                </button>
                                <button type="submit" class="btn-primary">
                                    Add Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Add the Reports Modal -->
                <div id="reportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-6 border w-11/12 xl:w-3/4 modal-content bg-white rounded-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Inventory Reports</h3>
                            <button onclick="closeReportModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Report Summary -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-blue-800">Total Items</h4>
                                <p class="text-2xl font-bold text-blue-600" id="reportTotalItems">0</p>
                            </div>
                            <div class="bg-green-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-green-800">Total Value</h4>
                                <p class="text-2xl font-bold text-green-600" id="reportTotalValue">$0.00</p>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-purple-800">Low Stock Items</h4>
                                <p class="text-2xl font-bold text-purple-600" id="reportLowStock">0</p>
                            </div>
                        </div>

                        <!-- Filters -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h4 class="text-sm font-semibold mb-4">Filters</h4>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="form-group">
                                    <label class="form-label">Location</label>
                                    <select id="filterLocation" class="form-select">
                                        <option value="">All Locations</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <select id="filterCategory" class="form-select">
                                        <option value="">All Categories</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Supplier</label>
                                    <select id="filterSupplier" class="form-select">
                                        <option value="">All Suppliers</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Report Type</label>
                                    <select id="reportType" class="form-select">
                                        <option value="inventory">Inventory Report</option>
                                        <option value="sales">Sales Report</option>
                                        <option value="lowStock">Low Stock Report</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <button onclick="generateReport()" class="btn-primary">
                                    Generate Report
                                </button>
                            </div>
                        </div>

                        <!-- Report Table -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Code</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Cost</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Value</th>
                                        </tr>
                                    </thead>
                                    <tbody id="reportTableBody" class="bg-white divide-y divide-gray-200">
                                        <!-- Report data will be inserted here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Report Actions -->
                        <div class="mt-6 flex justify-end gap-4">
                            <button onclick="exportReport('pdf')" class="btn-secondary">
                                <i class="fas fa-file-pdf mr-2"></i>Export PDF
                            </button>
                            <button onclick="exportReport('excel')" class="btn-secondary">
                                <i class="fas fa-file-excel mr-2"></i>Export Excel
                            </button>
                            <button onclick="printReport()" class="btn-secondary">
                                <i class="fas fa-print mr-2"></i>Print
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Add the View Modal -->
                <div id="viewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-6 border w-11/12 xl:w-3/4 modal-content bg-white rounded-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Manage Data</h3>
                            <button onclick="closeViewModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Tabs -->
                        <div class="border-b border-gray-200 mb-6">
                            <nav class="flex -mb-px">
                                <button onclick="switchViewTab('categories')" class="view-tab-button active" data-tab="categories">
                                    Categories
                                </button>
                                <button onclick="switchViewTab('locations')" class="view-tab-button" data-tab="locations">
                                    Locations
                                </button>
                                <button onclick="switchViewTab('suppliers')" class="view-tab-button" data-tab="suppliers">
                                    Suppliers
                                </button>
                                <button onclick="switchViewTab('brands')" class="view-tab-button" data-tab="brands">
                                    Brands
                                </button>
                                <button onclick="switchViewTab('units')" class="view-tab-button" data-tab="units">
                                    Units
                                </button>
                            </nav>
                        </div>

                        <!-- Content Area -->
                        <div class="view-content">
                            <!-- Categories Tab -->
                            <div id="categoriesTab" class="view-tab-content">
                                <div class="flex justify-between mb-4">
                                    <h4 class="text-lg font-semibold">Categories</h4>
                                    <button onclick="openNewCategoryModal()" class="btn-primary">
                                        <i class="fas fa-plus mr-2"></i>Add Category
                                    </button>
                                </div>
                                <div class="bg-white rounded-lg shadow overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items Count</th>
                                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="categoriesTableBody" class="bg-white divide-y divide-gray-200">
                                            <!-- Categories will be loaded here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Locations Tab -->
                            <div id="locationsTab" class="view-tab-content hidden">
                                <div class="flex justify-between mb-4">
                                    <h4 class="text-lg font-semibold">Locations</h4>
                                    <button onclick="openNewLocationModal()" class="btn-primary">
                                        <i class="fas fa-plus mr-2"></i>Add Location
                                    </button>
                                </div>
                                <div class="bg-white rounded-lg shadow overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="locationsTableBody" class="bg-white divide-y divide-gray-200">
                                            <!-- Locations will be loaded here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Suppliers Tab -->
                            <div id="suppliersTab" class="view-tab-content hidden">
                                <div class="flex justify-between mb-4">
                                    <h4 class="text-lg font-semibold">Suppliers</h4>
                                    <button onclick="openNewSupplierModal()" class="btn-primary">
                                        <i class="fas fa-plus mr-2"></i>Add Supplier
                                    </button>
                                </div>
                                <div class="bg-white rounded-lg shadow overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Person</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="suppliersTableBody" class="bg-white divide-y divide-gray-200">
                                            <!-- Suppliers will be loaded here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Brands Tab -->
                            <div id="brandsTab" class="view-tab-content hidden">
                                <div class="flex justify-between mb-4">
                                    <h4 class="text-lg font-semibold">Brands</h4>
                                    <button onclick="openAddBrandModal()" class="btn-primary">
                                        <i class="fas fa-plus mr-2"></i>Add Brand
                                    </button>
                                </div>
                                <div class="bg-white rounded-lg shadow overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items Count</th>
                                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="brandsTableBody" class="bg-white divide-y divide-gray-200">
                                            <!-- Brands will be loaded here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Units Tab -->
                            <div id="unitsTab" class="view-tab-content hidden">
                                <div class="flex justify-between mb-4">
                                    <h4 class="text-lg font-semibold">Units</h4>
                                    <button onclick="openAddUnitModal()" class="btn-primary">
                                        <i class="fas fa-plus mr-2"></i>Add Unit
                                    </button>
                                </div>
                                <div class="bg-white rounded-lg shadow overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Symbol</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="unitsTableBody" class="bg-white divide-y divide-gray-200">
                                            <!-- Units will be loaded here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Category Modal -->
                <div id="editCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Edit Category</h3>
                            <button onclick="closeEditCategoryModal()" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form id="editCategoryForm" class="space-y-4">
                            <input type="hidden" name="category_id" id="editCategoryId">
                            <div class="form-group">
                                <label class="form-label">Category Name</label>
                                <input type="text" name="name" id="editCategoryName" required class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="editCategoryDescription" rows="3" class="form-textarea"></textarea>
                            </div>
                            <div class="flex justify-end gap-4">
                                <button type="button" onclick="closeEditCategoryModal()" class="btn-secondary">Cancel</button>
                                <button type="submit" class="btn-primary">Update Category</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Location Modal -->
                <div id="editLocationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Edit Location</h3>
                            <button onclick="closeEditLocationModal()" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form id="editLocationForm" class="space-y-4">
                            <input type="hidden" name="location_id" id="editLocationId">
                            <div class="form-group">
                                <label class="form-label">Location Name</label>
                                <input type="text" name="name" id="editLocationName" required class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Type</label>
                                <select name="type" id="editLocationType" class="form-select">
                                    <option value="warehouse">Warehouse</option>
                                    <option value="store">Store</option>
                                    <option value="shop">Shop</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <textarea name="address" id="editLocationAddress" rows="3" class="form-textarea"></textarea>
                            </div>
                            <div class="flex justify-end gap-4">
                                <button type="button" onclick="closeEditLocationModal()" class="btn-secondary">Cancel</button>
                                <button type="submit" class="btn-primary">Update Location</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Supplier Modal -->
                <div id="editSupplierModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Edit Supplier</h3>
                            <button onclick="closeEditSupplierModal()" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form id="editSupplierForm" class="space-y-4">
                            <input type="hidden" name="supplier_id" id="editSupplierId">
                            <div class="form-group">
                                <label class="form-label">Supplier Name</label>
                                <input type="text" name="name" id="editSupplierName" required class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Contact Person</label>
                                <input type="text" name="contact_person" id="editSupplierContact" class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="editSupplierEmail" class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" id="editSupplierPhone" class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <textarea name="address" id="editSupplierAddress" rows="3" class="form-textarea"></textarea>
                            </div>
                            <div class="flex justify-end gap-4">
                                <button type="button" onclick="closeEditSupplierModal()" class="btn-secondary">Cancel</button>
                                <button type="submit" class="btn-primary">Update Supplier</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Find Item Modal -->
                <div id="findItemModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-6 border w-11/12 md:w-4/5 lg:w-5/6 modal-content bg-white rounded-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Find Item</h3>
                            <button onclick="closeFindItemModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Search Filters -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div class="form-group">
                                    <label class="form-label">Search by Item Code or Description</label>
                                    <input type="text" id="searchQuery" class="form-input" placeholder="Enter item code or description">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <select id="searchCategory" class="form-select">
                                        <option value="">All Categories</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Location</label>
                                    <select id="searchLocation" class="form-select">
                                        <option value="">All Locations</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Supplier</label>
                                    <select id="searchSupplier" class="form-select">
                                        <option value="">All Suppliers</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <button onclick="searchItems()" class="btn-primary">
                                    <i class="fas fa-search mr-2"></i>Search
                                </button>
                                <button onclick="clearSearch()" class="btn-secondary">
                                    <i class="fas fa-times mr-2"></i>Clear
                                </button>
                            </div>
                        </div>

                        <!-- Results Table -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Code</th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="searchResultsBody" class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                                Enter search criteria and click Search to find items
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stock List Modal -->
                <div id="stockListModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-6 border w-11/12 md:w-4/5 lg:w-5/6 modal-content bg-white rounded-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Stock List</h3>
                            <button onclick="closeStockListModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Filters -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="form-group">
                                    <label class="form-label">Location</label>
                                    <select id="stockListLocationFilter" class="form-select">
                                        <option value="">All Locations</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <select id="stockListCategoryFilter" class="form-select">
                                        <option value="">All Categories</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Supplier</label>
                                    <select id="stockListSupplierFilter" class="form-select">
                                        <option value="">All Suppliers</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Stock Status</label>
                                    <select id="stockListStatusFilter" class="form-select">
                                        <option value="">All Items</option>
                                        <option value="in_stock">In Stock</option>
                                        <option value="low_stock">Low Stock</option>
                                        <option value="out_of_stock">Out of Stock</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <button onclick="loadStockList()" class="btn-primary">
                                    <i class="fas fa-search mr-2"></i>Filter
                                </button>
                                <button onclick="clearStockListFilters()" class="btn-secondary">
                                    <i class="fas fa-times mr-2"></i>Clear
                                </button>
                                <button onclick="exportStockList('csv')" class="btn-secondary">
                                    <i class="fas fa-download mr-2"></i>Export CSV
                                </button>
                            </div>
                        </div>

                        <!-- Stock Summary -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-blue-800">Total Items</h4>
                                <p class="text-2xl font-bold text-blue-600" id="stockTotalItems">0</p>
                            </div>
                            <div class="bg-green-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-green-800">Total Value</h4>
                                <p class="text-2xl font-bold text-green-600" id="stockTotalValue">$0.00</p>
                            </div>
                            <div class="bg-yellow-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-yellow-800">Low Stock Items</h4>
                                <p class="text-2xl font-bold text-yellow-600" id="stockLowStock">0</p>
                            </div>
                            <div class="bg-red-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-red-800">Out of Stock</h4>
                                <p class="text-2xl font-bold text-red-600" id="stockOutOfStock">0</p>
                            </div>
                        </div>

                        <!-- Stock Table -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Code</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Min Qty</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Value</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Updated</th>
            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="stockListTableBody" class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td colspan="11" class="px-6 py-4 text-center text-gray-500">
                                                Loading stock data...
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transfer Stock Modal -->
                <div id="transferStockModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-6 border w-11/12 md:w-4/5 lg:w-3/4 modal-content bg-white rounded-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Transfer Stock</h3>
                            <button onclick="closeTransferStockModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="space-y-6">
                            <!-- Transfer Form -->
                            <form id="transferStockForm" class="space-y-6">
                                <!-- Source Selection -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Source</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="form-group">
                                            <label class="form-label">From Location</label>
                                            <select name="from_location_id" id="transferFromLocation" class="form-select" required>
                                                <option value="">Select Source Location</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Item</label>
                                            <select name="product_id" id="transferProduct" class="form-select" required>
                                                <option value="">Select Item to Transfer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="bg-white rounded-lg p-4 border">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Available Quantity</label>
                                                    <p class="text-lg font-semibold text-blue-600" id="availableQuantity">0</p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Unit Price</label>
                                                    <p class="text-lg font-semibold text-green-600" id="itemUnitPrice">$0.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Destination Selection -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Destination</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="form-group">
                                            <label class="form-label">To Location</label>
                                            <select name="to_location_id" id="transferToLocation" class="form-select" required>
                                                <option value="">Select Destination Location</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Transfer Quantity</label>
                                            <input type="number" name="quantity" id="transferQuantity" class="form-input" min="1" required placeholder="Enter quantity to transfer">
                                        </div>
                                    </div>
                                </div>

                                <!-- Transfer Details -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Transfer Details</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="form-group">
                                            <label class="form-label">Transfer Date</label>
                                            <input type="date" name="transfer_date" class="form-input" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Reference Number</label>
                                            <input type="text" name="reference" id="transferReference" class="form-input" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Notes</label>
                                        <textarea name="notes" rows="3" class="form-textarea" placeholder="Optional notes about the transfer"></textarea>
                                    </div>
                                </div>

                                <!-- Transfer Summary -->
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <h4 class="text-lg font-semibold text-blue-800 mb-4">Transfer Summary</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div class="text-center">
                                            <label class="block text-sm font-medium text-gray-700">Item</label>
                                            <p class="text-lg font-semibold text-blue-600" id="summaryItem">-</p>
                                        </div>
                                        <div class="text-center">
                                            <label class="block text-sm font-medium text-gray-700">Quantity</label>
                                            <p class="text-lg font-semibold text-blue-600" id="summaryQuantity">-</p>
                                        </div>
                                        <div class="text-center">
                                            <label class="block text-sm font-medium text-gray-700">Value</label>
                                            <p class="text-lg font-semibold text-green-600" id="summaryValue">$0.00</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex justify-end gap-4">
                                    <button type="button" onclick="closeTransferStockModal()" class="btn-secondary">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn-primary">
                                        <i class="fas fa-exchange-alt mr-2"></i>Transfer Stock
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- View Item Modal -->
                <div id="viewItemModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-6 border w-11/12 md:w-3/4 lg:w-1/2 modal-content bg-white rounded-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Item Details</h3>
                            <button onclick="closeViewItemModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div id="itemDetailsContent" class="space-y-6">
                            <!-- Item details will be loaded here -->
                        </div>

                        <div class="flex justify-end gap-4 mt-6">
                            <button onclick="closeViewItemModal()" class="btn-secondary">Close</button>
                            <button onclick="editCurrentItem()" class="btn-primary">
                                <i class="fas fa-edit mr-2"></i>Edit Item
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Add Category Modal -->
                <div id="addCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Add New Category</h3>
                            <button onclick="closeAddCategoryModal()" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form id="addCategoryForm" class="space-y-4">
                            <div class="form-group">
                                <label class="form-label">Category Name</label>
                                <input type="text" name="name" required class="form-input" placeholder="Enter category name">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="description" rows="3" class="form-textarea" placeholder="Enter description"></textarea>
                            </div>
                            <div class="flex justify-end gap-4">
                                <button type="button" onclick="closeAddCategoryModal()" class="btn-secondary">Cancel</button>
                                <button type="submit" class="btn-primary">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Add Location Modal -->
                <div id="addLocationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Add New Location</h3>
                            <button onclick="closeAddLocationModal()" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form id="addLocationForm" class="space-y-4">
                            <div class="form-group">
                                <label class="form-label">Location Name</label>
                                <input type="text" name="name" required class="form-input" placeholder="Enter location name">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Type</label>
                                <select name="type" required class="form-select">
                                    <option value="warehouse">Warehouse</option>
                                    <option value="store">Store</option>
                                    <option value="shop">Shop</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <textarea name="address" rows="3" class="form-textarea" placeholder="Enter address"></textarea>
                            </div>
                            <div class="flex justify-end gap-4">
                                <button type="button" onclick="closeAddLocationModal()" class="btn-secondary">Cancel</button>
                                <button type="submit" class="btn-primary">Add Location</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Add Supplier Modal -->
                <div id="addSupplierModal" class="fixed inset-0 z-40 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Add New Supplier</h3>
                            <button onclick="closeAddSupplierModal()" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form id="addSupplierForm" class="space-y-4 z-40">
                            <div class="form-group">
                                <label class="form-label">Supplier Name</label>
                                <input type="text" name="name" required class="form-input" placeholder="Enter supplier name">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Contact Person</label>
                                <input type="text" name="contact_person" class="form-input" placeholder="Enter contact person">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-input" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-input" placeholder="Enter phone">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <textarea name="address" rows="3" class="form-textarea" placeholder="Enter address"></textarea>
                            </div>
                            <div class="flex justify-end gap-4">
                                <button type="button" onclick="closeAddSupplierModal()" class="btn-secondary">Cancel</button>
                                <button type="submit" class="btn-primary">Add Supplier</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Add Order Stock Modal -->
                <div id="orderModal" class="fixed inset-0 z-10 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-5 border w-11/12 xl:w-4/5 modal-content bg-white rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-semibold text-gray-800">New Purchase Order</h3>
                            <button onclick="closeOrderModal()" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form id="orderForm" class="space-y-6 z-10">
                            <!-- Header Section -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Left Column -->
                                <div class="space-y-4">
                                    <div class="form-group">
                                        <label class="form-label">Order Supplier</label>
                                        <div class="flex gap-2">
                                            <select name="supplier_id" class="form-select flex-1" required>
                                                <!-- Suppliers will be loaded here -->
                                            </select>
                                            <button type="button" onclick="openNewSupplierModal()"
                                                    class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Expected Receipt Date</label>
                                        <input type="date" name="expected_date" class="form-input" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Bill To</label>
                                        <textarea name="billing_address" rows="2" class="form-textarea" required></textarea>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="space-y-4">
                                    <div class="form-group">
                                        <label class="form-label">Issue Date</label>
                                        <input type="date" name="issue_date" class="form-input" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Ship To Location</label>
                                        <select name="location_id" class="form-select" required>
                                            <!-- Locations will be loaded here -->
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Ship To Address</label>
                                        <textarea name="shipping_address" rows="2" class="form-textarea" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label class="form-label">Tracking Ref#</label>
                                    <input type="text" name="tracking_ref" class="form-input">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Ship By</label>
                                    <div class="flex gap-2">
                                        <select name="ship_by" class="form-select flex-1">
                                            <!-- Ship by options will be loaded here -->
                                        </select>
                                        <button type="button" onclick="openShipByModal()"
                                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items Table -->
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left">Item</th>
                                            <th class="px-4 py-2 text-left">Quantity</th>
                                            <th class="px-4 py-2 text-left">Unit Price</th>
                                            <th class="px-4 py-2 text-left">Total</th>
                                            <th class="px-4 py-2"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="orderItemsBody">
                                        <!-- Rows will be added here -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="px-4 py-2 text-right font-semibold">Order Total:</td>
                                            <td class="px-4 py-2">
                                                <span id="orderTotal">0.00</span>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="mt-4">
                                <button type="button" onclick="addOrderRow()" class="btn-secondary">
                                    <i class="fas fa-plus mr-2"></i>Add Row
                                </button>
                            </div>

                            <!-- Notes Section -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label class="form-label">Order Note</label>
                                    <textarea name="order_note" rows="2" class="form-textarea"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Internal Note</label>
                                    <textarea name="internal_note" rows="2" class="form-textarea"></textarea>
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-right">Subtotal:</div>
                                    <div class="font-semibold" id="orderSubtotal">$0.00</div>
                                    <div class="text-right">Total:</div>
                                    <div class="font-semibold text-lg" id="orderTotal">$0.00</div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-end gap-4">
                                <button type="button" onclick="closeOrderModal()" class="btn-secondary">
                                    Cancel
                                </button>
                                <button type="submit" name="action" value="record" class="btn-secondary">
                                    <i class="fas fa-save mr-2"></i>Record
                                </button>
                                <button type="submit" name="action" value="print" class="btn-primary">
                                    <i class="fas fa-print mr-2"></i>Record & Print
                                </button>
                                <button type="submit" name="action" value="email" class="btn-primary">
                                    <i class="fas fa-envelope mr-2"></i>Record & Email
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ship By Modal -->
    <div id="shipByModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Add New Shipping Method</h3>
                <button type="button" onclick="closeShipByModal()" class="text-gray-500 hover:text-gray-700">×</button>
            </div>

            <form id="shipByForm" action="{{ route('ship-by.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div class="form-group">
                        <label class="form-label">Method Name</label>
                        <input type="text" name="name" required class="form-input w-full">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3" class="form-textarea w-full"></textarea>
                    </div>
                    <div class="flex justify-end gap-4">
                        <button type="button" onclick="closeShipByModal()" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">Add Method</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!-- Add this before closing body tag -->
    <script>
        function generateItemCode() {
            const prefix = 'ITM';
            const timestamp = Date.now().toString().slice(-6);
            const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            return `${prefix}${timestamp}${random}`;
        }

        function openItemModal() {
            const modal = document.getElementById('itemModal');
            const content = modal.querySelector('.modal-content');
            modal.classList.remove('hidden');
            // Trigger animation
            setTimeout(() => content.classList.add('show'), 10);

            // Generate and set the item code
            const itemCode = generateItemCode();
            document.getElementById('itemCode').value = itemCode;
            // Add a hidden input for the item code
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'item_code';
            hiddenInput.value = itemCode;
            document.getElementById('itemForm').appendChild(hiddenInput);

            loadCategories();
            loadLocations();
            loadSuppliers();
        }

        function closeItemModal() {
            const modal = document.getElementById('itemModal');
            const content = modal.querySelector('.modal-content');
            content.classList.remove('show');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function switchTab(tab) {
            const basicInfo = document.getElementById('basicInfo');
            const inventoryInfo = document.getElementById('inventoryInfo');
            const basicTab = document.getElementById('basicTab');
            const inventoryTab = document.getElementById('inventoryTab');

            if (tab === 'basic') {
                basicInfo.classList.remove('hidden');
                inventoryInfo.classList.add('hidden');
                basicTab.classList.add('border-blue-500');
                inventoryTab.classList.remove('border-blue-500');
            } else {
                basicInfo.classList.add('hidden');
                inventoryInfo.classList.remove('hidden');
                basicTab.classList.remove('border-blue-500');
                inventoryTab.classList.add('border-blue-500');
            }
        }

        document.getElementById('itemForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            // Add CSRF token to form data
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            // Check if we're in edit mode
            const isEditMode = this.dataset.mode === 'edit';

            try {
                // Show loading state
                Swal.fire({
                    title: isEditMode ? 'Updating product...' : 'Adding product...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Log the form data for debugging
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }

                let url = '/products';
                let method = 'POST';

                if (isEditMode) {
                    // Get the item ID from the hidden input
                    const itemId = document.getElementById('editItemId').value;
                    url = `/products/${itemId}`;
                    method = 'PUT';
                }

                const response = await fetch(url, {
                    method: method,
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const contentType = response.headers.get('content-type');
                let result;

                if (contentType && contentType.includes('application/json')) {
                    result = await response.json();
                } else {
                    result = await response.text();
                }

                if (!response.ok) {
                    // Handle validation errors
                    if (response.status === 422) {
                        const errors = result.errors;
                        const errorMessages = Object.values(errors).flat().join('\n');
                        throw new Error(`Validation failed:\n${errorMessages}`);
                    }
                    throw new Error(`Failed to ${isEditMode ? 'update' : 'add'} product: ${response.status} - ${result}`);
                }

                // Success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: `Product ${isEditMode ? 'updated' : 'added'} successfully!`,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    // Refresh the latest products table and stats without full page reload
                    refreshLatestProductsTable();
                });

                closeItemModal();
                updateDashboardStats(); // Update stats after adding/updating product
            } catch (error) {
                console.error('Error:', error);

                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || `Error ${isEditMode ? 'updating' : 'adding'} product. Please try again.`
                });
            } finally {
                // Reset form mode
                this.dataset.mode = '';
                // Remove edit ID if it exists
                const editId = document.getElementById('editItemId');
                if (editId) {
                    editId.remove();
                }
            }
        });

        // Add these functions to populate dropdowns
        async function loadCategories() {
            const select = document.querySelector('select[name="category_id"]');
            try {
                select.innerHTML = '';

                const response = await fetch('/categories', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to load categories');
                }

                const categories = await response.json();

                const placeholder = new Option('Select a category', '');
                placeholder.disabled = true;
                placeholder.selected = true;
                select.add(placeholder);

                categories.forEach(category => {
                    const option = new Option(category.name, category.id);
                    select.add(option);
                });
            } catch (error) {
                console.error('Error loading categories:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to load categories. Please try again.'
                });
            }
        }

        async function loadLocations() {
            const select = document.querySelector('select[name="location_id"]');
            try {
                select.innerHTML = '';

                const response = await fetch('/locations', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to load locations');
                }

                const locations = await response.json();

                const placeholder = new Option('Select a location', '');
                placeholder.disabled = true;
                placeholder.selected = true;
                select.add(placeholder);

                locations.forEach(location => {
                    const option = new Option(location.name, location.id);
                    select.add(option);
                });
            } catch (error) {
                console.error('Error loading locations:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to load locations. Please try again.'
                });
            }
        }

        async function loadSuppliers() {
            const select = document.querySelector('select[name="supplier_id"]');
            try {
                select.innerHTML = '';

                const response = await fetch('/suppliers', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to load suppliers');
                }

                const suppliers = await response.json();

                const placeholder = new Option('Select a supplier', '');
                placeholder.disabled = true;
                placeholder.selected = true;
                select.add(placeholder);

                suppliers.forEach(supplier => {
                    const option = new Option(supplier.name, supplier.id);
                    select.add(option);
                });
            } catch (error) {
                console.error('Error loading suppliers:', error);
                // Show an error message to the user
                showToast('Error loading suppliers. Please try again.', 'error');
            }
        }

        function openNewCategoryModal() {
            document.getElementById('addCategoryModal').classList.remove('hidden');
        }

        function closeAddCategoryModal() {
            document.getElementById('addCategoryModal').classList.add('hidden');
            document.getElementById('addCategoryForm').reset();
        }

        // Helper function for error logging
        function logError(error, context) {
            console.group(context);
                console.error('Error:', error);
            console.error('Stack:', error.stack);
            console.groupEnd();
        }

        // Helper function for form submission
        async function submitForm(url, formData, successMessage, closeModalFn, reloadFn) {
            try {
                showLoading('Submitting...');
                const data = Object.fromEntries(formData);
                console.log('Submitting data:', data); // Debug log

                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Failed to submit form');
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: successMessage,
                    timer: 1500,
                    showConfirmButton: false
                });

                closeModalFn();
                if (reloadFn) await reloadFn();

                return result;
            } catch (error) {
                console.error('Form Submission Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'An error occurred while submitting the form'
                });
                throw error;
            }
        }

        // Update category form submission
        document.getElementById('addCategoryForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            try {
                await submitForm(
                    '/categories',
                    new FormData(this),
                    'Category added successfully',
                    () => {
                        this.reset();
                        closeAddCategoryModal();
                    },
                    async () => {
                        await loadCategoriesTable();
                        await loadCategories();
                    }
                );
            } catch (error) {
                // Error already handled by submitForm
            }
        });

        // Location form submission
        const addLocationForm = document.getElementById('addLocationForm');
        if (addLocationForm) {
            // Remove existing listeners
            const newLocationForm = addLocationForm.cloneNode(true);
            addLocationForm.parentNode.replaceChild(newLocationForm, addLocationForm);

            // Add new listener
            newLocationForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                try {
                    await submitForm(
                        '/locations',
                        new FormData(this),
                        'Location added successfully',
                        () => {
                            this.reset();
                            closeAddLocationModal();
                        },
                        async () => {
                            await loadLocationsTable();
                            await loadLocations();
                        }
                    );
                } catch (error) {
                    // Error already handled by submitForm
                }
            });
        }

        // Supplier form submission
        const addSupplierForm = document.getElementById('addSupplierForm');
        if (addSupplierForm) {
            // Remove existing listeners
            const newSupplierForm = addSupplierForm.cloneNode(true);
            addSupplierForm.parentNode.replaceChild(newSupplierForm, addSupplierForm);

            // Add new listener
            newSupplierForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                try {
                    await submitForm(
                        '/suppliers',
                        new FormData(this),
                        'Supplier added successfully',
                        () => {
                            this.reset();
                            closeAddSupplierModal();
                        },
                        async () => {
                            await loadSuppliersTable();
                            await loadSuppliers();
                        }
                    );
                } catch (error) {
                    // Error already handled by submitForm
                }
            });
        }

        function openReportModal() {
            const modal = document.getElementById('reportModal');
            const content = modal.querySelector('.modal-content');
            modal.classList.remove('hidden');
            setTimeout(() => content.classList.add('show'), 10);
            loadReportFilters();
            generateReport();
        }

        function closeReportModal() {
            const modal = document.getElementById('reportModal');
            const content = modal.querySelector('.modal-content');
            content.classList.remove('show');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        async function loadReportFilters() {
            try {
                // Load locations
                const locations = await fetch('/locations').then(res => res.json());
                const locationSelect = document.getElementById('filterLocation');
                locationSelect.innerHTML = '<option value="">All Locations</option>';
                locations.forEach(location => {
                    locationSelect.add(new Option(location.name, location.id));
                });

                // Load categories
                const categories = await fetch('/categories').then(res => res.json());
                const categorySelect = document.getElementById('filterCategory');
                categorySelect.innerHTML = '<option value="">All Categories</option>';
                categories.forEach(category => {
                    categorySelect.add(new Option(category.name, category.id));
                });

                // Load suppliers
                const suppliers = await fetch('/suppliers').then(res => res.json());
                const supplierSelect = document.getElementById('filterSupplier');
                supplierSelect.innerHTML = '<option value="">All Suppliers</option>';
                suppliers.forEach(supplier => {
                    supplierSelect.add(new Option(supplier.name, supplier.id));
                });
            } catch (error) {
                console.error('Error loading filters:', error);
                showToast('Error loading filters', 'error');
            }
        }

        async function generateReport() {
            const location = document.getElementById('filterLocation').value;
            const category = document.getElementById('filterCategory').value;
            const supplier = document.getElementById('filterSupplier').value;
            const reportType = document.getElementById('reportType').value;

            try {
                showLoading('Generating report...');

                const response = await fetch('/reports/generate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        location_id: location,
                        category_id: category,
                        supplier_id: supplier,
                        report_type: reportType
                    })
                });

                if (!response.ok) throw new Error('Failed to generate report');

                const data = await response.json();
                updateReportTable(data.items);
                updateReportSummary(data.summary);

                Swal.close();
            } catch (error) {
                console.error('Error generating report:', error);
                showToast('Error generating report', 'error');
            }
        }

        function updateReportTable(items) {
            const tbody = document.getElementById('reportTableBody');
            tbody.innerHTML = '';

            items.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.item_code || '-'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <span class="cursor-help" title="${item.description || ''}">${item.description_short || '-'}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.category_name || '-'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.location_name || '-'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.quantity || '0'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$${parseFloat(item.purchase_cost || 0).toFixed(2)}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$${parseFloat(item.total_value || 0).toFixed(2)}</td>
                `;
                tbody.appendChild(row);
            });
        }

        function updateReportSummary(summary) {
            document.getElementById('reportTotalItems').textContent = summary.total_items || '0';
            document.getElementById('reportTotalValue').textContent = `$${parseFloat(summary.total_value || 0).toFixed(2)}`;
            document.getElementById('reportLowStock').textContent = summary.low_stock_items || '0';
        }

        function exportReport(format) {
            // Implementation for export functionality
        }

        function printReport() {
            window.print();
        }

        // View Modal Functions
        function openViewModal() {
            const modal = document.getElementById('viewModal');
            const content = modal.querySelector('.modal-content');
            modal.classList.remove('hidden');
            setTimeout(() => content.classList.add('show'), 10);
            loadCategories();
        }

        function closeViewModal() {
            const modal = document.getElementById('viewModal');
            const content = modal.querySelector('.modal-content');
            content.classList.remove('show');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        // Find Item Modal Functions
        function openFindItemModal() {
            const modal = document.getElementById('findItemModal');
            const content = modal.querySelector('.modal-content');
            modal.classList.remove('hidden');
            setTimeout(() => content.classList.add('show'), 10);

            // Load filter options
            loadSearchFilters();
        }

        function closeFindItemModal() {
            const modal = document.getElementById('findItemModal');
            const content = modal.querySelector('.modal-content');
            content.classList.remove('show');
            setTimeout(() => modal.classList.add('hidden'), 300);

            // Clear search results
            document.getElementById('searchResultsBody').innerHTML = '<tr><td colspan="9" class="px-6 py-4 text-center text-gray-500">Enter search criteria and click Search to find items</td></tr>';
        }

        async function loadSearchFilters() {
            try {
                // Load categories
                const categories = await fetch('/categories').then(res => res.json());
                const categorySelect = document.getElementById('searchCategory');
                categorySelect.innerHTML = '<option value="">All Categories</option>';
                categories.forEach(category => {
                    categorySelect.add(new Option(category.name, category.id));
                });

                // Load locations
                const locations = await fetch('/locations').then(res => res.json());
                const locationSelect = document.getElementById('searchLocation');
                locationSelect.innerHTML = '<option value="">All Locations</option>';
                locations.forEach(location => {
                    locationSelect.add(new Option(location.name, location.id));
                });

                // Load suppliers
                const suppliers = await fetch('/suppliers').then(res => res.json());
                const supplierSelect = document.getElementById('searchSupplier');
                supplierSelect.innerHTML = '<option value="">All Suppliers</option>';
                suppliers.forEach(supplier => {
                    supplierSelect.add(new Option(supplier.name, supplier.id));
                });
            } catch (error) {
                console.error('Error loading search filters:', error);
                showToast('Error loading search filters', 'error');
            }
        }

        async function searchItems() {
            const query = document.getElementById('searchQuery').value.trim().toLowerCase();
            const category = document.getElementById('searchCategory').value;
            const location = document.getElementById('searchLocation').value;
            const supplier = document.getElementById('searchSupplier').value;

            try {
                showLoading('Searching items...');

                // Fetch all products (since we don't have a search endpoint)
                const response = await fetch('/api/products', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load products');

                const allProducts = await response.json();

                // Filter products based on search criteria
                const filteredItems = allProducts.filter(product => {
                    // Text search (item code or description)
                    const matchesQuery = !query ||
                        product.item_code?.toLowerCase().includes(query) ||
                        product.description?.toLowerCase().includes(query);

                    // Category filter
                    const matchesCategory = !category || product.category_id == category;

                    // Location filter
                    const matchesLocation = !location || product.location_id == location;

                    // Supplier filter
                    const matchesSupplier = !supplier || product.supplier_id == supplier;

                    return matchesQuery && matchesCategory && matchesLocation && matchesSupplier;
                });

                displaySearchResults(filteredItems);

                Swal.close();
            } catch (error) {
                console.error('Error searching items:', error);
                showToast('Error searching items', 'error');
            }
        }

        function displaySearchResults(items) {
            const tbody = document.getElementById('searchResultsBody');

            if (items.length === 0) {
                tbody.innerHTML = '<tr><td colspan="9" class="px-6 py-4 text-center text-gray-500">No items found matching your criteria</td></tr>';
                return;
            }

            tbody.innerHTML = '';

            items.forEach(item => {
                const statusBadge = item.quantity <= item.warn_quantity
                    ? '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Low Stock</span>'
                    : '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">In Stock</span>';

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.item_code || '-'}</td>
                    <td class="px-2 py-4 text-sm text-gray-500">
                        <div class="description-tooltip" title="${item.description || ''}">${item.description ? (item.description.length > 30 ? item.description.substring(0, 30) + '...' : item.description) : '-'}</div>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">${item.category?.name || '-'}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">${item.supplier?.name || '-'}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">${item.location?.name || '-'}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">${item.quantity || '0'}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">$${parseFloat(item.sales_price || 0).toFixed(2)}</td>
                    <td class="px-2 py-4 whitespace-nowrap">${statusBadge}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <button onclick="viewItemDetails(${item.id})" class="action-button edit action-button-tooltip" data-tooltip="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button onclick="editItem(${item.id})" class="action-button edit action-button-tooltip" data-tooltip="Edit Item">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function clearSearch() {
            document.getElementById('searchQuery').value = '';
            document.getElementById('searchCategory').value = '';
            document.getElementById('searchLocation').value = '';
            document.getElementById('searchSupplier').value = '';

            // Reset results
            document.getElementById('searchResultsBody').innerHTML = '<tr><td colspan="9" class="px-6 py-4 text-center text-gray-500">Enter search criteria and click Search to find items</td></tr>';
        }

        // Store current search results for view/edit operations
        let currentSearchResults = [];

        async function searchItems() {
            const query = document.getElementById('searchQuery').value.trim().toLowerCase();
            const category = document.getElementById('searchCategory').value;
            const location = document.getElementById('searchLocation').value;
            const supplier = document.getElementById('searchSupplier').value;

            try {
                showLoading('Searching items...');

                // Fetch all products (since we don't have a search endpoint)
                const response = await fetch('/api/products', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load products');

                const allProducts = await response.json();

                // Filter products based on search criteria
                const filteredItems = allProducts.filter(product => {
                    // Text search (item code or description)
                    const matchesQuery = !query ||
                        product.item_code?.toLowerCase().includes(query) ||
                        product.description?.toLowerCase().includes(query);

                    // Category filter
                    const matchesCategory = !category || product.category_id == category;

                    // Location filter
                    const matchesLocation = !location || product.location_id == location;

                    // Supplier filter
                    const matchesSupplier = !supplier || product.supplier_id == supplier;

                    return matchesQuery && matchesCategory && matchesLocation && matchesSupplier;
                });

                // Store filtered results for view/edit operations
                currentSearchResults = filteredItems;

                displaySearchResults(filteredItems);

                Swal.close();
            } catch (error) {
                console.error('Error searching items:', error);
                showToast('Error searching items', 'error');
            }
        }

        // Item details and editing functions
        function viewItemDetails(id) {
            // Find the item in current search results
            const item = currentSearchResults.find(product => product.id == id);

            if (!item) {
                showToast('Item not found in search results', 'error');
                return;
            }

            // Store the current item ID for the edit button in view modal
            currentItemId = id;

            displayItemDetails(item);
        }

        function displayItemDetails(item) {
            const content = document.getElementById('itemDetailsContent');

            const statusBadge = item.quantity <= item.warn_quantity
                ? '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Low Stock</span>'
                : '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">In Stock</span>';

            content.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Item Code</label>
                            <p class="mt-1 text-sm text-gray-900">${item.item_code || '-'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <p class="mt-1 text-sm text-gray-900">${item.description || '-'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <p class="mt-1 text-sm text-gray-900">${item.category?.name || '-'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Supplier</label>
                            <p class="mt-1 text-sm text-gray-900">${item.supplier?.name || '-'}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Location</label>
                            <p class="mt-1 text-sm text-gray-900">${item.location?.name || '-'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Quantity</label>
                            <p class="mt-1 text-sm text-gray-900">${item.quantity || '0'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Purchase Price</label>
                            <p class="mt-1 text-sm text-gray-900">$${parseFloat(item.purchase_cost || 0).toFixed(2)}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sales Price</label>
                            <p class="mt-1 text-sm text-gray-900">$${parseFloat(item.sales_price || 0).toFixed(2)}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <p class="mt-1">${statusBadge}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Notes</label>
                        <p class="mt-1 text-sm text-gray-900">${item.notes || 'No notes available'}</p>
                    </div>
                </div>
            `;

            openViewItemModal();
        }

        function openViewItemModal() {
            const modal = document.getElementById('viewItemModal');
            const content = modal.querySelector('.modal-content');
            modal.classList.remove('hidden');
            setTimeout(() => content.classList.add('show'), 10);
        }

        function closeViewItemModal() {
            const modal = document.getElementById('viewItemModal');
            const content = modal.querySelector('.modal-content');
            content.classList.remove('show');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function editCurrentItem() {
            if (currentItemId) {
                editItem(currentItemId);
                closeViewItemModal();
            } else {
                showToast('No item selected for editing', 'error');
            }
        }

        function editItem(id) {
            // Find the item in current search results
            const item = currentSearchResults.find(product => product.id == id);

            if (!item) {
                showToast('Item not found in search results', 'error');
                return;
            }

            populateEditForm(item);
            openItemModal();
        }

        function populateEditForm(item) {
            // Store the item ID for editing
            let hiddenId = document.getElementById('editItemId');
            if (!hiddenId) {
                hiddenId = document.createElement('input');
                hiddenId.type = 'hidden';
                hiddenId.id = 'editItemId';
                hiddenId.name = 'id';
                document.getElementById('itemForm').appendChild(hiddenId);
            }
            hiddenId.value = item.id;

            // Populate Basic Info tab fields (make selectors more specific)
            const itemForm = document.getElementById('itemForm');
            itemForm.querySelector('#itemCode').value = item.item_code || '';
            itemForm.querySelector('input[name="description"]').value = item.description || '';
            itemForm.querySelector('select[name="category_id"]').value = item.category_id || '';
            itemForm.querySelector('input[name="sub_category"]').value = item.sub_category || '';
            itemForm.querySelector('input[name="purchase_cost"]').value = item.purchase_cost || '';
            itemForm.querySelector('input[name="sales_price"]').value = item.sales_price || '';
            itemForm.querySelector('select[name="unit_measure"]').value = item.unit_measure || '';
            itemForm.querySelector('textarea[name="notes"]').value = item.notes || '';

            // Populate Inventory tab fields (these are required - make selectors more specific)
            itemForm.querySelector('select[name="location_id"]').value = item.location_id || '';
            itemForm.querySelector('input[name="quantity"]').value = item.quantity || '0';
            itemForm.querySelector('input[name="ideal_quantity"]').value = item.ideal_quantity || '';
            itemForm.querySelector('input[name="warn_quantity"]').value = item.warn_quantity || '';
            itemForm.querySelector('select[name="supplier_id"]').value = item.supplier_id || '';

            // Change modal title and button text
            const modalTitle = document.querySelector('#itemModal h3');
            const submitButton = document.querySelector('#itemForm button[type="submit"]');

            if (modalTitle) modalTitle.textContent = 'Edit Item';
            if (submitButton) submitButton.textContent = 'Update Item';

            // Change form action to update
            document.getElementById('itemForm').dataset.mode = 'edit';
        }

        // Store current item ID for edit button in view modal
        let currentItemId = null;

        function setCurrentItemId(id) {
            currentItemId = id;
        }

        function editCurrentItem() {
            if (currentItemId) {
                editItem(currentItemId);
                closeViewItemModal();
            }
        }

        function switchViewTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.view-tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });

            // Show selected tab content
            const selectedTab = document.getElementById(`${tabName}Tab`);
            selectedTab.classList.remove('hidden');

            // Update tab buttons
            document.querySelectorAll('.view-tab-button').forEach(button => {
                button.classList.remove('active');
            });
            document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');

            // Load data for the selected tab with loading indicator
            switch(tabName) {
                case 'categories':
                    loadCategoriesTable();
                    break;
                case 'locations':
                    loadLocationsTable();
                    break;
                case 'suppliers':
                    loadSuppliersTable();
                    break;
                case 'brands':
                    loadBrandsTable();
                    break;
                case 'units':
                    loadUnitsTable();
                    break;
            }
        }

        // Add this helper function for showing loading state in tables
        function showTableLoading(tableId) {
            const tbody = document.getElementById(tableId);
            tbody.innerHTML = `
                <tr>
                    <td colspan="100%" class="loading-spinner">
                        <div>
                            <div class="loading-spinner-icon"></div>
                            <div class="loading-text">Loading data...</div>
                        </div>
                    </td>
                </tr>
            `;
        }

        // Update the loadCategoriesTable function
        async function loadCategoriesTable() {
            const tbody = document.getElementById('categoriesTableBody');
            showTableLoading('categoriesTableBody');

            try {
                const response = await fetch('/categories');
                if (!response.ok) throw new Error('Failed to load categories');

                const categories = await response.json();
                tbody.innerHTML = '';

                if (categories.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No categories found
                            </td>
                        </tr>
                    `;
                    return;
                }

                categories.forEach(category => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${category.name}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${category.description || '-'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${category.items_count}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <button onclick="editCategory(${category.id})"
                                    class="action-button edit action-button-tooltip"
                                    data-tooltip="Edit Category">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteCategory(${category.id})"
                                    class="action-button delete action-button-tooltip"
                                    data-tooltip="Delete Category">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (error) {
                console.error('Error loading categories:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-red-500">
                            Error loading categories. Please try again.
                        </td>
                    </tr>
                `;
                showToast('Error loading categories', 'error');
            }
        }

        // Update the loadLocationsTable function
        async function loadLocationsTable() {
            const tbody = document.getElementById('locationsTableBody');
            showTableLoading('locationsTableBody');

            try {
                const response = await fetch('/locations');
                if (!response.ok) throw new Error('Failed to load locations');

                const locations = await response.json();
                tbody.innerHTML = '';

                if (locations.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No locations found
                            </td>
                        </tr>
                    `;
                    return;
                }

                locations.forEach(location => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${location.name}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${location.type}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${location.address || '-'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <button onclick="editLocation(${location.id})"
                                    class="action-button edit action-button-tooltip"
                                    data-tooltip="Edit Location">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteLocation(${location.id})"
                                    class="action-button delete action-button-tooltip"
                                    data-tooltip="Delete Location">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (error) {
                console.error('Error loading locations:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-red-500">
                            Error loading locations. Please try again.
                        </td>
                    </tr>
                `;
                showToast('Error loading locations', 'error');
            }
        }

        // Update the loadSuppliersTable function
        async function loadSuppliersTable() {
            const tbody = document.getElementById('suppliersTableBody');
            showTableLoading('suppliersTableBody');

            try {
                const response = await fetch('/suppliers');
                if (!response.ok) throw new Error('Failed to load suppliers');

                const suppliers = await response.json();
                tbody.innerHTML = '';

                if (suppliers.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No suppliers found
                            </td>
                        </tr>
                    `;
                    return;
                }

                suppliers.forEach(supplier => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${supplier.name}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${supplier.contact_person || '-'}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${supplier.email || '-'}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${supplier.phone || '-'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <button onclick="editSupplier(${supplier.id})"
                                    class="action-button edit action-button-tooltip"
                                    data-tooltip="Edit Supplier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteSupplier(${supplier.id})"
                                    class="action-button delete action-button-tooltip"
                                    data-tooltip="Delete Supplier">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (error) {
                console.error('Error loading suppliers:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-red-500">
                            Error loading suppliers. Please try again.
                        </td>
                    </tr>
                `;
                showToast('Error loading suppliers', 'error');
            }
        }

        // CRUD Operations
        async function deleteCategory(id) {
            const confirmed = await showConfirm(
                'Are you sure?',
                "You won't be able to revert this!"
            );

            if (confirmed) {
                try {
                    showLoading('Deleting...');
                    const response = await fetch(`/categories/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    if (!response.ok) throw new Error('Failed to delete category');

                    showToast('Category deleted successfully');
                    await loadCategoriesTable();
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: error.message || 'Failed to delete category'
                    });
                }
            }
        }

        // Edit Category Functions
        function openEditCategoryModal(category) {
            document.getElementById('editCategoryId').value = category.id;
            document.getElementById('editCategoryName').value = category.name;
            document.getElementById('editCategoryDescription').value = category.description;
            document.getElementById('editCategoryModal').classList.remove('hidden');
        }

        function closeEditCategoryModal() {
            document.getElementById('editCategoryModal').classList.add('hidden');
        }

        document.getElementById('editCategoryForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const categoryId = document.getElementById('editCategoryId').value;
            const formData = new FormData(this);

            try {
                const response = await fetch(`/categories/${categoryId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                });

                if (!response.ok) throw new Error('Failed to update category');

                showToast('Category updated successfully', 'success');
                closeEditCategoryModal();
                loadCategoriesTable();
            } catch (error) {
                console.error('Error:', error);
                showToast('Error updating category', 'error');
            }
        });

        // Edit Location Functions
        function openEditLocationModal(location) {
            document.getElementById('editLocationId').value = location.id;
            document.getElementById('editLocationName').value = location.name;
            document.getElementById('editLocationType').value = location.type;
            document.getElementById('editLocationAddress').value = location.address;
            document.getElementById('editLocationModal').classList.remove('hidden');
        }

        function closeEditLocationModal() {
            document.getElementById('editLocationModal').classList.add('hidden');
        }

        document.getElementById('editLocationForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const locationId = document.getElementById('editLocationId').value;
            const formData = new FormData(this);

            try {
                showLoading('Updating location...');
                const response = await fetch(`/locations/${locationId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                });

                if (!response.ok) throw new Error('Failed to update location');

                showToast('Location updated successfully');
                document.getElementById('editLocationModal').classList.add('hidden');
                await loadLocationsTable();
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Failed to update location'
                });
            }
        });

        // Edit Supplier Functions
        function openEditSupplierModal(supplier) {
            document.getElementById('editSupplierId').value = supplier.id;
            document.getElementById('editSupplierName').value = supplier.name;
            document.getElementById('editSupplierContact').value = supplier.contact_person || '';
            document.getElementById('editSupplierEmail').value = supplier.email || '';
            document.getElementById('editSupplierPhone').value = supplier.phone || '';
            document.getElementById('editSupplierAddress').value = supplier.address || '';
            document.getElementById('editSupplierModal').classList.remove('hidden');
        }

        function closeEditSupplierModal() {
            document.getElementById('editSupplierModal').classList.add('hidden');
        }

        document.getElementById('editSupplierForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const supplierId = document.getElementById('editSupplierId').value;
            const formData = new FormData(this);

            try {
                showLoading('Updating supplier...');
                const response = await fetch(`/suppliers/${supplierId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                });

                if (!response.ok) throw new Error('Failed to update supplier');

                showToast('Supplier updated successfully');
                document.getElementById('editSupplierModal').classList.add('hidden');
                await loadSuppliersTable();
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Failed to update supplier'
                });
            }
        });

        // Location Functions
        function openNewLocationModal() {
            document.getElementById('addLocationModal').classList.remove('hidden');
        }

        function closeAddLocationModal() {
            document.getElementById('addLocationModal').classList.add('hidden');
            document.getElementById('addLocationForm').reset();
        }

        // Supplier Functions
        function openNewSupplierModal() {
            document.getElementById('addSupplierModal').classList.remove('hidden');
        }

        function closeAddSupplierModal() {
            document.getElementById('addSupplierModal').classList.add('hidden');
            document.getElementById('addSupplierForm').reset();
        }

        // Add these functions before your existing JavaScript code
        function showToast(message, icon = 'success') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: message,
                showConfirmButton: false,
                timer: 3000
            });
        }

        function showLoading(message = 'Loading...') {
            Swal.fire({
                title: message,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        async function showConfirm(title, text) {
            const result = await Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            });
            return result.isConfirmed;
        }

        // Add these functions for Location actions
        async function deleteLocation(id) {
            const confirmed = await showConfirm(
                'Are you sure?',
                "You won't be able to revert this location!"
            );

            if (confirmed) {
                try {
                    showLoading('Deleting...');
                    const response = await fetch(`/locations/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    if (!response.ok) throw new Error('Failed to delete location');

                    showToast('Location deleted successfully');
                    await loadLocationsTable();
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: error.message || 'Failed to delete location'
                    });
                }
            }
        }

        async function editLocation(id) {
            try {
                showLoading('Loading location data...');
                const response = await fetch(`/locations/${id}`);
                if (!response.ok) throw new Error('Failed to fetch location data');

                const location = await response.json();
                Swal.close();

                // Populate the edit modal with location data
                document.getElementById('editLocationId').value = location.id;
                document.getElementById('editLocationName').value = location.name;
                document.getElementById('editLocationType').value = location.type;
                document.getElementById('editLocationAddress').value = location.address || '';

                // Show the edit modal
                document.getElementById('editLocationModal').classList.remove('hidden');
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Failed to load location data'
                });
            }
        }

        // Add these functions for Supplier actions
        async function deleteSupplier(id) {
            const confirmed = await showConfirm(
                'Are you sure?',
                "You won't be able to revert this supplier!"
            );

            if (confirmed) {
                try {
                    showLoading('Deleting...');
                    const response = await fetch(`/suppliers/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    if (!response.ok) throw new Error('Failed to delete supplier');

                    showToast('Supplier deleted successfully');
                    await loadSuppliersTable();
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: error.message || 'Failed to delete supplier'
                    });
                }
            }
        }

        async function editSupplier(id) {
            try {
                showLoading('Loading supplier data...');
                const response = await fetch(`/suppliers/${id}`);
                if (!response.ok) throw new Error('Failed to fetch supplier data');

                const supplier = await response.json();
                Swal.close();

                // Populate the edit modal with supplier data
                document.getElementById('editSupplierId').value = supplier.id;
                document.getElementById('editSupplierName').value = supplier.name;
                document.getElementById('editSupplierContact').value = supplier.contact_person || '';
                document.getElementById('editSupplierEmail').value = supplier.email || '';
                document.getElementById('editSupplierPhone').value = supplier.phone || '';
                document.getElementById('editSupplierAddress').value = supplier.address || '';

                // Show the edit modal
                document.getElementById('editSupplierModal').classList.remove('hidden');
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Failed to load supplier data'
                });
            }
        }

        // Order Stock Functions
        function openOrderModal() {
            const modal = document.getElementById('orderModal');
            const content = modal.querySelector('.modal-content');
            modal.classList.remove('hidden');
            setTimeout(() => content.classList.add('show'), 10);

            // Set default dates
            const today = new Date().toISOString().split('T')[0];
            document.querySelector('input[name="issue_date"]').value = today;
            document.querySelector('input[name="expected_date"]').value = today;

            // Generate and set tracking reference
            const trackingRef = generateTrackingRef();
            document.querySelector('input[name="tracking_ref"]').value = trackingRef;

            // Load all required data
            Promise.all([
                loadOrderSuppliers(),
                loadOrderLocations(),
                loadShipByOptions()
            ]).then(() => {
                console.log('All form data loaded successfully');
            addOrderRow();
            }).catch(error => {
                console.error('Error loading form data:', error);
                showToast('Error loading form data. Please try again.', 'error');
            });
        }

        function closeOrderModal() {
            const modal = document.getElementById('orderModal');
            const content = modal.querySelector('.modal-content');
            content.classList.remove('show');
            setTimeout(() => modal.classList.add('hidden'), 300);
            document.getElementById('orderForm').reset();
            document.getElementById('orderItemsBody').innerHTML = '';
        }

        // Add submit handler for order form
        document.getElementById('orderForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const action = formData.get('action'); // 'print' or 'email'

            try {
                showLoading('Processing order...');

                // Calculate totals before sending
                const totals = Array.from(document.querySelectorAll('input[name*="[total]"]'))
                    .map(input => parseFloat(input.value) || 0);
                const orderTotal = totals.reduce((sum, current) => sum + current, 0);

                // Add totals to form data
                formData.set('subtotal', orderTotal.toFixed(2));
                formData.set('total', orderTotal.toFixed(2));

                // Send data to server
                const response = await fetch('/orders', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to create order');
                }

                const result = await response.json();

                // Handle different actions
                if (action === 'print') {
                    // Open print view in new tab
                    window.open(`/orders/${result.id}/print`, '_blank');
                } else if (action === 'email') {
                    // Send email
                    const emailResponse = await fetch(`/orders/${result.id}/email`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    if (!emailResponse.ok) {
                        throw new Error('Failed to send email');
                    }
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: `Purchase order ${action === 'print' ? 'recorded and ready for printing' : 'recorded and emailed'} successfully!`,
                    timer: 2000,
                    showConfirmButton: false
                });

                closeOrderModal();

            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Failed to process purchase order'
                });
            }
        });

        async function loadOrderSuppliers() {
            try {
                const response = await fetch('/suppliers', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load suppliers');

                const suppliers = await response.json();
                const select = document.querySelector('#orderModal select[name="supplier_id"]');

                // Clear existing options
                select.innerHTML = '<option value="">Select Supplier</option>';

                // Add new options
                suppliers.forEach(supplier => {
                    const option = new Option(supplier.name, supplier.id);
                    option.dataset.address = supplier.address || '';
                    select.appendChild(option);
                });

                // Add event listener to auto-fill billing address
                select.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const billingAddressField = document.querySelector('#orderModal textarea[name="billing_address"]');
                    if (selectedOption.dataset.address) {
                        billingAddressField.value = selectedOption.dataset.address;
                    }
                });

                return suppliers;
            } catch (error) {
                console.error('Error loading suppliers:', error);
                showToast('Error loading suppliers', 'error');
                throw error;
            }
        }

        async function loadOrderLocations() {
            try {
                const response = await fetch('/locations', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load locations');

                const locations = await response.json();
                const select = document.querySelector('#orderModal select[name="location_id"]');

                // Clear existing options
                select.innerHTML = '<option value="">Select Location</option>';

                // Add new options
                locations.forEach(location => {
                    const option = new Option(location.name, location.id);
                    option.dataset.address = location.address || '';
                    select.appendChild(option);
                });

                // Add event listener to auto-fill shipping address
                select.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const shippingAddressField = document.querySelector('#orderModal textarea[name="shipping_address"]');
                    if (selectedOption.dataset.address) {
                        shippingAddressField.value = selectedOption.dataset.address;
                    }
                });

                return locations;
            } catch (error) {
                console.error('Error loading locations:', error);
                showToast('Error loading locations', 'error');
                throw error;
            }
        }

        // Update the quick stats section HTML
        document.querySelector('.grid.grid-cols-1.md\\:grid-cols-3.gap-6').innerHTML = `
            <div class="bg-blue-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-blue-800">Total Products</h3>
                <p class="text-3xl font-bold text-blue-600" data-stat="total-products">0</p>
            </div>

            <div class="bg-yellow-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-yellow-800">Low Stock Items</h3>
                <p class="text-3xl font-bold text-yellow-600" data-stat="low-stock">0</p>
            </div>

            <div class="bg-green-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-green-800">Total Value</h3>
                <p class="text-3xl font-bold text-green-600" data-stat="total-value">$0.00</p>
            </div>
        `;

        // Call updateDashboardStats when page loads and after adding/updating products
        document.addEventListener('DOMContentLoaded', updateDashboardStats);

        function generateTrackingRef() {
            const prefix = 'TRK';
            const date = new Date();
            const year = date.getFullYear().toString().slice(-2);
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const day = date.getDate().toString().padStart(2, '0');
            const timestamp = date.getTime().toString().slice(-4);
            const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            return `${prefix}${year}${month}${day}-${timestamp}${random}`;
        }

        // Ship By Modal Functions
        function openShipByModal() {
            const modal = document.getElementById('shipByModal');
            if (!modal) return;
            modal.classList.remove('hidden');
        }

        function closeShipByModal() {
            const modal = document.getElementById('shipByModal');
            if (!modal) return;
            modal.classList.add('hidden');
            document.getElementById('shipByForm').reset();
        }

        // Load shipping methods
        async function loadShipByOptions() {
            const select = document.querySelector('select[name="ship_by"]');
            if (!select) return;

            try {
                select.innerHTML = '<option value="">Select Shipping Method</option>';
                const response = await fetch('/ship-by');
                if (!response.ok) throw new Error('Failed to load shipping methods');

                const methods = await response.json();
                methods.forEach(method => {
                    select.add(new Option(method.name, method.id));
                });
            } catch (error) {
                console.error('Error loading shipping methods:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to load shipping methods'
                });
            }
        }

        // Submit shipping method
        async function submitShipByForm() {
            const form = document.getElementById('shipByForm');
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalContent = submitBtn.innerHTML;

            try {
                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <div class="inline-flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Saving...
                    </div>
                `;

                const formData = new FormData(form);
                const data = {
                    name: formData.get('name'),
                    description: formData.get('description')
                };

                const response = await fetch('/ship-by', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Failed to add shipping method');
                }

                await Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Shipping method added successfully',
                    timer: 1500,
                    showConfirmButton: false
                });

                closeShipByModal();
                await loadShipByOptions();

            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Failed to add shipping method'
                });
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalContent;
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Set up form submission
            const form = document.getElementById('shipByForm');
            if (form) {
                // Remove any existing event listeners
                const newForm = form.cloneNode(true);
                form.parentNode.replaceChild(newForm, form);

                // Add the new event listener
                newForm.addEventListener('submit', submitShipByForm);
            }

            // Load initial shipping methods
            loadShipByOptions();
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Get form element
            const form = document.getElementById('shipByForm');

            // Add form submit handler
            if (form) {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    console.log('Form submitted');

                    try {
                        const formData = new FormData(form);
                        const response = await fetch('/ship-by', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                name: formData.get('name'),
                                description: formData.get('description')
                            })
                        });

                        const result = await response.json();
                        console.log('Response:', result);

                        if (response.ok) {
                            alert('Shipping method added successfully');
                            closeShipByModal();
                        } else {
                            throw new Error(result.message || 'Failed to add shipping method');
                        }

                    } catch (error) {
                        console.error('Error:', error);
                        alert(error.message || 'Failed to add shipping method');
                    }
                });
            }
        });

        // Simple modal functions
        function openShipByModal() {
            console.log('Opening modal');
            document.getElementById('shipByModal').classList.remove('hidden');
        }

        function closeShipByModal() {
            console.log('Closing modal');
            const modal = document.getElementById('shipByModal');
            modal.classList.add('hidden');
            document.getElementById('shipByForm').reset();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('shipByForm');

            if (form) {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const submitBtn = document.getElementById('saveShipByBtn');
                    const originalContent = submitBtn.innerHTML;

                    try {
                        // Show loading state
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = `
                            <div class="inline-flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Saving...
                            </div>
                        `;

                        const formData = new FormData(form);
                        const response = await fetch('/ship-by', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                name: formData.get('name'),
                                description: formData.get('description')
                            })
                        });

                        const result = await response.json();

                        if (result.success) {
                            // Show SweetAlert using the response swal configuration
                            await Swal.fire(result.swal);

                            // Close modal and reset form
                            closeShipByModal();

                            // Refresh the shipping methods dropdown
                            await loadShipByOptions();
                        } else {
                            throw new Error(result.message || 'Failed to add shipping method');
                        }

                    } catch (error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: error.message || 'Failed to add shipping method'
                        });
                    } finally {
                        // Reset button state
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalContent;
                    }
                });
            }
        });

        // Modal functions
        function openShipByModal() {
            document.getElementById('shipByModal').classList.remove('hidden');
        }

        function closeShipByModal() {
            const modal = document.getElementById('shipByModal');
            const form = document.getElementById('shipByForm');
            modal.classList.add('hidden');
            if (form) form.reset();
        }

        // Load shipping methods into dropdown
        async function loadShipByOptions() {
            const select = document.querySelector('select[name="ship_by"]');
            if (!select) return;

            try {
                select.innerHTML = '<option value="">Select Shipping Method</option>';
                const response = await fetch('/ship-by');

                if (!response.ok) {
                    throw new Error('Failed to load shipping methods');
                }

                const methods = await response.json();
                methods.forEach(method => {
                    const option = new Option(method.name, method.id);
                    select.add(option);
                });
            } catch (error) {
                console.error('Error loading shipping methods:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to load shipping methods'
                });
            }
        }

        function addOrderRow() {
            const tbody = document.getElementById('orderItemsBody');
            const rowCount = tbody.getElementsByTagName('tr').length + 1;

            const newRow = `
                <tr class="order-item-row">
                    <td class="px-4 py-2">
                        <select name="items[${rowCount}][item_id]" class="form-select w-full" required>
                            <option value="">Select Item</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->sales_price }}">
                                    {{ $product->item_code }} - {{ \Str::limit($product->description, 50) }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="px-4 py-2">
                        <input type="number" name="items[${rowCount}][quantity]"
                               class="form-input w-full" min="1" required
                               placeholder="Quantity">
                    </td>
                    <td class="px-4 py-2">
                        <input type="text" name="items[${rowCount}][unit_price]"
                               class="form-input w-full" readonly
                               placeholder="Unit Price">
                    </td>
                    <td class="px-4 py-2">
                        <input type="text" name="items[${rowCount}][total]"
                               class="form-input w-full" readonly
                               placeholder="Total">
                    </td>
                    <td class="px-4 py-2">
                        <button type="button" onclick="removeOrderRow(this)"
                                class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;

            tbody.insertAdjacentHTML('beforeend', newRow);

            // Get the newly added row's select element
            const newSelect = tbody.lastElementChild.querySelector('select');

            // Load items for the new select
            loadItemsForSelect(newSelect);

            // Add event listeners for the new row
            setupRowEventListeners(tbody.lastElementChild);
        }

        function removeOrderRow(button) {
            const row = button.closest('tr');
            row.remove();
            updateOrderTotal();
        }

        function setupRowEventListeners(row) {
            const itemSelect = row.querySelector('select[name*="[item_id]"]');
            const quantityInput = row.querySelector('input[name*="[quantity]"]');

            // Item selection change
            itemSelect.addEventListener('change', async function() {
                const selectedOption = this.options[this.selectedIndex];
                const unitPrice = selectedOption.dataset.price || '0';
                const unitPriceInput = row.querySelector('input[name*="[unit_price]"]');
                unitPriceInput.value = unitPrice;
                updateRowTotal(row);
            });

            // Quantity change
            quantityInput.addEventListener('input', function() {
                updateRowTotal(row);
            });
        }

        function updateRowTotal(row) {
            const quantity = parseFloat(row.querySelector('input[name*="[quantity]"]').value) || 0;
            const unitPrice = parseFloat(row.querySelector('input[name*="[unit_price]"]').value) || 0;
            const totalInput = row.querySelector('input[name*="[total]"]');

            const total = quantity * unitPrice;
            totalInput.value = total.toFixed(2);

            updateOrderTotal();
        }

        function updateOrderTotal() {
            const totals = Array.from(document.querySelectorAll('input[name*="[total]"]'))
                .map(input => parseFloat(input.value) || 0);

            const orderTotal = totals.reduce((sum, current) => sum + current, 0);
            const orderTotalElement = document.getElementById('orderTotal');
            const orderSubtotalElement = document.getElementById('orderSubtotal');

            if (orderTotalElement) {
                orderTotalElement.textContent = '$' + orderTotal.toFixed(2);
            }
            if (orderSubtotalElement) {
                orderSubtotalElement.textContent = '$' + orderTotal.toFixed(2);
            }
        }

        async function loadItemsForSelect(select) {
            try {
                const response = await fetch('/api/products', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load items');

                const products = await response.json();

                // Clear existing options
                select.innerHTML = '<option value="">Select Item</option>';

                // Add new options
                products.forEach(product => {
                    const option = document.createElement('option');
                    option.value = product.id;
                    option.textContent = `${product.item_code} - ${product.description}`;
                    option.dataset.price = product.sales_price;
                    select.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading items:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to load items'
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            tippy('[data-tippy-content]', {
                theme: 'custom',
                placement: 'top',
                arrow: true,
                maxWidth: 300,
                animation: 'fade',
                allowHTML: false,
                interactive: true,
                appendTo: document.body,
                delay: [100, 0], // [show delay, hide delay]
                duration: [200, 200], // [show duration, hide duration]
                onShow(instance) {
                    // Ensure content is up to date
                    const content = instance.reference.getAttribute('data-tippy-content');
                    if (content) {
                        instance.setContent(content);
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Native tooltip implementation
            const descriptions = document.querySelectorAll('.description-tooltip');

            descriptions.forEach(description => {
                const fullText = description.getAttribute('title');
                if (fullText) {
                    // Create tooltip element
                    const tooltip = document.createElement('div');
                    tooltip.className = 'tooltip';
                    tooltip.textContent = fullText;
                    description.appendChild(tooltip);

                    // Remove title attribute to prevent default browser tooltip
                    description.removeAttribute('title');
                }
            });
        });

        async function updateDashboardStats() {
            try {
                const response = await fetch('/api/dashboard/stats', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch dashboard stats');
                }

                const stats = await response.json();

                // Update the stats in the UI
                document.querySelector('[data-stat="total-products"]').textContent = stats.total_products || 0;
                document.querySelector('[data-stat="low-stock"]').textContent = stats.low_stock || 0;
                document.querySelector('[data-stat="total-value"]').textContent =
                    `$${parseFloat(stats.total_value || 0).toFixed(2)}`;

            } catch (error) {
                console.error('Error updating dashboard stats:', error);
            }
        }

        async function updateFinancialOverview() {
            try {
                const response = await fetch('/api/financial/overview', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch financial overview');
                }

                const financial = await response.json();

                // Update financial overview cards
                document.querySelector('[data-financial="revenue"]').textContent = `$${parseFloat(financial.revenue || 0).toFixed(2)}`;
                document.querySelector('[data-financial="sale-return"]').textContent = `$${parseFloat(financial.sale_return || 0).toFixed(2)}`;
                document.querySelector('[data-financial="purchase-return"]').textContent = `$${parseFloat(financial.purchase_return || 0).toFixed(2)}`;
                document.querySelector('[data-financial="cash-flow"]').textContent = `$${parseFloat(financial.cash_flow || 0).toFixed(2)}`;
                document.querySelector('[data-financial="profit"]').textContent = `$${parseFloat(financial.profit || 0).toFixed(2)}`;

            } catch (error) {
                console.error('Error updating financial overview:', error);
            }
        }

        async function updateYearlyStats() {
            try {
                const response = await fetch('/api/financial/yearly-stats', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch yearly stats');
                }

                const yearly = await response.json();

                // Update yearly statistics cards
                document.querySelector('[data-yearly="purchases"]').textContent = `$${parseFloat(yearly.purchases || 0).toFixed(2)}`;
                document.querySelector('[data-yearly="revenue"]').textContent = `$${parseFloat(yearly.revenue || 0).toFixed(2)}`;
                document.querySelector('[data-yearly="expenses"]').textContent = `$${parseFloat(yearly.expenses || 0).toFixed(2)}`;

            } catch (error) {
                console.error('Error updating yearly stats:', error);
            }
        }

        // Call updateDashboardStats and financial data when page loads
        document.addEventListener('DOMContentLoaded', function() {
            updateDashboardStats();
            updateFinancialOverview();
            updateYearlyStats();
        });

        // Update stats every 5 minutes (300000 milliseconds)
        setInterval(function() {
            updateDashboardStats();
            updateFinancialOverview();
            updateYearlyStats();
        }, 300000);

        // Transfer Stock Modal Functions
        function openTransferStockModal() {
            const modal = document.getElementById('transferStockModal');
            const content = modal.querySelector('.modal-content');
            modal.classList.remove('hidden');
            setTimeout(() => content.classList.add('show'), 10);

            // Load form data
            loadTransferLocations();
            loadTransferProducts();

            // Set default transfer date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('transferDate').value = today;

            // Generate reference number
            const reference = generateTransferReference();
            document.getElementById('transferReference').value = reference;
        }

        function closeTransferStockModal() {
            const modal = document.getElementById('transferStockModal');
            const content = modal.querySelector('.modal-content');
            content.classList.remove('show');
            setTimeout(() => modal.classList.add('hidden'), 300);

            // Reset form
            document.getElementById('transferStockForm').reset();
            updateTransferSummary();
        }

        async function loadTransferLocations() {
            try {
                const response = await fetch('/locations', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load locations');

                const locations = await response.json();
                const fromSelect = document.getElementById('transferFromLocation');
                const toSelect = document.getElementById('transferToLocation');

                // Clear existing options
                fromSelect.innerHTML = '<option value="">Select Source Location</option>';
                toSelect.innerHTML = '<option value="">Select Destination Location</option>';

                // Add location options
                locations.forEach(location => {
                    const option1 = new Option(location.name, location.id);
                    const option2 = new Option(location.name, location.id);
                    fromSelect.appendChild(option1);
                    toSelect.appendChild(option2);
                });

                // Add change listeners
                fromSelect.addEventListener('change', updateAvailableProducts);
                toSelect.addEventListener('change', updateTransferSummary);

            } catch (error) {
                console.error('Error loading locations:', error);
                showToast('Error loading locations', 'error');
            }
        }

        async function loadTransferProducts() {
            try {
                const response = await fetch('/api/products', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load products');

                const products = await response.json();
                window.allProducts = products; // Store globally for filtering

            } catch (error) {
                console.error('Error loading products:', error);
                showToast('Error loading products', 'error');
            }
        }

        function updateAvailableProducts() {
            const fromLocationId = document.getElementById('transferFromLocation').value;
            const productSelect = document.getElementById('transferProduct');

            if (!fromLocationId) {
                productSelect.innerHTML = '<option value="">Select Item</option>';
                updateAvailableQuantity();
                return;
            }

            // Filter products by selected location (handle string/number comparison)
            const availableProducts = window.allProducts.filter(product =>
                String(product.location_id) === String(fromLocationId) && parseInt(product.quantity) > 0
            );

            productSelect.innerHTML = '<option value="">Select Item</option>';
            availableProducts.forEach(product => {
                const option = new Option(
                    `${product.item_code} - ${product.description} (Qty: ${product.quantity})`,
                    product.id
                );
                option.dataset.quantity = product.quantity;
                option.dataset.price = product.sales_price;
                productSelect.appendChild(option);
            });

            // Add change listener for quantity update
            productSelect.addEventListener('change', updateAvailableQuantity);
            updateAvailableQuantity();
        }

        // Stock List Modal Functions
        function openStockListModal() {
            const modal = document.getElementById('stockListModal');
            const content = modal.querySelector('.modal-content');
            modal.classList.remove('hidden');
            setTimeout(() => content.classList.add('show'), 10);

            // Load initial data
            loadStockListFilters();
            loadStockList();
        }

        function closeStockListModal() {
            const modal = document.getElementById('stockListModal');
            const content = modal.querySelector('.modal-content');
            content.classList.remove('show');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        async function loadStockListFilters() {
            try {
                // Load locations
                const locations = await fetch('/locations').then(res => res.json());
                const locationSelect = document.getElementById('stockListLocationFilter');
                locationSelect.innerHTML = '<option value="">All Locations</option>';
                locations.forEach(location => {
                    locationSelect.add(new Option(location.name, location.id));
                });

                // Load categories
                const categories = await fetch('/categories').then(res => res.json());
                const categorySelect = document.getElementById('stockListCategoryFilter');
                categorySelect.innerHTML = '<option value="">All Categories</option>';
                categories.forEach(category => {
                    categorySelect.add(new Option(category.name, category.id));
                });

                // Load suppliers
                const suppliers = await fetch('/suppliers').then(res => res.json());
                const supplierSelect = document.getElementById('stockListSupplierFilter');
                supplierSelect.innerHTML = '<option value="">All Suppliers</option>';
                suppliers.forEach(supplier => {
                    supplierSelect.add(new Option(supplier.name, supplier.id));
                });

            } catch (error) {
                console.error('Error loading stock list filters:', error);
                showToast('Error loading filters', 'error');
            }
        }

        async function loadStockList() {
            try {
                showTableLoading('stockListTableBody');

                // Get filter values
                const locationId = document.getElementById('stockListLocationFilter').value;
                const categoryId = document.getElementById('stockListCategoryFilter').value;
                const supplierId = document.getElementById('stockListSupplierFilter').value;
                const statusFilter = document.getElementById('stockListStatusFilter').value;

                const response = await fetch('/api/products', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load products');

                let products = await response.json();

                // Apply filters
                if (locationId) {
                    products = products.filter(product => String(product.location_id) === String(locationId));
                }
                if (categoryId) {
                    products = products.filter(product => String(product.category_id) === String(categoryId));
                }
                if (supplierId) {
                    products = products.filter(product => String(product.supplier_id) === String(supplierId));
                }
                if (statusFilter) {
                    switch (statusFilter) {
                        case 'in_stock':
                            products = products.filter(product => parseInt(product.quantity) > parseInt(product.warn_quantity));
                            break;
                        case 'low_stock':
                            products = products.filter(product => parseInt(product.quantity) <= parseInt(product.warn_quantity) && parseInt(product.quantity) > 0);
                            break;
                        case 'out_of_stock':
                            products = products.filter(product => parseInt(product.quantity) <= 0);
                            break;
                    }
                }

                // Update current search results so view/edit functions work
                currentSearchResults = products;

                displayStockList(products);
                updateStockListSummary(products);

            } catch (error) {
                console.error('Error loading stock list:', error);
                const tbody = document.getElementById('stockListTableBody');
                tbody.innerHTML = `<tr><td colspan="11" class="px-6 py-4 text-center text-red-500">Error loading stock data. Please try again.</td></tr>`;
            }
        }

        function displayStockList(products) {
            const tbody = document.getElementById('stockListTableBody');

            if (products.length === 0) {
                tbody.innerHTML = '<tr><td colspan="11" class="px-6 py-4 text-center text-gray-500">No items found matching your criteria</td></tr>';
                return;
            }

            tbody.innerHTML = '';
            products.forEach(product => {
                const quantity = parseInt(product.quantity) || 0;
                const warnQuantity = parseInt(product.warn_quantity) || 0;
                const totalValue = (parseFloat(product.purchase_cost) || 0) * quantity;

                let statusBadge = '';
                let statusClass = '';

                if (quantity <= 0) {
                    statusBadge = 'Out of Stock';
                    statusClass = 'bg-red-100 text-red-800';
                } else if (quantity <= warnQuantity) {
                    statusBadge = 'Low Stock';
                    statusClass = 'bg-yellow-100 text-yellow-800';
                } else {
                    statusBadge = 'In Stock';
                    statusClass = 'bg-green-100 text-green-800';
                }

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${product.item_code || '-'}</td>
                    <td class="px-2 py-4 text-sm text-gray-500">
                        <div class="description-tooltip" title="${product.description || ''}">${product.description ? (product.description.length > 30 ? product.description.substring(0, 30) + '...' : product.description) : '-'}</div>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">${product.category?.name || '-'}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">${product.supplier?.name || '-'}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">${product.location?.name || '-'}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">${quantity}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">${warnQuantity}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">$${parseFloat(product.sales_price || 0).toFixed(2)}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">$${totalValue.toFixed(2)}</td>
                    <td class="px-2 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">${statusBadge}</span>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(product.created_at || Date.now()).toLocaleDateString()}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <button onclick="viewItemDetails(${product.id})" class="action-button edit action-button-tooltip" data-tooltip="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button onclick="editItem(${product.id})" class="action-button edit action-button-tooltip" data-tooltip="Edit Item">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function updateStockListSummary(products) {
            const totalItems = products.length;
            const totalValue = products.reduce((sum, product) => {
                return sum + ((parseFloat(product.purchase_cost) || 0) * (parseInt(product.quantity) || 0));
            }, 0);

            const lowStock = products.filter(product => {
                const quantity = parseInt(product.quantity) || 0;
                const warnQuantity = parseInt(product.warn_quantity) || 0;
                return quantity <= warnQuantity && quantity > 0;
            }).length;

            const outOfStock = products.filter(product => parseInt(product.quantity) <= 0).length;

            document.getElementById('stockTotalItems').textContent = totalItems;
            document.getElementById('stockTotalValue').textContent = `$${totalValue.toFixed(2)}`;
            document.getElementById('stockLowStock').textContent = lowStock;
            document.getElementById('stockOutOfStock').textContent = outOfStock;
        }

        function clearStockListFilters() {
            document.getElementById('stockListLocationFilter').value = '';
            document.getElementById('stockListCategoryFilter').value = '';
            document.getElementById('stockListSupplierFilter').value = '';
            document.getElementById('stockListStatusFilter').value = '';
            loadStockList();
        }

        function exportStockList(format) {
            // For now, show a message that export functionality is coming soon
            showToast(`Export to ${format.toUpperCase()} functionality coming soon!`, 'info');
        }

        function updateAvailableQuantity() {
            const productSelect = document.getElementById('transferProduct');
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const quantity = selectedOption?.dataset?.quantity || 0;
            const price = selectedOption?.dataset?.price || 0;

            document.getElementById('availableQuantity').textContent = quantity;
            document.getElementById('itemUnitPrice').textContent = `$${parseFloat(price).toFixed(2)}`;

            updateTransferSummary();
        }

        function updateTransferSummary() {
            const quantity = parseInt(document.getElementById('transferQuantity').value) || 0;
            const price = parseFloat(document.getElementById('itemUnitPrice').textContent.replace('$', '')) || 0;
            const fromLocation = document.getElementById('transferFromLocation').options[document.getElementById('transferFromLocation').selectedIndex]?.text || '';
            const toLocation = document.getElementById('transferToLocation').options[document.getElementById('transferToLocation').selectedIndex]?.text || '';
            const productSelect = document.getElementById('transferProduct');
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const itemText = selectedOption ? selectedOption.text.split(' (Qty:')[0] : '';

            document.getElementById('summaryItem').textContent = itemText;
            document.getElementById('summaryQuantity').textContent = quantity;
            document.getElementById('summaryValue').textContent = `$${parseFloat(quantity * price).toFixed(2)}`;
        }

        function generateTransferReference() {
            const prefix = 'TRF';
            const date = new Date();
            const year = date.getFullYear().toString().slice(-2);
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const day = date.getDate().toString().padStart(2, '0');
            const timestamp = date.getTime().toString().slice(-4);
            return `${prefix}${year}${month}${day}${timestamp}`;
        }

        // Add form submission handler for transfer stock
        document.getElementById('transferStockForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            // Validate transfer
            const fromLocation = formData.get('from_location_id');
            const toLocation = formData.get('to_location_id');
            const productId = formData.get('product_id');
            const quantity = parseInt(formData.get('quantity')) || 0;
            const availableQty = parseInt(document.getElementById('availableQuantity').textContent) || 0;

            if (fromLocation === toLocation) {
                showToast('Source and destination locations cannot be the same', 'error');
                return;
            }

            if (quantity > availableQty) {
                showToast('Transfer quantity cannot exceed available quantity', 'error');
                return;
            }

            if (quantity <= 0) {
                showToast('Transfer quantity must be greater than 0', 'error');
                return;
            }

            try {
                showLoading('Processing stock transfer...');

                // Here you would send the transfer data to the server
                // For now, simulate success
                await new Promise(resolve => setTimeout(resolve, 1500));

                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: `Stock transfer completed successfully! Reference: ${formData.get('reference')}`,
                    timer: 2000,
                    showConfirmButton: false
                });

                closeTransferStockModal();
                updateDashboardStats(); // Update stats after transfer

            } catch (error) {
                console.error('Error processing transfer:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Failed to process stock transfer'
                });
            }
        });

        // Add event listener for quantity input changes
        document.getElementById('transferQuantity').addEventListener('input', updateTransferSummary);

        // Refresh Latest Products table after operations
        async function refreshLatestProductsTable() {
            try {
                const response = await fetch('/api/latest-products', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to refresh latest products');

                const latestProducts = await response.json();
                updateLatestProductsTable(latestProducts);

                // Update stats as well
                updateDashboardStats();

            } catch (error) {
                console.error('Error refreshing latest products:', error);
                // If API fails, reload page as fallback
                window.location.reload();
            }
        }

        function updateLatestProductsTable(products) {
            const tbody = document.querySelector('.latest-products-tbody');

            if (!tbody) {
                // If table doesn't exist, reload page
                window.location.reload();
                return;
            }

            tbody.innerHTML = '';

            if (products.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No products found
                        </td>
                    </tr>
                `;
                return;
            }

            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        ${product.item_code || '-'}
                    </td>
                    <td class="px-2 py-4 text-sm text-gray-500">
                        <div class="description-tooltip" title="${product.description || ''}">${product.description ? (product.description.length > 30 ? product.description.substring(0, 30) + '...' : product.description) : '-'}</div>
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                        ${product.category?.name || 'N/A'}
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                        ${product.supplier?.name || 'N/A'}
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                        ${product.location?.name || 'N/A'}
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                        ${product.quantity || '0'}
                    </td>
                    <td class="px-2 py-4 whitespace-nowrap">
                        ${product.quantity <= product.warn_quantity
                            ? '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Low Stock</span>'
                            : '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">In Stock</span>'}
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Toggle section expand/collapse
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            const chevron = document.getElementById(sectionId + '-chevron');

            if (section.classList.contains('section-expanded')) {
                // Collapse section
                section.classList.remove('section-expanded');
                section.style.maxHeight = '0';
                chevron.classList.remove('rotate-180');
            } else {
                // Expand section
                section.classList.add('section-expanded');
                section.style.maxHeight = section.scrollHeight + 'px';
                chevron.classList.add('rotate-180');
            }
        }

        // Brand Management Functions
        async function showBrandManagement() {
            try {
                openViewModal();
                // Small delay to ensure modal is fully rendered
                setTimeout(() => switchViewTab('brands'), 100);
            } catch (error) {
                console.error('Error loading brand management:', error);
                showToast('Error loading brand management', 'error');
            }
        }

        async function loadBrandsTable() {
            const tbody = document.getElementById('brandsTableBody');
            if (!tbody) return;

            showTableLoading('brandsTableBody');

            try {
                const response = await fetch('/api/brands', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load brands');

                const brands = await response.json();
                tbody.innerHTML = '';

                if (brands.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No brands found
                            </td>
                        </tr>
                    `;
                    return;
                }

                brands.forEach(brand => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${brand.name}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${brand.description || '-'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${brand.products_count || 0}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <button onclick="editBrand(${brand.id})"
                                    class="action-button edit action-button-tooltip"
                                    data-tooltip="Edit Brand">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteBrand(${brand.id})"
                                    class="action-button delete action-button-tooltip"
                                    data-tooltip="Delete Brand">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (error) {
                console.error('Error loading brands:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-red-500">
                            Error loading brands. Please try again.
                        </td>
                    </tr>
                `;
                showToast('Error loading brands', 'error');
            }
        }

        function openAddBrandModal() {
            // Create and show add brand modal
            const modal = document.createElement('div');
            modal.id = 'addBrandModal';
            modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50';
            modal.innerHTML = `
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Add New Brand</h3>
                        <button onclick="closeAddBrandModal()" class="text-gray-500 hover:text-gray-700">×</button>
                    </div>
                    <form id="addBrandForm" class="space-y-4">
                        <div class="form-group">
                            <label class="form-label">Brand Name</label>
                            <input type="text" name="name" required class="form-input" placeholder="Enter brand name">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3" class="form-textarea" placeholder="Enter brand description"></textarea>
                        </div>
                        <div class="flex justify-end gap-4">
                            <button type="button" onclick="closeAddBrandModal()" class="btn-secondary">Cancel</button>
                            <button type="submit" class="btn-primary">Add Brand</button>
                        </div>
                    </form>
                </div>
            `;
            document.body.appendChild(modal);

            // Show modal
            modal.classList.remove('hidden');

            // Add form submission handler
            document.getElementById('addBrandForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                try {
                    const formData = new FormData(this);
                    const data = Object.fromEntries(formData);

                    const response = await fetch('/api/brands', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        throw new Error(result.message || 'Failed to create brand');
                    }

                    showToast('Brand added successfully', 'success');
                    closeAddBrandModal();
                    await loadBrandsTable();
                } catch (error) {
                    console.error('Error creating brand:', error);
                    showToast(error.message || 'Error creating brand', 'error');
                }
            });
        }

        function closeAddBrandModal() {
            const modal = document.getElementById('addBrandModal');
            if (modal) {
                modal.remove();
            }
        }

        async function deleteBrand(id) {
            const confirmed = await showConfirm('Are you sure?', "You won't be able to revert this brand!");
            if (confirmed) {
                try {
                    showLoading('Deleting...');
                    const response = await fetch(`/api/brands/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        throw new Error(result.message || 'Failed to delete brand');
                    }

                    showToast('Brand deleted successfully');
                    await loadBrandsTable();
                } catch (error) {
                    console.error('Error deleting brand:', error);
                    showToast(error.message || 'Failed to delete brand', 'error');
                }
            }
        }

        async function addBrandTabToViewModal() {
            const tabContainer = document.querySelector('.view-content .flex.-mb-px');
            if (!tabContainer) return;

            // Check if brands tab already exists
            if (document.getElementById('brandsTab')) return;

            // Add brands tab button
            const brandsTabButton = document.createElement('button');
            brandsTabButton.onclick = () => switchViewTab('brands');
            brandsTabButton.className = 'view-tab-button';
            brandsTabButton.setAttribute('data-tab', 'brands');
            brandsTabButton.id = 'brandsTabButton';
            brandsTabButton.textContent = 'Brands';
            tabContainer.appendChild(brandsTabButton);

            // Add brands tab content
            const viewContent = document.querySelector('.view-content');
            const brandsTabContent = document.createElement('div');
            brandsTabContent.id = 'brandsTab';
            brandsTabContent.className = 'view-tab-content hidden';
            brandsTabContent.innerHTML = `
                <div class="flex justify-between mb-4">
                    <h4 class="text-lg font-semibold">Brands</h4>
                    <button onclick="openAddBrandModal()" class="btn-primary">
                        <i class="fas fa-plus mr-2"></i>Add Brand
                    </button>
                </div>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items Count</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="brandsTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Brands will be loaded here -->
                        </tbody>
                    </table>
                </div>
            `;
            viewContent.appendChild(brandsTabContent);

            // Load brands data
            await loadBrandsTable();
        }



        function openAddBrandModal() {
            // Create and show add brand modal
            const modal = document.createElement('div');
            modal.id = 'addBrandModal';
            modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50';
            modal.innerHTML = `
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Add New Brand</h3>
                        <button onclick="closeAddBrandModal()" class="text-gray-500 hover:text-gray-700">×</button>
                    </div>
                    <form id="addBrandForm" class="space-y-4">
                        <div class="form-group">
                            <label class="form-label">Brand Name</label>
                            <input type="text" name="name" required class="form-input" placeholder="Enter brand name">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3" class="form-textarea" placeholder="Enter brand description"></textarea>
                        </div>
                        <div class="flex justify-end gap-4">
                            <button type="button" onclick="closeAddBrandModal()" class="btn-secondary">Cancel</button>
                            <button type="submit" class="btn-primary">Add Brand</button>
                        </div>
                    </form>
                </div>
            `;
            document.body.appendChild(modal);

            // Show modal
            modal.classList.remove('hidden');

            // Add form submission handler
            document.getElementById('addBrandForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                try {
                    await submitForm('/brands', new FormData(this), 'Brand added successfully', () => {
                        closeAddBrandModal();
                        loadBrandsTable();
                    });
                } catch (error) {
                    // Error handled by submitForm
                }
            });
        }

        function closeAddBrandModal() {
            const modal = document.getElementById('addBrandModal');
            if (modal) {
                modal.remove();
            }
        }

        async function deleteBrand(id) {
            const confirmed = await showConfirm('Are you sure?', "You won't be able to revert this brand!");
            if (confirmed) {
                try {
                    showLoading('Deleting...');
                    const response = await fetch(`/brands/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    if (!response.ok) throw new Error('Failed to delete brand');
                    showToast('Brand deleted successfully');
                    await loadBrandsTable();
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: error.message || 'Failed to delete brand'
                    });
                }
            }
        }

        // Unit Management Functions
        async function showUnitManagement() {
            try {
                openViewModal();
                switchViewTab('units');
            } catch (error) {
                console.error('Error loading unit management:', error);
                showToast('Error loading unit management', 'error');
            }
        }

        async function loadUnitsTable() {
            const tbody = document.getElementById('unitsTableBody');
            if (!tbody) return;

            showTableLoading('unitsTableBody');

            try {
                const response = await fetch('/api/units', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load units');

                const units = await response.json();
                tbody.innerHTML = '';

                if (units.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No units found
                            </td>
                        </tr>
                    `;
                    return;
                }

                units.forEach(unit => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${unit.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${unit.symbol || '-'}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${unit.description || '-'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <button onclick="editUnit(${unit.id})"
                                    class="action-button edit action-button-tooltip"
                                    data-tooltip="Edit Unit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteUnit(${unit.id})"
                                    class="action-button delete action-button-tooltip"
                                    data-tooltip="Delete Unit">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (error) {
                console.error('Error loading units:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-red-500">
                            Error loading units. Please try again.
                        </td>
                    </tr>
                `;
                showToast('Error loading units', 'error');
            }
        }

        function openAddUnitModal() {
            const modal = document.createElement('div');
            modal.id = 'addUnitModal';
            modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50';
            modal.innerHTML = `
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Add New Unit</h3>
                        <button onclick="closeAddUnitModal()" class="text-gray-500 hover:text-gray-700">×</button>
                    </div>
                    <form id="addUnitForm" class="space-y-4">
                        <div class="form-group">
                            <label class="form-label">Unit Name</label>
                            <input type="text" name="name" required class="form-input" placeholder="Enter unit name">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Symbol</label>
                            <input type="text" name="symbol" class="form-input" placeholder="Enter unit symbol">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3" class="form-textarea" placeholder="Enter unit description"></textarea>
                        </div>
                        <div class="flex justify-end gap-4">
                            <button type="button" onclick="closeAddUnitModal()" class="btn-secondary">Cancel</button>
                            <button type="submit" class="btn-primary">Add Unit</button>
                        </div>
                    </form>
                </div>
            `;
            document.body.appendChild(modal);
            modal.classList.remove('hidden');

            document.getElementById('addUnitForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                try {
                    await submitForm('/units', new FormData(this), 'Unit added successfully', () => {
                        closeAddUnitModal();
                        loadUnitsTable();
                    });
                } catch (error) {
                    // Error handled by submitForm
                }
            });
        }

        function closeAddUnitModal() {
            const modal = document.getElementById('addUnitModal');
            if (modal) modal.remove();
        }

        async function deleteUnit(id) {
            const confirmed = await showConfirm('Are you sure?', "You won't be able to revert this unit!");
            if (confirmed) {
                try {
                    showLoading('Deleting...');
                    const response = await fetch(`/units/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    if (!response.ok) throw new Error('Failed to delete unit');
                    showToast('Unit deleted successfully');
                    await loadUnitsTable();
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: error.message || 'Failed to delete unit'
                    });
                }
            }
        }

        // Barcode Printing Function
        async function printBarcode() {
            try {
                // Get selected products for barcode printing
                const selectedProducts = await getSelectedProductsForBarcode();

                if (selectedProducts.length === 0) {
                    showToast('Please select products to print barcodes', 'warning');
                    return;
                }

                // Open barcode printing modal
                openBarcodePrintModal(selectedProducts);
            } catch (error) {
                console.error('Error in barcode printing:', error);
                showToast('Error preparing barcode printing', 'error');
            }
        }

        async function getSelectedProductsForBarcode() {
            // For now, return all products. In a real implementation,
            // you might want to show a selection interface
            try {
                const response = await fetch('/api/products', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load products');
                return await response.json();
            } catch (error) {
                console.error('Error loading products for barcode:', error);
                return [];
            }
        }

        function openBarcodePrintModal(products) {
            const modal = document.createElement('div');
            modal.id = 'barcodePrintModal';
            modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50';

            let productOptions = '';
            products.forEach(product => {
                productOptions += `<option value="${product.id}">${product.item_code} - ${product.description}</option>`;
            });

            modal.innerHTML = `
                <div class="relative top-20 mx-auto p-6 border w-11/12 md:w-3/4 lg:w-1/2 modal-content bg-white rounded-lg">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">Print Barcodes</h3>
                        <button onclick="closeBarcodePrintModal()" class="text-gray-500 hover:text-gray-700">×</button>
                    </div>

                    <form id="barcodePrintForm" class="space-y-6">
                        <div class="form-group">
                            <label class="form-label">Select Products</label>
                            <select name="product_ids[]" multiple class="form-input" size="8" required>
                                ${productOptions}
                            </select>
                            <small class="text-gray-500">Hold Ctrl/Cmd to select multiple products</small>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="form-group">
                                <label class="form-label">Copies per Product</label>
                                <input type="number" name="copies" value="1" min="1" class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Barcode Type</label>
                                <select name="barcode_type" class="form-select">
                                    <option value="code128">Code 128</option>
                                    <option value="code39">Code 39</option>
                                    <option value="ean13">EAN-13</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Paper Size</label>
                                <select name="paper_size" class="form-select">
                                    <option value="a4">A4</option>
                                    <option value="letter">Letter</option>
                                    <option value="label">Label</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end gap-4">
                            <button type="button" onclick="closeBarcodePrintModal()" class="btn-secondary">Cancel</button>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-print mr-2"></i>Generate & Print
                            </button>
                        </div>
                    </form>
                </div>
            `;

            document.body.appendChild(modal);
            modal.classList.remove('hidden');

            document.getElementById('barcodePrintForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                try {
                    showLoading('Generating barcodes...');

                    const formData = new FormData(this);
                    const response = await fetch('/barcodes/generate', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    if (!response.ok) throw new Error('Failed to generate barcodes');

                    const result = await response.json();

                    // Open print window
                    window.open(result.print_url, '_blank');

                    closeBarcodePrintModal();
                    Swal.close();
                } catch (error) {
                    console.error('Error generating barcodes:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: error.message || 'Failed to generate barcodes'
                    });
                }
            });
        }

        function closeBarcodePrintModal() {
            const modal = document.getElementById('barcodePrintModal');
            if (modal) modal.remove();
        }

        // Adjustment Management Functions
        async function openAdjustmentListModal() {
            try {
                const modal = document.createElement('div');
                modal.id = 'adjustmentListModal';
                modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50';

                modal.innerHTML = `
                    <div class="relative top-20 mx-auto p-6 border w-11/12 xl:w-4/5 modal-content bg-white rounded-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Stock Adjustments</h3>
                            <button onclick="closeAdjustmentListModal()" class="text-gray-500 hover:text-gray-700">×</button>
                        </div>

                        <div class="flex justify-between mb-4">
                            <div class="flex gap-2">
                                <input type="text" id="adjustmentSearch" placeholder="Search adjustments..." class="form-input w-64">
                                <select id="adjustmentTypeFilter" class="form-select">
                                    <option value="">All Types</option>
                                    <option value="addition">Addition</option>
                                    <option value="reduction">Reduction</option>
                                </select>
                            </div>
                            <button onclick="openAddAdjustmentModal()" class="btn-primary">
                                <i class="fas fa-plus mr-2"></i>Add Adjustment
                            </button>
                        </div>

                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reference</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="adjustmentListTableBody" class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                                Loading adjustments...
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                `;

                document.body.appendChild(modal);
                modal.classList.remove('hidden');

                await loadAdjustmentList();

                // Add search and filter functionality
                document.getElementById('adjustmentSearch').addEventListener('input', loadAdjustmentList);
                document.getElementById('adjustmentTypeFilter').addEventListener('change', loadAdjustmentList);

            } catch (error) {
                console.error('Error opening adjustment list modal:', error);
                showToast('Error loading adjustment list', 'error');
            }
        }

        async function loadAdjustmentList() {
            const tbody = document.getElementById('adjustmentListTableBody');
            if (!tbody) return;

            showTableLoading('adjustmentListTableBody');

            try {
                const search = document.getElementById('adjustmentSearch')?.value || '';
                const type = document.getElementById('adjustmentTypeFilter')?.value || '';

                const params = new URLSearchParams();
                if (search) params.append('search', search);
                if (type) params.append('type', type);

                const response = await fetch(`/api/adjustments?${params}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load adjustments');

                const result = await response.json();
                const adjustments = result.data || result; // Handle paginated response
                tbody.innerHTML = '';

                if (adjustments.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No adjustments found
                            </td>
                        </tr>
                    `;
                    return;
                }

                adjustments.forEach(adjustment => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${adjustment.reference || '-'}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${adjustment.product?.description || '-'}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${adjustment.type === 'addition' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                                ${adjustment.type}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${adjustment.quantity}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${adjustment.reason || '-'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(adjustment.created_at).toLocaleDateString()}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="viewAdjustmentDetails(${adjustment.id})"
                                    class="action-button edit action-button-tooltip"
                                    data-tooltip="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            } catch (error) {
                console.error('Error loading adjustments:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-red-500">
                            Error loading adjustments. Please try again.
                        </td>
                    </tr>
                `;
                showToast('Error loading adjustments', 'error');
            }
        }

        function closeAdjustmentListModal() {
            const modal = document.getElementById('adjustmentListModal');
            if (modal) modal.remove();
        }

        async function openAddAdjustmentModal() {
            try {
                const modal = document.createElement('div');
                modal.id = 'addAdjustmentModal';
                modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50';

                modal.innerHTML = `
                    <div class="relative top-20 mx-auto p-6 border w-11/12 md:w-3/4 lg:w-1/2 modal-content bg-white rounded-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Add Stock Adjustment</h3>
                            <button onclick="closeAddAdjustmentModal()" class="text-gray-500 hover:text-gray-700">×</button>
                        </div>

                        <form id="addAdjustmentForm" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label class="form-label">Product</label>
                                    <select name="product_id" id="adjustmentProduct" class="form-select" required>
                                        <option value="">Select Product</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Adjustment Type</label>
                                    <select name="type" class="form-select" required>
                                        <option value="addition">Addition (+)</option>
                                        <option value="reduction">Reduction (-)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="quantity" class="form-input" min="1" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Reason</label>
                                    <select name="reason" class="form-select" required>
                                        <option value="">Select Reason</option>
                                        <option value="damaged">Damaged</option>
                                        <option value="lost">Lost</option>
                                        <option value="found">Found</option>
                                        <option value="correction">Correction</option>
                                        <option value="donation">Donation</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" rows="3" class="form-textarea" placeholder="Additional notes"></textarea>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Current Stock</label>
                                        <p class="text-lg font-semibold text-blue-600" id="currentStock">0</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Adjusted Stock</label>
                                        <p class="text-lg font-semibold text-green-600" id="adjustedStock">0</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end gap-4">
                                <button type="button" onclick="closeAddAdjustmentModal()" class="btn-secondary">Cancel</button>
                                <button type="submit" class="btn-primary">Create Adjustment</button>
                            </div>
                        </form>
                    </div>
                `;

                document.body.appendChild(modal);
                modal.classList.remove('hidden');

                // Load products for selection
                await loadAdjustmentProducts();

                // Add form event listeners
                const form = document.getElementById('addAdjustmentForm');
                const productSelect = document.getElementById('adjustmentProduct');
                const typeSelect = form.querySelector('select[name="type"]');
                const quantityInput = form.querySelector('input[name="quantity"]');

                productSelect.addEventListener('change', updateCurrentStock);
                typeSelect.addEventListener('change', calculateAdjustedStock);
                quantityInput.addEventListener('input', calculateAdjustedStock);

                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    try {
                        await submitForm('/adjustments', new FormData(this), 'Stock adjustment created successfully', () => {
                            closeAddAdjustmentModal();
                            if (document.getElementById('adjustmentListModal')) {
                                loadAdjustmentList();
                            }
                            updateDashboardStats();
                        });
                    } catch (error) {
                        // Error handled by submitForm
                    }
                });

            } catch (error) {
                console.error('Error opening add adjustment modal:', error);
                showToast('Error loading adjustment form', 'error');
            }
        }

        async function loadAdjustmentProducts() {
            try {
                const response = await fetch('/api/products', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load products');

                const products = await response.json();
                const select = document.getElementById('adjustmentProduct');

                products.forEach(product => {
                    const option = new Option(`${product.item_code} - ${product.description} (Current: ${product.quantity})`, product.id);
                    option.dataset.currentStock = product.quantity;
                    select.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading products for adjustment:', error);
                showToast('Error loading products', 'error');
            }
        }

        function updateCurrentStock() {
            const productSelect = document.getElementById('adjustmentProduct');
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const currentStock = selectedOption ? selectedOption.dataset.currentStock : 0;

            document.getElementById('currentStock').textContent = currentStock;
            calculateAdjustedStock();
        }

        function calculateAdjustedStock() {
            const currentStock = parseInt(document.getElementById('currentStock').textContent) || 0;
            const quantity = parseInt(document.querySelector('#addAdjustmentForm input[name="quantity"]').value) || 0;
            const type = document.querySelector('#addAdjustmentForm select[name="type"]').value;

            let adjustedStock = currentStock;
            if (type === 'addition') {
                adjustedStock += quantity;
            } else if (type === 'reduction') {
                adjustedStock -= quantity;
            }

            document.getElementById('adjustedStock').textContent = adjustedStock;
        }

        function closeAddAdjustmentModal() {
            const modal = document.getElementById('addAdjustmentModal');
            if (modal) modal.remove();
        }

        // Stock Count Functions
        async function openStockCountModal() {
            try {
                const modal = document.createElement('div');
                modal.id = 'stockCountModal';
                modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50';

                modal.innerHTML = `
                    <div class="relative top-20 mx-auto p-6 border w-11/12 xl:w-4/5 modal-content bg-white rounded-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Stock Count</h3>
                            <button onclick="closeStockCountModal()" class="text-gray-500 hover:text-gray-700">×</button>
                        </div>

                        <div class="mb-6">
                            <div class="flex gap-4 mb-4">
                                <div class="form-group flex-1">
                                    <label class="form-label">Location</label>
                                    <select id="stockCountLocation" class="form-select">
                                        <option value="">All Locations</option>
                                    </select>
                                </div>
                                <div class="form-group flex-1">
                                    <label class="form-label">Category</label>
                                    <select id="stockCountCategory" class="form-select">
                                        <option value="">All Categories</option>
                                    </select>
                                </div>
                                <button onclick="startStockCount()" class="btn-primary self-end">
                                    <i class="fas fa-play mr-2"></i>Start Count
                                </button>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">System Count</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Physical Count</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Difference</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="stockCountTableBody" class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                Select location and category, then click "Start Count"
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-4">
                            <button onclick="saveStockCount()" class="btn-primary">
                                <i class="fas fa-save mr-2"></i>Save Count
                            </button>
                            <button onclick="closeStockCountModal()" class="btn-secondary">Cancel</button>
                        </div>
                    </div>
                `;

                document.body.appendChild(modal);
                modal.classList.remove('hidden');

                // Load filters
                await loadStockCountFilters();

            } catch (error) {
                console.error('Error opening stock count modal:', error);
                showToast('Error loading stock count', 'error');
            }
        }

        async function loadStockCountFilters() {
            try {
                // Load locations
                const locations = await fetch('/locations').then(res => res.json());
                const locationSelect = document.getElementById('stockCountLocation');
                locationSelect.innerHTML = '<option value="">All Locations</option>';
                locations.forEach(location => {
                    locationSelect.add(new Option(location.name, location.id));
                });

                // Load categories
                const categories = await fetch('/categories').then(res => res.json());
                const categorySelect = document.getElementById('stockCountCategory');
                categorySelect.innerHTML = '<option value="">All Categories</option>';
                categories.forEach(category => {
                    categorySelect.add(new Option(category.name, category.id));
                });
            } catch (error) {
                console.error('Error loading stock count filters:', error);
                showToast('Error loading filters', 'error');
            }
        }

        async function startStockCount() {
            const locationId = document.getElementById('stockCountLocation').value;
            const categoryId = document.getElementById('stockCountCategory').value;

            if (!locationId && !categoryId) {
                showToast('Please select at least a location or category', 'warning');
                return;
            }

            try {
                showLoading('Loading products for count...');

                const params = new URLSearchParams();
                if (locationId) params.append('location_id', locationId);
                if (categoryId) params.append('category_id', categoryId);

                const response = await fetch(`/api/products?${params}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Failed to load products');

                const products = await response.json();
                displayStockCountItems(products);

                Swal.close();
            } catch (error) {
                console.error('Error starting stock count:', error);
                showToast('Error loading products for count', 'error');
            }
        }

        function displayStockCountItems(products) {
            const tbody = document.getElementById('stockCountTableBody');
            tbody.innerHTML = '';

            if (products.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No products found for the selected filters
                        </td>
                    </tr>
                `;
                return;
            }

            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div>
                            <div class="font-medium">${product.item_code}</div>
                            <div class="text-gray-500">${product.description}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${product.quantity}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="number" class="form-input w-20 physical-count"
                               data-product-id="${product.id}"
                               data-system-count="${product.quantity}"
                               min="0" placeholder="Count">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 difference" id="diff-${product.id}">0</td>
                    <td class="px-6 py-4 whitespace-nowrap status" id="status-${product.id}">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            Pending
                        </span>
                    </td>
                `;
                tbody.appendChild(row);
            });

            // Add event listeners for physical count inputs
            document.querySelectorAll('.physical-count').forEach(input => {
                input.addEventListener('input', function() {
                    updateCountDifference(this);
                });
            });
        }

        function updateCountDifference(input) {
            const productId = input.dataset.productId;
            const systemCount = parseInt(input.dataset.systemCount) || 0;
            const physicalCount = parseInt(input.value) || 0;
            const difference = physicalCount - systemCount;

            const diffElement = document.getElementById(`diff-${productId}`);
            const statusElement = document.getElementById(`status-${productId}`);

            diffElement.textContent = difference;

            if (difference > 0) {
                diffElement.className = 'px-6 py-4 whitespace-nowrap text-sm text-green-600';
                statusElement.innerHTML = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Surplus</span>';
            } else if (difference < 0) {
                diffElement.className = 'px-6 py-4 whitespace-nowrap text-sm text-red-600';
                statusElement.innerHTML = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Shortage</span>';
            } else {
                diffElement.className = 'px-6 py-4 whitespace-nowrap text-sm text-gray-500';
                statusElement.innerHTML = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Matched</span>';
            }
        }

        async function saveStockCount() {
            const countData = [];
            document.querySelectorAll('.physical-count').forEach(input => {
                const productId = input.dataset.productId;
                const physicalCount = parseInt(input.value) || 0;
                const systemCount = parseInt(input.dataset.systemCount) || 0;

                if (physicalCount !== systemCount) {
                    countData.push({
                        product_id: productId,
                        system_count: systemCount,
                        physical_count: physicalCount,
                        difference: physicalCount - systemCount
                    });
                }
            });

            if (countData.length === 0) {
                showToast('No changes detected in stock count', 'info');
                return;
            }

            try {
                showLoading('Saving stock count...');

                const response = await fetch('/stock-counts', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        items: countData,
                        location_id: document.getElementById('stockCountLocation').value,
                        category_id: document.getElementById('stockCountCategory').value
                    })
                });

                if (!response.ok) throw new Error('Failed to save stock count');

                const result = await response.json();

                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: `Stock count saved successfully! ${result.adjustments_created || 0} adjustments created.`,
                    timer: 2000,
                    showConfirmButton: false
                });

                closeStockCountModal();
                updateDashboardStats();

            } catch (error) {
                console.error('Error saving stock count:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Failed to save stock count'
                });
            }
        }

        function closeStockCountModal() {
            const modal = document.getElementById('stockCountModal');
            if (modal) modal.remove();
        }

        // Initialize all sections on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all sections as collapsed by default
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => {
                section.classList.remove('section-expanded');
                section.style.maxHeight = '0';
            });

            // Remove rotate-180 class from all chevrons (they start pointing down)
            const chevrons = document.querySelectorAll('[id$="-chevron"]');
            chevrons.forEach(chevron => {
                chevron.classList.remove('rotate-180');
            });
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    timer: 1500,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    showConfirmButton: true
                });
            });



        </script>
    @endif


    <script>
        // Toggle sidebar functions
function openSidebar() {
    document.getElementById('sidebar-container').classList.remove('-translate-x-full');
    document.getElementById('sidebar-overlay').classList.remove('hidden');
    if (window.innerWidth < 1024) {
        document.body.classList.add('overflow-hidden');
    }
}

function closeSidebar() {
    document.getElementById('sidebar-container').classList.add('-translate-x-full');
    document.getElementById('sidebar-overlay').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Toggle sidebar on mobile and desktop
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar-container');

    if (sidebar.classList.contains('-translate-x-full')) {
        openSidebar();
    } else {
        closeSidebar();
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Open sidebar on desktop by default
    if (window.innerWidth >= 1024) {
        openSidebar();
    }

    // Toggle button
    const toggleBtn = document.getElementById('sidebar-toggle');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', toggleSidebar);
    }

    // Close button
    const closeBtn = document.getElementById('sidebar-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', closeSidebar);
    }

    // Close when clicking overlay
    const overlay = document.getElementById('sidebar-overlay');
    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    // Close sidebar when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSidebar();
        }
    });
});


    </script>
</body>

</html>
