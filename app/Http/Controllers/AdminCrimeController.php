<?php

namespace App\Http\Controllers;

use App\Models\Crime;
use Illuminate\Http\Request;

class AdminCrimeController extends Controller
{
    public function index()
    {
        $crimes = Crime::orderBy('created_at', 'desc')->paginate(5); // 5 crimes per page
        return view('admin.crimes.index', compact('crimes'));
    }
    public function approve($id) {
        Crime::where('id', $id)->update(['is_approved' => true]);
        return redirect()->back()->with('success', 'Crime approved');
    }

    public function disapprove($id) {
        Crime::where('id', $id)->update(['is_approved' => false]);
        return redirect()->back()->with('success', 'Crime disapproved');
    }

    public function create() {
        return view('admin.crimes.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'reported_by' => 'required',
        ]);

        Crime::create($request->all() + ['is_approved' => true]);

        return redirect()->route('admin.crimes.index')->with('success', 'Crime added');
    }

    public function edit($id) {
        $crime = Crime::findOrFail($id);
        return view('admin.crimes.edit', compact('crime'));
    }

    public function update(Request $request, $id) {
        $crime = Crime::findOrFail($id);
        $crime->update($request->all());
        return redirect()->route('admin.crimes.index')->with('success', 'Crime updated');
    }

    public function destroy($id) {
        Crime::destroy($id);
        return redirect()->back()->with('success', 'Crime deleted');
    }


    public function search(Request $request)
    {
        \Log::info('Search Request Received', ['query' => $request->input('search')]);

        $searchTerm = $request->input('search');

        $crimes = Crime::where('title', 'like', '%' . $searchTerm . '%')
                       ->orWhere('description', 'like', '%' . $searchTerm . '%')
                       ->orWhere('location', 'like', '%' . $searchTerm . '%')
                       ->get();

        \Log::info('Search Results:', ['count' => $crimes->count()]);

        return view('admin.crimes.search', compact('crimes'));
    }

    public function ajaxSearch(Request $request)
    {
        $searchTerm = $request->input('search');

        // Log the query for debugging purposes (optional)
        \Log::info('Search Term:', ['search' => $searchTerm]);

        $crimes = Crime::where('title', 'like', '%' . $searchTerm . '%')
                       ->orWhere('description', 'like', '%' . $searchTerm . '%')
                       ->orWhere('location', 'like', '%' . $searchTerm . '%')
                       ->get();

        return response()->json(['crimes' => $crimes]);
    }



}
