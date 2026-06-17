@extends('layout.app')

@section('title', 'Edit Advertisement')

@section('content')
    @include('components.header')

    <div class="flex max-w-1980 mx-auto">
        @include('components.sidenavbar')

        <div class="flex-grow p-8">

            <h2 class="text-2xl font-bold mb-6 text-gray-800">✏️ Edit Advertisement</h2>

            <form action="{{ route('ads.update', $ad->ad_id) }}" method="POST" enctype="multipart/form-data"
                class="bg-white p-6 rounded-xl shadow space-y-6">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Title -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" value="{{ $ad->title }}"
                            class="w-full border border-gray-200 p-2.5 rounded-lg focus:ring-2 focus:ring-green-500">
                    </div>

                    <!-- Budget -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Budget</label>
                        <select name="budget" id="budget"
                            class="w-full border border-gray-200 p-2.5 rounded-lg focus:ring-2 focus:ring-green-500">

                            <option value="">Select Budget</option>

                            @foreach ([5, 100, 500, 1000, 1500, 2000] as $amount)
                                <option value="{{ $amount }}" {{ $ad->budget == $amount ? 'selected' : '' }}>
                                    ₹{{ number_format($amount) }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Max Clicks -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Max Clicks</label>
                        <input type="number" id="max_clicks" value="{{ $ad->max_clicks }}"
                            class="w-full bg-gray-100 border border-gray-200 p-2.5 rounded-lg" readonly>
                    </div>

                    <!-- Max Likes -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Max Likes</label>
                        <input type="number" id="max_likes" value="{{ $ad->max_likes ?? 0 }}"
                            class="w-full bg-gray-100 border border-gray-200 p-2.5 rounded-lg" readonly>
                    </div>

                    <!-- Max Shares -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Max Shares</label>
                        <input type="number" id="max_shares" value="{{ $ad->max_shares ?? 0 }}"
                            class="w-full bg-gray-100 border border-gray-200 p-2.5 rounded-lg" readonly>
                    </div>

                    <!-- Current Media Preview -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Current Media</label>

                        <div class="mt-2 border rounded-lg overflow-hidden">

                            @if ($ad->media_type == 'video')
                                <video class="w-full h-40 object-cover" controls>
                                    <source src="{{ asset($ad->media_url) }}" type="video/mp4">
                                </video>
                            @else
                                <img src="{{ asset($ad->media_url) }}" class="w-full h-40 object-cover" alt="Ad Image">
                            @endif

                        </div>
                    </div>

                    <!-- Upload New Media -->
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium text-gray-700">Replace Media (Optional)</label>
                        <input type="file" name="media" accept="image/*,video/*"
                            class="w-full border border-gray-200 p-2.5 rounded-lg">
                        <p class="text-xs text-gray-500 mt-1">
                            Leave empty to keep existing media
                        </p>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full border border-gray-200 p-2.5 rounded-lg focus:ring-2 focus:ring-green-500">{{ $ad->description }}</textarea>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-between items-center">

                    <a href="{{ route('ads.index') }}" class="text-gray-600 hover:underline">
                        ← Back
                    </a>

                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg transition">
                        💾 Update Ad
                    </button>

                </div>

            </form>

        </div>
    </div>

    @include('components.footer')
    <script>
        function calculateAdValues(budget) {
            budget = parseInt(budget) || 0;

            let clicks = budget;
            let likes = Math.floor(budget * 0.5);
            let shares = Math.floor(budget * 0.5);

            document.getElementById('max_clicks').value = clicks;
            document.getElementById('max_likes').value = likes;
            document.getElementById('max_shares').value = shares;
        }

        // Run on load
        calculateAdValues(document.getElementById('budget').value);

        // Run on change
        document.getElementById('budget').addEventListener('input', function() {
            calculateAdValues(this.value);
        });
    </script>
@endsection
