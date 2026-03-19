@extends('layouts.app')

@section('title')
    {{ Auth::user()->username }}
@endsection

@section('content')
    <x-main-user :user="$user">
        <div class="max-w-200 h-160 mx-auto overflow-y-scroll scroll-smooth">
            @foreach ($questions as $question)
                <x-post-mini :question="$question" :userSaved="$userSaved" />
            @endforeach
        </div>
    </x-main-user>
@endsection
