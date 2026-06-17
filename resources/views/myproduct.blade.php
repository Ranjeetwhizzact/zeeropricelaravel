@extends('layout.app')

@section('title', 'Whizzact | Job list')

@section('style')
    {{-- <link rel="stylesheet" href="{{ url('/assests/css/careerlist.css') }}"> --}}
@endsection

@section('content')
    @include('components.header')
     <div class="flex max-w-1980 mx-auto">
@include('components.sidenavbar')
    <div id="main-content" class="flex-grow pt-4 lg:pt-8 pb-12 transition-all duration-300 ease-in-out px-4 sm:px-6 lg:px-8">
            
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-center mb-8 border-b pb-4 border-crimson-red-500/50">
                    <h2 class="text-3xl font-extrabold text-gray-900">
                        📦 My Listed ZeroPriceProducts
                    </h2>
                    <a href="#" class="flex items-center py-2 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-crimson-red-600 hover:bg-crimson-red-500 focus:outline-none focus:ring-4 focus:ring-red-300 transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Add Product
                    </a>
                </div>

                <div class="hidden md:block bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-crimson-red-500/10">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Product Name
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Price Range
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                                                     <span class="">Actions</span>

                                </th>
                              
                            </tr>
                        </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
@forelse($products as $product)
<tr class="hover:bg-red-50 transition duration-150">
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full object-cover border border-gray-200"
                     src="{{ asset('/product_images/' . $product->pic1) }}">
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                    {{ $product->ititle }}
                </div>
                <div class="text-xs text-gray-500">
                    SKU: {{ $product->sku ?? 'N/A' }}
                </div>
            </div>
        </div>
    </td>

    <td class="px-6 py-4 text-sm text-gray-500">
        <div class="max-w-48">

            {{ $product->description }}
        </div>
    </td>

    <td class="px-6 py-4 text-sm text-gray-500">
        ₹{{ $product->mrp }}
    </td>

    <td class="px-6 py-4 text-sm text-gray-500">
        {{ $product->qty }} in stock
    </td>

    <td class="px-6 py-4">
        <span class="px-3 inline-flex text-xs font-semibold rounded-full
            {{ $product->qty > 0 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
            {{ $product->qty > 0 ? 'Active' : 'Out of Stock' }}
        </span>
    </td>

    <td class="px-6 py-4 text-right text-sm font-medium flex">
        <a href="{{ url('productsedit', $product->pid) }}" class="text-indigo-600 mr-4">Edit</a>
<form action="{{ url('productsdelete', $product->pid) }}" method="POST"
      onsubmit="return confirm('Are you sure?')">
    @csrf
    @method('POST')
    <button type="submit"  class="text-red-600">Delete</button>
</form>

    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center py-6 text-gray-500">
        No products found
    </td>
</tr>
@endforelse
</tbody>

                    </table>
                </div>

                <div class="md:hidden space-y-4">
                    <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-100">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-bold text-gray-900">ZeroPriceSignature Tee</h3>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        </div>
                        <div class="flex items-center space-x-4 mb-3 border-b pb-3">
                             <img class="h-12 w-12 rounded-full object-cover border border-gray-200" src="https://via.placeholder.com/150/dc2626/FFFFFF?text=Product+A" alt="Product Image">
                             <div>
                                 <p class="text-sm text-gray-600">Category: **Apparel - Tops**</p>
                                 <p class="text-sm text-gray-600">Quantity: **25 in stock**</p>
                             </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-lg font-semibold text-crimson-red-600">₹899.00 
                                <span class="text-sm text-gray-400 line-through">₹1200.00</span>
                            </p>
                            <div class="flex space-x-3">
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Edit</a>
                                <a href="#" class="text-sm font-medium text-red-600 hover:text-red-900">Delete</a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-100">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-bold text-gray-900">Midnight Running Shoes</h3>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Out of Stock
                            </span>
                        </div>
                        <div class="flex items-center space-x-4 mb-3 border-b pb-3">
                             <img class="h-12 w-12 rounded-full object-cover border border-gray-200" src="https://via.placeholder.com/150/dc2626/FFFFFF?text=Product+B" alt="Product Image">
                             <div>
                                 <p class="text-sm text-gray-600">Category: **Shoes**</p>
                                 <p class="text-sm text-gray-600">Quantity: **0 in stock**</p>
                             </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-lg font-semibold text-crimson-red-600">₹2500.00 
                                <span class="text-sm text-gray-400 line-through">₹3500.00</span>
                            </p>
                            <div class="flex space-x-3">
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Edit</a>
                                <a href="#" class="text-sm font-medium text-red-600 hover:text-red-900">Delete</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-100">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-bold text-gray-900">Ruby Summer Dress</h3>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Expired
                            </span>
                        </div>
                        <div class="flex items-center space-x-4 mb-3 border-b pb-3">
                             <img class="h-12 w-12 rounded-full object-cover border border-gray-200" src="https://via.placeholder.com/150/dc2626/FFFFFF?text=Product+C" alt="Product Image">
                             <div>
                                 <p class="text-sm text-gray-600">Category: **Apparel - Dresses**</p>
                                 <p class="text-sm text-gray-600">Quantity: **12 in stock**</p>
                             </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-lg font-semibold text-crimson-red-600">₹1499.00 
                                <span class="text-sm text-gray-400 line-through">₹1499.00</span>
                            </p>
                            <div class="flex space-x-3">
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Edit</a>
                                <a href="#" class="text-sm font-medium text-red-600 hover:text-red-900">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


</div>
  @include('components.footer')
@endsection

@section('script')
    <script src="{{ url('/assests/js/home.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
