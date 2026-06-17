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
                        🛒 Your ZeroPriceOrders
                    </h2>
                    <a href="#" class="py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-600 bg-white hover:bg-gray-50 transition duration-300">
                        View Past Orders
                    </a>
                </div>

                <div class="hidden md:block bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-crimson-red-500/10">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Order ID
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Date Placed
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Items
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Total Amount
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="relative px-6 py-4">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                     <tbody class="bg-white divide-y divide-gray-200">

@forelse($orders as $order)
<tr class="hover:bg-red-50 transition duration-150">

<td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-crimson-red-600">
    #{{ $order->orderid }}
</td>

<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
    {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
</td>

<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    {{ $order->title }} ({{ $order->qty }} Qty)
</td>

<td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
    ₹{{ $order->customercost }}
</td>

<td class="px-6 py-4 whitespace-nowrap">

@if($order->isDelivered == 1)
<span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
Delivered
</span>

@elseif($order->isCancelled == 1)
<span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
Cancelled
</span>

@else
<span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
Processing
</span>
@endif

</td>

<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
<a href="#" class="text-indigo-600 hover:text-indigo-900 mr-4">Details</a>
</td>

</tr>

@empty
<tr>
<td colspan="6" class="text-center py-6 text-gray-500">
No Orders Found
</td>
</tr>
@endforelse

</tbody>
                    </table>
                </div>

                <div class="md:hidden space-y-4">
                    
                    <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-100">
                        <div class="flex justify-between items-center mb-2 pb-2 border-b border-gray-100">
                            <h3 class="text-lg font-bold text-crimson-red-600">Order #CS100245</h3>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Shipped
                            </span>
                        </div>
                        <div class="space-y-1 mb-3">
                             <p class="text-sm text-gray-600">Date: **2025-11-28**</p>
                             <p class="text-sm text-gray-600">Items: **3 items**</p>
                             <p class="text-base font-bold text-gray-900">Total: **₹4,898.00**</p>
                        </div>
                        <div class="flex justify-end space-x-4 pt-2 border-t border-gray-100">
                            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Details</a>
                            <a href="#" class="text-sm font-medium text-green-600 hover:text-green-900">Track Order</a>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-100">
                        <div class="flex justify-between items-center mb-2 pb-2 border-b border-gray-100">
                            <h3 class="text-lg font-bold text-crimson-red-600">Order #CS100246</h3>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Processing
                            </span>
                        </div>
                        <div class="space-y-1 mb-3">
                             <p class="text-sm text-gray-600">Date: **2025-11-29**</p>
                             <p class="text-sm text-gray-600">Items: **1 item**</p>
                             <p class="text-base font-bold text-gray-900">Total: **₹499.00**</p>
                        </div>
                        <div class="flex justify-end space-x-4 pt-2 border-t border-gray-100">
                            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Details</a>
                            <a href="#" class="text-sm font-medium text-gray-400 cursor-not-allowed">Track Order</a>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-100">
                        <div class="flex justify-between items-center mb-2 pb-2 border-b border-gray-100">
                            <h3 class="text-lg font-bold text-crimson-red-600">Order #CS100244</h3>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Delivered
                            </span>
                        </div>
                        <div class="space-y-1 mb-3">
                             <p class="text-sm text-gray-600">Date: **2025-11-25**</p>
                             <p class="text-sm text-gray-600">Items: **2 items**</p>
                             <p class="text-base font-bold text-gray-900">Total: **₹3,250.00**</p>
                        </div>
                        <div class="flex justify-end space-x-4 pt-2 border-t border-gray-100">
                            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Details</a>
                            <a href="#" class="text-sm font-medium text-red-600 hover:text-red-900">Return</a>
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
