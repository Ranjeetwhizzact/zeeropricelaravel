@extends('layout.app')

@section('title', 'Coin Transactions')

@section('style')
<style>
    /* Price Window Styles */
    #price-window-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 320px;
        z-index: 1000;
    }

    #revealed-box {
        opacity: 1;
        transition: opacity 0.7s ease;
        background: linear-gradient(135deg, #fff9dc 0%, #fff2c9 100%);
        border-radius: 16px;
        border: 2px solid #ffd872;
        padding: 20px;
        position: relative;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .initial-price-box {
        background: linear-gradient(135deg, #ffca5e 0%, #ffb347 100%);
        border-radius: 16px;
        padding: 25px;
        text-align: center;
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        z-index: 5;
        transition: width 0.9s ease-in-out;
        overflow: hidden;
        white-space: nowrap;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 10px 25px rgba(255, 193, 7, 0.3);
    }

    .initial-price-box .text {
        font-weight: 800;
        font-size: 1.8rem;
        color: #2d3748;
        text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.5);
    }

    .initial-price-box .subtitle {
        font-size: 1rem;
        color: #4a5568;
        font-weight: 600;
    }

    .initial-price-box.shrink {
        width: 0;
        padding-left: 0;
        padding-right: 0;
    }

    .countdown-bar {
        background: linear-gradient(135deg, #d9463f 0%, #c53030 100%);
        color: white;
        margin-top: 12px;
        padding: 12px 16px;
        border-radius: 50px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.95rem;
        position: absolute;
        top: -10px;
        left: 10px;
        right: 10px;
        z-index: 3;
        transition: opacity 0.5s ease;
        box-shadow: 0 4px 12px rgba(217, 70, 63, 0.3);
    }

    #revealed-content {
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    #revealed-content.visible {
        opacity: 1;
    }

    .coin-pulse {
        animation: coinPulse 2s infinite;
    }

    @keyframes coinPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .transaction-row {
        transition: all 0.3s ease;
    }

    .transaction-row:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .gold-gradient {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    }

    .free-gradient {
        background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
    }
</style>
@endsection

@section('content')
@include('components.header')

<div class="flex max-w-1980 mx-auto">
    @include('components.sidenavbar')

    <div id="main-content" class="flex-grow pt-4 lg:pt-8 pb-12 transition-all duration-300 ease-in-out px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <!-- Header with Coin Balance -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 pb-4 border-b border-crimson-red-500/30">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 flex items-center">
                        <svg class="w-8 h-8 mr-2 text-yellow-500 coin-pulse" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"/>
                        </svg>
                        🪙 Coin Transactions
                    </h2>
                    <p class="text-gray-600 mt-1">Track your coin earnings and redemptions</p>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Gold Coins Card -->
                    <div class="gold-gradient rounded-xl p-3 text-white shadow-lg flex items-center space-x-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                        </svg>
                        {{-- <div>
                            <p class="text-xs opacity-90">Gold COINS</p>
                            <p class="text-xl font-bold">{{ $coinStats['gold_coins'] }}</p>
                        </div> --}}
                    </div>
                    
                    <!-- Free Coins Card -->
                    <div class="free-gradient rounded-xl p-3 text-white shadow-lg flex items-center space-x-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"/>
                        </svg>
                        {{-- <div>
                            <p class="text-xs opacity-90">Free COINS</p>
                            <p class="text-xl font-bold">{{ $coinStats['free_coins'] }}</p>
                        </div> --}}
                    </div>
                    
                    <a href="{{ route('logout') }}" class="flex items-center text-gray-600 hover:text-crimson-red-600 transition bg-white px-4 py-2 rounded-lg shadow-sm">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </a>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
                    <p class="text-sm text-gray-500 mb-1">Total Points Paid</p>
                    {{-- <p class="text-3xl font-bold text-gray-800">₹ {{ number_format($coinStats['total_points_paid'], 2) }}</p> --}}
                    <p class="text-xs text-green-600 mt-2">↑ +5.2% from last month</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 mb-1">Total Transactions</p>
                    {{-- <p class="text-3xl font-bold text-gray-800">{{ $coinStats['total_transactions'] }}</p> --}}
                    {{-- <p class="text-xs text-green-600 mt-2">{{ $coinStats['total_transactions'] }} successful redemptions</p> --}}
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-lg p-4 mb-6">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 bg-yellow-500 text-white rounded-lg text-sm font-medium hover:bg-yellow-600 transition">
                            All Transactions
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition">
                            Gold Coins
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition">
                            Free Coins
                        </button>
                    </div>
                    <div class="flex space-x-2">
                        <input type="text" placeholder="Search by product..." 
                               class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <input type="date" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                </div>
            </div>

            <!-- Desktop Table View - Coins Transaction Style -->
            <div class="hidden md:block bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-yellow-50 to-orange-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Image</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Points Paid</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">MRP</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Zero Price</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Transaction Time</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($transactions as $index => $transaction)
                        <tr class="transaction-row hover:bg-yellow-50/30 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $transactions->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex-shrink-0 h-12 w-12">
                                    @if($transaction->pic1)
                                    <img class="h-12 w-12 rounded-lg object-cover border-2 border-yellow-200" 
                                         src="{{ asset('/product_images/' . $transaction->pic1) }}" 
                                         alt="{{ $transaction->product_title }}">
                                    @else
                                    <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-yellow-100 to-orange-100 flex items-center justify-center border-2 border-yellow-200">
                                        <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $transaction->product_title }}</div>
                                <div class="text-xs text-gray-500">Qty: {{ $transaction->qty }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                    </svg>
                                    <span class="text-sm font-semibold text-gray-900">₹ {{ number_format($transaction->customerCost, 2) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500 line-through">₹ {{ number_format($transaction->mrp, 2) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-green-600">₹ {{ number_format($transaction->customerCost - ($transaction->customerCost * 0.1), 2) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ date('d-m-Y', strtotime($transaction->postedOn)) }}</div>
                                <div class="text-xs text-gray-500">{{ date('H:i:s', strtotime($transaction->postedOn)) }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-12">
                                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-lg text-gray-600 mb-2">No coin transactions found</p>
                                <p class="text-sm text-gray-500">Your coin redemptions will appear here</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="px-6 py-4 bg-white border-t border-gray-200">
                    {{ $transactions->links() }}
                </div>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4">
                @forelse($transactions as $index => $transaction)
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transaction-row">
                    <div class="p-4">
                        <!-- Header with Image and Title -->
                        <div class="flex items-center space-x-3 mb-3">
                            @if($transaction->pic1)
                            <img class="h-16 w-16 rounded-lg object-cover border-2 border-yellow-200" 
                                 src="{{ asset('/product_images/' . $transaction->pic1) }}" 
                                 alt="{{ $transaction->product_title }}">
                            @else
                            <div class="h-16 w-16 rounded-lg bg-gradient-to-br from-yellow-100 to-orange-100 flex items-center justify-center border-2 border-yellow-200">
                                <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                </svg>
                            </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900">{{ $transaction->product_title }}</h3>
                                <p class="text-xs text-gray-500">Transaction #{{ $transactions->firstItem() + $index }}</p>
                            </div>
                        </div>

                        <!-- Transaction Details Grid -->
                        <div class="grid grid-cols-2 gap-3 bg-gray-50 rounded-lg p-3 mb-2">
                            <div>
                                <p class="text-xs text-gray-500">Points Paid</p>
                                <p class="text-sm font-bold text-gray-900 flex items-center">
                                    <svg class="w-4 h-4 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                    </svg>
                                    ₹ {{ number_format($transaction->customerCost, 2) }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">MRP</p>
                                <p class="text-sm text-gray-500 line-through">₹ {{ number_format($transaction->mrp, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Zero Price</p>
                                <p class="text-sm font-bold text-green-600">₹ {{ number_format($transaction->customerCost - ($transaction->customerCost * 0.1), 2) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Qty</p>
                                <p class="text-sm text-gray-900">{{ $transaction->qty }}</p>
                            </div>
                        </div>

                        <!-- Transaction Time -->
                        <div class="flex justify-between items-center text-xs text-gray-500 border-t pt-2">
                            <span>{{ date('d-m-Y', strtotime($transaction->postedOn)) }}</span>
                            <span>{{ date('H:i:s', strtotime($transaction->postedOn)) }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                    <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-lg text-gray-600 mb-2">No coin transactions found</p>
                    <p class="text-sm text-gray-500">When you redeem coins, they will appear here</p>
                </div>
                @endforelse
                
                <!-- Mobile Pagination -->
                <div class="mt-6">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Price Window Component (Hidden by default) -->
<div id="price-window-container" class="hidden">
    <div id="revealed-box">
        <!-- Initial Cover -->
        <div id="initial-box" class="initial-price-box">
            <div class="text">🪙</div>
            <div class="subtitle">Tap to Reveal Price</div>
        </div>

        <!-- Countdown Cover -->
        <div id="countdown-cover" class="countdown-bar" style="display: flex;">
            <span>⏰ Window closes in</span>
            <span id="countdown-timer" class="font-bold">60</span>
            <span>sec</span>
            <button class="ml-2 bg-white/20 hover:bg-white/30 rounded-full p-1 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Revealed Content -->
        <div id="revealed-content">
            <div class="text-center mb-4">
                <div class="text-3xl mb-2">🎉</div>
                <h3 class="text-lg font-bold text-gray-800">Special Coin Offer!</h3>
            </div>
            <div class="bg-white/50 rounded-lg p-4">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">You saved:</span>
                    <span class="font-bold text-green-600">₹ 250</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Coins earned:</span>
                    <span class="font-bold text-yellow-600">+50 🪙</span>
                </div>
            </div>
            <button class="w-full mt-4 bg-gradient-to-r from-yellow-500 to-orange-500 text-white py-2 rounded-lg font-semibold hover:from-yellow-600 hover:to-orange-600 transition">
                Claim Now
            </button>
        </div>
    </div>
</div>

@include('components.footer')
@endsection

@section('script')
<script>
/* ================= PRICE WINDOW FUNCTIONALITY ================= */
const priceWindow = document.getElementById('price-window-container');
const curtain = document.getElementById('initial-box');
const revealedBox = document.getElementById('revealed-box');
const countdownCover = document.getElementById('countdown-cover');
const revealedContent = document.getElementById('revealed-content');

let countdown = null;
let isWindowOpen = false;

// Auto-open price window after 3 seconds (for demo)
setTimeout(() => {
    if (!isWindowOpen) {
        openPriceWindow();
    }
}, 3000);

function openPriceWindow() {
    isWindowOpen = true;
    priceWindow.classList.remove('hidden');
    curtain.classList.add('shrink');

    setTimeout(() => {
        revealedBox.classList.add('visible');
        startCountdown();
    }, 900);
}

function startCountdown() {
    let time = 60;
    document.getElementById('countdown-timer').textContent = time;

    if (countdown) clearInterval(countdown);

    countdown = setInterval(() => {
        time--;
        document.getElementById('countdown-timer').textContent = time;

        if (time <= 0) {
            closePriceWindow();
        }
    }, 1000);
}

function closePriceWindow() {
    clearInterval(countdown);
    countdown = null;

    curtain.classList.remove('shrink');
    revealedBox.classList.remove('visible');
    countdownCover.style.display = 'flex';
    countdownCover.style.opacity = '1';
    revealedContent?.classList.remove('visible');
    document.getElementById('countdown-timer').textContent = '60';
    
    setTimeout(() => {
        priceWindow.classList.add('hidden');
        isWindowOpen = false;
    }, 500);
}

// Manual close button
countdownCover.querySelector('button').addEventListener('click', (e) => {
    e.stopPropagation();
    closePriceWindow();
});

// Click on curtain to reveal
curtain.addEventListener('click', () => {
    if (!curtain.classList.contains('shrink')) {
        curtain.classList.add('shrink');
        setTimeout(() => {
            revealedBox.classList.add('visible');
            startCountdown();
        }, 900);
    }
});
</script>
@endsection