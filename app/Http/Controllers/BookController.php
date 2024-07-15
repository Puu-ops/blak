<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        // Validation logic
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string', // Validate description field
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $coverImagePath = null;
        if ($request->hasFile('image')) {
            $coverImagePath = $request->file('image')->store('cover_images', 'public');
        }

        // Store book in database
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'description' => $request->description, // Ensure description field is included
            'cover_image' => $coverImagePath,
        ]);
        // Redirect back with success message
        return redirect()->route('books.create')->with('success', 'Book added successfully.');
    }

    public function index()
    {
        $books = Book::all();
        return view('staff.dashboard', compact('books'));
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }


}
