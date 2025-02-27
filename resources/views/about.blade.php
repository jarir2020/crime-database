@extends('layouts.welcome-layout')

@section('content')
    <div class="max-w-2xl mx-auto p-6 text-center">
        <h1 class="text-4xl font-bold mb-4">About Us</h1>
        <p class="text-lg text-gray-700 dark:text-gray-300">{{ $aboutText }}</p>
    </div>
@endsection
