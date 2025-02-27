@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="container my-5">
        <h2 class="text-center mb-4">Crime Reports</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover shadow-sm mx-auto" style="max-width: 1200px; border-collapse: collapse;">
                <thead class="table-dark">
                    <tr>
                        <th class="border px-4 py-2">Title</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2">Location</th>
                        <th class="border px-4 py-2">Reported By</th>
                        <th class="border px-4 py-2">Status</th>
                        @if(auth()->user()->is_admin)
                            <th class="text-center border px-4 py-2">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($crimes as $crime)
                    <tr>
                        <td class="border px-4 py-2">{{ $crime->title }}</td>
                        <td class="border px-4 py-2">{{ Str::limit($crime->description, 70) }}</td>
                        <td class="border px-4 py-2">{{ $crime->location }}</td>
                        <td class="border px-4 py-2">{{ $crime->reported_by }}</td>
                        <td class="border px-4 py-2">
                            <span class="badge {{ $crime->is_approved ? 'bg-success' : 'bg-warning' }} text-black">
                                {{ $crime->is_approved ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        @if(auth()->user()->is_admin)
                        <td class="text-center border px-4 py-2">
                            <div class="btn-group" role="group" aria-label="Crime Actions">
                                <a href="{{ route('admin.crimes.edit', $crime->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.crimes.destroy', $crime->id) }}" method="POST" class="d-inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                                @if(!$crime->is_approved)
                                    <form action="{{ route('admin.crimes.approve', $crime->id) }}" method="POST" class="d-inline-block">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.crimes.disapprove', $crime->id) }}" method="POST" class="d-inline-block">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-times"></i> Disapprove
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $crimes->links() }}
        </div>
    </div>

</div>
@endsection
