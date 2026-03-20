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

        @if (Auth::id() === $question->user->id || auth()->user()?->role === 'admin')
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
        @endif
    </div>

    <div class="mb-5">
        <h2 class="text-2xl font-semibold mb-4">{{ Str::limit($question->title, 100) }}</h2>
        <p class="text-gray-600 dark:text-gray-400">{{ Str::limit($question->body, 200) }}</p>

        @foreach ($question->images as $image)
            <div
                class="w-full overflow-hidden my-5 dark:bg-neutral-800 backdrop-blur-xl bg-neutral-100 rounded-lg h-140 bg-center bg-no-repeat">
                <img src="{{ $image->image }}" alt="Image" class="mx-auto object-contain h-140 rounded-lg">
            </div>
        @endforeach
    </div>

    <div class="flex items-center gap-4">
        <div class="voteBox flex items-center gap-2 dark:bg-[#333333] rounded-full bg-gray-300">
            <button id="upvote" data-question-id="{{ $question->id }}" data-type="up"
                class="vote {{ ($question->votes[0]->type ?? null) === 'up' ? 'text-blue-500 dark:text-yellow-500' : '' }} dark:bg-[#333333] bg-gray-300 w-10 h-10 rounded-full dark:hover:bg-neutral-700 hover:bg-gray-400 flex items-center justify-center duration-300 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 256 256">
                    <path
                        d="M229.66,114.34l-96-96a8,8,0,0,0-11.32,0l-96,96A8,8,0,0,0,32,128H72v80a16,16,0,0,0,16,16h80a16,16,0,0,0,16-16V128h40a8,8,0,0,0,5.66-13.66ZM176,112a8,8,0,0,0-8,8v88H88V120a8,8,0,0,0-8-8H51.31L128,35.31,204.69,112Z">
                    </path>
                </svg>
            </button>

            <span class="upvoteText font-medium select-none">{{ $question->upvotes }}</span>

            <button id="downvote" data-question-id="{{ $question->id }}" data-type="down"
                class="vote {{ ($question->votes[0]->type ?? null) === 'down' ? 'text-blue-500 dark:text-yellow-500' : 'GAY' }} dark:bg-[#333333] bg-gray-300 w-10 h-10 rounded-full dark:hover:bg-neutral-700 hover:bg-gray-400 flex items-center justify-center duration-300 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 256 256">
                    <path
                        d="M231.39,132.94A8,8,0,0,0,224,128H184V48a16,16,0,0,0-16-16H88A16,16,0,0,0,72,48v80H32a8,8,0,0,0-5.66,13.66l96,96a8,8,0,0,0,11.32,0l96-96A8,8,0,0,0,231.39,132.94ZM128,220.69,51.31,144H80a8,8,0,0,0,8-8V48h80v88a8,8,0,0,0,8,8h28.69Z">
                    </path>
                </svg>
            </button>

            <span class="downvoteText hidden font-medium select-none">{{ $question->downvotes }}</span>
        </div>

        <a href="{{ route('question.show', $question->id) }}"
            class="flex items-center justify-center gap-2 dark:bg-[#333333] rounded-full bg-gray-300 px-3 h-10 cursor-pointer dark:hover:bg-neutral-700 hover:bg-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
            </svg>
            <span class="font-medium select-none">{{ $question->answers }}</span>
        </a>

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
                class="menu share-menu hidden absolute -bottom-2 left-0 translate-y-full rounded-lg dark:bg-[#1d1f20] bg-[#f8f8f8] w-max flex flex-col gap-1 shadow-lg">
                <button type="button" data-url="{{ route('question.show', $question->id) }}"
                    class="copy-link-btn w-full flex items-center gap-4 px-4 py-2 cursor-pointer bg-[#f8f8f8] dark:bg-[#101314] hover:bg-gray-200 dark:hover:bg-[#313232] duration-300 rounded-lg duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>

                    Copy link
                </button>
            </div>
        </div>
    </div>
</div>
