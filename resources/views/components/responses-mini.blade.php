<div
    class="flex flex-col gap-4 w-full group hover:bg-gray-100 dark:hover:bg-neutral-800 duration-300 p-2 rounded-lg relative">
    @if ($response->user_id == auth()->id() || auth()->user()?->role === 'admin')
        <div class="hidden absolute group-hover:flex items-center gap-2 top-2 right-2">
            @if ($response->user_id == Auth::id())
                <button
                    class="edit-btn cursor-pointer flex items-center gap-1.5 bg-gray-200 hover:text-blue-500 dark:hover:text-yellow-500 hover:bg-gray-300 dark:hover:bg-neutral-700  duration-300 rounded-lg px-3 py-1 dark:bg-neutral-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                    <span class="text-sm">Edit</span>
                </button>
            @endif
            <form action="{{ route('responses.delete') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $response->user->id }}" class="hidden">
                <input type="hidden" name="response_id" value="{{ $response->id }}" class="hidden">
                <input type="hidden" name="question_id" value="{{ $response->question_id }}" class="hidden">

                <button type="submit"
                    class="flex cursor-pointer items-center gap-1.5 bg-gray-200 hover:bg-gray-300 hover:text-red-500 dark:hover:bg-neutral-700  duration-300 rounded-lg px-3 py-1 dark:bg-neutral-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>

                    <span class="text-sm">Delete</span>
                </button>
            </form>

        </div>
    @endif

    <a href="{{ route('question.show', $response->question->id) }}" class="flex items-center group gap-4">
        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
            <img src="{{ $response->user?->avatar ? asset('storage/' . $response->user->avatar) : '' }}" alt="AV"
                class="w-full h-full object-cover rounded-full">
        </div>
        <span class="font-medium group-hover:underline underline-offset-2">{{ $response->user->username }}</span>
        &bull;
        <span class="text-gray-500 text-sm">{{ $response->updated_at->diffForHumans() }}</span>
        @if ($response->is_edited)
            &bull;
            <span class="text-gray-500 text-sm">Edited</span>
        @endif
        @if ($response->is_accepted)
            <span class="text-sm bg-emerald-600 px-3 py-0.5 rounded-full">Accepted</span>
        @endif

    </a>

    <p class="response-body text-neutral-400 font-medium">
        {{ $response->body }}
    </p>
    @if ($response->user_id == Auth::id())
        <form action="{{ route('responses.edit') }}" method="post"
            class="edit-form hidden border border-gray-300 font-medium text-neutral-800 dark:border-neutral-500 dark:text-gray-100 rounded-xl">
            @csrf
            <input type="hidden" name="user_id" value="{{ $response->user->id }}" class="hidden">
            <input type="hidden" name="response_id" value="{{ $response->id }}" class="hidden">
            <input type="hidden" name="question_id" value="{{ $response->question_id }}" class="hidden">
            <textarea name="body" id="body" class="w-full min-h-25 outline-none rounded-xl py-2 px-3">{{ $response->body }}</textarea>
            <div class="w-full flex items-center justify-between px-4 py-1 rounded-3xl">
                <div class="flex items-center gap-4">
                    <div>
                        <input type="file" name="file" id="file" class="hidden">
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
                    <button type="reset"
                        class="edit-reset-btn font-semibold py-1.5 px-4 rounded-full dark:bg-neutral-700 bg-neutral-300 hover:bg-neutral-500 dark:hover:bg-neutral-600 duration-300 cursor-pointer">Cancel</button>
                    <button type="submit"
                        class="py-1.5 px-4 rounded-full dark:bg-yellow-600 bg-blue-500 dark:hover:bg-yellow-700 hover:bg-blue-700 duration-300 font-semibold cursor-pointer">Submit</button>
                </div>
            </div>
        </form>
        @error('body')
            <div class="font-medium text-red-500">{{ $message }}</div>
        @enderror
    @endif

    @if (isset($response->image))
        <div class="my-2">
            <img src="{{ $response->image }}" alt="img" class="h-50 object-contain">
        </div>
    @endif

    <form action="{{ route('responses.create') }}" method="post"
        class="form-comment w-full border dark:border-neutral-600 border-neutral-400 rounded-3xl hidden">
        <textarea name="body" id="body" placeholder="Response the question"
            class="response-input px-4 py-2.5 w-full min-h-12 h-12 text-lg outline-none rounded-3xl"></textarea>
        <input type="hidden" name="question_id" class="hidden" value="{{ $response->question_id }}">
        <input type="hidden" name="parent_id" class="hidden" value="{{ $response->id }}">
        @csrf
        <div class="response-block hidden w-full flex items-center justify-between px-4 py-1 rounded-3xl">
            <div class="flex items-center gap-4">
                <div>
                    <input type="file" name="file" id="file" class="hidden">
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
                <button type="reset"
                    class="reset-btn font-semibold py-1.5 px-4 rounded-full dark:bg-neutral-700 bg-neutral-300 hover:bg-neutral-500 dark:hover:bg-neutral-800 duration-300 cursor-pointer">Cancel</button>
                <button type="submit"
                    class="py-1.5 px-4 rounded-full dark:bg-yellow-600 bg-blue-500 dark:hover:bg-yellow-700 hover:bg-blue-700 duration-300 font-semibold cursor-pointer">Submit</button>
            </div>
        </div>
    </form>
</div>
