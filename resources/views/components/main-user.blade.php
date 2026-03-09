<section class="main-content translate-x-0 my-10 max-w-7xl mx-auto duration-300">
    <div class="w-full flex items-center justify-between">
        <div class="w-full flex items-center gap-4">
            <div class="w-20 h-20 rounded-full dark:bg-neutral-300 bg-neutral-300">

            </div>
            <div class="flex flex-col">
                <span class="text-4xl font-semibold dark:text-white">{{ $user->username }}</span>
                <span class="text-lg font-medium dark:text-gray-300 text-neutral-700">{{ $user->created_at }}</span>
            </div>
        </div>
        <div class="flex flex-col gap-2 items-center justify-center">
            @if ($user->role === 'admin')
                <span class="text-lg text-yellow-500 font-semibold capitalize flex items-center gap-1">
                    {{ $user->role }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                        viewBox="0 0 256 256">
                        <path
                            d="M248,80a28,28,0,1,0-51.12,15.77l-26.79,33L146,73.4a28,28,0,1,0-36.06,0L85.91,128.74l-26.79-33a28,28,0,1,0-26.6,12L47,194.63A16,16,0,0,0,62.78,208H193.22A16,16,0,0,0,209,194.63l14.47-86.85A28,28,0,0,0,248,80ZM128,40a12,12,0,1,1-12,12A12,12,0,0,1,128,40ZM24,80A12,12,0,1,1,36,92,12,12,0,0,1,24,80ZM193.22,192H62.78L48.86,108.52,81.79,149A8,8,0,0,0,88,152a7.83,7.83,0,0,0,1.08-.07,8,8,0,0,0,6.26-4.74l29.3-67.4a27,27,0,0,0,6.72,0l29.3,67.4a8,8,0,0,0,6.26,4.74A7.83,7.83,0,0,0,168,152a8,8,0,0,0,6.21-3l32.93-40.52ZM220,92a12,12,0,1,1,12-12A12,12,0,0,1,220,92Z">
                        </path>
                    </svg>
                </span>
            @endif
            <a href="{{ route('user.edit') }}"
                class="text-lg dark:bg-yellow-600 bg-blue-500 py-1 px-5 rounded-xl font-semibold text-white">Edit</a>
        </div>
    </div>
    <div
        class="flex items-center gap-4 dark:text-white my-10 text-neutral-700 border-b pb-4 dark:border-neutral-600 border-neutral-400">
        <a href="{{ route('user.profile', 1) }}"
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
