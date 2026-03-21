@extends('layouts.app')

@section('title')
    {{ $user->username }}
@endsection

@section('content')
    <x-main-user :user="$user">
        <div>
            <div class="flex items-center gap-4 mb-5">
                <span
                    class="py-2 px-4 {{ $user->reputation > 100 ? 'dark:bg-yellow-600 bg-blue-500' : 'dark:bg-[#af9204] bg-cyan-500' }} font-medium dark:text-neutral-100 rounded-lg">
                    {{ $user->reputation }} reputation</span>
                <span class="py-2 px-4 dark:bg-neutral-600 bg-gray-300 dark:text-neutral-100 font-medium rounded-lg">
                    {{ $answerQty }} answers</span>
                <span class="py-2 px-4 dark:bg-neutral-600 bg-gray-300 dark:text-neutral-100 font-medium rounded-lg">
                    {{ $questionQty }} questions</span>
                <span class="py-2 px-4 dark:bg-neutral-600 bg-gray-300 dark:text-neutral-100 font-medium rounded-lg">
                    {{ $upvoteQty }} upvotes</span>
                <span class="py-2 px-4 dark:bg-neutral-600 bg-gray-300 dark:text-neutral-100 font-medium rounded-lg">
                    {{ $downvoteQty }} downvotes</span>
                @if ($user->id === Auth::id())
                    <form action="{{ route('logout') }}" method="post" class="ml-auto">
                        @csrf
                        <button type="submit"
                            class=" bg-red-500 py-2 px-6 rounded-lg font-semibold hover:bg-red-700 text-white duration-300">Logout</button>
                    </form>
                @endif
            </div>
            <div>
                <h2 class="font-semibold text-3xl mb-2">About</h2>
                @if ($user->bio)
                    <p class="dark:text-neutral-100 text-neutral-700">{{ $user->bio }}</p>
                @else
                    <p class="dark:text-neutral-100 text-neutral-700">You can add bio...</p>
                @endif
            </div>
        </div>
    </x-main-user>
@endsection
