@extends('layout.app')

@section('title', 'Advertisements')

@section('content')
    @include('components.header')

    <div class="flex max-w-1980 mx-auto">
        @include('components.sidenavbar')

        <div id="main-content" class="flex-grow pt-4 lg:pt-8 pb-12 px-4 sm:px-6 lg:px-8">

            <div class="max-w-7xl mx-auto">

                <!-- HEADER -->
                <div class="flex justify-between items-center mb-8 border-b pb-4 border-crimson-red-500/50">

                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900">
                            📢 My Advertisements
                        </h2>

                        <!-- ✅ SHOW REMAINING CREDITS -->
                        <p class="mt-2 text-sm font-semibold text-gray-600">
                            🎟️ Remaining Ad Credits:
                            <span class="text-crimson-red-600 font-bold">
                                {{ max(0, $remainingCredits) }}
                            </span>
                        </p>
                    </div>

                    <!-- ✅ CONDITIONAL BUTTON -->
                    @if ($remainingCredits > 0)
                        <a href="{{ route('ads.create') }}"
                            class="flex items-center py-2 px-4 rounded-lg shadow-md text-sm font-bold text-white bg-crimson-red-600 hover:bg-crimson-red-500">
                            ➕ Create Ad
                        </a>
                    @else
                        <a href="{{ route('ads.packages') }}"
                            class="flex items-center py-2 px-4 rounded-lg shadow-md text-sm font-bold text-white bg-green-600 hover:bg-green-500">
                            💳 Buy Ad Package
                        </a>
                    @endif

                </div>

                <!-- TABLE -->
                <div class="bg-white shadow-2xl rounded-xl overflow-hidden border">
                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-crimson-red-500/10">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold">Title</th>
                                <th class="px-6 py-4 text-left text-xs font-bold">Product</th>
                                <th class="px-6 py-4 text-left text-xs font-bold">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-bold">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y">

                            @forelse($ads as $ad)
                                <tr class="hover:bg-red-50">

                                    <td class="px-6 py-4">
                                        {{ $ad->title }}
                                    </td>

                                    <td class="px-6 py-4">
                                        Product ID: {{ $ad->product_id }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 text-xs rounded-full
                                    {{ $ad->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700' }}">
                                            {{ ucfirst($ad->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 flex space-x-3">

                                        <a href="{{ route('ads.analytics', $ad->ad_id) }}"
                                            class="text-blue-600 hover:underline">
                                            Analytics
                                        </a>

                                        <form action="{{ route('ads.destroy', $ad->ad_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600">Delete</button>
                                        </form>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-6">
                                        No Ads Found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    @include('components.footer')
@endsection
