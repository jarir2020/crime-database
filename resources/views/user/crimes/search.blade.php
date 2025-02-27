<!-- resources/views/admin/crimes/search.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-6 sm:p-8 bg-white shadow rounded-lg">
            <h2 class="text-xl font-medium text-gray-900">Search Crimes</h2>
            <form method="GET" action="{{ route('user.crimes.search') }}" class="mt-4 flex space-x-4">
             <div style="display:block; gap:2px;">

                <input type="text" style="width:309px;" name="search" class="form-input" placeholder="Search by Title, Description, or Location" value="{{ request()->input('search') }}">

                <button type="submit" style="background-color: #04AA6D; border: none; color: white; padding: 8px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;">Search</button>
               
                <button style="background-color: #04AA6D; border: none; color: white; padding: 8px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;"> <a href="{{ route('admin.crimes.search') }}">
                    Refresh</a>
                </button>
                
            </div>
            </form>

            @if($crimes->isEmpty())
                <p class="mt-4 text-gray-600">No crimes found matching your search.</p>
            @else
                <table class="mt-4 w-full table-auto border-collapse">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Title</th>
                            <th class="border px-4 py-2">Description</th>
                            <th class="border px-4 py-2">Location</th>
                            <th class="border px-4 py-2">Reported By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($crimes as $crime)
                            <tr>
                                <td class="border px-4 py-2">{{ $crime->title }}</td>
                                <td class="border px-4 py-2">{{ $crime->description }}</td>
                                <td class="border px-4 py-2">{{ $crime->location }}</td>
                                <td class="border px-4 py-2">{{ $crime->reported_by }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
