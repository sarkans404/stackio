<header
    class="z-50 fixed dark:bg-[#101314] bg-white top-0 left-0 right-0 w-full mx-auto py-2 px-4 flex items-center justify-between border-b border-gray-600">
    <a href="{{ route('home') }}" class="text-2xl font-bold select-none">Stackio</a>

    <form action="{{ route('search') }}" method="get" class="max-w-180 w-full relative">
        <input type="text" name="search" placeholder="Find response" value="{{ trim(request()->get('search')) }}"
            class="w-full text-center focus:pl-14 focus:text-left py-2 font-medium focus:outline-none rounded-full border border-blue-500 dark:border-yellow-500 duration-300 transition-colors ease-in-out focus:border-blue-700 dark:focus:border-yellow-700">
        <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </div>
    </form>
    <nav class="flex items-center gap-1">
        <button id="theme-toggle" type="button" aria-label="Toggle dark mode"
            class="hover:bg-gray-200 dark:hover:bg-[#313232] cursor-pointer rounded-full p-2 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 hidden dark:block">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 dark:hidden">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
            </svg>
        </button>
        <a href="{{ route('question.create') }}"
            class="text-lg font-medium hover:text-blue-500 dark:hover:text-yellow-500 px-4 h-10 flex items-center justify-center gap-2 rounded-full hover:bg-gray-200 dark:hover:bg-[#313232] duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span>Ask</span>
        </a>
        <a href="{{ route('notification.show') }}"
            class="hover:text-blue-500 dark:hover:text-yellow-500 w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-200 dark:hover:bg-[#313232] group duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 group-hover:scale-105 duration-200">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
        </a>
        <a href="{{ route('user.profile') }}"
            class="w-10 h-10 flex items-center justify-center rounded-full hover:text-blue-500 dark:hover:text-yellow-500 hover:bg-gray-200 dark:hover:bg-[#313232] group duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
        </a>
    </nav>
</header>
