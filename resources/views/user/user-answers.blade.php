@extends('layouts.app')

@section('title')
    {{ $user->username }}
@endsection

@section('content')
    <x-main-user :user="$user">
        <div class="max-w-200 h-160 mx-auto overflow-y-scroll scroll-smooth space-y-2">
            @foreach ($responses as $response)
                <x-responses-mini :response="$response" />
            @endforeach
        </div>
    </x-main-user>
@endsection
