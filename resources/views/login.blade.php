<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Stackio</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-[#f8f8f8] text-black dark:bg-[#0a0b0b] dark:text-white relative">
    <main class="h-screen flex items-center justify-center w-full bg-[#f8f8f8] dark:bg-[#0a0b0b] pt-20 px-4">
        <div class="w-[40%] bg-neutral-800 p-12 rounded-xl relative">
            <a href="{{ route('home') }}"
                class="absolute top-0 -left-2 -translate-x-full w-10 h-10 rounded-full flex items-center justify-center dark:bg-[#333333] bg-gray-300 dark:hover:bg-neutral-700 hover:bg-gray-400 cursor-pointer duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
            </a>
            <h1 class="text-5xl font-semibold tracking-wider mb-10">Login</h1>
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-2">
                @csrf

                <label for="email" class="font-medium text-xl">Email</label>
                <div class="mb-5">
                    <input name="email" type="email" placeholder="Email"
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
                <div class="flex items-center justify-end gap-5">
                    <a href="{{ route('register.show') }}"
                        class="text-lg font-medium underline underline-offset-3">Resigter</a>
                    <button type="submit"
                        class="w-max py-3 px-14 cursor-pointer bg-yellow-600 rounded-lg font-semibold text-2xl">Login</button>

                </div>
            </form>
        </div>
    </main>
</body>

</html>
