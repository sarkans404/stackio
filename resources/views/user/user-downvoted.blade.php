@extends('layouts.app')

@section('title')
    {{ $user->username }}
@endsection

@section('content')
    <x-main-user :user="$user">
        <div class="max-w-200 max-h-250 mx-auto pr-2 overflow-y-scroll scroll-smooth">
            @foreach ($questions as $question)
                <x-vote-card :question="$question" />
            @endforeach
        </div>
    </x-main-user>
@endsection
