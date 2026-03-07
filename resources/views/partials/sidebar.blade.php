<aside
    class="z-50 fixed -translate-x-[92%] dark:bg-[#101314] bg-white top-14.75 left-0 w-68 border-r border-gray-600 h-screen">
    <div id="sidebar-toggle"
        class="absolute -right-5 top-2 dark:bg-[#101314] bg-white w-10 h-10 rounded-full flex items-center justify-center border border-gray-600 cursor-pointer hover:bg-gray-200 dark:hover:bg-[#313232] duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 rotate-0">
            <path fill-rule="evenodd"
                d="M10.72 11.47a.75.75 0 0 0 0 1.06l7.5 7.5a.75.75 0 1 0 1.06-1.06L12.31 12l6.97-6.97a.75.75 0 0 0-1.06-1.06l-7.5 7.5Z"
                clip-rule="evenodd" />
            <path fill-rule="evenodd"
                d="M4.72 11.47a.75.75 0 0 0 0 1.06l7.5 7.5a.75.75 0 1 0 1.06-1.06L6.31 12l6.97-6.97a.75.75 0 0 0-1.06-1.06l-7.5 7.5Z"
                clip-rule="evenodd" />
        </svg>
    </div>
    <div class="px-5 my-5">
        <ul class="flex flex-col gap-1 border-b dark:border-neutral-700 border-gray-400 pb-4 pr-2 font-medium">
            <li>
                <a href="{{ route('home') }}"
                    class="flex gap-3 items-center w-full rounded-xl cursor-pointer py-2 px-8 dark:hover:bg-[#313232] hover:bg-gray-200 duration-200 {{ request()->routeIs('home') ? 'dark:bg-[#313232] bg-gray-200' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path
                            d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                        <path
                            d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                    </svg>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('popular') }}"
                    class="flex gap-3 items-center w-full rounded-xl cursor-pointer py-2 px-8 dark:hover:bg-[#313232] hover:bg-gray-200 duration-200 {{ request()->routeIs('popular') ? 'dark:bg-[#313232] bg-gray-200' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span>Popular</span=>
                </a>
            </li>
            <li>
                <a href="{{ route('new') }}"
                    class="flex gap-3 items-center w-full rounded-xl cursor-pointer py-2 px-8 dark:hover:bg-[#313232] hover:bg-gray-200 duration-200 {{ request()->routeIs('new') ? 'dark:bg-[#313232] bg-gray-200' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M9 4.5a.75.75 0 0 1 .721.544l.813 2.846a3.75 3.75 0 0 0 2.576 2.576l2.846.813a.75.75 0 0 1 0 1.442l-2.846.813a3.75 3.75 0 0 0-2.576 2.576l-.813 2.846a.75.75 0 0 1-1.442 0l-.813-2.846a3.75 3.75 0 0 0-2.576-2.576l-2.846-.813a.75.75 0 0 1 0-1.442l2.846-.813A3.75 3.75 0 0 0 7.466 7.89l.813-2.846A.75.75 0 0 1 9 4.5ZM18 1.5a.75.75 0 0 1 .728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 0 1 0 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 0 1-1.456 0l-.258-1.036a2.625 2.625 0 0 0-1.91-1.91l-1.036-.258a.75.75 0 0 1 0-1.456l1.036-.258a2.625 2.625 0 0 0 1.91-1.91l.258-1.036A.75.75 0 0 1 18 1.5ZM16.5 15a.75.75 0 0 1 .712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 0 1 0 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 0 1-1.422 0l-.395-1.183a1.5 1.5 0 0 0-.948-.948l-1.183-.395a.75.75 0 0 1 0-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0 1 16.5 15Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span>New</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="px-5">
        <ul class="flex flex-col gap-1 pb-4 pr-2 font-medium">
            <li>
                <a href="{{ route('rules') }}"
                    class="flex gap-3 items-center w-full rounded-xl cursor-pointer py-2 px-8 dark:hover:bg-[#313232] hover:bg-gray-200 duration-200 {{ request()->routeIs('rules') ? 'dark:bg-[#313232] bg-gray-200' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>

                    <span> Stackio Rules</span>
                </a>
            </li>
            <li>
                <a href="{{ route('privacy') }}"
                    class="flex gap-3 items-center w-full rounded-xl cursor-pointer py-2 px-8 dark:hover:bg-[#313232] hover:bg-gray-200 duration-200 {{ request()->routeIs('privacy') ? 'dark:bg-[#313232] bg-gray-200' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>


                    <span>Privacy Policy</span>
                </a>
            </li>
            <li>
                <a href="{{ route('agreement') }}"
                    class="flex gap-3 items-center w-full rounded-xl cursor-pointer py-2 px-8 dark:hover:bg-[#313232] hover:bg-gray-200 duration-200 {{ request()->routeIs('agreement') ? 'dark:bg-[#313232] bg-gray-200' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>


                    <span>User Agreement</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
