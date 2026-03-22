<div id="recentCont" class="mb-4 dark:bg-[#212121] bg-white rounded-lg mt-2 p-4 h-max">
    <div class="flex items-center justify-between mb-3 p-2">
        <h2 class="text-xl font-semibold dark:text-gray-300">Recent posts</h2>
        <button type="button" id="clearRecentBtn" data-user-id="{{ Auth::id() }}"
            class="text-sm font-medium hover:text-blue-700 dark:hover:text-yellow-700 text-blue-500 underline-offset-2 underline dark:text-yellow-600 cursor-pointer duration-300">Clear</button>
    </div>

    <div class="flex flex-col gap-4">

        @foreach ($recentPosts as $question)
            <div data-id="{{ $question->id }}"
                class="post-card flex items-start justify-between gap-4 border-b py-4 border-neutral-300 px-4 dark:border-neutral-700 dark:hover:bg-neutral-800 hover:bg-neutral-100 duration-300 cursor-pointer">
                <div class="{{ isset($question->image) ? 'w-[70%]' : 'w-full' }}">
                    <div class="flex items-center gap-2 mb-2">
                        <img src="{{ $question->user?->avatar ? asset('storage/' . $question->user->avatar) : '' }}"
                            class="w-8 h-8 rounded-full dark:bg-gray-300 bg-gray-300">
                        <span class="text-sm font-medium text-gray-300">{{ $question->username }}</span>
                    </div>
                    <h4 class="text-sm font-bold dark:text-gray-300 mb-4">{{ $question->title }}</h4>
                    <span class="text-medium dark:text-gray-400 text-sm">{{ $question->upvotes }} upvotes</span>
                </div>
                @if (isset($question->images[0]->image))
                    <div class="w-[30%] aspect-square">
                        <img src="{{ asset('storage/' . $question->images[0]->image) ? asset('storage/' . $question->images[0]->image) : '' }}"
                            alt="image" class="border w-full h-full rounded-lg object-cover">
                    </div>
                @endif
            </div>
        @endforeach

    </div>

</div>
