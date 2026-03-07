@extends('layouts.app')

@section('title')
    {{ $user['name'] }}
@endsection

@section('content')
    <x-main-user :user="$user">
        <div class="max-w-200 h-160 mx-auto overflow-y-scroll scroll-smooth">
            <x-post-card :question="$user" />
            <x-post-card :question="$user" />
            <x-post-card :question="$user" />
        </div>
    </x-main-user>
@endsection
