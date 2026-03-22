@extends('layouts.app')

@section('title', 'Inbox')

@section('content')
    <section class="main-content translate-x-0 max-w-5xl h-max mx-auto my-10">
        <div class="flex items-center justify-between mb-8">
            <h2 class="font-semibold text-3xl">Notifications</h2>
            <a href="{{ route('notification.read.all') }}"
                class="font-medium text-lg hover:text-neutral-500 underline-offset-3 underline dark:hover:text-neutral-400 duration-300">Mark
                all as read</a>
        </div>
        <div class="flex flex-col gap-5 w-1/2 mx-auto my-10">
            @foreach ($notifications as $n)
                @if ($n->type === 'new_response')
                    <div class="w-full py-6 px-2 dark:bg-neutral-900 bg-gray-200 rounded-2xl text-center">
                        <a href="{{ route('user.profile', $n->actor->id) }}"
                            class="underline underline-offset-2 hover:opacity-70">{{ $n->actor->username }}</a> answered a
                        <a href="{{ route('question.show', $n->notifiable->question_id) }}"
                            class="underline underline-offset-2 hover:opacity-70">question</a>
                    </div>
                @endif

                @if ($n->type === 'new_comment')
                    <div class="w-full py-6 px-2 dark:bg-neutral-900 bg-gray-200 rounded-2xl text-center">
                        <a href="{{ route('user.profile', $n->actor->id) }}"
                            class="underline underline-offset-2 hover:opacity-70">{{ $n->actor->username }}</a> replied to
                        your response
                    </div>
                @endif

                @if ($n->type === 'response_banned')
                    <div class="w-full py-6 px-2 dark:bg-neutral-900 bg-gray-200 rounded-2xl text-center">
                        Your response was banned
                    </div>
                @endif

                @if ($n->type === 'question_reported')
                    <div class="w-full py-6 px-2 dark:bg-neutral-900 bg-gray-200 rounded-2xl text-center">
                        Your <a href="{{ route('question.show', $n->notifiable->question_id) }}"
                            class="underline underline-offset-2 hover:opacity-70">question</a> was reported
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endsection
