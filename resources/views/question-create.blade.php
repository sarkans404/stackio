@extends('layouts.app')

@section('title', 'New Question')

@section('content')
    <section class="main-content max-w-150 translate-x-0 mx-auto my-15 duration-300">
        <h2 class="font-semibold dark:text-gray-200 mb-6 text-3xl">Create post</h2>
        <form action="{{ route('question.create') }}" method="post" class="w-full rounded-3xl">
            @csrf
            <div class="mb-8">
                <div class="relative">
                    <input type="text" name="title" id="title" placeholder=" " value="{{ old('title') }}"
                        class="border text-lg px-5 pt-5 pb-3 dark:border-neutral-600 focus:border-neutral-300 dark:focus:border-neutral-500 duration-300 border-neutral-400 w-full rounded-2xl outline-none">
                    <label for="title"
                        class="label-animation dark:text-neutral-500 absolute top-1/2 -translate-y-1/2 left-5 select-none cursor-text touch-none text-lg duration-300">Title<span
                            class="text-red-500">*</span></label>
                </div>
                @error('title')
                    <span class="font-medium text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <textarea name="text" id="text" placeholder="Place here detalies(optional)"
                class="mb-8 border min-h-30 p-4 dark:border-neutral-600 focus:border-neutral-300 dark:focus:border-neutral-500 border-neutral-400 w-full rounded-2xl outline-none">{{ old('text') }}</textarea>
            @error('text')
                <span class="font-medium text-red-500">{{ $message }}</span>
            @enderror

            <input list="tags" type="text" name="tag" id="tag" placeholder="Add tags"
                value="{{ old('tag') }}"
                class="mb-4 border p-4 dark:border-neutral-600 focus:border-neutral-300 dark:focus:border-neutral-500 duration-300 border-neutral-400 w-full rounded-2xl outline-none">
            @if ($tags)
                <datalist id="tags" placeholder="e.g. js, html">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->slug }}">{{ $tag->name }}</option>
                    @endforeach
                </datalist>
            @endif
            @error('tag')
                <span class="font-medium text-red-500">{{ $message }}</span>
            @enderror

            <div class="flex item-start justify-between">
                <div>
                    <input type="file" name="img" id="img" class="hidden">
                    @error('img')
                        <span class="font-medium text-red-500">{{ $message }}</span>
                    @enderror
                    <label for="img"
                        class="w-11 h-11 flex items-center justify-center dark:bg-neutral-800 text-neutral-700 dark:text-white bg-gray-300 rounded-full dark:hover:bg-neutral-700 hover:bg-gray-500 duration-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </label>
                    <div class="img-selected flex flex-col gap-1">
                    </div>
                </div>
                <button type="submit"
                    class="px-6 py-2 text-lg font-semibold rounded-lg dark:bg-yellow-600 bg-blue-500 hover:bg-blue-600 dark:hover:bg-yellow-700 duration-300 cursor-pointer">Send</button>
            </div>
        </form>
    </section>
@endsection
