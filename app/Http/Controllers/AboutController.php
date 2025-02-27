<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index()
    {
        $aboutText = DB::table('about_us')->value('text');
        return view('about', compact('aboutText'));
    }

    public function edit()
    {
        $aboutText = DB::table('about_us')->value('text');
        return view('admin.about.edit', compact('aboutText'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);
    
        // Check if the 'about_us' table has any record
        $aboutUs = DB::table('about_us')->first();
    
        if ($aboutUs) {
            // Update the existing record
            DB::table('about_us')->update(['text' => $request->text]);
        } else {
            // Create a new record if the table is empty
            DB::table('about_us')->insert(['text' => $request->text]);
        }
    
        return redirect()->route('admin.about.edit')->with('success', 'About Us content updated successfully.');
    }
    
}
