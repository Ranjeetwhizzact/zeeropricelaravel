@extends('layout.app')

@section('title', 'Buy Ad Package')

@section('content')
    @include('components.header')

    <div class="flex max-w-1980 mx-auto">
        @include('components.sidenavbar')

        <div class="flex-grow p-6">

            <div class="max-w-5xl mx-auto">

                <!-- HEADER -->
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900">
                        💳 Buy Ad Package
                    </h2>
                    <p class="text-gray-600 mt-2">
                        Choose a package to start creating ads
                    </p>
                </div>

                <!-- PACKAGES -->
                <form action="{{ route('ads.pay') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                        @foreach ($packages as $package)
                            <label class="cursor-pointer border rounded-xl p-6 shadow hover:shadow-lg transition">

                                <input type="radio" name="package_id" value="{{ $package->id }}" class="hidden peer"
                                    required>

                                <div class="text-center">

                                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                                        ₹{{ $package->price }}
                                    </h3>

                                    <p class="text-gray-600 mb-4">
                                        {{ $package->ads_count }} Ads
                                    </p>

                                    <div class="text-sm text-gray-500">
                                        ₹{{ round($package->price / $package->ads_count) }} per ad
                                    </div>

                                </div>

                                <!-- Selected Border -->
                                <div class="mt-4 text-center hidden peer-checked:block text-green-600 font-bold">
                                    ✔ Selected
                                </div>

                            </label>
                        @endforeach

                    </div>

                    <!-- BUTTON -->
                    <div class="text-center mt-8">
                        <button type="submit"
                            class="bg-crimson-red-600 hover:bg-crimson-red-500 text-white px-6 py-3 rounded-lg font-bold shadow">
                            Proceed to Pay
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

    @include('components.footer')
@endsection
