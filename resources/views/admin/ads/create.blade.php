@extends('layout.app')

@section('title', 'Create Advertisement')

@section('content')
    @include('components.header')

    <div class="flex max-w-1980 mx-auto">
        @include('components.sidenavbar')

        <div class="flex-grow p-8">

            <h2 class="text-2xl font-bold mb-6">Create Advertisement</h2>

            <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white p-6 rounded-xl shadow">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 bg-white p-6 rounded-2xl shadow-sm">

                    <!-- Seller ID -->
                    <input type="hidden" name="seller_id" value="{{ auth()->id() }}">

                    <!-- Product -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Select Product</label>
                        <select name="product_id"
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-2.5 rounded-xl focus:ring-2 focus:ring-green-500 focus:bg-white transition"
                            required>
                            <option value="">-- Select Product --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->pid }}">
                                    {{ $product->ititle }} (₹{{ $product->mrp }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Title -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title"
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-2.5 rounded-xl focus:ring-2 focus:ring-green-500 focus:bg-white transition"
                            placeholder="Enter ad title" required>
                    </div>

                    <!-- Start Date -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" name="start_date"
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-2.5 rounded-xl focus:ring-2 focus:ring-green-500 focus:bg-white transition">
                    </div>

                    <!-- End Date -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="end_date"
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-2.5 rounded-xl focus:ring-2 focus:ring-green-500 focus:bg-white transition">
                    </div>

                    <!-- Media Upload -->
                    <div class="col-span-1 md:col-span-2 space-y-1">
                        <label class="text-sm font-medium text-gray-700">Upload Ad Media (Image/Video)</label>
                        <input type="file" name="media" accept="image/*,video/*"
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-2.5 rounded-xl">
                    </div>

                    <!-- Description -->
                    <div class="col-span-1 md:col-span-2 space-y-1">
                        <label class="text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-2.5 rounded-xl focus:ring-2 focus:ring-green-500 focus:bg-white transition"
                            placeholder="Write about your ad..."></textarea>
                    </div>

                </div>

                <!-- Submit -->
                <button type="submit"
                    class="mt-4 w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                    ➕ Create Ad
                </button>

            </form>
        </div>
    </div>

    @include('components.footer')
@endsection
