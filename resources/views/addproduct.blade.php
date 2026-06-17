@extends('layout.app')

@section('title', 'Whizzact | Add Product')

@section('style')
    {{-- Add any custom styles if needed --}}
    <style>
        @media (max-width: 767px) {
            #camera-btn, #gallery-btn {
                padding: 12px 16px;
            }

            #image-preview-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }
        }


        button {
            -webkit-tap-highlight-color: transparent;
        }
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: #dc2626;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #b91c1c;
        }
    </style>
@endsection

@section('content')
    @include('components.header')
    <div class="flex max-w-1980 mx-auto">
        @include('components.sidenavbar')

        <div id="main-content" class="flex-grow pt-4 lg:pt-8 pb-12 transition-all duration-300 ease-in-out px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-8 border-b pb-4 border-crimson-red-500/50">
                    ➕ {{ isset($product) ? 'Edit Product' : 'Add a New Product' }}
                </h2>

                <form action="{{ isset($product) ? route('product.update', $product->pid) : route('product.store') }}"
                      method="POST" enctype="multipart/form-data"
                      class="space-y-6 bg-white p-6 sm:p-8 rounded-xl shadow-2xl border border-gray-100">

                    @csrf
                    @if(isset($product))
                        @method('POST')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- CATEGORY --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Category *</label>
                            <select id="category" name="catid" required
                                class="w-full border-gray-300 focus:border-crimson-red-500 focus:ring-crimson-red-500 rounded-lg shadow-sm p-3">
                                <option value="" disabled {{ !isset($product) ? 'selected' : '' }}>Select Category</option>
                                @foreach($cat as $item)
                                    <option value="{{ $item->catid }}"
                                        {{ isset($product) && $product->catid == $item->catid ? 'selected' : '' }}>
                                        {{ $item->catname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- SUBCATEGORY --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Sub Category *</label>
                            <select id="sub-category" name="subcatid" required
                                class="w-full border-gray-300 focus:border-crimson-red-500 focus:ring-crimson-red-500 rounded-lg shadow-sm p-3">
                                <option value="" disabled selected>Select Subcategory</option>
                            </select>
                        </div>
                    </div>

                    {{-- PRODUCT NAME --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Product Name *</label>
                        <input type="text" id="product-name" name="product-name"
                            value="{{ old('ititle', $product->ititle ?? '') }}" required
                            class="w-full border-gray-300 focus:border-crimson-red-500 focus:ring-crimson-red-500 rounded-lg shadow-sm p-3">
                    </div>

                    {{-- DESCRIPTION --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Product Description *</label>
                        <textarea id="description" name="description" rows="3" required
                            class="w-full border-gray-300 focus:border-crimson-red-500 focus:ring-crimson-red-500 rounded-lg shadow-sm p-3">{{ old('description', $product->description ?? '') }}</textarea>
                    </div>

                    {{-- PRICE SECTION --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Maximum Price (₹) *</label>
                            <input type="number" id="max-price" name="max-price" step="0.01"
                                value="{{ old('max-price', $product->mrp ?? '') }}" required
                                class="w-full border-gray-300 focus:border-crimson-red-500 focus:ring-crimson-red-500 rounded-lg shadow-sm p-3 price-input">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Minimum Price (₹) *</label>
                            <input type="number" id="min-price" name="min-price" step="0.01"
                                value="{{ old('min-price', $product->minprice ?? '') }}" required
                                class="w-full border-gray-300 focus:border-crimson-red-500 focus:ring-crimson-red-500 rounded-lg shadow-sm p-3 price-input">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Discount Amount *</label>
                            <input type="text" id="discount" name="discount" readonly
                                value="{{ old('discount', $product->reducedprice ?? '') }}"
                                class="w-full border-gray-300 bg-gray-100 rounded-lg shadow-sm p-3">
                        </div>
                    </div>

                    {{-- QUANTITY + DATE --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Quantity *</label>
                            <input type="number" id="quantity" name="quantity"
                                value="{{ old('qty', $product->qty ?? '') }}" required
                                class="w-full border-gray-300 focus:border-crimson-red-500 focus:ring-crimson-red-500 rounded-lg shadow-sm p-3">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Display Till *</label>
                            <input type="date" id="display-till" name="display-till"
                                value="{{ old('display-till', isset($product->tilldate) ? date('Y-m-d', strtotime($product->tilldate)) : '') }}"
                                required class="w-full border-gray-300 focus:border-crimson-red-500 focus:ring-crimson-red-500 rounded-lg shadow-sm p-3">
                        </div>
                    </div>

                    {{-- IMAGES SECTION --}}
                    <div class="bg-gray-50 p-4 rounded-xl border border-dashed border-gray-300">
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Product Images (Max 5) <span class="text-xs font-normal text-gray-500">- First image is main</span>
                        </label>

                        {{-- Camera and Gallery Buttons for Mobile --}}
                        <div class="flex flex-col sm:flex-row gap-4 mb-4 md:hidden">
                            <button type="button" id="camera-btn"
                                    class="flex-1 py-3 px-4 rounded-lg bg-crimson-red-600 text-white font-semibold hover:bg-crimson-red-500 transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Take Photo
                            </button>
                            <button type="button" id="gallery-btn"
                                    class="flex-1 py-3 px-4 rounded-lg bg-gray-700 text-white font-semibold hover:bg-gray-600 transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Choose from Gallery
                            </button>
                        </div>

                        {{-- Desktop Upload Area --}}
                        <div id="desktop-upload" class="hidden md:flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-white hover:bg-gray-50 transition-all">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-crimson-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-700 font-semibold">Click to Upload Images</p>
                                <p class="text-xs text-gray-500">Up to 5 images (JPG, PNG)</p>
                            </div>
                            <input id="file-upload" name="file-upload[]" type="file" multiple accept="image/*" class="hidden" />
                        </div>

                        {{-- Hidden Inputs for Camera/Gallery --}}
                        <input id="camera-input" type="file" accept="image/*" capture="environment" class="hidden" />
                        <input id="gallery-input" type="file" accept="image/*" multiple class="hidden" />

                        {{-- PREVIEW GRID --}}
                        <div id="image-preview-container" class="mt-4 grid grid-cols-3 sm:grid-cols-5 gap-3">
                            <!-- JS will inject previews here -->
                            <div class="col-span-3 sm:col-span-5 flex flex-col items-center justify-center py-8 text-gray-400">
                                <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-sm">No images selected yet</p>
                            </div>
                        </div>

                        {{-- Existing Images (for edit mode) --}}
                        @if(isset($product) && isset($product->images))
                            <div class="mt-4">
                                <p class="text-sm font-semibold text-gray-700 mb-2">Existing Images:</p>
                                <div class="grid grid-cols-3 sm:grid-cols-5 gap-3">
                                    @foreach($product->images as $image)
                                        <div class="relative aspect-square rounded-lg overflow-hidden border border-gray-200">
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image" class="w-full h-full object-cover">
                                            <span class="absolute bottom-0 left-0 right-0 bg-black/50 text-white text-[10px] text-center">
                                                Existing
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- SUBMIT BUTTON --}}
                    <div class="pt-2 flex justify-end gap-4">
                        {{-- <a href="{{ route('product.index') }}"
                           class="py-3 px-6 rounded-lg shadow-lg text-base font-bold text-gray-700 bg-gray-200 hover:bg-gray-300 transition">
                            Cancel
                        </a> --}}
                        <button type="submit"
                            class="py-3 px-6 rounded-lg shadow-lg text-base font-bold text-white bg-crimson-red-600 hover:bg-crimson-red-500 transition">
                            {{ isset($product) ? 'Update Product' : 'Add Product' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('components.footer')
@endsection

@section('script')
    <script src="{{ url('/assests/js/home.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            // Category change handler
            $('#category').on('change', function () {
                var category_id = $(this).val();

                $.ajax({
                    url: "{{ url('get-subcategories') }}/" + category_id,
                    type: "GET",
                    success: function (data) {
                        $('#sub-category').empty().append('<option selected disabled>Select Subcategory</option>');
                        $.each(data, function (key, value) {
                            $('#sub-category').append('<option value="' + value.subcatid + '">' + value.subcatname + '</option>');
                        });

                        // If editing, select the previously selected subcategory
                        @if(isset($product) && isset($product->subcategory_id))
                            $('#sub-category').val({{ $product->subcategory_id }});
                        @endif
                    }
                });
            });

            // Trigger category change on page load if editing
            @if(isset($product))
                $('#category').trigger('change');
            @endif
        });
    </script>

    <script>
        // Price calculation
        const maxPriceInput = document.getElementById("max-price");
        const minPriceInput = document.getElementById("min-price");
        const discountInput = document.getElementById("discount");

        function calculateDiscount() {
            let max = parseFloat(maxPriceInput.value) || 0;
            let min = parseFloat(minPriceInput.value) || 0;

            let discount = max - min;
            discountInput.value = discount > 0 ? discount.toFixed(2) : 0;
        }

        maxPriceInput.addEventListener("input", calculateDiscount);
        minPriceInput.addEventListener("input", calculateDiscount);

        // Calculate on page load
        calculateDiscount();
    </script>

    <script>
        // Image upload functionality
        document.addEventListener("DOMContentLoaded", function () {
            const fileUploadInput = document.getElementById("file-upload");
            const cameraInput = document.getElementById("camera-input");
            const galleryInput = document.getElementById("gallery-input");
            const cameraBtn = document.getElementById("camera-btn");
            const galleryBtn = document.getElementById("gallery-btn");
            const desktopUpload = document.getElementById("desktop-upload");
            const previewContainer = document.getElementById("image-preview-container");

            let selectedFiles = [];

            // Show desktop upload on desktop, hide on mobile
            function checkScreenSize() {
                if (window.innerWidth >= 768) { // md breakpoint
                    desktopUpload.classList.remove('hidden');
                } else {
                    desktopUpload.classList.add('hidden');
                }
            }

            checkScreenSize();
            window.addEventListener('resize', checkScreenSize);

            // Desktop upload handler
            desktopUpload.addEventListener("click", function() {
                fileUploadInput.click();
            });

            // Mobile Camera button
            cameraBtn.addEventListener("click", function() {
                // Clear any previous selection
                cameraInput.value = '';
                // Trigger camera with rear camera preference
                cameraInput.setAttribute('capture', 'environment');
                cameraInput.click();
            });

            // Mobile Gallery button
            galleryBtn.addEventListener("click", function() {
                // Clear any previous selection
                galleryInput.value = '';
                galleryInput.click();
            });

            // Handle file selection from all inputs
            function handleFileSelection(files) {
                const newFiles = Array.from(files);

                // Validate file types
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                const invalidFiles = newFiles.filter(file => !validTypes.includes(file.type));

                if (invalidFiles.length > 0) {
                    alert("Please upload only JPG, PNG, or WebP images.");
                    return;
                }

                // Limit logic: Total must not exceed 5
                if (selectedFiles.length + newFiles.length > 5) {
                    alert("You can only upload a maximum of 5 images.");
                    // Take only the remaining slots
                    const remainingSlots = 5 - selectedFiles.length;
                    if (remainingSlots > 0) {
                        selectedFiles = [...selectedFiles, ...newFiles.slice(0, remainingSlots)];
                        updateInputFiles();
                        displayPreviews();
                    }
                } else {
                    selectedFiles = [...selectedFiles, ...newFiles];
                    updateInputFiles();
                    displayPreviews();
                }
            }

            // Event listeners for all file inputs
            fileUploadInput.addEventListener("change", function(event) {
                handleFileSelection(event.target.files);
            });

            cameraInput.addEventListener("change", function(event) {
                if (event.target.files.length > 0) {
                    handleFileSelection(event.target.files);
                }
            });

            galleryInput.addEventListener("change", function(event) {
                if (event.target.files.length > 0) {
                    handleFileSelection(event.target.files);
                }
            });

            function displayPreviews() {
                previewContainer.innerHTML = "";

                if (selectedFiles.length === 0) {
                    previewContainer.innerHTML = `
                        <div class="col-span-3 sm:col-span-5 flex flex-col items-center justify-center py-8 text-gray-400">
                            <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-sm">No images selected yet</p>
                        </div>
                    `;
                    return;
                }

                selectedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement("div");
                        div.className = "relative group aspect-square rounded-lg overflow-hidden border border-gray-200 shadow-sm";

                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-full object-cover" alt="Preview ${index + 1}">
                            <button type="button" class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] shadow-lg hover:bg-red-700 remove-img" data-index="${index}" title="Remove image">
                                ✕
                            </button>
                            ${index === 0 ? '<span class="absolute bottom-0 left-0 right-0 bg-black/50 text-white text-[10px] text-center">Main</span>' : ''}
                        `;

                        previewContainer.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            }

            // Handle Deletion
            previewContainer.addEventListener("click", function(e) {
                if (e.target.classList.contains('remove-img') || e.target.closest('.remove-img')) {
                    const button = e.target.classList.contains('remove-img') ? e.target : e.target.closest('.remove-img');
                    const index = button.getAttribute('data-index');
                    selectedFiles.splice(index, 1);
                    updateInputFiles();
                    displayPreviews();
                }
            });

            function updateInputFiles() {
                // Update the main file input
                let dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => dataTransfer.items.add(file));
                fileUploadInput.files = dataTransfer.files;
            }

            // Form validation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                // Check if display date is not in the past
                const displayTillInput = document.getElementById('display-till');
                const selectedDate = new Date(displayTillInput.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate < today) {
                    e.preventDefault();
                    alert('Display Till date cannot be in the past.');
                    displayTillInput.focus();
                    return;
                }

                // Check if min price is less than max price
                const maxPrice = parseFloat(maxPriceInput.value);
                const minPrice = parseFloat(minPriceInput.value);

                if (minPrice >= maxPrice) {
                    e.preventDefault();
                    alert('Minimum price must be less than maximum price.');
                    minPriceInput.focus();
                    return;
                }

                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Processing...';
                submitBtn.disabled = true;
            });
        });
    </script>
@endsection
