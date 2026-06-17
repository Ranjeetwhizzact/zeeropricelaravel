 <aside id="sidebar" class="fixed inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40 w-64 bg-white border-r border-gray-200 shadow-xl lg:static lg:shadow-none lg:h-auto overflow-y-auto">
            <div class="p-6">
                <div class="pb-4 border-b border-gray-200 mb-6">
                    <p class="text-xl font-semibold text-gray-800">Welcome, {{ auth()->user()->name }}</p>
                    <div class="flex space-x-4 mt-2 text-sm text-gray-600">
                        <span>💰 2884 Gold</span>
                        <span>✨ 466 Free</span>
                    </div>
                </div>

           <nav class="space-y-1">
    
    <a href="{{ route('admin.dashboard') }}" 
       class="flex items-center p-3 text-base font-medium rounded-lg shadow-md transition duration-150 
           @if (Route::is('dashboard')) 
               text-white bg-crimson-red-500 
           @else 
               text-gray-600 hover:bg-gray-100 
           @endif">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
       Dashboard
    </a>
    
    <a href="{{ route('admin.category') }}" 
       class="flex items-center p-3 text-base font-medium rounded-lg transition duration-150 
           @if (Route::is('category')) 
               text-white bg-crimson-red-500 shadow-md 
           @else 
               text-gray-600 hover:bg-gray-100 
           @endif">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1-1h6l-1 1-1-3m-6-4h12l2-6H7l2 6z"></path></svg>
    Category
    </a>
    <a href="{{ route('admin.subcategory') }}" 
       class="flex items-center p-3 text-base font-medium rounded-lg transition duration-150 
           @if (Route::is('subcategory')) 
               text-white bg-crimson-red-500 shadow-md 
           @else 
               text-gray-600 hover:bg-gray-100 
           @endif">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1-1h6l-1 1-1-3m-6-4h12l2-6H7l2 6z"></path></svg>
   Subcategory 
    </a>
    <a href="{{ url('admin/pointspackage') }}" 
       class="flex items-center p-3 text-base capitalize font-medium rounded-lg transition duration-150 
           @if (Route::is('pointspackage')) 
               text-white bg-crimson-red-500 shadow-md 
           @else 
               text-gray-600 hover:bg-gray-100 
           @endif">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1-1h6l-1 1-1-3m-6-4h12l2-6H7l2 6z"></path></svg>
pointspackage
    </a>
    
    <a href="{{ route('add-product') }}" 
       class="flex items-center p-3 text-base font-medium rounded-lg transition duration-150 
           @if (Route::is('add-product')) 
               text-white bg-crimson-red-500 shadow-md 
           @else 
               text-gray-600 hover:bg-gray-100 
           @endif">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
     Manage Product
    </a>
    
    <a href="{{ url('admin/users') }}" 
       class="flex items-center p-3 text-base font-medium rounded-lg transition duration-150 
           @if (Route::is('admin/users')) 
               text-white bg-crimson-red-500 shadow-md 
           @else 
               text-gray-600 hover:bg-gray-100 
           @endif">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
    Manage  User
    </a>
    
    <a href="{{ route('my-store') }}" 
       class="flex items-center p-3 text-base font-medium rounded-lg transition duration-150 
           @if (Route::is('my-store')) 
               text-white bg-crimson-red-500 shadow-md 
           @else 
               text-gray-600 hover:bg-gray-100 
           @endif">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        My Store
    </a>
    
    <a href="{{ route('my-orders') }}" 
       class="flex items-center p-3 text-base font-medium rounded-lg transition duration-150 
           @if (Route::is('my-orders')) 
               text-white bg-crimson-red-500 shadow-md 
           @else 
               text-gray-600 hover:bg-gray-100 
           @endif">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        My Orders
    </a>
    
    <a href="{{ route('my-transactions') }}" 
       class="flex items-center p-3 text-base font-medium rounded-lg transition duration-150 
           @if (Route::is('my-transactions')) 
               text-white bg-crimson-red-500 shadow-md 
           @else 
               text-gray-600 hover:bg-gray-100 
           @endif">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        My Transactions
    </a>
    <a href="{{ route('wallet') }}" 
       class="flex items-center p-3 text-base font-medium rounded-lg transition duration-150 
           @if (Route::is('wallet')) 
               text-white bg-crimson-red-500 shadow-md 
           @else 
               text-gray-600 hover:bg-gray-100 
           @endif">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        My Gold Points
    </a>
    
</nav>

                <div class="pt-6 mt-6 border-t border-gray-200">
                    <a href="#" class="flex items-center p-3 text-base font-medium text-gray-600 hover:text-crimson-red-500 hover:bg-red-50 rounded-lg transition duration-150">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </a>
                </div>

            </div>
        </aside>