<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutController extends Controller
{
    public function index()
    {
        $aboutText = AboutUs::value('text');
        return view('about', compact('aboutText'));
    }

    public function edit()
    {
        $aboutText = AboutUs::value('text');
        return view('admin.about.edit', compact('aboutText'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);
    
        // Check if the 'about_us' table has any record
        $aboutUs = AboutUs::first();
    
        if ($aboutUs) {
            // Update the existing record
            $aboutUs->update(['text' => $request->text]);
        } else {
            // Create a new record if the table is empty
            AboutUs::create(['text' => $request->text]);
        }
    
        return redirect()->route('admin.about.edit')->with('success', 'About Us content updated successfully.');
    }
    
}
