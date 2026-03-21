@extends('layouts.app')

@section('title')
    {{ $question->title }}
@endsection

@section('content')
    <section
        class="main-content grid grid-cols-1 gap-10 translate-x-20 sm:grid-cols-[2fr_1fr] max-w-7xl h-max mx-auto my-2 px-4 bg-[#f8f8f8] dark:bg-[#0a0b0b] py-3 
        ">
        <div>
            <div class="flex items-center justify-between mb-4">
                <div class="relative flex items-center gap-2 text-sm">
                    <a href="{{ route('user.profile', $question->user->id) }}"
                        class="w-12 h-12 bg-gray-300 dark:bg-gray-200 rounded-full overflow-hidden">
                        <img src="{{ $question->user?->avatar ? asset('storage/' . $question->user->avatar) : '' }}"
                            class="w-full h-full object-cover rounded-full">
                    </a>
                    <a href="{{ route('user.profile', $question->user->id) }}" class="flex flex-col group justify-center">
                        <span
                            class="font-medium text-neutral-700 dark:text-gray-300 leading-4 group-hover:underline underline-offset-2">{{ $question->user->username }}</span>
                        <div class="flex gap-2 items-center">
                            <span
                                class="text-neutral-500 dark:text-gray-400">{{ $question->created_at->format('d.m.Y') }}</span>
                            &bull;
                            <span
                                class="text-neutral-500 dark:text-gray-400">{{ $question->updated_at->diffForHumans() }}</span>
                        </div>
                    </a>

                    <div id="back-btn"
                        class="absolute top-1/2 -left-2 -translate-x-full -translate-y-1/2 w-10 h-10 rounded-full flex items-center justify-center dark:bg-[#333333] bg-gray-300 dark:hover:bg-neutral-700 hover:bg-gray-400 cursor-pointer duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>
                    </div>
                </div>

                <div class="relative">
                    <div
                        class="action-btn flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-200 dark:hover:bg-[#313232] duration-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>

                    </div>
                    <div
                        class="z-20 action-menu menu hidden absolute top-10 right-0 translate-y-0 w-max rounded-xl overflow-hidden shadow-xl bg-[#f8f8f8] dark:bg-[#1d1f20] flex flex-col">
                        <button type="button"
                            class="w-full flex items-center gap-4 px-4 py-2 cursor-pointer bg-[#f8f8f8] dark:bg-[#101314] hover:bg-gray-200 dark:hover:bg-[#313232] duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                            Follow reponse
                        </button>
                        <button type="button" data-user-id="{{ Auth::id() }}" data-question-id="{{ $question->id }}"
                            class="saveBtn {{ $userSaved[$question->id] ?? -1 === Auth::id() ? 'text-blue-500 dark:text-yellow-500' : '' }} w-full flex items-center gap-4 px-4 py-2 cursor-pointer bg-[#f8f8f8] dark:bg-[#101314] hover:bg-gray-200 dark:hover:bg-[#313232] duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                            </svg>

                            <span>{{ ($userSaved[$question->id] ?? -1) === Auth::id() ? 'Saved' : 'Save' }}</span>
                        </button>
                        <button type="button"
                            class="w-full flex items-center gap-4 px-4 py-2 cursor-pointer bg-[#f8f8f8] dark:bg-[#101314] hover:bg-gray-200 dark:hover:bg-[#313232] duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>

                            Hide post
                        </button>
                        <button type="button"
                            class="w-full flex items-center gap-4 px-4 py-2 cursor-pointer bg-[#f8f8f8] dark:bg-[#101314] hover:bg-gray-200 dark:hover:bg-[#313232] duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                            </svg>

                            Report
                        </button>
                        @if (Auth::id() === $question->user->id)
                            <a href="{{ route('question.edit.show', $question->id) }}" type="submit"
                                class="w-full flex items-center gap-4 px-4 py-2 cursor-pointer bg-[#f8f8f8] dark:bg-[#101314] hover:bg-gray-200 dark:hover:bg-[#313232] duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                                Edit
                            </a>
                        @endif
                        @if (Auth::id() === $question->user->id || auth()->user()?->role === 'admin')
                            <form action="{{ route('question.delete') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="question_id" id="question_id" value="{{ $question->id }}"
                                    class="hidden">
                                <button type="submit"
                                    class="w-full flex items-center gap-4 px-4 py-2 cursor-pointer bg-[#f8f8f8] dark:bg-[#101314] hover:bg-gray-200 dark:hover:bg-[#313232] duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-5xl font-semibold mb-6">{{ $question->title }}</h2>
                <p class="text-gray-700 dark:text-gray-400">{{ $question->body }}</p>

                @if ($question->images->isNotEmpty())
                    <div
                        class="galleryCont w-full h-140 relative rounded-lg group cursor-pointer flex duration-300 transition-all items-center overflow-hidden my-5 dark:bg-neutral-800 backdrop-blur-xl bg-neutral-100">
                        @if ($question->images->count() > 1)
                            <div
                                class="btnLeft z-1 group-hover:flex hidden cursor-pointer hover:opacity-70 duration-300 transition-all bg-gray-300/80 absolute dark:bg-black/50 p-2 rounded-full top-1/2 -translate-y-1/2 left-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 19.5 8.25 12l7.5-7.5" />
                                </svg>
                            </div>
                        @endif

                        <div class="flex w-full h-full">
                            @foreach ($question->images as $image)
                                <div class="imagesCont duration-300 min-w-full bg-center bg-no-repeat rounded-lg">
                                    <img src="{{ $image?->image ? asset('storage/' . $image->image) : '' }}"
                                        alt="Image" class="image mx-auto object-contain h-140 rounded-lg">
                                </div>
                            @endforeach
                        </div>

                        @if ($question->images->count() > 1)
                            <div
                                class="dotsCont z-1 absolute bg-gray-400/80 dark:bg-neutral-500/50 py-1.5 px-3 flex items-center gap-1 rounded-full bottom-5 -translate-x-1/2 left-1/2">
                                @for ($i = 0; $i < $question->images->count(); $i++)
                                    <div data-qty="{{ $i }}"
                                        class="dots h-3 w-3 hover:opacity-70 rounded-full dark:bg-white/80 bg-black/60 duration-300">
                                    </div>
                                @endfor
                            </div>
                        @endif

                        <div
                            class="hidden closeGallery absolute flex items-center justify-center top-4 right-4 w-12 h-12 text-xl hover:opacity-80 duration-300 rounded-full border dark:border-neutral-700 dark:bg-neutral-900/80 border-black/30 bg-gray-300">
                            ✕
                        </div>


                        @if ($question->images->count() > 1)
                            <div
                                class="btnRight z-1 hidden group-hover:flex cursor-pointer absolute hover:opacity-70 transition-all duration-300 bg-gray-300/80 dark:bg-black/50 p-2 rounded-full top-1/2 -translate-y-1/2 right-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        @endif
                    </div>
                @endif

            </div>

            <div class="flex items-center justify-between my-4">
                <div class="flex items-center gap-4">
                    <div class="voteBox flex items-center gap-2 dark:bg-[#333333] rounded-full bg-gray-300">
                        <button id="upvote" data-question-id="{{ $question->id }}" data-type="up"
                            class="vote dark:bg-[#333333] {{ ($userVotes[$question->id] ?? null) === 'up' ? 'text-blue-500 dark:text-yellow-500' : '' }} bg-gray-300 w-10 h-10 rounded-full dark:hover:bg-neutral-700 hover:bg-gray-400 flex items-center justify-center duration-300 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 256 256">
                                <path
                                    d="M229.66,114.34l-96-96a8,8,0,0,0-11.32,0l-96,96A8,8,0,0,0,32,128H72v80a16,16,0,0,0,16,16h80a16,16,0,0,0,16-16V128h40a8,8,0,0,0,5.66-13.66ZM176,112a8,8,0,0,0-8,8v88H88V120a8,8,0,0,0-8-8H51.31L128,35.31,204.69,112Z">
                                </path>
                            </svg>
                        </button>

                        <span class="upvoteText font-medium select-none">{{ $question->upvotes }}</span>

                        <button id="downvote" data-question-id="{{ $question->id }}" data-type="down"
                            class="vote dark:bg-[#333333] {{ ($userVotes[$question->id] ?? null) === 'down' ? 'text-blue-500 dark:text-yellow-500' : '' }} bg-gray-300 w-10 h-10 rounded-full dark:hover:bg-neutral-700 hover:bg-gray-400 flex items-center justify-center duration-300 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 256 256">
                                <path
                                    d="M231.39,132.94A8,8,0,0,0,224,128H184V48a16,16,0,0,0-16-16H88A16,16,0,0,0,72,48v80H32a8,8,0,0,0-5.66,13.66l96,96a8,8,0,0,0,11.32,0l96-96A8,8,0,0,0,231.39,132.94ZM128,220.69,51.31,144H80a8,8,0,0,0,8-8V48h80v88a8,8,0,0,0,8,8h28.69Z">
                                </path>
                            </svg>
                        </button>

                        <span class="downvoteText font-medium select-none pr-4">{{ $question->downvotes }}</span>
                    </div>

                    <div id="comment-btn"
                        class="flex items-center justify-center gap-2 dark:bg-[#333333] rounded-full bg-gray-300 px-3 h-10 cursor-pointer dark:hover:bg-neutral-700 hover:bg-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                        </svg>
                        <span class="font-medium select-none">{{ $question->answers }}</span>
                    </div>

                    <div class="relative">
                        <div
                            class="share-btn flex items-center justify-center gap-2 dark:bg-[#333333] rounded-full bg-gray-300 px-3 h-10 cursor-pointer dark:hover:bg-neutral-700 hover:bg-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 256 256">
                                <path
                                    d="M237.66,106.35l-80-80A8,8,0,0,0,144,32V72.35c-25.94,2.22-54.59,14.92-78.16,34.91-28.38,24.08-46.05,55.11-49.76,87.37a12,12,0,0,0,20.68,9.58h0c11-11.71,50.14-48.74,107.24-52V192a8,8,0,0,0,13.66,5.65l80-80A8,8,0,0,0,237.66,106.35ZM160,172.69V144a8,8,0,0,0-8-8c-28.08,0-55.43,7.33-81.29,21.8a196.17,196.17,0,0,0-36.57,26.52c5.8-23.84,20.42-46.51,42.05-64.86C99.41,99.77,127.75,88,152,88a8,8,0,0,0,8-8V51.32L220.69,112Z">
                                </path>
                            </svg>

                            <span class="font-medium select-none">Share</span>
                        </div>

                        <div
                            class="share-menu menu hidden absolute -bottom-2 left-0 translate-y-full rounded-lg dark:bg-[#1d1f20] bg-[#f8f8f8] w-max flex flex-col gap-1 shadow-lg">
                            <button type="button" data-url="{{ Request::url() }}"
                                class="copy-link-btn w-full flex items-center gap-4 px-4 py-2 cursor-pointer bg-[#f8f8f8] dark:bg-[#101314] hover:bg-gray-200 dark:hover:bg-[#313232] duration-300 rounded-lg duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                </svg>

                                Copy link
                            </button>
                        </div>
                    </div>
                </div>

                @if ($question->tags)
                    <div class="flex items-center gap-2">
                        @foreach ($question->tags as $tag)
                            <div class="flex items-center gap-1 flex-wrap">
                                <span
                                    class="text-white bg-gray-500 dark:bg-gray-700 px-3 py-1 rounded">{{ $tag->name }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="responseCont w-full my-6">
                <form action="{{ route('responses.create') }}" method="post" enctype="multipart/form-data"
                    class="w-full border dark:border-neutral-600 border-neutral-400 rounded-3xl">
                    @csrf
                    <input type="hidden" name="question_id" class="hidden" value="{{ $question->id }}">
                    <textarea name="body" id="response-input" placeholder="Response the question"
                        class="px-4 py-2.5 w-full min-h-12 h-12 text-lg outline-none rounded-3xl"></textarea>
                    <div id="response-block"
                        class="hidden w-full flex items-center justify-between px-4 py-1 rounded-3xl">
                        <div class="flex items-center gap-4">
                            <div>
                                <input type="file" name="file" id="file" class="hidden inputResponse">

                                <label for="file"
                                    class="w-10 h-10 flex items-center justify-center rounded-full dark:text-neutral-200 dark:hover:text-neutral-100 cursor-pointer dark:hover:bg-neutral-700 hover:bg-gray-300 duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="reset" id="reset-btn"
                                class="font-semibold py-1.5 px-4 rounded-full dark:bg-neutral-700 bg-neutral-300 hover:bg-neutral-500 dark:hover:bg-neutral-800 duration-300 cursor-pointer">Cancel</button>
                            <button type="submit"
                                class="py-1.5 px-4 rounded-full dark:bg-yellow-600 bg-blue-500 dark:hover:bg-yellow-700 hover:bg-blue-700 duration-300 font-semibold cursor-pointer">Submit</button>
                        </div>
                    </div>
                    <div class="responsePreview hidden img-selected p-2 flex flex-wrap w-full gap-4">

                    </div>
                </form>
                @error('body')
                    <span class="text-medium text-red-500">{{ $message }}</span>
                @enderror
                @error('file')
                    <span class="text-medium text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <label for="sort" class="font-medium dark:text-gray-400">Sort by:</label>
                <select name="sort" id="sort">
                    <option value="highest">Highest score</option>
                    <option value="new">New</option>
                    <option value="old">Old</option>
                </select>
            </div>

            <div class="my-8 w-full space-y-10">
                {{-- comments --}}
                @foreach ($question->responses as $responses)
                    <div
                        class="flex flex-col gap-4 w-full group hover:bg-gray-100 dark:hover:bg-neutral-800 duration-300 p-2 rounded-lg relative">
                        @if ($responses->user_id == auth()->id() || auth()->user()?->role === 'admin')
                            <div class="hidden absolute group-hover:flex items-center gap-2 top-2 right-2">
                                @if ($responses->user_id == Auth::id())
                                    <button
                                        class="edit-btn cursor-pointer flex items-center gap-1.5 bg-gray-200 hover:text-blue-500 dark:hover:text-yellow-500 hover:bg-gray-300 dark:hover:bg-neutral-700  duration-300 rounded-lg px-3 py-1 dark:bg-neutral-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                        <span class="text-sm">Edit</span>
                                    </button>
                                @endif
                                <form action="{{ route('responses.delete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $responses->user->id }}"
                                        class="hidden">
                                    <input type="hidden" name="response_id" value="{{ $responses->id }}"
                                        class="hidden">
                                    <input type="hidden" name="question_id" value="{{ $question->id }}"
                                        class="hidden">

                                    <button type="submit"
                                        class="flex cursor-pointer items-center gap-1.5 bg-gray-200 hover:bg-gray-300 hover:text-red-500 dark:hover:bg-neutral-700  duration-300 rounded-lg px-3 py-1 dark:bg-neutral-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>

                                        <span class="text-sm">Delete</span>
                                    </button>
                                </form>

                            </div>
                        @endif

                        <div class="flex items-center gap-4">
                            <a href="{{ route('user.profile', $responses->user->id) }}"
                                class="group flex items-center gap-4">
                                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                    <img src="{{ $responses->user?->avatar ? asset('storage/' . $responses->user->avatar) : '' }}"
                                        class="w-full h-full object-cover rounded-full">
                                </div>
                                <span
                                    class="font-medium group-hover:underline underline-offset-2">{{ $responses->user->username }}</span>
                                &bull;
                                <span class="text-gray-500 text-sm">{{ $responses->updated_at->diffForHumans() }}</span>
                            </a>
                            @if ($responses->is_edited)
                                &bull;
                                <span class="text-gray-500 text-sm">Edited</span>
                            @endif

                            @if ($responses->user_id === $question->user->id)
                                <span
                                    class="text-sm bg-gray-300 dark:bg-neutral-500 px-3 py-0.5 rounded-full">Author</span>
                            @endif
                            @if ($responses->user->role === 'admin')
                                <span class="text-sm bg-blue-500 dark:bg-yellow-600 px-3 py-0.5 rounded-full">Admin</span>
                            @endif
                            @if ($responses->is_accepted)
                                <span class="text-sm bg-emerald-600 px-3 py-0.5 rounded-full">Accepted</span>
                            @endif

                        </div>

                        <p class="response-body text-neutral-400 font-medium">
                            {{ $responses->body }}
                        </p>
                        @if ($responses->user_id == Auth::id())
                            <form action="{{ route('responses.edit') }}" method="post" enctype="multipart/form-data"
                                class="edit-form responseCont hidden border border-gray-300 font-medium text-neutral-800 dark:border-neutral-500 dark:text-gray-100 rounded-xl">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $responses->user->id }}" class="hidden">
                                <input type="hidden" name="response_id" value="{{ $responses->id }}" class="hidden">
                                <input type="hidden" name="question_id" value="{{ $question->id }}" class="hidden">
                                <input type="hidden" name="remove_image" value="0" class="remove-image-input">
                                <textarea name="body" id="body" class="w-full min-h-25 outline-none rounded-xl py-2 px-3">{{ $responses->body }}</textarea>
                                <div class="w-full flex items-center justify-between px-4 py-1 rounded-3xl">
                                    <div class="flex items-center gap-4">
                                        <div>
                                            <input type="file" name="file" id="file-{{ $responses->id }}"
                                                class="hidden inputResponse">
                                            <label for="file-{{ $responses->id }}"
                                                class="w-10 h-10 flex items-center justify-center rounded-full dark:text-neutral-200 dark:hover:text-neutral-100 cursor-pointer dark:hover:bg-neutral-700 hover:bg-gray-300 duration-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <button type="reset"
                                            class="edit-reset-btn font-semibold py-1.5 px-4 rounded-full dark:bg-neutral-700 bg-neutral-300 hover:bg-neutral-500 dark:hover:bg-neutral-600 duration-300 cursor-pointer">Cancel</button>
                                        <button type="submit"
                                            class="py-1.5 px-4 rounded-full dark:bg-yellow-600 bg-blue-500 dark:hover:bg-yellow-700 hover:bg-blue-700 duration-300 font-semibold cursor-pointer">Submit</button>
                                    </div>
                                </div>
                                <div class="responsePreview img-selected p-2 flex flex-wrap w-full gap-4">
                                    @if (isset($responses->image))
                                        <div class="my-2 relative group">
                                            <img src="{{ asset('storage/' . $responses->image) ? asset('storage/' . $responses->image) : '' }}"
                                                class="h-28 object-cover rounded-lg">
                                            <button type="button"
                                                class="absolute top-1 right-1 bg-black/60 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 duration-200">
                                                ✕
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                            @error('body')
                                <div class="font-medium text-red-500">{{ $message }}</div>
                            @enderror
                            @error('file')
                                <span class="text-medium text-red-500">{{ $message }}</span>
                            @enderror
                        @endif

                        @if (isset($responses->image))
                            <div class="my-2 responseImage">
                                <img src="{{ asset('storage/' . $responses->image) ? asset('storage/' . $responses->image) : '' }}"
                                    class="h-50 object-cover rounded-lg">
                            </div>
                        @endif

                        <div class="voteBox flex items-center gap-2">
                            <div class="flex items-center gap-2">

                                <button data-response-id="{{ $responses->id }}" data-type="up"
                                    class="vote res-upvote {{ ($userVotesRes[$responses->id] ?? null) === 'up' ? 'text-blue-500 dark:text-yellow-500' : '' }} w-10 h-10 rounded-full dark:hover:bg-neutral-700 hover:bg-gray-400 flex items-center justify-center duration-300 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 256 256">
                                        <path
                                            d="M229.66,114.34l-96-96a8,8,0,0,0-11.32,0l-96,96A8,8,0,0,0,32,128H72v80a16,16,0,0,0,16,16h80a16,16,0,0,0,16-16V128h40a8,8,0,0,0,5.66-13.66ZM176,112a8,8,0,0,0-8,8v88H88V120a8,8,0,0,0-8-8H51.31L128,35.31,204.69,112Z">
                                        </path>
                                    </svg>
                                </button>

                                <span
                                    class="upvoteText font-semibold text-gray-500 dark:text-gray-400">{{ $responses->upvotes }}</span>

                            </div>


                            <div class="flex items-center gap-1">
                                <button data-response-id="{{ $responses->id }}" data-type="down"
                                    class="vote res-downvote {{ ($userVotesRes[$responses->id] ?? null) === 'down' ? 'text-blue-500 dark:text-yellow-500' : '' }} w-10 h-10 rounded-full dark:hover:bg-neutral-700 hover:bg-gray-400 flex items-center justify-center duration-300 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 256 256">
                                        <path
                                            d="M231.39,132.94A8,8,0,0,0,224,128H184V48a16,16,0,0,0-16-16H88A16,16,0,0,0,72,48v80H32a8,8,0,0,0-5.66,13.66l96,96a8,8,0,0,0,11.32,0l96-96A8,8,0,0,0,231.39,132.94ZM128,220.69,51.31,144H80a8,8,0,0,0,8-8V48h80v88a8,8,0,0,0,8,8h28.69Z">
                                        </path>
                                    </svg>
                                </button>

                                <span
                                    class="downvoteText font-semibold text-gray-500 dark:text-gray-400">{{ $responses->downvotes }}</span>
                            </div>

                            <div
                                class="reply-btn flex items-center justify-center gap-2 rounded-full px-3 h-10 cursor-pointer dark:hover:bg-neutral-700 hover:bg-gray-400 duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                </svg>
                                <span class="font-medium select-none text-neutral-700 dark:text-neutral-300">Reply</span>
                            </div>

                        </div>

                        <form action="{{ route('responses.create') }}" method="post" enctype="multipart/form-data"
                            class="form-comment responseCont w-full border dark:border-neutral-600 border-neutral-400 rounded-3xl hidden">
                            <textarea name="body" id="body" placeholder="Response the question"
                                class="response-input px-4 py-2.5 w-full min-h-12 h-12 text-lg outline-none rounded-3xl"></textarea>
                            <input type="hidden" name="question_id" class="hidden" value="{{ $question->id }}">
                            <input type="hidden" name="parent_id" class="hidden" value="{{ $responses->id }}">
                            @csrf
                            <div
                                class="response-block hidden w-full flex items-center justify-between px-4 py-1 rounded-3xl">
                                <div class="flex items-center gap-4">
                                    <div>
                                        <input type="file" name="file" id="file2-{{ $responses->id }}"
                                            class="hidden inputResponse">
                                        <label for="file2-{{ $responses->id }}"
                                            class="w-10 h-10 flex items-center justify-center rounded-full dark:text-neutral-200 dark:hover:text-neutral-100 cursor-pointer dark:hover:bg-neutral-700 hover:bg-gray-300 duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <button type="reset"
                                        class="reset-btn font-semibold py-1.5 px-4 rounded-full dark:bg-neutral-700 bg-neutral-300 hover:bg-neutral-500 dark:hover:bg-neutral-800 duration-300 cursor-pointer">Cancel</button>
                                    <button type="submit"
                                        class="py-1.5 px-4 rounded-full dark:bg-yellow-600 bg-blue-500 dark:hover:bg-yellow-700 hover:bg-blue-700 duration-300 font-semibold cursor-pointer">Submit</button>
                                </div>
                            </div>
                            <div class="responsePreview hidden img-selected p-2 flex flex-wrap w-full gap-4">

                            </div>
                            @error('body')
                                <span class="text-medium text-red-500">{{ $message }}</span>
                            @enderror
                            @error('file')
                                <span class="text-medium text-red-500">{{ $message }}</span>
                            @enderror
                        </form>
                    </div>
                    {{--  --}}
                    @foreach ($responses->children as $comment)
                        <div
                            class="flex flex-col gap-4 w-full pl-15 hover:bg-gray-100 dark:hover:bg-neutral-800 duration-300 rounded-lg p-2 relative group">
                            @if ($comment->user_id == Auth::id() || Auth::user()?->role === 'admin')
                                <div class="hidden z-10 absolute group-hover:flex items-center gap-2 top-2 right-2">
                                    @if ($comment->user_id == Auth::id())
                                        <button
                                            class="edit-btn cursor-pointer flex items-center gap-1.5 bg-gray-200 hover:text-blue-500 dark:hover:text-yellow-500 hover:bg-gray-300 dark:hover:bg-neutral-700  duration-300 rounded-lg px-3 py-1 dark:bg-neutral-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                            <span class="text-sm">Edit</span>
                                        </button>
                                    @endif

                                    <form action="{{ route('responses.delete') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="response_id" value="{{ $comment->id }}"
                                            class="hidden">
                                        <input type="hidden" name="question_id" value="{{ $question->id }}"
                                            class="hidden">

                                        <button type="submit"
                                            class="flex cursor-pointer items-center gap-1.5 bg-gray-200 hover:bg-gray-300 hover:text-red-500 dark:hover:bg-neutral-700  duration-300 rounded-lg px-3 py-1 dark:bg-neutral-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>

                                            <span class="text-sm">Delete</span>
                                        </button>
                                    </form>

                                </div>
                            @endif
                            <div class="relative flex items-center gap-4">
                                <a href="{{ route('user.profile', $comment->user->id) }}"
                                    class="flex items-center gap-4 group">
                                    <div class="w-10 h-10 bg-gray-300 rounded-full">
                                        <img src="{{ $comment->user?->avatar ? asset('storage/' . $comment->user->avatar) : '' }}"
                                            class="w-full h-full object-cover rounded-full">
                                    </div>
                                    <span
                                        class="font-medium group-hover:underline underline-offset-2">{{ $comment->user->username }}</span>
                                    &bull;
                                    <span class="text-gray-500 text-sm">{{ $comment->updated_at->diffForHumans() }}</span>
                                </a>
                                @if ($comment->user_id === $question->user->id)
                                    <span
                                        class="text-sm bg-gray-300 dark:bg-neutral-500 px-3 py-0.5 rounded-full">Author</span>
                                @endif

                                @if ($comment->user->role === 'admin')
                                    <span
                                        class="text-sm bg-blue-500 dark:bg-yellow-600 px-3 py-0.5 rounded-full">Admin</span>
                                @endif
                                @if ($comment->is_edited)
                                    &bull;
                                    <span class="text-gray-500 text-sm">Edited</span>
                                @endif

                                <div
                                    class="absolute top-0 -left-2 text-gray-400 -translate-x-full w-10 h-10 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.49 12 3.75 3.75m0 0-3.75 3.75m3.75-3.75H3.74V4.499" />
                                    </svg>
                                </div>
                            </div>

                            <p class="response-body text-neutral-400 font-medium">
                                {{ $comment->body }}
                            </p>

                            @if ($comment->user_id == Auth::id())
                                <form action="{{ route('responses.edit') }}" method="post"
                                    enctype="multipart/form-data"
                                    class="edit-form responseCont hidden border border-gray-300 font-medium text-neutral-800 dark:border-neutral-500 dark:text-gray-100 rounded-xl">
                                    @csrf
                                    <input type="hidden" name="response_id" value="{{ $comment->id }}"
                                        class="hidden">
                                    <input type="hidden" name="parent_id" value="{{ $comment->parent_id }}"
                                        class="hidden">
                                    <input type="hidden" name="question_id" value="{{ $question->id }}"
                                        class="hidden">
                                    <input type="hidden" name="remove_image" value="0" class="remove-image-input">
                                    <textarea name="body" id="body" class="w-full min-h-25 outline-none rounded-xl py-2 px-3">{{ $comment->body }}</textarea>
                                    <div class="w-full flex items-center justify-between px-4 py-1 rounded-3xl">
                                        <div class="flex items-center gap-4">
                                            <div>
                                                <input type="file" name="file" id="file-{{ $comment->id }}"
                                                    class="hidden inputResponse">
                                                <label for="file-{{ $comment->id }}"
                                                    class="w-10 h-10 flex items-center justify-center rounded-full dark:text-neutral-200 dark:hover:text-neutral-100 cursor-pointer dark:hover:bg-neutral-700 hover:bg-gray-300 duration-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                    </svg>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-4">
                                            <button type="reset"
                                                class="edit-reset-btn font-semibold py-1.5 px-4 rounded-full dark:bg-neutral-700 bg-neutral-300 hover:bg-neutral-500 dark:hover:bg-neutral-600 duration-300 cursor-pointer">Cancel</button>
                                            <button type="submit"
                                                class="py-1.5 px-4 rounded-full dark:bg-yellow-600 bg-blue-500 dark:hover:bg-yellow-700 hover:bg-blue-700 duration-300 font-semibold cursor-pointer">Submit</button>
                                        </div>
                                    </div>
                                    <div class="responsePreview hidden img-selected p-2 flex flex-wrap w-full gap-4">
                                        @if (isset($comment->image))
                                            <div class="my-2 relative group">
                                                <img src="{{ asset('storage/' . $comment->image) ? asset('storage/' . $comment->image) : '' }}"
                                                    class="h-28 object-cover rounded-lg">
                                                <button type="button"
                                                    class="absolute top-1 right-1 bg-black/60 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 duration-200">
                                                    ✕
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                                @error('body')
                                    <div class="font-medium text-red-500">{{ $message }}</div>
                                @enderror
                                @error('file')
                                    <span class="text-medium text-red-500">{{ $message }}</span>
                                @enderror
                            @endif

                            @if (isset($comment->image))
                                <div class="my-2">
                                    <img src="{{ asset('storage/' . $comment->image) ? asset('storage/' . $comment->image) : '' }}"
                                        class="h-50 object-contain">
                                </div>
                            @endif

                            <div class="voteBox flex items-center gap-2">
                                <div class="flex items-center gap-2">

                                    <button data-response-id="{{ $comment->id }}" data-type="up"
                                        class="vote res-upvote {{ ($userVotesRes[$comment->id] ?? null) === 'up' ? 'text-blue-500 dark:text-yellow-500' : '' }} w-10 h-10 rounded-full dark:hover:bg-neutral-700 hover:bg-gray-400 flex items-center justify-center duration-300 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 256 256">
                                            <path
                                                d="M229.66,114.34l-96-96a8,8,0,0,0-11.32,0l-96,96A8,8,0,0,0,32,128H72v80a16,16,0,0,0,16,16h80a16,16,0,0,0,16-16V128h40a8,8,0,0,0,5.66-13.66ZM176,112a8,8,0,0,0-8,8v88H88V120a8,8,0,0,0-8-8H51.31L128,35.31,204.69,112Z">
                                            </path>
                                        </svg>
                                    </button>

                                    <span
                                        class="upvoteText font-semibold text-gray-500 dark:text-gray-400">{{ $comment->upvotes }}</span>

                                </div>


                                <div class="flex items-center gap-1">
                                    <button data-response-id="{{ $comment->id }}" data-type="down"
                                        class="vote res-downvote {{ ($userVotesRes[$comment->id] ?? null) === 'down' ? 'text-blue-500 dark:text-yellow-500' : '' }} w-10 h-10 rounded-full dark:hover:bg-neutral-700 hover:bg-gray-400 flex items-center justify-center duration-300 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 256 256">
                                            <path
                                                d="M231.39,132.94A8,8,0,0,0,224,128H184V48a16,16,0,0,0-16-16H88A16,16,0,0,0,72,48v80H32a8,8,0,0,0-5.66,13.66l96,96a8,8,0,0,0,11.32,0l96-96A8,8,0,0,0,231.39,132.94ZM128,220.69,51.31,144H80a8,8,0,0,0,8-8V48h80v88a8,8,0,0,0,8,8h28.69Z">
                                            </path>
                                        </svg>
                                    </button>

                                    <span
                                        class="downvoteText font-semibold text-gray-500 dark:text-gray-400">{{ $comment->downvotes }}</span>
                                </div>

                                {{-- HIDDEN --}}
                                <div
                                    class="hidden reply-btn flex items-center justify-center gap-2 rounded-full px-3 h-10 cursor-pointer dark:hover:bg-neutral-700 hover:bg-gray-400 duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                    </svg>
                                    <span
                                        class="font-medium select-none text-neutral-700 dark:text-neutral-300">Reply</span>
                                </div>
                                {{-- ----- --}}

                            </div>

                            {{-- HIDDEN --}}
                            <form action="{{ route('responses.create') }}" method="post"
                                class="form-comment w-full border dark:border-neutral-600 border-neutral-400 rounded-3xl hidden">
                                <textarea name="body" id="response-input" placeholder="Response the question"
                                    class="response-input px-4 py-2.5 w-full min-h-12 h-12 text-lg outline-none rounded-3xl"></textarea>
                                <input type="hidden" name="parent_id" class="hidden" value="{{ $comment->id }}">
                                <input type="hidden" name="question_id" class="hidden" value="{{ $question->id }}">
                                @csrf
                                <div
                                    class="response-block hidden w-full flex items-center justify-between px-4 py-1 rounded-3xl">
                                    <div class="flex items-center gap-4">
                                        <div>
                                            <input type="file" name="file" id="file" class="hidden">
                                            <label for="file"
                                                class="w-10 h-10 flex items-center justify-center rounded-full dark:text-neutral-200 dark:hover:text-neutral-100 cursor-pointer dark:hover:bg-neutral-700 hover:bg-gray-300 duration-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <button type="reset"
                                            class="reset-btn font-semibold py-1.5 px-4 rounded-full dark:bg-neutral-700 bg-neutral-300 hover:bg-neutral-500 dark:hover:bg-neutral-800 duration-300 cursor-pointer">Cancel</button>
                                        <button type="submit"
                                            class="py-1.5 px-4 rounded-full dark:bg-yellow-600 bg-blue-500 dark:hover:bg-yellow-700 hover:bg-blue-700 duration-300 font-semibold cursor-pointer">Submit</button>
                                    </div>
                                </div>
                            </form>
                            {{-- ----- --}}

                        </div>
                    @endforeach
                @endforeach

            </div>

        </div>

        <x-aside-card :question="$question" :recentPosts="$recentPosts" :questionsQty="$questionsQty" :popularTags="$popularTags" :answersQty="$answersQty"
            :commentQty="$commentQty" :userQty="$userQty" />
    </section>
@endsection
