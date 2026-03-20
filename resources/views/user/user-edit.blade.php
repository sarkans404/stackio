@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <section class="main-content max-w-150 translate-x-0 mx-auto my-15 duration-300">
        <h2 class="font-semibold dark:text-gray-200 mb-6 text-4xl -ml-6">Edit Profile</h2>
        <form id="formEdit" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data"
            class="w-full rounded-3xl mb-20">
            @csrf
            <div class="relative w-max h-max mb-5">
                <div class="h-40 w-40 dark:bg-neutral-400 flex items-center justify-center bg-gray-400 rounded-full">
                    <img id="avatarPreview" class="w-full h-full rounded-full object-cover"
                        src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://placeholdit.com/200x200/dddddd/999999?text=Avatar' }}">
                </div>
                <div class="absolute bottom-0 right-0">
                    <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden">
                    <label for="avatarInput"
                        class="border-3 border-[#f8f8f8] dark:border-[#0a0b0b] w-11 h-11 flex items-center justify-center dark:bg-neutral-800 text-neutral-700 dark:text-white bg-gray-300 rounded-full dark:hover:bg-neutral-700 hover:bg-gray-500 duration-300 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </label>
                </div>
            </div>
            <div id="avatarError">
                @error('avatar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <label for="name" class="text-lg font-semibold mb-1 inline-block">Your Name</label>
            <div>
                <input type="text" name="username" id="username" placeholder="Name" value="{{ $user->username }}"
                    class="border text-lg px-5 py-4 dark:border-neutral-600 mb-6 focus:border-neutral-300 dark:focus:border-neutral-500 duration-300 border-neutral-400 w-full rounded-2xl outline-none">
                @error('username')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <label for="bio" class="text-lg font-semibold mb-1 inline-block">About You</label>
            <div>
                <textarea name="bio" id="bio" placeholder="About"
                    class="mb-6 border min-h-30 p-4 dark:border-neutral-600 focus:border-neutral-300 dark:focus:border-neutral-500 border-neutral-400 w-full rounded-2xl outline-none">{{ $user->bio }}</textarea>
                @error('bio')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <label for="email" class="text-lg font-semibold mb-1 inline-block">Email</label>
            <input type="email" readonly name="email" id="email" placeholder="Name" value="{{ $user->email }}"
                class="border text-lg px-5 py-4 dark:bg-neutral-900 dark:text-neutral-400 text-neutral-700 bg-neutral-200 cursor-not-allowed select-none dark:border-neutral-600 mb-8 duration-300 border-neutral-400 w-full rounded-2xl outline-none">
        </form>

        <div class="flex item-center justify-end">
            <div class="space-x-4 flex item-center">
                <form action="{{ route('user.delete') }}" method="post">
                    @csrf
                    @method('delete')

                    <input type="hidden" name="user_id" value="{{ $user->id }}" class="hidden">
                    <button type="submit"
                        class="px-6 py-2.5 text-lg font-semibold rounded-xl bg-red-500 hover:bg-red-700 duration-300 cursor-pointer">Delete
                        Account</button>

                </form>

                <button type="submit" form="formEdit"
                    class="px-6 py-2 text-lg font-semibold rounded-xl dark:bg-yellow-600 bg-blue-500 hover:bg-blue-600 dark:hover:bg-yellow-700 duration-300 cursor-pointer">Update</button>
            </div>
        </div>
    </section>
@endsection
