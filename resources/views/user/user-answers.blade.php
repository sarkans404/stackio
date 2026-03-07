@extends('layouts.app')

@section('title')
    {{ $user['name'] }}
@endsection

@section('content')
    <x-main-user :user="$user">
        answers
    </x-main-user>
@endsection
