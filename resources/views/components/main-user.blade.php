<section class="main-content translate-x-0 my-10 max-w-7xl mx-auto duration-300">
    <div class="w-full flex items-center justify-between">
        <div class="w-full flex items-center gap-4">
            <div class="w-20 h-20 rounded-full dark:bg-neutral-300 bg-neutral-300">

            </div>
            <div class="flex flex-col">
                <span class="text-4xl font-semibold dark:text-white">{{ $user['name'] }}</span>
                <span class="text-lg font-medium dark:text-gray-300 text-neutral-700">{{ $user['date'] }}</span>
            </div>
        </div>
        <a href="{{ route('user.edit') }}"
            class="text-lg dark:bg-yellow-600 bg-blue-500 py-1 px-5 rounded-xl font-semibold dark:text-white text-neutral-800">Edit</a>
    </div>
    <div
        class="flex items-center gap-4 dark:text-white my-10 text-neutral-700 border-b pb-4 dark:border-neutral-600 border-neutral-400">
        <a href="{{ route('user.profile') }}"
            class="text-lg py-2 px-5 {{ request()->path() === 'user' ? 'dark:bg-neutral-700 bg-gray-300' : '' }} cursor-pointer dark:hover:bg-neutral-600 hover:bg-gray-400 duration-300 rounded-full font-semibold">Profile</a>
        <a href="{{ route('user.questions') }}"
            class="text-lg py-2 px-5 {{ request()->path() === 'user/posts' ? 'dark:bg-neutral-700 bg-gray-300' : '' }} cursor-pointer dark:hover:bg-neutral-600 hover:bg-gray-400 duration-300 rounded-full font-semibold">Questions</a>
        <a href="{{ route('user.answers') }}"
            class="text-lg py-2 px-5 {{ request()->path() === 'user/comments' ? 'dark:bg-neutral-700 bg-gray-300' : '' }} cursor-pointer dark:hover:bg-neutral-600 hover:bg-gray-400 duration-300 rounded-full font-semibold">Answers</a>
        <a href="{{ route('user.saved') }}"
            class="text-lg py-2 px-5 {{ request()->path() === 'user/saved' ? 'dark:bg-neutral-700 bg-gray-300' : '' }} cursor-pointer dark:hover:bg-neutral-600 hover:bg-gray-400 duration-300 rounded-full font-semibold">Saved</a>
        <a href="{{ route('user.hidden') }}"
            class="text-lg py-2 px-5 {{ request()->path() === 'user/hidden' ? 'dark:bg-neutral-700 bg-gray-300' : '' }} cursor-pointer dark:hover:bg-neutral-600 hover:bg-gray-400 duration-300 rounded-full font-semibold">Hidden</a>
        <a href="{{ route('user.upvoted') }}"
            class="text-lg py-2 px-5 {{ request()->path() === 'user/upvoted' ? 'dark:bg-neutral-700 bg-gray-300' : '' }} cursor-pointer dark:hover:bg-neutral-600 hover:bg-gray-400 duration-300 rounded-full font-semibold">Upvoted</a>
        <a href="{{ route('user.downvoted') }}"
            class="text-lg py-2 px-5 {{ request()->path() === 'user/downvoted' ? 'dark:bg-neutral-700 bg-gray-300' : '' }} cursor-pointer dark:hover:bg-neutral-600 hover:bg-gray-400 duration-300 rounded-full font-semibold">Downvoted</a>
    </div>
    <div>
        {{ $slot }}
    </div>
</section>
