@extends('layout.app')

@section('title', 'Processing Payment')

@section('content')
@include('components.header')

<div class="flex max-w-1980 mx-auto">
    @include('components.sidenavbar')

    <div class="flex-grow flex items-center justify-center min-h-[60vh] px-4">

        <div class="bg-white p-8 rounded-2xl shadow-2xl text-center max-w-md w-full">

            <svg class="w-16 h-16 text-green-600 mx-auto mb-4 animate-spin"
                fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke-opacity="0.25" />
                <path d="M12 2a10 10 0 0110 10" />
            </svg>

            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Processing Payment
            </h2>

            <p class="text-gray-500 mb-6">
                Please wait... Do not refresh or press back.
            </p>

            <input type="hidden" id="paymentSessionId" value="{{ $paymentSessionId }}">

        </div>
    </div>
</div>

@include('components.footer')
@endsection

@section('script')
<script src="https://sdk.cashfree.com/js/ui/2.0.0/cashfree.sandbox.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentSessionId = document.getElementById('paymentSessionId').value;

        if (!paymentSessionId) {
            alert('Payment session not found');
            return;
        }

        const cf = new Cashfree(paymentSessionId);
        cf.redirect();
    });
</script>
@endsection
