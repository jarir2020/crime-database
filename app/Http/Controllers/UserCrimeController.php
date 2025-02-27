<?php

namespace App\Http\Controllers;

use App\Models\Crime;
use Illuminate\Http\Request;

class UserCrimeController extends Controller
{

    public function index()
    {
        $crimes = Crime::where('is_approved', true)->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.crimes.index', compact('crimes'));
    }
    

    public function create()
    {
        return view('user.crimes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'reported_by' => 'required',
        ]);

        Crime::create($request->all() + ['is_approved' => false]);

        return redirect()->route('report.new.crime')->with('success', 'Crime report submitted for approval');
    }

    public function search(Request $request)
{
    \Log::info('Search Request Received', ['query' => $request->input('search')]);

    $searchTerm = $request->input('search');

    $crimes = Crime::where('is_approved', true)
                   ->where(function ($query) use ($searchTerm) {
                        $query->where('title', 'like', '%' . $searchTerm . '%')
                              ->orWhere('description', 'like', '%' . $searchTerm . '%')
                              ->orWhere('location', 'like', '%' . $searchTerm . '%');
                   })
                   ->get();

    \Log::info('Search Results:', ['count' => $crimes->count()]);

    return view('user.crimes.search', compact('crimes'));
}

public function ajaxSearch(Request $request)
{
    $searchTerm = $request->input('search');

    \Log::info('Search Term:', ['search' => $searchTerm]);

    $crimes = Crime::where('is_approved', true)
                   ->where(function ($query) use ($searchTerm) {
                        $query->where('title', 'like', '%' . $searchTerm . '%')
                              ->orWhere('description', 'like', '%' . $searchTerm . '%')
                              ->orWhere('location', 'like', '%' . $searchTerm . '%');
                   })
                   ->get();

    return response()->json(['crimes' => $crimes]);
}

}
