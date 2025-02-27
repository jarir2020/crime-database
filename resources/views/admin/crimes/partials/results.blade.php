@if($crimes->isEmpty())
    <p class="mt-4 text-gray-600">No crimes found.</p>
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
