@extends('layout.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50 p-4">
    <div class="w-full max-w-md">

        <div class="bg-white rounded-xl shadow-2xl p-8 sm:p-10 border border-gray-100 transform transition duration-500 hover:shadow-3xl">
            
            <h2 class="text-3xl font-extrabold text-center text-crimson-red-600 mb-6">
                Welcome Back
            </h2>
            <p class="text-center text-gray-500 mb-8">
                Log in to browse our exclusive collection.
            </p>

            <form method="POST" action="{{ route('login') }}">
                @csrf 
                
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input 
                        id="phone" 
                        type="text" 
                        name="phone" 
                        value="{{ old('phone') }}" 
                        {{-- required  --}}
                        autofocus 
                        autocomplete="username"
                        placeholder="phone number"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-crimson-red-500 transition duration-150"
                    >
                    @error('phone')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-crimson-red-500 transition duration-150"
                    >
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            name="remember" 
                            class="h-4 w-4 text-crimson-red-600 border-gray-300 rounded focus:ring-crimson-red-500"
                        >
                        <label for="remember_me" class="ml-2 block text-sm text-gray-600">
                            Remember me
                        </label>
                    </div>

                    {{-- Remove this if you don't have password reset --}}
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-crimson-red-600 hover:text-crimson-red-500 font-medium transition duration-150">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <div>
                    <button type="submit" class="w-full py-3 bg-crimson-red-500 text-white rounded-lg font-semibold shadow-md hover:bg-crimson-red-600 transition duration-300 transform hover:scale-[1.005]">
                        Log In
                    </button>
                </div>

            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-crimson-red-600 font-bold hover:text-crimson-red-500 transition duration-150">
                        Create One
                    </a>
                </p>
            </div>

        </div>
        
    </div>
</div>
@endsection
