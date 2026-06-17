@extends('layout.app')

@section('title', 'Ad Analytics')

@section('content')

    <div class="max-w-5xl mx-auto p-6">

        {{-- HEADER --}}
        <h2 class="text-2xl font-bold mb-6">
            📊 Analytics: {{ $ad->title }}
        </h2>

        {{-- 📊 ENGAGEMENT SUMMARY --}}
        <h3 class="text-xl font-bold mb-4">📊 Engagement</h3>

        <div class="grid grid-cols-4 gap-4 mb-6">

            <div class="bg-blue-100 p-4 rounded text-center">
                👍 <span class="font-bold">{{ $likes }}</span>
            </div>

            <div class="bg-green-100 p-4 rounded text-center">
                📘 Facebook <span class="font-bold">{{ $facebookShares }}</span>
            </div>

            <div class="bg-green-200 p-4 rounded text-center">
                📱 WhatsApp <span class="font-bold">{{ $whatsappShares }}</span>
            </div>

            <div class="bg-purple-100 p-4 rounded text-center">
                💬 <span class="font-bold">{{ $comments }}</span>
            </div>

        </div>

        <hr class="my-4">

        {{-- 👥 USER ACTIVITY --}}
        <h3 class="font-bold mb-3 text-lg">👥 User Activity</h3>

        <div class="bg-white rounded shadow">

            @forelse ($ad->tasks->sortByDesc('created_at') as $task)

                <div class="border-b py-3 px-3 flex justify-between items-center">

                    <div>

                        {{-- USER NAME --}}
                        <strong>
                            {{ $task->user->name ?? 'User' }}
                        </strong>

                        →

                        {{-- TASK TYPE --}}
                        <span class="font-medium">
                            {{ ucfirst($task->task_type) }}
                        </span>

                        {{-- PLATFORM DETECTION (NO DB CHANGE) --}}
                        @if ($task->task_type == 'share')
                            @php
                                $details = strtolower($task->task_details);
                            @endphp

                            @if (str_contains($details, 'facebook'))
                                <span class="text-blue-600">(📘 Facebook)</span>
                            @elseif (str_contains($details, 'whatsapp'))
                                <span class="text-green-600">(📱 WhatsApp)</span>
                            @else
                                <span class="text-gray-500">(Unknown)</span>
                            @endif
                        @endif

                        {{-- COMMENT TEXT --}}
                        @if ($task->task_type == 'comment' && $task->comment_text)
                            <div class="text-sm text-gray-600 mt-1">
                                💬 "{{ $task->comment_text }}"
                            </div>
                        @endif

                    </div>

                    {{-- TIME --}}
                    <div class="text-sm text-gray-500">
                        {{ $task->created_at->diffForHumans() }}
                    </div>

                </div>

            @empty

                <div class="p-4 text-center text-gray-500">
                    No activity yet
                </div>

            @endforelse

        </div>

        {{-- BACK --}}
        <div class="mt-6">
            <a href="{{ route('ads.index') }}" class="text-gray-600 hover:underline">
                ← Back to Ads
            </a>
        </div>

    </div>

@endsection
