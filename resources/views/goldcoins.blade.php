@extends('layout.app')

@section('title', 'Whizzact | Wallet')

@section('content')
@include('components.header')

<div class="flex max-w-1980 mx-auto">
    @include('components.sidenavbar')

    <div id="main-content"
        class="flex-grow pt-4 lg:pt-8 pb-12 transition-all duration-300 ease-in-out px-4 sm:px-6 lg:px-8">

        <div class="max-w-7xl mx-auto">

            {{-- HEADER --}}
            <div class="mb-8 border-b pb-4 border-crimson-red-500/50">
                <h2 class="text-3xl font-extrabold text-gray-900">
                    💎 Your ZeroPriceWallet
                </h2>
            </div>

            {{-- WALLET BALANCE --}}
            <div class="bg-white p-6 md:p-10 rounded-xl shadow-2xl border-t-4 border-yellow-500 mb-10 text-center">
                <h3 class="text-2xl font-bold text-gray-700 mb-4">Current Balance</h3>

                <p class="text-4xl font-extrabold text-gray-900">
                    {{ auth()->user()->points ?? 0 }}
                    <span class="text-yellow-600">Gold COINS</span>
                </p>

                <p class="text-xl text-gray-500 mt-2">
                    worth ₹ {{ auth()->user()->points ?? 0 }}
                </p>

                <div class="mt-6 pt-4 border-t border-gray-100">
                    <p class="text-base font-semibold text-blue-600">
                        Free COINS: {{ auth()->user()->free_coins ?? 0 }}
                    </p>
                </div>
            </div>

            {{-- BUY GOLD COINS --}}
            <h3 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-2">
                🛍️ Buy Gold COINS
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($packages->whereIn('points',[5,10,15]) as $package)
                <div class="bg-white rounded-xl shadow-lg border p-6 text-center">
                    <div class="bg-indigo-600 text-white font-bold py-2 rounded-t-lg -mx-6 mb-4">
                        {{ $package->packagename }}
                    </div>

                    <p class="text-5xl font-extrabold text-indigo-600 mb-2">
                        {{ $package->points }}
                    </p>

                    <p class="text-xl font-semibold text-gray-700 mb-6">COINS</p>

                    <button
                        onclick="openModal(
                            '{{ $package->id }}',
                            '{{ $package->packagename }}',
                            '{{ $package->points }}',
                            '{{ $package->cost }}'
                        )"
                        class="w-full py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700">
                        Buy for ₹{{ $package->cost }}/-
                    </button>
                </div>
                @endforeach
            </div>

            {{-- ECONOMY PACKS --}}
            <h3 class="text-2xl font-bold text-gray-900 mt-10 mb-6 border-b pb-2">
                🚀 Economy Packs
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($packages->whereIn('points',[25,50,100]) as $package)
                <div class="bg-white rounded-xl p-6 text-center relative
                    {{ $package->points == 50 ? 'shadow-2xl border-4 border-yellow-500 scale-105' : 'shadow-lg border' }}">

                    @if($package->points == 50)
                        <span class="absolute top-0 right-0 -mt-3 -mr-3 bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                            BEST VALUE
                        </span>
                    @endif

                    <div class="bg-teal-600 text-white font-bold py-2 rounded-t-lg -mx-6 mb-4">
                        {{ $package->packagename }}
                    </div>

                    <p class="text-5xl font-extrabold text-teal-600 mb-2">
                        {{ $package->points }}
                    </p>

                    <p class="text-xl font-semibold text-gray-700 mb-6">COINS</p>

                    <button
                        onclick="openModal(
                            '{{ $package->id }}',
                            '{{ $package->packagename }}',
                            '{{ $package->points }}',
                            '{{ $package->cost }}'
                        )"
                        class="w-full py-3 bg-teal-600 text-white font-bold rounded-lg hover:bg-teal-700">
                        Buy for ₹{{ $package->cost }}/-
                    </button>
                </div>
                @endforeach
            </div>
                        <h3 class="text-2xl font-bold text-gray-900 mt-10 mb-6 border-b pb-2">
                🚀 Sliver Packs
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($packages->whereIn('points',[250,500,1000]) as $package)
                <div class="bg-white rounded-xl p-6 text-center relative
                    {{ $package->points == 50 ? 'shadow-2xl border-4 border-blue-500 scale-105' : 'shadow-lg border' }}">

                    @if($package->points == 50)
                        <span class="absolute top-0 right-0 -mt-3 -mr-3 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                            BEST VALUE
                        </span>
                    @endif

                    <div class="bg-yellow-500 text-white font-bold py-2 rounded-t-lg -mx-6 mb-4">
                        {{ $package->packagename }}
                    </div>

                    <p class="text-5xl font-extrabold text-yellow-600 mb-2">
                        {{ $package->points }}
                    </p>

                    <p class="text-xl font-semibold text-gray-700 mb-6">COINS</p>

                    <button
                        onclick="openModal(
                            '{{ $package->id }}',
                            '{{ $package->packagename }}',
                            '{{ $package->points }}',
                            '{{ $package->cost }}'
                        )"
                        class="w-full py-3 bg-yellow-500 text-white font-bold rounded-lg hover:bg-blue-700">
                        Buy for ₹{{ $package->cost }}/-
                    </button>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

{{-- CONFIRM BUY MODAL --}}
<div id="buyModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden relative animate-fadeIn">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <h3 class="text-lg font-bold">Confirm Purchase</h3>
            </div>

            <button onclick="closeModal()"
                class="text-white/80 hover:text-white text-xl transition">
                ✕
            </button>
        </div>

        {{-- Body --}}
        <div class="p-6 space-y-6">

            {{-- Package Info --}}
            <div class="text-center">
                <p class="text-sm text-gray-500">You are buying</p>
                <h4 id="modalPackName" class="text-xl font-extrabold text-gray-800 mt-1"></h4>
            </div>

            {{-- Coins --}}
            <div class="flex items-center justify-center gap-3 bg-yellow-50 border border-yellow-200 rounded-xl py-4">
                <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <div>
                    <p class="text-2xl font-extrabold text-yellow-600">
                        <span id="modalCoins"></span> COINS
                    </p>
                    <p class="text-xs text-gray-500">Added instantly after payment</p>
                </div>
            </div>

            {{-- Price --}}
            <div class="text-center">
                <p class="text-sm text-gray-500">Total Payable</p>
                <p class="text-3xl font-extrabold text-gray-900">
                    ₹<span id="modalPrice"></span>
                </p>
                <p class="text-xs text-gray-400 mt-1">Inclusive of all taxes</p>
            </div>

            {{-- Form --}}
            <form action="{{ route('wallet.pay') }}" method="POST" class="space-y-3">
                @csrf
                <input type="hidden" name="package_id" id="modalPackageId">

                <button type="submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold text-lg shadow-lg hover:scale-[1.02] transition">
                    Confirm & Pay
                </button>

                <button type="button" onclick="closeModal()"
                    class="w-full py-2 rounded-xl border border-gray-300 text-gray-600 font-semibold hover:bg-gray-100 transition">
                    Cancel
                </button>
            </form>
        </div>
    </div>
</div>


@include('components.footer')
@endsection

@section('script')
<script>
    function openModal(id, name, coins, price) {
        document.getElementById('modalPackageId').value = id;
        document.getElementById('modalPackName').innerText = name;
        document.getElementById('modalCoins').innerText = coins;
        document.getElementById('modalPrice').innerText = price;

        document.getElementById('buyModal').classList.remove('hidden');
        document.getElementById('buyModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('buyModal').classList.add('hidden');
        document.getElementById('buyModal').classList.remove('flex');
    }
</script>
@endsection
