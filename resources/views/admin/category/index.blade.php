{{-- resources/views/categories/index.blade.php --}}
@extends('layout.app')

@section('title', 'Whizzact | Category Management')

@section('style')
    {{-- <link rel="stylesheet" href="{{ url('/assests/css/careerlist.css') }}"> --}}
@endsection

@section('content')
    @include('admin.common.header')
    
    <div class="flex max-w-1980 mx-auto">
        @include('admin.common.sidenavbar')
        
        <div id="main-content" class="flex-grow min-h-screen pt-4 lg:pt-0 pb-12 transition-all duration-300 ease-in-out">
            
            <div class="min-h-screen bg-gray-50 p-6">
                <div class="max-w-7xl mx-auto">
                    
                    {{-- Header with Add Button --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                        <div>
                            <h2 class="text-3xl font-extrabold text-red-600">Category Management</h2>
                            <p class="text-gray-500 mt-1">Manage your product categories</p>
                        </div>
                        <button onclick="openCreateModal()" class="mt-4 sm:mt-0 px-6 py-3 bg-red-500 text-white rounded-lg font-semibold shadow-md hover:bg-red-600 transition duration-300 transform hover:scale-[1.02] flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add New Category
                        </button>
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Categories Table --}}
                    <div class="bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">S.No</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Category Name</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($categories as $index => $category)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        {{-- Calculate serial number based on current page --}}
                                        <td class="px-6 py-4 text-sm text-gray-800">
                                            {{ $categories->firstItem() + $index }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $category->catname }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                                {{ $category->istatus == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $category->istatus == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-3">
                                                <button onclick="openEditModal({{ $category->catid }}, '{{ $category->catname }}', {{ $category->istatus }})" 
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition duration-150">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </button>
                                                <button onclick="openDeleteModal({{ $category->catid }}, '{{ $category->catname }}')" 
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition duration-150">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                            </svg>
                                            <p class="text-lg font-medium">No categories found</p>
                                            <p class="text-sm mt-1">Click "Add New Category" to create one.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        {{-- Pagination --}}
                        @if(method_exists($categories, 'links'))
                            <div class="px-6 py-4 border-t border-gray-200">
                                {{ $categories->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Create/Edit Modal --}}
            <div id="categoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-2xl rounded-xl bg-white">
                    <div class="mt-3">
                        <h3 id="modalTitle" class="text-2xl font-bold text-red-600 mb-6">Add New Category</h3>
                        
                        <form id="categoryForm" method="POST">
                            @csrf
                            <input type="hidden" id="method" name="_method" value="POST">
                            
                            <div class="mb-5">
                                <label for="catname" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                                <input 
                                    type="text" 
                                    id="catname" 
                                    name="catname"
                                    required
                                    maxlength="100"
                                    placeholder="Enter category name"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150"
                                >
                            </div>

                            <div class="mb-6">
                                <label for="istatus" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select 
                                    id="istatus" 
                                    name="istatus"
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150"
                                >
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="flex items-center justify-end space-x-3">
                                <button type="button" onclick="closeModal()" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition duration-150">
                                    Cancel
                                </button>
                                <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition duration-150">
                                    Save Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Delete Confirmation Modal --}}
            <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-2xl rounded-xl bg-white">
                    <div class="mt-3 text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Delete Category</h3>
                        <p class="text-gray-500 mb-6">Are you sure you want to delete <span id="deleteCategoryName" class="font-semibold text-red-600"></span>? This action cannot be undone.</p>
                        
                        <form id="deleteForm" method="POST" class="flex items-center justify-center space-x-3">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="closeDeleteModal()" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition duration-150">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition duration-150">
                                Delete Category
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
        // Modal Functions
        function openCreateModal() {
            document.getElementById('modalTitle').innerText = 'Add New Category';
            document.getElementById('categoryForm').action = '{{ route("categories.store") }}';
            document.getElementById('method').value = 'POST';
            document.getElementById('catname').value = '';
            document.getElementById('istatus').value = '1';
            document.getElementById('categoryModal').classList.remove('hidden');
            
            // Remove any existing error highlights
            document.getElementById('catname').classList.remove('border-red-500');
        }

        function openEditModal(id, name, status) {
            document.getElementById('modalTitle').innerText = 'Edit Category';
            document.getElementById('categoryForm').action = '{{ url("/categories") }}/' + id;
            document.getElementById('method').value = 'PUT';
            document.getElementById('catname').value = name;
            document.getElementById('istatus').value = status;
            document.getElementById('categoryModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('categoryModal').classList.add('hidden');
        }

   function openDeleteModal(id, name) {
    document.getElementById('deleteCategoryName').innerText = name;

    let url = "{{ route('delete.cat', ':id') }}";
    url = url.replace(':id', id);

    document.getElementById('deleteForm').action = url;

    document.getElementById('deleteModal').classList.remove('hidden');
}

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('bg-opacity-50')) {
                closeModal();
                closeDeleteModal();
            }
        }

        // Form validation
        document.getElementById('categoryForm')?.addEventListener('submit', function(e) {
            const catname = document.getElementById('catname').value.trim();
            if (catname === '') {
                e.preventDefault();
                alert('Please enter a category name');
                document.getElementById('catname').classList.add('border-red-500');
                document.getElementById('catname').focus();
            }
        });

        // Remove error highlight on input
        document.getElementById('catname')?.addEventListener('input', function() {
            this.classList.remove('border-red-500');
        });

        // Auto-hide success/error messages after 5 seconds
        // setTimeout(function() {
        //     const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
        //     alerts.forEach(alert => {
        //         alert.style.transition = 'opacity 0.5s';
        //         alert.style.opacity = '0';
        //         setTimeout(() => alert.remove(), 500);
        //     });
        // }, 5000);
    </script>
@endsection