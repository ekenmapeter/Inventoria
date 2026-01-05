<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links (desktop) -->
                <div class="hidden sm:-my-px sm:ml-4 sm:flex sm:flex-wrap sm:items-center sm:gap-x-4 sm:gap-y-1 lg:ml-10">
                    {{-- Core --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- Inventory --}}
                    <x-dropdown align="left" width="64">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 transition">
                                {{ __('Inventory') }}
                                <svg class="ms-1 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="px-2 py-1 text-xs font-semibold text-gray-400 uppercase">
                                {{ __('Master Data') }}
                            </div>
                            <x-dropdown-link :href="route('products.index')">{{ __('Product List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('products.create')">{{ __('Add Product') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('categories.index')">{{ __('Category') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('brands.index')">{{ __('Brand') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('units.index')">{{ __('Unit') }}</x-dropdown-link>

                            <div class="mt-2 px-2 py-1 text-xs font-semibold text-gray-400 uppercase">
                                {{ __('Adjustments & Stock') }}
                            </div>
                            <x-dropdown-link :href="route('barcodes.index')">{{ __('Print Barcode') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('adjustments.index')">{{ __('Adjustment List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('adjustments.create')">{{ __('Add Adjustment') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('stock-counts.index')">{{ __('Stock Count') }}</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    {{-- Purchasing --}}
                    <x-dropdown align="left" width="64">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 transition">
                                {{ __('Purchase') }}
                                <svg class="ms-1 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('purchases.index')">{{ __('Purchase List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('purchases.create')">{{ __('Add Purchase') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('purchases.import.csv')">{{ __('Import Purchase By CSV') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('purchase-returns.index')">{{ __('Purchase Return') }}</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    {{-- Sales --}}
                    <x-dropdown align="left" width="72">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 transition">
                                {{ __('Sales') }}
                                <svg class="ms-1 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('sales.index')">{{ __('Sale List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('pos.index')">{{ __('POS') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('sales.create')">{{ __('Add Sale') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('sales.import.csv')">{{ __('Import Sale By CSV') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('packing-slips.index')">{{ __('Packing Slip List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('challans.index')">{{ __('Challan List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('deliveries.index')">{{ __('Delivery List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('gift-cards.index')">{{ __('Gift Card List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('coupons.index')">{{ __('Coupon List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('couriers.index')">{{ __('Courier List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('sale-returns.index')">{{ __('Sale Return') }}</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    {{-- Quotation --}}
                    <x-dropdown align="left" width="56">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 transition">
                                {{ __('Quotation') }}
                                <svg class="ms-1 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('quotations.index')">{{ __('Quotation List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('quotations.create')">{{ __('Add Quotation') }}</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    {{-- Transfer --}}
                    <x-dropdown align="left" width="56">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 transition">
                                {{ __('Transfer') }}
                                <svg class="ms-1 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('transfers.index')">{{ __('Transfer List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('transfers.create')">{{ __('Add Transfer') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('transfers.import.csv')">{{ __('Import Transfer By CSV') }}</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    {{-- Expense / Income --}}
                    <x-dropdown align="left" width="72">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 transition">
                                {{ __('Expense & Income') }}
                                <svg class="ms-1 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="px-2 py-1 text-xs font-semibold text-gray-400 uppercase">
                                {{ __('Expense') }}
                            </div>
                            <x-dropdown-link :href="route('expense-categories.index')">{{ __('Expense Category') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('expenses.index')">{{ __('Expense List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('expenses.create')">{{ __('Add Expense') }}</x-dropdown-link>

                            <div class="mt-2 px-2 py-1 text-xs font-semibold text-gray-400 uppercase">
                                {{ __('Income') }}
                            </div>
                            <x-dropdown-link :href="route('income-categories.index')">{{ __('Income Category') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('incomes.index')">{{ __('Income List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('incomes.create')">{{ __('Add Income') }}</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    {{-- People --}}
                    <x-dropdown align="left" width="56">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 transition">
                                {{ __('People') }}
                                <svg class="ms-1 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('customers.index')">{{ __('Customer List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('suppliers.index')">{{ __('Supplier List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('users.index')">{{ __('User List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('agents.index')">{{ __('Sale Agents') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('billers.index')">{{ __('Biller List') }}</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    {{-- Accounting --}}
                    <x-dropdown align="left" width="64">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 transition">
                                {{ __('Accounting') }}
                                <svg class="ms-1 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('accounts.index')">{{ __('Account List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('accounts.create')">{{ __('Add Account') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('money-transfers.index')">{{ __('Money Transfer') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('balance-sheet.index')">{{ __('Balance Sheet') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('account-statements.index')">{{ __('Account Statement') }}</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    {{-- Manufacturing --}}
                    <x-dropdown align="left" width="56">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 transition">
                                {{ __('Manufacturing') }}
                                <svg class="ms-1 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('productions.index')">{{ __('Production List') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('productions.create')">{{ __('Add Production') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('recipes.index')">{{ __('Recipe') }}</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            {{-- Inventory --}}
            <div class="mt-2 border-t border-gray-200 dark:border-gray-700"></div>
            <div class="px-4 pt-2 text-xs font-semibold text-gray-400 uppercase">
                {{ __('Inventory') }}
            </div>
            <x-responsive-nav-link :href="route('products.index')">{{ __('Product List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.create')">{{ __('Add Product') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('categories.index')">{{ __('Category') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('brands.index')">{{ __('Brand') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('units.index')">{{ __('Unit') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('barcodes.index')">{{ __('Print Barcode') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('adjustments.index')">{{ __('Adjustment List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('adjustments.create')">{{ __('Add Adjustment') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('stock-counts.index')">{{ __('Stock Count') }}</x-responsive-nav-link>

            {{-- Purchase --}}
            <div class="mt-2 border-t border-gray-200 dark:border-gray-700"></div>
            <div class="px-4 pt-2 text-xs font-semibold text-gray-400 uppercase">
                {{ __('Purchase') }}
            </div>
            <x-responsive-nav-link :href="route('purchases.index')">{{ __('Purchase List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('purchases.create')">{{ __('Add Purchase') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('purchases.import.csv')">{{ __('Import Purchase By CSV') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('purchase-returns.index')">{{ __('Purchase Return') }}</x-responsive-nav-link>

            {{-- Sales --}}
            <div class="mt-2 border-t border-gray-200 dark:border-gray-700"></div>
            <div class="px-4 pt-2 text-xs font-semibold text-gray-400 uppercase">
                {{ __('Sales') }}
            </div>
            <x-responsive-nav-link :href="route('sales.index')">{{ __('Sale List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pos.index')">{{ __('POS') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('sales.create')">{{ __('Add Sale') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('sales.import.csv')">{{ __('Import Sale By CSV') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('packing-slips.index')">{{ __('Packing Slip List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('challans.index')">{{ __('Challan List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('deliveries.index')">{{ __('Delivery List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('gift-cards.index')">{{ __('Gift Card List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('coupons.index')">{{ __('Coupon List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('couriers.index')">{{ __('Courier List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('sale-returns.index')">{{ __('Sale Return') }}</x-responsive-nav-link>

            {{-- Quotation --}}
            <div class="mt-2 border-t border-gray-200 dark:border-gray-700"></div>
            <div class="px-4 pt-2 text-xs font-semibold text-gray-400 uppercase">
                {{ __('Quotation') }}
            </div>
            <x-responsive-nav-link :href="route('quotations.index')">{{ __('Quotation List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('quotations.create')">{{ __('Add Quotation') }}</x-responsive-nav-link>

            {{-- Transfer --}}
            <div class="mt-2 border-t border-gray-200 dark:border-gray-700"></div>
            <div class="px-4 pt-2 text-xs font-semibold text-gray-400 uppercase">
                {{ __('Transfer') }}
            </div>
            <x-responsive-nav-link :href="route('transfers.index')">{{ __('Transfer List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('transfers.create')">{{ __('Add Transfer') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('transfers.import.csv')">{{ __('Import Transfer By CSV') }}</x-responsive-nav-link>

            {{-- Expense & Income --}}
            <div class="mt-2 border-t border-gray-200 dark:border-gray-700"></div>
            <div class="px-4 pt-2 text-xs font-semibold text-gray-400 uppercase">
                {{ __('Expense & Income') }}
            </div>
            <x-responsive-nav-link :href="route('expense-categories.index')">{{ __('Expense Category') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('expenses.index')">{{ __('Expense List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('expenses.create')">{{ __('Add Expense') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('income-categories.index')">{{ __('Income Category') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('incomes.index')">{{ __('Income List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('incomes.create')">{{ __('Add Income') }}</x-responsive-nav-link>

            {{-- People --}}
            <div class="mt-2 border-t border-gray-200 dark:border-gray-700"></div>
            <div class="px-4 pt-2 text-xs font-semibold text-gray-400 uppercase">
                {{ __('People') }}
            </div>
            <x-responsive-nav-link :href="route('customers.index')">{{ __('Customer List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('suppliers.index')">{{ __('Supplier List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('users.index')">{{ __('User List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('agents.index')">{{ __('Sale Agents') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('billers.index')">{{ __('Biller List') }}</x-responsive-nav-link>

            {{-- Accounting --}}
            <div class="mt-2 border-t border-gray-200 dark:border-gray-700"></div>
            <div class="px-4 pt-2 text-xs font-semibold text-gray-400 uppercase">
                {{ __('Accounting') }}
            </div>
            <x-responsive-nav-link :href="route('accounts.index')">{{ __('Account List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('accounts.create')">{{ __('Add Account') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('money-transfers.index')">{{ __('Money Transfer') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('balance-sheet.index')">{{ __('Balance Sheet') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('account-statements.index')">{{ __('Account Statement') }}</x-responsive-nav-link>

            {{-- Manufacturing --}}
            <div class="mt-2 border-t border-gray-200 dark:border-gray-700"></div>
            <div class="px-4 pt-2 text-xs font-semibold text-gray-400 uppercase">
                {{ __('Manufacturing') }}
            </div>
            <x-responsive-nav-link :href="route('productions.index')">{{ __('Production List') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('productions.create')">{{ __('Add Production') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('recipes.index')">{{ __('Recipe') }}</x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
