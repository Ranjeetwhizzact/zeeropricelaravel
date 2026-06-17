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
                        <select id="sort" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-crimson-red-500">
                            <option>Best Selling</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest</option>
                        </select>

                        <button class="text-gray-500 hover:text-crimson-red-500 transition duration-150 p-2 rounded-full hover:bg-red-50">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zM3 13h4v4H3v-4zM3 3h4v4H3V3zm10 0h4v4h-4V3zm0 10h4v4h-4v-4z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <main class="px-4 sm:px-6 lg:px-8 py-8">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-8">
                    
@foreach($products as $product)
<a href="{{ url('productdetail/' . $product->pid) }}" class="block group w-80">
    <div class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-500 overflow-hidden transform hover:-translate-y-0.5 border border-gray-100">
        <div class="relative overflow-hidden p-6">
            <div class="bg-gray-100 h-56 w-full rounded-lg flex items-center justify-center">
                <img src="{{ asset('/product_images/' . $product->pic1) }}"
                     alt="{{ $product->ititle }}"
                     class="h-56 w-full object-cover rounded-lg">
            </div>

            @if($loop->first)
                <span class="absolute top-4 right-4 text-xs font-bold px-3 py-1 bg-crimson-red-500 text-white rounded-full">HOT</span>
            @endif
        </div>

        <div class="p-6 ">
            <h3 class="text-xl font-semibold truncate mb-2">{{ $product->ititle }}</h3>

            {{-- Short Description --}}
            <p class="text-sm text-gray-500 truncate mb-3">
                {{ Str::limit($product->description, 40) }}
            </p>

            <p class="text-2xl font-extrabold text-crimson-red-600">
                ₹{{ number_format($product->reducedPrice, 2) }}
            </p>
        </div>
    </div>
</a>
@endforeach


                    {{-- <div class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-500 overflow-hidden transform hover:-translate-y-0.5 border border-gray-100">
                        <div class="relative overflow-hidden p-6">
                            <div class="bg-gray-100 h-56 w-full rounded-lg flex items-center justify-center">
                                <span class="text-gray-400">Product Image</span>
                            </div>
                            <span class="absolute top-4 right-4 text-xs font-bold px-3 py-1 bg-crimson-red-500 text-white rounded-full">HOT</span>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-semibold truncate mb-3">ZeroPriceTee</h3>
                            <p class="text-2xl font-extrabold text-crimson-red-600">$29.50</p>
                            <button class="mt-5 w-full py-3 bg-crimson-red-500 text-white rounded-lg font-semibold hover:bg-crimson-red-600 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    <div class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-500 overflow-hidden transform hover:-translate-y-0.5 border border-gray-100">
                        <div class="relative overflow-hidden p-6">
                            <div class="bg-gray-100 h-56 w-full rounded-lg flex items-center justify-center">
                                <span class="text-gray-400">Product Image</span>
                            </div>
                            <span class="absolute top-4 right-4 text-xs font-bold px-3 py-1 bg-crimson-red-500 text-white rounded-full">NEW</span>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-semibold truncate mb-3">Scarlet Scarf</h3>
                            <p class="text-2xl font-extrabold text-crimson-red-600">$19.00</p>
                            <button class="mt-5 w-full py-3 bg-crimson-red-500 text-white rounded-lg font-semibold hover:bg-crimson-red-600 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div> --}}
                    </div>
                
            </main>

            <section class="bg-white py-12 border-t border-crimson-red-500/20 mx-4 sm:mx-6 lg:mx-8 mt-12 max-w-6xl">
                <div class=" mx-auto px-4 sm:px-6 lg:px-8">
                    <h3 class="text-3xl font-bold text-start text-crimson-red-600 mb-6">
                       WHAT IS ZEEROPRICE
                    </h3>
                    <div class=" mx-auto text-start text-gray-600 leading-relaxed">
                        <p class="mb-4">
                          ZeeroPrice is a New and a Novel way where sellers will be able to sell products online with prices keep reducing whenever and every time any Buyer sees the ZeeroPrice .
                        </p>
                        <p>
                           A Coin/s is added from the Buyer's Wallet to decrease the Product Price equal to the value of Coin/s added , till the product price reaches the seller's undisclosed minimum Price . Buyer can Buy this Product every time they see the product Price in the open for 45 seconds, ZeeroPrice window .

                        </p>
                        <p>
                          Once any Buyer matches the Minimum Price set by the seller , that Product will become Free for this Buyer . Here the Buyer will get Two options.
                        </p>
                        <p>
                          One to Take the Free Product or Second option , To take certain percentage of Coins offered in exchange of the Free Product. These Coins can later be encashed for money within ZeeroPrice.com.
                        </p>
                        <p>
                         This way anyone can generate personal income too by participating in ZeeroPrice.com , whenever their Coin/s match seller's minimum Price and then exchange the FREE PRODUCTS with ZeeroPrice Points .
                        </p>
                        
                    </div>
                      <h3 class="text-3xl font-bold text-start text-crimson-red-600 mb-6">
                    How this Works

                    </h3>
                    <div class=" mx-auto text-start text-gray-600 leading-relaxed">
                        <p class="mb-4">
                       Seller will upload the product page with regular description of product, pics etc . Seller Must add the starting Maximum price he wants to sell the product . This Price will always be displayed price of the Product with a BUY NOW button .

                        </p>
                        <p>
                          <h3 class="text-3xl font-bold text-start text-crimson-red-600 mb-6">
                      Minimum Price of the Product
                    </h3>
                    <div class=" mx-auto text-start text-gray-600 leading-relaxed">
                        <p class="mb-4">
                       Seller must also Add the Minimum Price they are ready to sell. This minimum Price will be hidden in our Software / Website and will only be seen when they Add the required ZeeroPrice Points to see the on going Decreased ZeeroPrice .
                        </p>
                        <p>
                        The hidden ZeeroPrice can be viewed by clicking the VIEW ZEEROPRICE option and by following the instructions given to view ZeeroPrice.
                        </p>
                        <p>
                        The Final Minimum Price is disclosed to the Last Person who view's ZeeroPrice by adding the required Coin/s and by this Coin/s it matches the seller's Minimum Price set when the Product was uploaded .
                        </p>
                        <p>
                         So , instead of buyers Bargaining or sellers offering Discounts etc , etc , the Prices will keep reducing as many times someone views the ZeeroPrice and/ or till anyone Buys that product at the ZEEROPRICE window when open .
                        </p>
                        <p>
                        Coins have to be purchased from our website and Added to Buyer's Wallet to participate in the ZeeroPrice.com website.
                        </p>
                        
                    </div>
                    <p>
                        As of Now , ZeeroPrice Point is Priced Re.0.25 paise each .
                        </p>
                        <p>
                        However , Daily limited FREE DEMO Coins is provided to buyer's Wallet . These Demo Coins will ONLY allow anyone to view the ZeeroPrice window . They can only see what is the Decreased Price of that Product in the ZeeroPrice window open for 45 seconds. Free Demo Coins will Not Decrease the Price nor will be Good for any other features in ZeeroPrice.com .
                        </p>
                        <p>
                        Once someone purchases ZeeroPrice Points , then Daily Free Demo Coins will not be Added in their Wallet anymore and the Buyer is now ready to take part as Paid ZeeroPrice Point person . Their Wallet will now show Only Paid Coins .
                        </p>
                        <p>
                        ZeeroPrice window when opened with Paid ZeeroPrice Coins then only that Person will be able to Buy that Product . Paid Coins are valid to Take other benefits offered in ZeeroPrice.com .
                        </p>
                        <p>
                        Buyers Get offer to Free Products whenever after their added Coin/s the Reduced Price matches the seller's minimum Price, even if this is their first time they Added Coin/s to see ZeeroPrice window .

                        </p>
                        <p>
                       If someone Buys the Product before the Product reaches the minimum Price set by seller then the accumulated ZeeroPrice Points in the Product's Wallet may be distributed as per ZeeroPrice.com administrator's decision. This decision will be shown at the time after the Product is Purchased.
                        </p>
                        <p>
                        This distribution will happen after the Transaction between the Seller and Buyer is over . This ZeeroPrice Points distribution may be considered as extra rewards for Completing the Transaction and would be added in their individual wallet .
                        </p>
                        <p>
                        Please Note.
Our Administrator's Descion is Final incase any matter arises due to this website or any Transaction/s .
                        </p>
                        <p>
                       Our Goal is to bring Buyers, Sellers and others on ZeeroPrice.com and to fix the Prices of the Products between them . All other formalities like Deliveries , Payments , exchanges or any other items , would be strictly between Buyers and Sellers.
                        </p>
                        <p>
                        ZeeroPrice.com is a Marketplace to make Buyers and Sellers meet and Decide the Price .
                        </p>
                        <p>
                       However we assure action will be taken against those who do Not follow ZeeroPrice.com guidelines honestly.
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
@endsection
