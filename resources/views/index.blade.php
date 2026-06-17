@extends('layout.app')

@section('title', 'Whizzact | Job list')

@section('style')
    {{-- <link rel="stylesheet" href="{{ url('/assests/css/careerlist.css') }}"> --}}
@endsection

@section('content')
    @include('components.header')
    <div class="flex max-w-1980 mx-auto">
        @include('components.sidenavbar')
        <div id="main-content" class="flex-grow min-h-screen pt-4 lg:pt-0 pb-12 transition-all duration-300 ease-in-out">

            <div class="bg-white border-b border-gray-200 shadow-sm mx-4 sm:mx-6 lg:mx-8">
                <div class="max-w-full px-4 sm:px-6 lg:px-8 flex justify-between items-center py-3">

                    <h2 class="text-lg font-bold text-crimson-red-600">
                        Browse Our Collection
                    </h2>

                    <div class="flex items-center space-x-4 text-sm">

                        <label for="sort" class="font-medium text-gray-600 hidden sm:inline">Sort By:</label>
                        <select id="sort"
                            class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-crimson-red-500">
                            <option>Best Selling</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest</option>
                        </select>

                        <button
                            class="text-gray-500 hover:text-crimson-red-500 transition duration-150 p-2 rounded-full hover:bg-red-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zM3 13h4v4H3v-4zM3 3h4v4H3V3zm10 0h4v4h-4V3zm0 10h4v4h-4v-4z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <main class="px-4 sm:px-6 lg:px-8 py-8">

                <!-- ================= ADS SECTION ================= -->
                <div class="mb-10">

                    <h2 class="text-xl font-bold mb-4 text-gray-800">
                        🔥 Sponsored Ads
                    </h2>

                    <!-- FLASH MESSAGES -->
                    @if (session('error'))
                        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm font-semibold">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif

                    @php
                        $clickedAds = \App\Models\AdClick::where('buyer_id', auth()->id())
                            ->pluck('ad_id')
                            ->toArray();
                    @endphp

                    <div id="ad-carousel" class="relative w-full overflow-hidden bg-white border border-gray-100 rounded-2xl shadow-lg group">
                        <!-- Carousel Slides Track -->
                        <div id="ad-carousel-track" class="flex transition-transform duration-500 ease-out" style="transform: translateX(0%);">
                            @foreach ($ads as $index => $ad)
                                <div class="ad-slide w-full flex-shrink-0 flex flex-col md:flex-row min-h-[350px] md:h-80" data-index="{{ $index }}">
                                    <!-- Left: Media -->
                                    <div class="relative w-full md:w-1/2 h-48 md:h-full bg-slate-950 flex items-center justify-center overflow-hidden">
                                        <!-- AD Badge -->
                                        <span class="absolute top-4 left-4 z-10 text-[10px] tracking-wider uppercase font-bold px-2.5 py-1 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-md shadow-md">
                                            Sponsored Ad
                                        </span>
                                        @if ($ad->media_type == 'video')
                                            <video class="w-full h-full object-cover" loop muted autoplay playsinline>
                                                <source src="{{ asset($ad->media_url) }}" type="video/mp4">
                                            </video>
                                        @else
                                            <img src="{{ asset($ad->media_url) }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" alt="{{ $ad->title }}">
                                        @endif
                                    </div>
                                    <!-- Right: Details -->
                                    <div class="w-full md:w-1/2 p-6 md:p-8 flex flex-col justify-between bg-gradient-to-br from-white to-slate-50 border-t md:border-t-0 md:border-l border-gray-100">
                                        <div class="flex-grow flex flex-col justify-center">
                                            <h3 class="text-xl md:text-2xl font-extrabold text-slate-800 leading-tight mb-3 tracking-tight">
                                                {{ $ad->title }}
                                            </h3>
                                            <p class="text-slate-600 text-sm leading-relaxed mb-5">
                                                {{ $ad->description }}
                                            </p>
                                        </div>
                                        <!-- CLICK BUTTON -->
                                        <form action="{{ route('ads.click') }}" method="POST" class="w-full mt-auto">
                                            @csrf
                                            <input type="hidden" name="ad_id" value="{{ $ad->ad_id }}">
                                            <input type="hidden" name="product_id" value="{{ $products->first()->pid ?? 0 }}">

                                            @if (in_array($ad->ad_id, $clickedAds))
                                                <button disabled type="button"
                                                    class="w-full py-3 bg-slate-100 border border-slate-200 text-slate-400 font-semibold rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                                    </svg>
                                                    Already Viewed
                                                </button>
                                            @else
                                                <button type="submit"
                                                    class="w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 hover:shadow-lg hover:shadow-indigo-500/25 transition-all duration-200 active:scale-[0.98] transform flex items-center justify-center gap-2">
                                                    <span>View Ads</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                    </svg>
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($ads->count() > 1)
                            <!-- Nav Arrows -->
                            <button type="button" id="prev-ad" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/90 shadow-md border border-slate-100 hover:bg-white hover:scale-105 active:scale-95 flex items-center justify-center text-slate-700 transition z-10 opacity-0 group-hover:opacity-100 duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button type="button" id="next-ad" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/90 shadow-md border border-slate-100 hover:bg-white hover:scale-105 active:scale-95 flex items-center justify-center text-slate-700 transition z-10 opacity-0 group-hover:opacity-100 duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            <!-- Dot Indicators -->
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 z-10 bg-slate-900/20 backdrop-blur-sm px-3 py-1.5 rounded-full">
                                @foreach($ads as $index => $ad)
                                    <button type="button" class="ad-dot w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-all duration-300" data-slide="{{ $index }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <!-- ================= PRODUCTS SECTION ================= -->
                <div>

                    <h2 class="text-xl font-bold mb-6 text-gray-800">
                        📦 Products
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-8">

                        @foreach ($products as $product)
                            <a href="{{ url('productdetail/' . $product->pid) }}" class="block group w-80">
                                <div
                                    class="bg-white rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden border">

                                    <div class="p-6">
                                        <div class="bg-gray-100 h-56 w-full rounded-lg">
                                            <img src="{{ asset('/product_images/' . $product->pic1) }}"
                                                class="h-56 w-full object-cover rounded-lg">
                                        </div>
                                    </div>

                                    <div class="p-6">
                                        <h3 class="text-xl font-semibold truncate mb-2">
                                            {{ $product->ititle }}
                                        </h3>

                                        <p class="text-sm text-gray-500 mb-3">
                                            {{ Str::limit($product->description, 40) }}
                                        </p>

                                        <p class="text-2xl font-extrabold text-crimson-red-600">
                                            ₹{{ number_format($product->reducedPrice, 2) }}
                                        </p>
                                    </div>

                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>

            </main>

            <section class="bg-white py-12 border-t border-crimson-red-500/20 mx-4 sm:mx-6 lg:mx-8 mt-12 max-w-6xl">
                <div class=" mx-auto px-4 sm:px-6 lg:px-8">
                    <h3 class="text-3xl font-bold text-start text-crimson-red-600 mb-6">
                        WHAT IS ZEEROPRICE
                    </h3>
                    <div class=" mx-auto text-start text-gray-600 leading-relaxed">
                        <p class="mb-4">
                            ZeeroPrice is a New and a Novel way where sellers will be able to sell products online with
                            prices keep reducing whenever and every time any Buyer sees the ZeeroPrice .
                        </p>
                        <p>
                            A Coin/s is added from the Buyer's Wallet to decrease the Product Price equal to the value of
                            Coin/s added , till the product price reaches the seller's undisclosed minimum Price . Buyer can
                            Buy this Product every time they see the product Price in the open for 45 seconds, ZeeroPrice
                            window .

                        </p>
                        <p>
                            Once any Buyer matches the Minimum Price set by the seller , that Product will become Free for
                            this Buyer . Here the Buyer will get Two options.
                        </p>
                        <p>
                            One to Take the Free Product or Second option , To take certain percentage of Coins offered in
                            exchange of the Free Product. These Coins can later be encashed for money within ZeeroPrice.com.
                        </p>
                        <p>
                            This way anyone can generate personal income too by participating in ZeeroPrice.com , whenever
                            their Coin/s match seller's minimum Price and then exchange the FREE PRODUCTS with ZeeroPrice
                            Points .
                        </p>

                    </div>
                    <h3 class="text-3xl font-bold text-start text-crimson-red-600 mb-6">
                        How this Works

                    </h3>
                    <div class=" mx-auto text-start text-gray-600 leading-relaxed">
                        <p class="mb-4">
                            Seller will upload the product page with regular description of product, pics etc . Seller Must
                            add the starting Maximum price he wants to sell the product . This Price will always be
                            displayed price of the Product with a BUY NOW button .

                        </p>
                        <p>
                        <h3 class="text-3xl font-bold text-start text-crimson-red-600 mb-6">
                            Minimum Price of the Product
                        </h3>
                        <div class=" mx-auto text-start text-gray-600 leading-relaxed">
                            <p class="mb-4">
                                Seller must also Add the Minimum Price they are ready to sell. This minimum Price will be
                                hidden in our Software / Website and will only be seen when they Add the required ZeeroPrice
                                Points to see the on going Decreased ZeeroPrice .
                            </p>
                            <p>
                                The hidden ZeeroPrice can be viewed by clicking the VIEW ZEEROPRICE option and by following
                                the instructions given to view ZeeroPrice.
                            </p>
                            <p>
                                The Final Minimum Price is disclosed to the Last Person who view's ZeeroPrice by adding the
                                required Coin/s and by this Coin/s it matches the seller's Minimum Price set when the
                                Product was uploaded .
                            </p>
                            <p>
                                So , instead of buyers Bargaining or sellers offering Discounts etc , etc , the Prices will
                                keep reducing as many times someone views the ZeeroPrice and/ or till anyone Buys that
                                product at the ZEEROPRICE window when open .
                            </p>
                            <p>
                                Coins have to be purchased from our website and Added to Buyer's Wallet to participate in
                                the ZeeroPrice.com website.
                            </p>

                        </div>
                        <p>
                            As of Now , ZeeroPrice Point is Priced Re.0.25 paise each .
                        </p>
                        <p>
                            However , Daily limited FREE DEMO Coins is provided to buyer's Wallet . These Demo Coins will
                            ONLY allow anyone to view the ZeeroPrice window . They can only see what is the Decreased Price
                            of that Product in the ZeeroPrice window open for 45 seconds. Free Demo Coins will Not Decrease
                            the Price nor will be Good for any other features in ZeeroPrice.com .
                        </p>
                        <p>
                            Once someone purchases ZeeroPrice Points , then Daily Free Demo Coins will not be Added in their
                            Wallet anymore and the Buyer is now ready to take part as Paid ZeeroPrice Point person . Their
                            Wallet will now show Only Paid Coins .
                        </p>
                        <p>
                            ZeeroPrice window when opened with Paid ZeeroPrice Coins then only that Person will be able to
                            Buy that Product . Paid Coins are valid to Take other benefits offered in ZeeroPrice.com .
                        </p>
                        <p>
                            Buyers Get offer to Free Products whenever after their added Coin/s the Reduced Price matches
                            the seller's minimum Price, even if this is their first time they Added Coin/s to see ZeeroPrice
                            window .

                        </p>
                        <p>
                            If someone Buys the Product before the Product reaches the minimum Price set by seller then the
                            accumulated ZeeroPrice Points in the Product's Wallet may be distributed as per ZeeroPrice.com
                            administrator's decision. This decision will be shown at the time after the Product is
                            Purchased.
                        </p>
                        <p>
                            This distribution will happen after the Transaction between the Seller and Buyer is over . This
                            ZeeroPrice Points distribution may be considered as extra rewards for Completing the Transaction
                            and would be added in their individual wallet .
                        </p>
                        <p>
                            Please Note.
                            Our Administrator's Descion is Final incase any matter arises due to this website or any
                            Transaction/s .
                        </p>
                        <p>
                            Our Goal is to bring Buyers, Sellers and others on ZeeroPrice.com and to fix the Prices of the
                            Products between them . All other formalities like Deliveries , Payments , exchanges or any
                            other items , would be strictly between Buyers and Sellers.
                        </p>
                        <p>
                            ZeeroPrice.com is a Marketplace to make Buyers and Sellers meet and Decide the Price .
                        </p>
                        <p>
                            However we assure action will be taken against those who do Not follow ZeeroPrice.com guidelines
                            honestly.
                        </p>
                        <p>
                            Buyers , Sellers and others should Register their complaints here in ZeeroPrice.com.
                        </p>

                    </div>
                </div>
            </section>

        </div>


    </div>
    @include('components.footer')
@endsection

@section('script')
    <script src="{{ url('/assests/js/home.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function checkAdSlots(e) {
            let slotCount = {{ $slotCount }};

            if (slotCount >= 4) {
                e.preventDefault();

                // Show warning message
                let warning = document.getElementById('slotWarning');
                warning.classList.remove('hidden');

                // Scroll to message (optional but nice)
                warning.scrollIntoView({
                    behavior: 'smooth'
                });

                return false;
            }

            return true;
        }

        // Ads Carousel script
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.getElementById('ad-carousel-track');
            const slides = document.querySelectorAll('.ad-slide');
            const dots = document.querySelectorAll('.ad-dot');
            const prevBtn = document.getElementById('prev-ad');
            const nextBtn = document.getElementById('next-ad');
            const carousel = document.getElementById('ad-carousel');
            
            if (!track || slides.length === 0) return;
            
            let currentIndex = 0;
            let autoPlayInterval;
            const intervalTime = 5000; // 5 seconds
            
            function updateCarousel() {
                // Slide track
                track.style.transform = `translateX(-${currentIndex * 100}%)`;
                
                // Update dots
                dots.forEach((dot, index) => {
                    if (index === currentIndex) {
                        dot.classList.remove('bg-white/50', 'w-2');
                        dot.classList.add('bg-white', 'w-5');
                    } else {
                        dot.classList.remove('bg-white', 'w-5');
                        dot.classList.add('bg-white/50', 'w-2');
                    }
                });
            }
            
            function nextSlide() {
                if (slides.length <= 1) return;
                currentIndex = (currentIndex + 1) % slides.length;
                updateCarousel();
            }
            
            function prevSlide() {
                if (slides.length <= 1) return;
                currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                updateCarousel();
            }
            
            function startAutoPlay() {
                if (slides.length <= 1) return;
                stopAutoPlay();
                autoPlayInterval = setInterval(nextSlide, intervalTime);
            }
            
            function stopAutoPlay() {
                if (autoPlayInterval) {
                    clearInterval(autoPlayInterval);
                }
            }
            
            // Event Listeners
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    nextSlide();
                    startAutoPlay(); // Reset interval
                });
            }
            
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    prevSlide();
                    startAutoPlay(); // Reset interval
                });
            }
            
            dots.forEach(dot => {
                dot.addEventListener('click', (e) => {
                    currentIndex = parseInt(e.currentTarget.getAttribute('data-slide'));
                    updateCarousel();
                    startAutoPlay(); // Reset interval
                });
            });
            
            if (carousel) {
                carousel.addEventListener('mouseenter', stopAutoPlay);
                carousel.addEventListener('mouseleave', startAutoPlay);
            }
            
            // Initialize
            updateCarousel();
            startAutoPlay();
        });
    </script>
@endsection
