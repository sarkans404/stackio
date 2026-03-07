@extends('layouts.app')

@section('title')
    {{ $user['name'] }}
@endsection

@section('content')
    <x-main-user :user="$user">
        <div>
            <div class="flex items-center gap-4 mb-5">
                <span class="py-2 px-4 dark:bg-neutral-600 bg-gray-300 dark:text-neutral-100 font-medium rounded-lg">0
                    answers</span>
                <span class="py-2 px-4 dark:bg-neutral-600 bg-gray-300 dark:text-neutral-100 font-medium rounded-lg">0
                    questions</span>
                <span class="py-2 px-4 dark:bg-neutral-600 bg-gray-300 dark:text-neutral-100 font-medium rounded-lg">0
                    upvotes</span>
                <span class="py-2 px-4 dark:bg-neutral-600 bg-gray-300 dark:text-neutral-100 font-medium rounded-lg">0
                    downvotes</span>
            </div>
            <div>
                <h2 class="font-semibold text-3xl mb-2">About</h2>
                <p class="dark:text-neutral-100 text-neutral-700">about me information</p>
            </div>
        </div>
    </x-main-user>
@endsection
