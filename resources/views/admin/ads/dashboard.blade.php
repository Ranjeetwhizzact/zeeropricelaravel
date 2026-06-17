@extends('layout.app')

@section('title', 'Ad Slots')

@section('content')
    @include('components.header')

    <div class="flex max-w-1980 mx-auto">
        @include('components.sidenavbar')

        <div id="main-content" class="flex-grow pt-4 lg:pt-8 pb-12 px-4 sm:px-6 lg:px-8">

            <div class="max-w-7xl mx-auto">

                <!-- HEADER -->
                <div class="flex justify-between items-center mb-8 border-b pb-4 border-crimson-red-500/50">
                    <h2 class="text-3xl font-extrabold text-gray-900">
                        📦 Your Ad Slots
                    </h2>
                </div>

                <!-- SLOT UI -->
                <div class="mb-6">

                    <p class="text-sm text-gray-600 mb-4">
                        You can have maximum 4 active ad slots. Complete them to continue clicking ads.
                    </p>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">

                        @forelse($slots as $slot)
                            <div class="bg-white shadow-lg rounded-xl p-4 text-center border hover:shadow-xl transition">

                                <!-- AD TITLE -->
                                <p class="text-sm font-semibold text-gray-800 mb-2">
                                    {{ $slot->advertisement->title }}
                                </p>

                                <!-- STATUS -->
                                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">
                                    Pending
                                </span>

                                <!-- COMPLETE BUTTON -->
                                <a href="{{ route('ads.showAd', $slot->id) }}"
                                    class="mt-3 w-full block text-center bg-green-500 hover:bg-green-600 text-white text-xs py-2 rounded-lg transition">
                                    Complete Task
                                </a>
                            </div>
                        @empty
                            <div class="col-span-4 text-center text-gray-500 py-6">
                                No active ad slots
                            </div>
                        @endforelse

                    </div>

                </div>

            </div>
        </div>
    </div>
    @include('components.footer')
@endsection
