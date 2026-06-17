@extends('layout.app')

@section('title', 'Whizzact | Job list')

@section('style')
<style>
    #price-window-container {
   
  
}

/* hidden content underneath */
#revealed-box {
    opacity: 1;
    transition: opacity 0.7s ease;
    background: #fff9dc;
    border-radius: 12px;
    border: 2px solid #ffd872;
    padding: 16px;
    position: relative;
}

/* initial cover card */
.initial-price-box {
    background: #ffca5e;
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 5;
    transition: width 0.9s ease-in-out;
    overflow: hidden;
    white-space: nowrap;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.initial-price-box .text {
    font-weight: 800;
    font-size: 1.4rem;
}

.initial-price-box .subtitle {
    font-size: 0.8rem;
}

/* curtain opening animation */
.initial-price-box.shrink {
    width: 0;
    padding-left: 0;
    padding-right: 0;
}

/* reveal fade animation */


.countdown-bar {
    background: #d9463f;
    color: white;
    margin-top: 12px;
    padding: 8px;
    display: flex;
    justify-content: space-between;

    align-items: center;
    font-size: 0.85rem;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 3;
    transition: opacity 0.5s ease;
}

/* Content visible after removing cover */
#revealed-content {
    opacity: 0;
    transition: opacity 0.5s ease;
}

#revealed-content.visible {
    opacity: 1;
}
</style>
@endsection


@section('content')
@include('components.header')

<div class="flex max-w-1980 mx-auto">
    @include('components.sidenavbar')

    <div id="main-content" class="flex-grow pt-4 pb-12 px-4">
        <div class="max-w-6xl mx-auto">
            
            <h2 class="text-3xl font-extrabold text-gray-900 mb-8 border-b pb-4 border-crimson-red-500/50">
                {{ $product->ititle }}
            </h2>

            <div class="bg-white p-8 rounded-xl shadow-2xl grid grid-cols-1 lg:grid-cols-5 gap-6">

                {{-- LEFT CONTENT --}}
                <div class="lg:col-span-3 space-y-6">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-lg overflow-hidden border">
                        <img src="{{ asset('/product_images/' . $product->pic1) }}" class="w-full h-full object-cover">
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 border-b pb-2">Product Description</h3>
                    <p class="text-gray-600">{{ $product->description }}</p>

                    <div class="bg-white border border-gray-300 p-6 rounded-lg shadow-md text-center">
                        <h4 class="text-xl font-semibold text-gray-800 mb-2">Supporting India's Future</h4>
                        <p class="text-sm text-gray-500">Empowering Through Education</p>
                    </div>
                </div>

                {{-- RIGHT CONTENT --}}
                <div class="space-y-6 lg:col-span-2">

                    <div class="p-6 bg-red-50 rounded-lg border border-crimson-red-500/50">
                        <p class="text-lg text-gray-600">Seller's Price</p>
                        <p class="text-4xl font-extrabold text-crimson-red-600">₹ {{ $product->mrp }}</p>
                    </div>

                    {{-- BUTTON --}}
                    {{-- <button id="open-price-window" class="bg-blue-600 text-white px-4 py-2 rounded w-full">
                        Open ZeeroPrice Window
                    </button> --}}

                    {{-- PRICE WINDOW (curtain + content) --}}
                    {{-- PRICE WINDOW (curtain + content) --}}
<div id="price-window-container" class="relative h-64 mt-4 w-full">
    {{-- CURTAIN COVER --}}
    <div id="initial-box" class="initial-price-box h-[172px]">
        <div class="zeero-logo-content"> 
   
            <p class="text">ZEERO</p>
            <p class="subtitle">Special ZEEEROPRICE inside</p>
        </div>
    </div>

    {{-- CONTENT REVEAL --}}
    <div id="revealed-box" class="h-[172px]">
        <div>
            <p class="text-2xl font-semibold text-gray-700 ">
                Rs.<span id="price">{{ $product->reducedPrice }}</span>
            </p>
            <p class="price text-sm mt-1">
                {{-- To buy at Rs.<span class="" id="revealed-price-main">{{ $product->reducedPrice }}</span>, --}}
                You must use PAID ZEEEROPRICE GOLD COINS
            </p>
        </div>

        {{-- RED COUNTDOWN COVER --}}
        <div id="countdown-cover" class="countdown-bar mt-32 h-10 bottom-0 cursor-pointer rounded-b-[10px]">
            <span>ZeeroPrice window closes in <span id="countdown-timer">59</span> sec</span>
            <button class="text-white hover:text-red-300 font-semibold text-xs">X Close Now</button>
        </div>
    </div>
</div>

<div id="window-open-message"
     class="hidden text-lg text-red-600 mt-2">
    Price window is already open. Please close it to continue.
</div>
                    <div class="grid grid-cols-2">
                
                        <div class="w-48 p-4 shadow text-center " id="open-price-window-api1" data-api="api1" data-user-id="{{ $product->pid}}">

                            <div class="w-28 h-28 rounded-full m-auto relative">
                                <img src="{{ asset('assets/silvercoin.png') }}" class="w-full h-full object-contain rounded-full absolute z-50  " alt="Gold Coin" loading="lazy">
                                <div class="absolute z-50 w-full h-full flex justify-center items-center text-2xl font-bold text-gray-500" id="freepoints" >{{ $freepoint->points ?? 0 }} </div>
                            </div> 
                                <h3 class="text-xs font-bold uppercase mt-2">Paid Zeeroprice gold coin.</h3>
                                <p class="text-xs mt-1">To view current reduced ZeeroPrice You can order the product at show ZeroPrice.</p>
                            </div>
                        <div class="w-48 p-4 shadow text-center " id="open-price-window-api2" data-api="api2" data-product-id="{{ $product->pid}}">

                           <div class="w-28 h-28 rounded-full m-auto relative">
                                <img src="{{ asset('assets/goldcoin.png') }}" class="w-full h-full object-contain rounded-full absolute z-50  " alt="Gold Coin" loading="lazy">
                                <div class="absolute z-50 w-full h-full flex justify-center items-center text-3xl font-bold " id="goldpoint" >{{ auth()->user()->points }} </div>
                            </div> 
                                <h3 class="text-xs font-bold uppercase mt-2">Paid Zeeroprice gold coin.</h3>
                                <p class="text-xs mt-1">To view current reduced ZeeroPrice You can order the product at show ZeroPrice.</p>
                            </div>
                      
                        </div>

                        
                    </div>
                    <p class="text-center text-sm text-gray-500 mt-2">
                        Spend 1 COIN to view ZeeroPrice.
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

@include('components.footer')
@endsection



@section('script')
<script>
/* ================= DOM ELEMENTS ================= */
const priceWindow = document.getElementById('price-window-container');
const curtain = document.getElementById('initial-box');
const revealedBox = document.getElementById('revealed-box');
const countdownCover = document.getElementById('countdown-cover');
const revealedContent = document.getElementById('revealed-content');

const btnApi1 = document.getElementById('open-price-window-api1');
const btnApi2 = document.getElementById('open-price-window-api2');
const openMessage = document.getElementById('window-open-message');

/* ================= STATE ================= */
let countdown = null;
let isWindowOpen = false;

/* ================= BUTTON LISTENERS ================= */
btnApi1.addEventListener('click', (e) => {
    handleButtonClick(e.currentTarget, 'api1');
});

btnApi2.addEventListener('click', (e) => {
    handleButtonClick(e.currentTarget, 'api2');
});

/* ================= CORE FLOW ================= */
function handleButtonClick(element, apiType) {
    if (isWindowOpen) {
        showWindowOpenMessage();
        return;
    }

    // ✅ READ CORRECT DATA ATTRIBUTE
    const productId = element.dataset.productId;

    if (!productId) {
        alert('Product ID missing');
        return;
    }

    console.log('Button clicked → Product ID:', productId);

    openZeeroPriceWindow(apiType, productId);
}

function openZeeroPriceWindow(apiType, productId) {
    isWindowOpen = true;
    disableButtons();
    hideWindowOpenMessage();

    /* OPEN UI */
    priceWindow.classList.remove('hidden');
    curtain.classList.add('shrink');

    /* HIT LARAVEL */
    if (apiType === 'api2') {
        goldcoin(productId);
    } else {
        hitSecondAPI(productId);
    }

    /* SHOW CONTENT + START TIMER */
    setTimeout(() => {
        revealedBox.classList.add('visible');
        startCountdown();
    }, 900);
}

/* ================= API CALLS ================= */
function goldcoin(productId) {

    fetch(`/price-window-gold/${productId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        },
        credentials: 'same-origin'
    })
    .then(async res => {
        const data = await res.json();

        if (!res.ok) {
            throw new Error(data.message || 'Goldcoin API error');
        }

        return data;
    })
    .then(data => {
        // console.log('Laravel Response:', data);
        // alert(data.message);
    })
    .catch(err => {
        console.error('Goldcoin API error:', err.message);
        alert(err.message);
    });
    refreshProduct(productId);
}
function refreshProduct(productId) {
    fetch(`/productdetail/${productId}`, {
        headers: { 'Accept': 'application/json' }
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('price').innerText =  data.product.reducedPrice;
        document.getElementById('freepoints').innerText =  data.freepoint.points;
        document.getElementById('goldpoint').innerText =  data.userpoint;
    });
}
function hitSecondAPI(productId) {
    fetch('/api/price-window-two', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(res => res.json())
    .then(() => alert('API 2 Success'))
    .catch(() => alert('API 2 error'));
}

/* ================= TIMER ================= */
function startCountdown() {
    let time = 60;
    document.getElementById('countdown-timer').textContent = time;

    if (countdown) clearInterval(countdown);

    countdown = setInterval(() => {
        time--;
        document.getElementById('countdown-timer').textContent = time;

        if (time <= 0) {
            // alert('⏰ Time up! Closing window.');
            curtainComeBack();
        }
    }, 1000);
}

/* ================= RESET ================= */
function curtainComeBack() {
    clearInterval(countdown);
    countdown = null;

    curtain.classList.remove('shrink');
    revealedBox.classList.remove('visible');

    countdownCover.style.display = 'flex';
    countdownCover.style.opacity = '1';

    revealedContent?.classList.remove('visible');
    document.getElementById('countdown-timer').textContent = '60';

    isWindowOpen = false;
    enableButtons();
    hideWindowOpenMessage();
}

/* ================= UI HELPERS ================= */
function showWindowOpenMessage() {
    openMessage.classList.remove('hidden');
    openMessage.classList.add('animate-pulse');

    setTimeout(() => {
        openMessage.classList.remove('animate-pulse');
    }, 1500);
}

function hideWindowOpenMessage() {
    openMessage.classList.add('hidden');
}

function disableButtons() {
    btnApi1.disabled = true;
    btnApi2.disabled = true;
    btnApi1.classList.add('opacity-50', 'cursor-not-allowed');
    btnApi2.classList.add('opacity-50', 'cursor-not-allowed');
}

function enableButtons() {
    btnApi1.disabled = false;
    btnApi2.disabled = false;
    btnApi1.classList.remove('opacity-50', 'cursor-not-allowed');
    btnApi2.classList.remove('opacity-50', 'cursor-not-allowed');
}

/* MANUAL CLOSE BUTTON */
countdownCover.querySelector('button').addEventListener('click', (e) => {
    e.stopPropagation();
    curtainComeBack();
});
</script>





@endsection
