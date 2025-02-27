@extends('layouts.app')

@section('content')
<style>
    /* Custom Styles */
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-control {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 1rem;
    transition: border-color 0.2s ease-in-out;
}

.form-control:focus {
    border-color: #3b82f6;
    outline: none;
}

textarea.form-control {
    min-height: 150px;
    resize: vertical;
}

button[type="submit"] {
    background-color: #1D4ED8; /* Primary Blue */
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    font-size: 1.125rem;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #2563EB;
}

button[type="submit"]:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
}
</style>
<div style="margin-top:5px;"></div>
<h2 class="text-2xl font-semibold text-gray-800 mb-6" style="margin-left:330px;">Edit Crime</h2>
<div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg max-w-xl">
    <form action="{{ route('admin.crimes.update', $crime->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
            <input type="text" name="title" id="title" class="form-control w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $crime->title }}" required>
        </div>

        <div class="form-group mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" id="description" class="form-control w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $crime->description }}</textarea>
        </div>

        <div class="form-group mb-4">
            <label for="location" class="block text-gray-700 font-medium mb-2">Location</label>
            <input type="text" name="location" id="location" class="form-control w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $crime->location }}" required>
        </div>

        <div class="form-group mb-4">
            <label for="reported_by" class="block text-gray-700 font-medium mb-2">Reported By</label>
            <input type="text" name="reported_by" id="reported_by" class="form-control w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $crime->reported_by }}" required>
        </div>

        <button type="submit" class="btn btn-warning w-full bg-yellow-500 text-black py-2 rounded-md hover:bg-yellow-600 transition ease-in-out duration-200">
            Update
        </button>
    </form>
</div>
@endsection
