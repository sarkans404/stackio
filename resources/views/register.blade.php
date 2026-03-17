<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Stackio</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-[#f8f8f8] text-black dark:bg-[#0a0b0b] dark:text-white relative">
    <main class="h-screen flex items-center justify-center w-full bg-[#f8f8f8] dark:bg-[#0a0b0b] pt-20 px-4">
        <div class="w-[40%] bg-gray-200 dark:bg-neutral-800 p-12 rounded-xl relative">
            <a href="{{ route('home') }}"
                class="absolute top-0 -left-2 -translate-x-full w-10 h-10 rounded-full flex items-center justify-center dark:bg-[#333333] bg-gray-300 dark:hover:bg-neutral-700 hover:bg-gray-400 cursor-pointer duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
            </a>
            <button id="theme-toggle" type="button" aria-label="Toggle dark mode"
                class="hover:bg-gray-200 dark:hover:bg-[#313232] cursor-pointer rounded-full p-2 duration-300 absolute top-0 -right-2 translate-x-full dark:bg-[#333333] bg-gray-300">
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
            <h1 class="text-5xl font-semibold tracking-wider mb-10">Register</h1>
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-2">
                @csrf

                <label for="username" class="font-medium text-xl">Username</label>
                <div class="mb-5">
                    <input name="username" placeholder="Username" value="{{ old('username') }}"
                        class="w-full border border-neutral-600 rounded-lg py-2 px-4 text-lg outline-none">
                    @error('username')
                        <span class="font-medium text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <label for="email" class="font-medium text-xl">Email</label>
                <div class="mb-5">
                    <input name="email" type="email" placeholder="Email" value="{{ old('email') }}"
                        class="w-full border border-neutral-600 rounded-lg py-2 px-4 text-lg outline-none">
                    @error('email')
                        <span class="font-medium text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <label for="password" class="font-medium text-xl">Password</label>
                <div class="mb-5">
                    <input name="password" type="password"
                        placeholder="Password"class="w-full border border-neutral-600 rounded-lg py-2 px-4 text-lg outline-none">
                    @error('password')
                        <span class="font-medium text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <label for="password_confirmation" class="font-medium text-xl">Repeat Password</label>
                <input name="password_confirmation" type="password" placeholder="Password"
                    class="w-full border mb-5 border-neutral-600 rounded-lg py-2 px-4 text-lg outline-none">


                <div class="flex items-center justify-end gap-5">
                    <a href="{{ route('login.show') }}"
                        class="text-lg font-medium hover:underline underline-offset-3">Login</a>
                    <button type="submit"
                        class="w-max py-3 px-14 cursor-pointer bg-blue-500 hover:bg-blue-700 dark:hover:bg-yellow-700 duration-300 dark:bg-yellow-600 rounded-lg font-semibold text-2xl">Register</button>

                </div>
            </form>
        </div>
    </main>
</body>

</html>
