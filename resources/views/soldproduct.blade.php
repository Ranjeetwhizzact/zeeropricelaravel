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
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 border-b pb-4 border-crimson-red-500/50">
            <h2 class="text-3xl font-extrabold text-gray-900">
                📦 Sold Products
            </h2>
            <div class="flex items-center space-x-4">
                <span class="text-yellow-600 font-bold">Gold COINS: 665</span>
                <span class="text-blue-600 font-bold">Free COINS: 194</span>
                <a href="{{ route('logout') }}" class="text-gray-600 hover:text-crimson-red-600">Logout</a>
            </div>
        </div>

        <!-- Desktop View -->
        <div class="hidden md:block bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-100">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-crimson-red-500/10">
                    <tr>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-16">#</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Image</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Order Id</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Product</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Customer Cost</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">MRP</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Qty</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($soldProducts as $index => $order)
                    <tr class="hover:bg-red-50 transition duration-150">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $soldProducts->firstItem() + $index }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex-shrink-0 h-12 w-12">
                                @if($order->pic1)
                                <img class="h-12 w-12 rounded-lg object-cover border border-gray-200" 
                                     src="{{ asset('/product_images/' . $order->pic1) }}" 
                                     alt="{{ $order->product_title }}">
                                @else
                                <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                    <span class="text-xs text-gray-400">No img</span>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $order->orderid }}</div>
                            <div class="text-xs text-gray-500">{{ date('d M Y', strtotime($order->postedon)) }}</div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="text-sm text-gray-900">{{ $order->product_title }}</div>
                            <div class="text-xs text-gray-500">ID: {{ $order->pid }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-crimson-red-600">
                            ₹ {{ number_format($order->customercost, 2) }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 line-through">
                            ₹ {{ number_format($order->mrp, 2) }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $order->qty }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if($order->isDelivered == 1)
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Delivered
                            </span>
                            @elseif($order->isCancelled == 1)
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Cancelled
                            </span>
                            @else
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                            @if($order->isDelivered == 0 && $order->isCancelled == 0)
                            <div class="flex flex-col space-y-2">
                                <form action="{{ url('confirm-delivery', $order->id) }}" method="POST" class="inline">
                                    @csrf
                                    <div class="flex items-center space-x-1">
                                        <input type="text" name="otp" placeholder="Enter OTP" 
                                               class="w-20 px-1 py-1 text-xs border rounded" maxlength="6" required>
                                        <button type="submit" class="text-xs bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">
                                            Confirm
                                        </button>
                                    </div>
                                </form>
                                <form action="{{ url('cancel-order', $order->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" 
                                            onclick="return confirm('Cancel this order?')">
                                        Cancel Order
                                    </button>
                                </form>
                            </div>
                            @else
                            <span class="text-xs text-gray-400">No actions</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-10 text-gray-500">
                            No sold products found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="px-6 py-4 bg-white border-t border-gray-200">
                {{ $soldProducts->links() }}
            </div>
        </div>

        <!-- Mobile View -->
        <div class="md:hidden space-y-4">
            @forelse($soldProducts as $index => $order)
            <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-100">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-sm text-gray-500">#{{ $soldProducts->firstItem() + $index }}</span>
                    @if($order->isDelivered == 1)
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Delivered
                    </span>
                    @elseif($order->isCancelled == 1)
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Cancelled
                    </span>
                    @else
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        Pending
                    </span>
                    @endif
                </div>
                
                <div class="flex items-center space-x-4 mb-3 border-b pb-3">
                    <div class="flex-shrink-0 h-16 w-16">
                        @if($order->pic1)
                        <img class="h-16 w-16 rounded-lg object-cover border border-gray-200" 
                             src="{{ asset('/product_images/' . $order->pic1) }}" 
                             alt="{{ $order->product_title }}">
                        @else
                        <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                            <span class="text-xs text-gray-400">No img</span>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900">{{ $order->product_title }}</p>
                        <p class="text-xs text-gray-600">Order: {{ $order->orderid }}</p>
                        <p class="text-xs text-gray-600">{{ date('d M Y', strtotime($order->postedon)) }}</p>
                    </div>
                </div>
                
                <div class="flex justify-between items-center mb-3">
                    <div>
                        <p class="text-sm text-gray-500">Customer Cost</p>
                        <p class="text-lg font-bold text-crimson-red-600">₹ {{ number_format($order->customercost, 2) }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">MRP</p>
                        <p class="text-sm text-gray-400 line-through">₹ {{ number_format($order->mrp, 2) }}</p>
                        <p class="text-xs text-gray-500">Qty: {{ $order->qty }}</p>
                    </div>
                </div>
                
                @if($order->isDelivered == 0 && $order->isCancelled == 0)
                <div class="border-t pt-3">
                    <form action="{{ url('confirm-delivery', $order->id) }}" method="POST" class="mb-2">
                        @csrf
                        <div class="flex items-center space-x-2">
                            <input type="text" name="otp" placeholder="Enter OTP" 
                                   class="flex-1 px-2 py-2 text-sm border rounded" maxlength="6" required>
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600">
                                Confirm
                            </button>
                        </div>
                    </form>
                    <form action="{{ url('cancel-order', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600" 
                                onclick="return confirm('Cancel this order?')">
                            Cancel Order
                        </button>
                    </form>
                </div>
                @endif
            </div>
            @empty
            <div class="bg-white p-6 rounded-xl shadow-lg text-center text-gray-500">
                No sold products found
            </div>
            @endforelse
            
            <!-- Mobile Pagination -->
            <div class="mt-4">
                {{ $soldProducts->links() }}
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
