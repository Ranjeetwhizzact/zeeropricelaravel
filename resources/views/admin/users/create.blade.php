{{-- resources/views/users/create.blade.php --}}
@extends('layout.app')

@section('title', 'Whizzact | Create User Profile')

@section('style')
<style>
    .form-input {
        transition: all 0.3s ease;
    }
    .form-input:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }
    .preview-image {
        max-height: 150px;
        max-width: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #ef4444;
    }
</style>
@endsection

@section('content')
    @include('admin.common.header')
    
    <div class="flex max-w-1980 mx-auto">
        @include('admin.common.sidenavbar')
        
        <div id="main-content" class="flex-grow min-h-screen pt-4 lg:pt-0 pb-12 transition-all duration-300 ease-in-out">
            
            <div class="min-h-screen bg-gray-50 p-6">
                <div class="max-w-3xl mx-auto">
                    
                    {{-- Header with Back Button --}}
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-3xl font-extrabold text-red-600">Create User Profile</h2>
                            {{-- <p class="text-gray-500 mt-1">Add profile information for user: <span class="font-semibold">{{ $user->name }}</span></p> --}}
                        </div>
                        <a href="{{ route('users.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition duration-300 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Users
                        </a>
                    </div>

                    {{-- Error Messages --}}
                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            <div class="font-medium mb-2">Please fix the following errors:</div>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li class="text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- User Info Card --}}
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    Creating profile for <span class="font-bold">{{ $user->name }}</span> ({{ $user->email }})
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Create Profile Form --}}
                    <div class="bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden">
                        <form method="POST" action="{{ route('users.profile.store', $user->id) }}" enctype="multipart/form-data" class="p-8">
                            @csrf
                            
                            {{-- Profile Image Upload --}}
                            <div class="mb-8 text-center">
                                <label class="block text-sm font-medium text-gray-700 mb-4">Profile Image</label>
                                <div class="flex flex-col items-center">
                                    <div class="relative mb-4">
                                        <img id="imagePreview" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=150&color=ef4444&background=fee2e2" alt="Profile Preview" class="preview-image">
                                        <button type="button" onclick="document.getElementById('profile_image').click()" class="absolute bottom-0 right-0 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <input type="file" id="profile_image" name="profile_image" accept="image/*" class="hidden" onchange="previewImage(this)">
                                    <p class="text-xs text-gray-500">Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
                                </div>
                            </div>

                            {{-- Full Name --}}
                            <div class="mb-6">
                                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="full_name" 
                                    name="full_name" 
                                    value="{{ old('full_name', $user->name) }}"
                                    required
                                    class="form-input w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 @error('full_name') border-red-500 @enderror"
                                    placeholder="Enter full name"
                                >
                                @error('full_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Date of Birth --}}
                            <div class="mb-6">
                                <label for="dob" class="block text-sm font-medium text-gray-700 mb-2">
                                    Date of Birth
                                </label>
                                <input 
                                    type="date" 
                                    id="dob" 
                                    name="dob" 
                                    value="{{ old('dob') }}"
                                    max="{{ date('Y-m-d') }}"
                                    class="form-input w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 @error('dob') border-red-500 @enderror"
                                >
                                @error('dob')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Phone Number --}}
                            <div class="mb-6">
                                <label for="number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number
                                </label>
                                <input 
                                    type="tel" 
                                    id="number" 
                                    name="number" 
                                    value="{{ old('number') }}"
                                    class="form-input w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 @error('number') border-red-500 @enderror"
                                    placeholder="Enter phone number"
                                >
                                @error('number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Address Type --}}
                            <div class="mb-8">
                                <label for="address_type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Address Type
                                </label>
                                <select 
                                    id="address_type" 
                                    name="address_type" 
                                    class="form-input w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 @error('address_type') border-red-500 @enderror"
                                >
                                    <option value="">Select Address Type</option>
                                    <option value="home" {{ old('address_type') == 'home' ? 'selected' : '' }}>Home</option>
                                    <option value="work" {{ old('address_type') == 'work' ? 'selected' : '' }}>Work</option>
                                    <option value="other" {{ old('address_type') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('address_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Form Actions --}}
                            <div class="flex items-center justify-end space-x-4 border-t pt-6">
                                <a href="{{ route('users.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition duration-150">
                                    Cancel
                                </a>
                                <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition duration-150 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Create Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('admin.common.footer')
@endsection

@section('script')
<script>
    // Image preview function
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Form validation
    document.querySelector('form')?.addEventListener('submit', function(e) {
        const fullName = document.getElementById('full_name').value.trim();
        const phone = document.getElementById('number').value.trim();
        
        if (fullName === '') {
            e.preventDefault();
            alert('Please enter full name');
            document.getElementById('full_name').classList.add('border-red-500');
            document.getElementById('full_name').focus();
            return;
        }
        
        // Phone number validation (optional)
        if (phone !== '') {
            const phoneRegex = /^[0-9+\-\s()]{10,20}$/;
            if (!phoneRegex.test(phone)) {
                e.preventDefault();
                alert('Please enter a valid phone number');
                document.getElementById('number').classList.add('border-red-500');
                document.getElementById('number').focus();
                return;
            }
        }
    });

    // Remove error highlight on input
    document.querySelectorAll('input, select').forEach(element => {
        element?.addEventListener('input', function() {
            this.classList.remove('border-red-500');
        });
        element?.addEventListener('change', function() {
            this.classList.remove('border-red-500');
        });
    });
</script>
@endsection