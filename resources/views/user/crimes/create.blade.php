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

/* Flash message styles */
.flash-message {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background-color: green;
    color: white;
    padding: 12px 20px;
    border-radius: 5px;
    font-size: 1rem;
    display: none;
    z-index: 9999;
}
</style>

<div class="container">
    <h2 class="text-3xl font-semibold mb-6">Add Crime</h2>
    <form id="crimeForm" action="{{ auth()->user()->is_admin ? route('admin.crimes.store') : route('report.crime.store') }}" 
        method="POST" 
        class="bg-white p-6 rounded-lg shadow-lg">
  
        @csrf
        <div class="form-group mb-4">
            <label for="title" class="text-lg font-medium">Title</label>
            <input type="text" name="title" id="title" class="form-control" required placeholder="Enter the crime title">
        </div>
        <div class="form-group mb-4">
            <label for="description" class="text-lg font-medium">Description</label>
            <textarea name="description" id="description" class="form-control" required placeholder="Enter crime description"></textarea>
        </div>
        <div class="form-group mb-4">
            <label for="location" class="text-lg font-medium">Location</label>
            <input type="text" name="location" id="location" class="form-control" required placeholder="Enter the location">
        </div>
        <div class="form-group mb-4">
            <label for="reported_by" class="text-lg font-medium">Reported By</label>
            <input type="text" name="reported_by" id="reported_by" class="form-control" required placeholder="Enter reporter's name">
        </div>
        <button type="submit" class="btn btn-primary w-full py-2 px-4 rounded-md bg-blue-600 text-white text-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">Submit</button>
    </form>
</div>

<!-- Flash Message -->
<div id="flashMessage" class="flash-message">
    Crime Data Submitted, wait for approval
</div>

<script>
document.getElementById('crimeForm').addEventListener('submit', function() {
    setTimeout(function() {
        let flashMessage = document.getElementById('flashMessage');
        flashMessage.style.display = 'block';
        setTimeout(() => flashMessage.style.display = 'none', 3000);
    }, 500);
});
</script>

@endsection
