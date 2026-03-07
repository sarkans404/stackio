@extends('layouts.app')

@section('title', 'Search')

@section('content')
    <section class="main-content duration-300 translate-x-20 max-w-4xl h-max mx-auto">
        <h2 class="text-2xl font-semibold">Searched text: "{{ request()->get('search') }}"</h2>
        <div>
            @forelse ($questions as $question)
                <x-post-card :question="$question" />
            @empty
                <p class="text-center my-10">No questions found.</p>
            @endforelse
        </div>
    </section>
@endsection
