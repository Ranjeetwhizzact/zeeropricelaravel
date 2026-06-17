@extends('layout.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-50 p-4">
        <div class="w-full max-w-md">

            <div class="bg-white rounded-xl shadow-2xl p-8 sm:p-10 border border-gray-100">

                <h2 class="text-3xl font-extrabold text-center text-crimson-red-600 mb-2">
                    Join Our Collection
                </h2>

                <p class="text-center text-gray-500 mb-8">
                    Create your ZeroPriceCo. account in seconds.
                </p>

                <form method="POST" action="{{ route('register.submit') }}" class="space-y-5">
                    @csrf

                    {{-- NAME --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            placeholder="Enter your name"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-crimson-red-500 focus:outline-none transition">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PHONE --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                            placeholder="Enter phone number"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-crimson-red-500 focus:outline-none transition">
                        @error('phone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Enter email"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-crimson-red-500 focus:outline-none transition">
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" required placeholder="••••••••"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-crimson-red-500 focus:outline-none transition">
                        @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CONFIRM PASSWORD --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" required placeholder="••••••••"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-crimson-red-500 focus:outline-none transition">
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                        class="w-full bg-crimson-red-600 text-white py-3 rounded-lg font-semibold shadow-md hover:bg-crimson-red-500 transition duration-300">
                        Register Account
                    </button>

                </form>

                {{-- LOGIN LINK --}}
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already registered?
                        <a href="{{ route('login') }}" class="text-crimson-red-600 font-semibold hover:underline">
                            Log in here
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
