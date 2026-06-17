@extends('layout.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50 p-4">
    <div class="w-full max-w-md">

        <div class="bg-white rounded-xl shadow-2xl p-8 sm:p-10 border border-gray-100 transform transition duration-500 hover:shadow-3xl">
            
            <h2 class="text-3xl font-extrabold text-center text-crimson-red-600 mb-6">
                Join Our Collection
            </h2>
            <p class="text-center text-gray-500 mb-8">
                Create your ZeroPriceCo. account in seconds.
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf 
                
                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Your Name"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-crimson-red-500 transition duration-150"
                    >
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input 
                        id="phone" 
                        type="text" 
                        name="Phone" 
                        value="{{ old('phone') }}" 
                        required 
                        autocomplete="username"
                        placeholder="phone"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-crimson-red-500 transition duration-150"
                    >
                    @error('phone')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-crimson-red-500 transition duration-150"
                    >
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-crimson-red-500 transition duration-150"
                    >
                    @error('password_confirmation')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full py-3 bg-crimson-red-500 text-white rounded-lg font-semibold shadow-md hover:bg-crimson-red-600 transition duration-300 transform hover:scale-[1.005]">
                        Register Account
                    </button>
                </div>

            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    Already registered? 
                    <a href="{{ route('login') }}" class="text-crimson-red-600 font-bold hover:text-crimson-red-500 transition duration-150">
                        Log in here
                    </a>
                </p>
            </div>

        </div>
        
    </div>
</div>
@endsection
