@extends('layout.app')

@section('title', 'Watch Ad')

@section('content')

    <div class="flex justify-center items-center min-h-screen bg-gray-100">

        <div class="bg-white p-6 rounded-lg w-[400px] text-center shadow">

            {{-- ✅ Messages --}}
            @if (session('error'))
                <div class="bg-red-100 text-red-600 p-2 mb-2 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 text-green-600 p-2 mb-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ✅ Ad Content --}}
            @if ($ad->media_type == 'video')
                <video width="100%" autoplay muted>
                    <source src="{{ asset($ad->media_url) }}" type="video/mp4">
                </video>
            @else
                <img src="{{ asset($ad->media_url) }}" class="w-full rounded">
            @endif

            {{-- ✅ Timer --}}
            <p id="timerText" class="mt-3 text-sm text-gray-500">
                Ad ends in 30s
            </p>

            {{-- ✅ FORM --}}
            <form id="actionForm" action="{{ route('ads.completeTask') }}" method="POST">
                @csrf

                <input type="hidden" name="slot_id" value="{{ $slot->id }}">
                <input type="hidden" name="action" id="actionInput">
                <input type="hidden" name="platform" id="platformInput"> {{-- 🔥 FIX --}}
                <input type="hidden" name="comment_text" id="commentText">

                {{-- ✅ Actions --}}
                <div id="actions" class="hidden mt-4 space-y-2">

                    {{-- 👍 LIKE --}}
                    <button type="button" onclick="submitAction('like')"
                        class="bg-blue-500 text-white px-3 py-2 rounded w-full">
                        👍 Like
                    </button>

                    {{-- 🔄 SHARE --}}
                    <button type="button" onclick="showShareOptions()"
                        class="bg-green-500 text-white px-3 py-2 rounded w-full">
                        🔄 Share
                    </button>

                    {{-- 📱 SHARE OPTIONS --}}
                    <div id="shareOptions" class="hidden space-y-2">

                        <button type="button" onclick="shareAd('whatsapp')"
                            class="w-full bg-green-600 text-white px-3 py-2 rounded">
                            📱 Share on WhatsApp
                        </button>

                        <button type="button" onclick="shareAd('facebook')"
                            class="w-full bg-blue-700 text-white px-3 py-2 rounded">
                            📘 Share on Facebook
                        </button>

                    </div>

                    {{-- 💬 COMMENT --}}
                    <div class="text-left">
                        <select id="commentSelect" class="w-full border rounded px-2 py-2 text-sm">
                            <option value="">-- Select a Comment --</option>

                            <option>Don’t wait—this deal won’t last!</option>
                            <option>Grab it now before it’s gone.</option>
                            <option>Stocks won’t last long—act fast!</option>
                            <option>Limited deal—just go for it!</option>
                            <option>You’ll regret missing this one.</option>
                            <option>Best time to buy is NOW.</option>
                            <option>Selling fast—don’t think too much.</option>
                            <option>Offer like this doesn’t come again.</option>
                            <option>Hurry up, worth grabbing instantly.</option>
                            <option>Click buy before price goes up!</option>
                        </select>

                        <button type="button" onclick="submitComment()"
                            class="bg-purple-500 text-white px-3 py-2 rounded w-full mt-2">
                            💬 Submit Comment
                        </button>
                    </div>

                </div>
            </form>

        </div>

    </div>

    {{-- ✅ SCRIPT --}}
    <script>
        let timeLeft = 30;

        let timer = setInterval(() => {
            timeLeft--;

            document.getElementById('timerText').innerText = `Ad ends in ${timeLeft}s`;

            if (timeLeft <= 0) {
                clearInterval(timer);
                document.getElementById('actions').classList.remove('hidden');
                document.getElementById('timerText').innerText = "Now interact to earn reward 🎉";
            }
        }, 1000);

        // ✅ LIKE
        function submitAction(action) {
            document.getElementById('actionInput').value = action;

            document.getElementById('actionForm').submit();

            // redirect fallback
            setTimeout(() => {
                window.location.href = "{{ route('ads.dash') }}";
            }, 1500);
        }

        // ✅ SHOW SHARE OPTIONS
        function showShareOptions() {
            document.getElementById('shareOptions').classList.remove('hidden');
        }

        // ✅ SHARE
        function shareAd(platform) {

            let adUrl = "{{ url('/productdetail/' . $ad->product_id) }}";
            let text = "🔥 Check out this amazing deal!";

            let shareLink = '';

            if (platform === 'whatsapp') {
                shareLink = `https://wa.me/?text=${encodeURIComponent(text + ' ' + adUrl)}`;
            }

            if (platform === 'facebook') {
                shareLink = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(adUrl)}`;
            }

            window.open(shareLink, '_blank');

            setTimeout(() => {
                document.getElementById('actionInput').value = 'share';
                document.getElementById('platformInput').value = platform; // ✅ FIX

                document.getElementById('actionForm').submit();

                // redirect fallback
                setTimeout(() => {
                    window.location.href = "{{ route('ads.dash') }}";
                }, 1500);

            }, 1500);
        }

        // ✅ COMMENT
        function submitComment() {
            let comment = document.getElementById('commentSelect').value;

            if (!comment) {
                alert("Please select a comment");
                return;
            }

            document.getElementById('actionInput').value = 'comment';
            document.getElementById('commentText').value = comment;

            document.getElementById('actionForm').submit();

            setTimeout(() => {
                window.location.href = "{{ route('ads.dash') }}";
            }, 1500);
        }
    </script>

@endsection
