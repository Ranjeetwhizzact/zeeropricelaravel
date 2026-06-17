@extends('admin.layout.app')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
    <div class="w-full max-w-md">

```
    <div class="bg-white rounded-xl shadow-xl p-8 border border-gray-200">

        <h2 class="text-2xl font-bold text-center text-red-600 mb-2">
            Admin Control Panel
        </h2>

        <p class="text-center text-gray-500 text-sm mb-6">
            Authorized Personnel Only
        </p>

        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('adminlogin') }}">
            @csrf 
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                Admin Phone 
                </label>
                <input 
                    type="text" 
                    name="phone" 
                    value="{{ old('phone') }}"
                    required
                    placeholder="Enter Admin Phone"
                    class="w-full p-2 border rounded focus:ring-2 focus:ring-red-500"
                >
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input 
                    type="password" 
                    name="password" 
                    required
                    placeholder="********"
                    class="w-full p-2 border rounded focus:ring-2 focus:ring-red-500"
                >
            </div>

            <button 
                type="submit"
                class="w-full py-2 bg-red-600 text-white rounded hover:bg-red-700 transition"
            >
                Secure Login
            </button>

        </form>

        <p class="text-xs text-gray-400 text-center mt-6">
            Unauthorized access is strictly prohibited.
        </p>

    </div>
    
</div>

</div>
@endsection
