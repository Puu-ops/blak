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
            'coverImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure coverImage field name matches form input
        ]);

        // Handle file upload
        if ($request->hasFile('coverImage')) {
            $image = $request->file('coverImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/cover_images'), $imageName); // Move image to public storage/cover_images directory
        }

        // Store book in database
        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'description' => $request->description,
            'cover_image' => 'storage/cover_images/' . $imageName, // Save path to cover image in database
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
