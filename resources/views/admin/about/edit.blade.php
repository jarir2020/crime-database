@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-3xl font-semibold mb-4">Edit About Us</h1>

        @if(session('success'))
            <div class="mb-4 p-3 text-white bg-green-600 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.about.update') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="text" class="block text-lg font-medium">About Us Text</label>
                <textarea name="text" id="text" rows="6" class="w-full p-3 border rounded">{{ old('text', $aboutText) }}</textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">Save Changes</button>
        </form>
    </div>
@endsection
