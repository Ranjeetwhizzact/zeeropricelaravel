{{-- resources/views/users/index.blade.php --}}
@extends('layout.app')

@section('title', 'Whizzact | User Management')

@section('style')
<style>
    .filter-active {
        background-color: #fee2e2;
        border-color: #ef4444;
    }
    .modal-transition {
        transition: opacity 0.3s ease-in-out;
    }
</style>
@endsection

@section('content')
    @include('admin.common.header')
    
    <div class="flex max-w-1980 mx-auto">
        @include('admin.common.sidenavbar')
        
        <div id="main-content" class="flex-grow min-h-screen pt-4 lg:pt-0 pb-12 transition-all duration-300 ease-in-out">
            
            <div class="min-h-screen bg-gray-50 p-6">
                <div class="max-w-7xl mx-auto">
                    
                    {{-- Header --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                        <div>
                            <h2 class="text-3xl font-extrabold text-red-600">User Management</h2>
                            <p class="text-gray-500 mt-1">Manage all registered users</p>
                        </div>
                        <div class="mt-4 sm:mt-0 flex items-center space-x-4">
                            <span class="text-sm text-gray-500">Total Users: {{ $users->total() }}</span>
                            <a href="{{route('users.create') }}" class="mt-4 sm:mt-0 px-6 py-3 bg-red-500 text-white rounded-lg font-semibold shadow-md hover:bg-red-600 transition duration-300 transform hover:scale-[1.02] flex items-center justify-center" > Add User</a>
                        </div>
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex justify-between items-center">
                            <span>{{ session('success') }}</span>
                            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex justify-between items-center">
                            <span>{{ session('error') }}</span>
                            <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    @endif

                    {{-- Filter and Search Section --}}
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-6">
                        <form id="filterForm" method="GET" action="{{ route('users.index') }}" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Search --}}
                                <div>
                                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                                    <input 
                                        type="text" 
                                        name="search" 
                                        id="search" 
                                        value="{{ request('search') }}"
                                        placeholder="Search by name, email or phone..."
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150"
                                        onchange="this.form.submit()"
                                    >
                                </div>

                                {{-- Role Filter --}}
                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Filter by Role</label>
                                    <select 
                                        name="role" 
                                        id="role" 
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150"
                                        onchange="this.form.submit()"
                                    >
                                        <option value="">All Roles</option>
                                        @foreach($roles as $value => $label)
                                            <option value="{{ $value }}" {{ request('role') == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Active Filters Display --}}
                            @if(request('search') || request('role'))
                                <div class="flex items-center space-x-2 pt-2">
                                    <span class="text-sm text-gray-500">Active filters:</span>
                                    @if(request('search'))
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Search: "{{ request('search') }}"
                                            <a href="{{ route('users.index', array_merge(request()->except(['search', 'page']))) }}" class="ml-2 text-red-600 hover:text-red-800">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </a>
                                        </span>
                                    @endif
                                    @if(request('role'))
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Role: {{ ucfirst(request('role')) }}
                                            <a href="{{ route('users.index', array_merge(request()->except(['role', 'page']))) }}" class="ml-2 text-blue-600 hover:text-blue-800">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </a>
                                        </span>
                                    @endif
                                    <a href="{{ route('users.index') }}" class="text-sm text-red-600 hover:text-red-800 hover:underline">
                                        Clear all filters
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>

                    {{-- Users Table --}}
                    <div class="bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">S.No</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Phone</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Role</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Points</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Joined</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($users as $index => $user)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 text-sm text-gray-800">
                                            {{ $users->firstItem() + $index }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-red-100 rounded-full flex items-center justify-center">
                                                    <span class="text-red-600 font-semibold">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->phone ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                                @if($user->role == 'admin') bg-purple-100 text-purple-800
                                                @elseif($user->role == 'director') bg-blue-100 text-blue-800
                                                @elseif($user->role == 'executive') bg-green-100 text-green-800
                                                @elseif($user->role == 'subexecutive') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800
                                                @endif
                                            ">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="font-semibold text-gray-900">{{ number_format($user->points) }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $user->created_at ? $user->created_at->format('d M Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-2">
                                                {{-- Edit Button --}}
                                                <button onclick="openEditModal({{ $user->id }})" 
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition duration-150"
                                                    title="Edit User">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </button>
                                                
                                                {{-- Change Role Button --}}
                                                <button onclick="openRoleModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->role }}')" 
                                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition duration-150"
                                                    title="Change Role">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                </button>
                                                
                                                {{-- Update Points Button --}}
                                                <button onclick="openPointsModal({{ $user->id }}, '{{ $user->name }}', {{ $user->points }})" 
                                                    class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition duration-150"
                                                    title="Update Points">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </button>
                                                
                                                {{-- Delete Button --}}
                                                @if(auth()->id() != $user->id)
                                                <button onclick="openDeleteModal({{ $user->id }}, '{{ $user->name }}')" 
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition duration-150"
                                                    title="Delete User">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                            </svg>
                                            <p class="text-lg font-medium">No users found</p>
                                            @if(request('search') || request('role'))
                                                <p class="text-sm mt-1">Try clearing the filters to see all users.</p>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        {{-- Pagination --}}
                        @if(method_exists($users, 'links'))
                            <div class="px-6 py-4 border-t border-gray-200">
                                {{ $users->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Edit User Modal --}}
            <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 modal-transition">
                <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-2xl rounded-xl bg-white">
                    <div class="mt-3">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-red-600">Edit User</h3>
                            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <form id="editForm" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-4">
                                <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                <input 
                                    type="text" 
                                    id="edit_name" 
                                    name="name"
                                    required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150"
                                >
                            </div>

                            <div class="mb-4">
                                <label for="edit_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input 
                                    type="email" 
                                    id="edit_email" 
                                    name="email"
                                    required
                                    maxlength="50"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150"
                                >
                            </div>

                            <div class="mb-4">
                                <label for="edit_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <input 
                                    type="text" 
                                    id="edit_phone" 
                                    name="phone"
                                    maxlength="50"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150"
                                >
                            </div>

                            <div class="mb-4">
                                <label for="edit_role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                                <select 
                                    id="edit_role" 
                                    name="role"
                                    required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150"
                                >
                                    @foreach($roles as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-6">
                                <label for="edit_points" class="block text-sm font-medium text-gray-700 mb-2">Points</label>
                                <input 
                                    type="number" 
                                    id="edit_points" 
                                    name="points"
                                    required
                                    min="0"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150"
                                >
                            </div>

                            <div class="flex items-center justify-end space-x-3">
                                <button type="button" onclick="closeEditModal()" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition duration-150">
                                    Cancel
                                </button>
                                <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition duration-150">
                                    Update User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Change Role Modal --}}
            <div id="roleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 modal-transition">
                <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-2xl rounded-xl bg-white">
                    <div class="mt-3">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-red-600">Change User Role</h3>
                            <button onclick="closeRoleModal()" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-gray-600 mb-4">Update role for <span id="roleUserName" class="font-semibold"></span></p>
                        
                        <form id="roleForm" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-6">
                                <label for="role_select" class="block text-sm font-medium text-gray-700 mb-2">Select Role</label>
                                <select 
                                    id="role_select" 
                                    name="role"
                                    required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150"
                                >
                                    @foreach($roles as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-center justify-end space-x-3">
                                <button type="button" onclick="closeRoleModal()" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition duration-150">
                                    Cancel
                                </button>
                                <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition duration-150">
                                    Update Role
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Update Points Modal --}}
            <div id="pointsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 modal-transition">
                <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-2xl rounded-xl bg-white">
                    <div class="mt-3">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-red-600">Update User Points</h3>
                            <button onclick="closePointsModal()" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-gray-600 mb-4">Update points for <span id="pointsUserName" class="font-semibold"></span></p>
                        
                        <form id="pointsForm" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-6">
                                <label for="points_input" class="block text-sm font-medium text-gray-700 mb-2">Points</label>
                                <input 
                                    type="number" 
                                    id="points_input" 
                                    name="points"
                                    required
                                    min="0"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150"
                                >
                            </div>

                            <div class="flex items-center justify-end space-x-3">
                                <button type="button" onclick="closePointsModal()" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition duration-150">
                                    Cancel
                                </button>
                                <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition duration-150">
                                    Update Points
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Delete Confirmation Modal --}}
            <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 modal-transition">
                <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-2xl rounded-xl bg-white">
                    <div class="mt-3 text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Delete User</h3>
                        <p class="text-gray-500 mb-6">Are you sure you want to delete <span id="deleteUserName" class="font-semibold text-red-600"></span>? This action cannot be undone.</p>
                        
                        <form id="deleteForm" method="POST" class="flex items-center justify-center space-x-3">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="closeDeleteModal()" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition duration-150">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition duration-150">
                                Delete User
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    @include('admin.common.footer')
@endsection

@section('script')
    <script src="{{ url('/assests/js/home.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Auto-submit filters when changed
        document.getElementById('search')?.addEventListener('change', function() {
            this.form.submit();
        });
        
        document.getElementById('role')?.addEventListener('change', function() {
            this.form.submit();
        });

        // Edit Modal Functions
        function openEditModal(id) {
            // Fetch user data via AJAX
            fetch(`/users/${id}/edit`)
                .then(response => response.json())
                .then(user => {
                    document.getElementById('edit_name').value = user.name;
                    document.getElementById('edit_email').value = user.email;
                    document.getElementById('edit_phone').value = user.phone || '';
                    document.getElementById('edit_role').value = user.role;
                    document.getElementById('edit_points').value = user.points;
                    
                    document.getElementById('editForm').action = `/users/${id}`;
                    document.getElementById('editModal').classList.remove('hidden');
                })
                .catch(error => {
                    alert('Error loading user data');
                    console.error(error);
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Role Modal Functions
        function openRoleModal(id, name, currentRole) {
            document.getElementById('roleUserName').innerText = name;
            document.getElementById('roleForm').action = `/users/${id}/role`;
            document.getElementById('role_select').value = currentRole;
            document.getElementById('roleModal').classList.remove('hidden');
        }

        function closeRoleModal() {
            document.getElementById('roleModal').classList.add('hidden');
        }

        // Points Modal Functions
        function openPointsModal(id, name, points) {
            document.getElementById('pointsUserName').innerText = name;
            document.getElementById('pointsForm').action = `/users/${id}/points`;
            document.getElementById('points_input').value = points;
            document.getElementById('pointsModal').classList.remove('hidden');
        }

        function closePointsModal() {
            document.getElementById('pointsModal').classList.add('hidden');
        }

        // Delete Modal Functions
        function openDeleteModal(id, name) {
            document.getElementById('deleteUserName').innerText = name;
            document.getElementById('deleteForm').action = `/users/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('bg-opacity-50')) {
                closeEditModal();
                closeRoleModal();
                closePointsModal();
                closeDeleteModal();
            }
        }

        // Form validations
        document.getElementById('editForm')?.addEventListener('submit', function(e) {
            const name = document.getElementById('edit_name').value.trim();
            const email = document.getElementById('edit_email').value.trim();
            const points = document.getElementById('edit_points').value;
            
            if (name === '') {
                e.preventDefault();
                alert('Please enter name');
                document.getElementById('edit_name').classList.add('border-red-500');
                document.getElementById('edit_name').focus();
                return;
            }
            
            if (email === '' || !email.includes('@')) {
                e.preventDefault();
                alert('Please enter a valid email');
                document.getElementById('edit_email').classList.add('border-red-500');
                document.getElementById('edit_email').focus();
                return;
            }
            
            if (points === '' || points < 0) {
                e.preventDefault();
                alert('Please enter valid points');
                document.getElementById('edit_points').classList.add('border-red-500');
                document.getElementById('edit_points').focus();
                return;
            }
        });

        document.getElementById('pointsForm')?.addEventListener('submit', function(e) {
            const points = document.getElementById('points_input').value;
            if (points === '' || points < 0) {
                e.preventDefault();
                alert('Please enter valid points (minimum 0)');
                document.getElementById('points_input').classList.add('border-red-500');
                document.getElementById('points_input').focus();
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