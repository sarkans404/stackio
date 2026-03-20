<div data-id="{{ $question->id }}"
    class="post-card w-full my-2 border-b px-4 border-neutral-300 dark:border-neutral-700 bg-[#f8f8f8] dark:bg-[#101314] py-3 dark:hover:bg-neutral-800 hover:bg-neutral-100 duration-300 cursor-pointer">
    <div class="flex items-center justify-between mb-2">
        <a href="{{ route('user.profile', $question->user->id) }}" class="flex items-center group gap-2 text-sm">
            <div class="w-8 h-8 bg-gray-300 dark:bg-gray-200 rounded-full overflow-hidden">
                <img src="{{ $question->user?->avatar ? asset('storage/' . $question->user->avatar) : '' }}"
                    alt="Avatar" class="rounded-full w-full h-full object-cover object-center">
            </div>
            <span
                class="font-medium text-neutral-700 dark:text-gray-300 group-hover:underline underline-offset-2">{{ $question->user->username }}</span>
            &bull;
            <span class="text-neutral-500 dark:text-gray-400">{{ $question->created_at->diffForHumans() }}</span>
        </a>

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
                class="menu z-20 action-menu hidden absolute top-10 right-0 translate-y-0 w-max rounded-xl overflow-hidden shadow-xl bg-[#f8f8f8] dark:bg-[#1d1f20] flex flex-col">
                <button type="button" data-user-id="{{ Auth::id() }}" data-question-id="{{ $question->id }}"
                    class="saveBtn {{ isset($userSaved[$question->id]) ? 'text-blue-500 dark:text-yellow-500' : '' }} w-full flex items-center gap-4 px-4 py-2 cursor-pointer bg-[#f8f8f8] dark:bg-[#101314] hover:bg-gray-200 dark:hover:bg-[#313232] duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                    </svg>

                    <span>{{ isset($userSaved[$question->id]) ? 'Saved' : 'Save' }}</span>
                </button>
                @if (Auth::id() !== $question->user->id)
                    <button type="button" data-user-id="{{ Auth::id() }}" data-question-id="{{ $question->id }}"
                        class="hideBtn {{ isset($userHidden[$question->id]) ? 'text-blue-500 dark:text-yellow-500' : '' }} w-full flex items-center gap-4 px-4 py-2 cursor-pointer bg-[#f8f8f8] dark:bg-[#101314] hover:bg-gray-200 dark:hover:bg-[#313232] duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>

                        <span>{{ isset($userHidden[$question->id]) ? 'Hidden' : 'Hide Post' }}</span>
                    </button>
                @endif
                @if (Auth::id() === $question->user->id)
                    <a href="{{ route('question.edit.show', $question->id) }}" type="submit"
                        class="w-full flex items-center gap-4 px-4 py-2 cursor-pointer bg-[#f8f8f8] dark:bg-[#101314] hover:bg-gray-200 dark:hover:bg-[#313232] duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
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

    <div class="mb-5">
        <h2 class="text-2xl font-semibold mb-4">{{ Str::limit($question->title, 100) }}</h2>
        <p class="text-gray-600 dark:text-gray-400">{{ Str::limit($question->body, 200) }}</p>

        @if ($question->images->isNotEmpty())
            <div
                class="galleryCont w-full h-140 relative rounded-lg group cursor-pointer flex duration-300 transition-all items-center overflow-hidden my-5 dark:bg-neutral-800 backdrop-blur-xl bg-neutral-100">
                @if ($question->images->count() > 1)
                    <div
                        class="btnLeft z-1 group-hover:flex hidden cursor-pointer hover:opacity-70 duration-300 transition-all bg-gray-300/80 absolute dark:bg-black/50 p-2 rounded-full top-1/2 -translate-y-1/2 left-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </div>
                @endif

                <div class="flex w-full h-full">
                    @foreach ($question->images as $image)
                        <div class="imagesCont duration-300 min-w-full bg-center bg-no-repeat rounded-lg">
                            <img src="{{ $image?->image ? asset('storage/' . $image->image) : '' }}" alt="Image"
                                class="image mx-auto object-contain h-140 rounded-lg">
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
