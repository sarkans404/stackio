@extends('layouts.app')

@section('title', 'Inbox')

@section('content')
    <section class="main-content translate-x-0 max-w-5xl h-max mx-auto my-10">
        <div class="flex items-center justify-between mb-8">
            <h2 class="font-semibold text-3xl">Notifications</h2>
            <a href=""
                class="font-medium text-lg hover:text-neutral-500 underline-offset-3 underline dark:hover:text-neutral-400 duration-300">Mark
                all as read</a>
        </div>
        <div class="flex flex-col gap-4">
            <div class="w-full h-40 dark:bg-neutral-900 bg-gray-200 rounded-2xl"></div>
        </div>
    </section>
@endsection
