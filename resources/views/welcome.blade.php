@extends('layouts.welcome-layout')

@section('content')
    <h1 class="text-5xl font-bold text-center">Welcome to Crime Database</h1>
    <p class="text-xl mt-4">Stay informed and make your community safer. Search, report, and review crime data.</p>
    <div class="mt-8">
        <a href="{{ route('login') }}" class="text-white">Log in</a> |
        <a href="{{ route('register') }}" class="text-white">Register</a> |
        <a href="{{ route('about') }}" class="text-black dark:text-white">About Us</a>
    </div>
@endsection
