@php
    $userGold = auth()->user()->points ?? 0;
    $userFree = \App\Models\Freepoints::where('userid', auth()->id())->value('points') ?? 0;
@endphp

<aside id="sidebar"
    class="fixed inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40 w-64 flex-shrink-0 bg-white border-r border-slate-150 shadow-xl lg:static lg:shadow-none lg:h-auto overflow-y-auto">
    <div class="p-6 flex flex-col h-full justify-between">
        <div>
            <!-- User Info Card -->
            <div class="pb-5 border-b border-slate-100 mb-6 flex flex-col gap-3">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-crimson-red-600 to-red-400 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Welcome back,</p>
                        <p class="text-base font-bold text-slate-800 truncate" title="{{ auth()->user()->name }}">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 mt-1">
                    <div class="bg-amber-50/70 border border-amber-100/50 px-2.5 py-1.5 rounded-xl flex flex-col items-center justify-center">
                        <span class="text-[10px] font-semibold text-amber-800 uppercase">💰 Gold</span>
                        <span class="text-sm font-extrabold text-amber-600 mt-0.5">{{ number_format($userGold) }}</span>
                    </div>
                    <div class="bg-indigo-50/70 border border-indigo-100/50 px-2.5 py-1.5 rounded-xl flex flex-col items-center justify-center">
                        <span class="text-[10px] font-semibold text-indigo-800 uppercase">✨ Free</span>
                        <span class="text-sm font-extrabold text-indigo-600 mt-0.5">{{ number_format($userFree) }}</span>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1.5">
                <!-- Home -->
                <a href="{{ route('home') }}"
                    class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200
                    {{ Route::is('home')
                        ? 'text-white bg-gradient-to-r from-red-600 to-crimson-red-600 shadow-md shadow-red-500/25'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ Route::is('home') ? 'text-white' : 'text-slate-400 group-hover:text-slate-500' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    <span>Home</span>
                </a>

                <!-- Sold Product -->
                <a href="{{ route('sold-products') }}"
                    class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200
                    {{ Route::is('sold-products')
                        ? 'text-white bg-gradient-to-r from-red-600 to-crimson-red-600 shadow-md shadow-red-500/25'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ Route::is('sold-products') ? 'text-white' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1-1h6l-1 1-1-3m-6-4h12l2-6H7l2 6z"></path>
                    </svg>
                    <span>Sold Product</span>
                </a>

                <!-- Add Product -->
                <a href="{{ route('add-product') }}"
                    class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200
                    {{ Route::is('add-product')
                        ? 'text-white bg-gradient-to-r from-red-600 to-crimson-red-600 shadow-md shadow-red-500/25'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ Route::is('add-product') ? 'text-white' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Add Product</span>
                </a>

                <!-- My Products -->
                <a href="{{ route('my-products') }}"
                    class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200
                    {{ Route::is('my-products')
                        ? 'text-white bg-gradient-to-r from-red-600 to-crimson-red-600 shadow-md shadow-red-500/25'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ Route::is('my-products') ? 'text-white' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span>My Products</span>
                </a>

                <!-- My Store -->
                <a href="{{ route('my-store') }}"
                    class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200
                    {{ Route::is('my-store')
                        ? 'text-white bg-gradient-to-r from-red-600 to-crimson-red-600 shadow-md shadow-red-500/25'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ Route::is('my-store') ? 'text-white' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span>My Store</span>
                </a>

                <!-- My Orders -->
                <a href="{{ route('my-orders') }}"
                    class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200
                    {{ Route::is('my-orders')
                        ? 'text-white bg-gradient-to-r from-red-600 to-crimson-red-600 shadow-md shadow-red-500/25'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ Route::is('my-orders') ? 'text-white' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>My Orders</span>
                </a>

                <!-- My Transactions -->
                <a href="{{ route('my-transactions') }}"
                    class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200
                    {{ Route::is('my-transactions')
                        ? 'text-white bg-gradient-to-r from-red-600 to-crimson-red-600 shadow-md shadow-red-500/25'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ Route::is('my-transactions') ? 'text-white' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>My Transactions</span>
                </a>

                <!-- My Gold Points -->
                <a href="{{ route('wallet') }}"
                    class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200
                    {{ Route::is('wallet')
                        ? 'text-white bg-gradient-to-r from-red-600 to-crimson-red-600 shadow-md shadow-red-500/25'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ Route::is('wallet') ? 'text-white' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>My Gold Points</span>
                </a>

                <!-- Post Advertisements -->
                <a href="{{ route('ads.index') }}"
                    class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200
                    {{ request()->routeIs('ads.index')
                        ? 'text-white bg-gradient-to-r from-red-600 to-crimson-red-600 shadow-md shadow-red-500/25'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('ads.index') ? 'text-white' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6m-6 4h6m-6 4h6M5 5h.01M5 9h.01M5 13h.01M5 17h.01"></path>
                    </svg>
                    <span>Post Ads</span>
                </a>

                <!-- Clicked Advertisements -->
                <a href="{{ route('ads.dash') }}"
                    class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200
                    {{ request()->routeIs('ads.dash')
                        ? 'text-white bg-gradient-to-r from-red-600 to-crimson-red-600 shadow-md shadow-red-500/25'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('ads.dash') ? 'text-white' : 'text-slate-400 group-hover:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6m-6 4h6m-6 4h6M5 5h.01M5 9h.01M5 13h.01M5 17h.01"></path>
                    </svg>
                    <span>Clicked Ads</span>
                </a>
            </nav>
        </div>

        <!-- Logout Form -->
        <div class="pt-6 mt-6 border-t border-slate-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="group flex items-center w-full px-4 py-3 text-sm font-semibold text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all duration-150">
                    <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
