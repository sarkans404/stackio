@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section
        class="main-content grid grid-cols-1 gap-10 duration-300 translate-x-20 sm:grid-cols-[2fr_1fr] max-w-7xl h-max mx-auto">
        <div class="">
            @forelse ($questions as $question)
                <x-post-card :question="$question" />
                <x-post-card :question="$question" />
                <x-post-card :question="$question" />
                <x-post-card :question="$question" />
            @empty
                <p class="text-center my-10">No questions found.</p>
            @endforelse
        </div>

        <x-aside-card :question="$question" />

    </section>
@endsection
