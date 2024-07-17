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
            'coverImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // corrected field name to 'coverImage'
        ]);

        // Handle file upload
        if ($request->hasFile('coverImage')) {
            $image = $request->file('coverImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/books'), $imageName);
            $coverImagePath = 'images/books/' . $imageName;
        }

        // Store book in database
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'description' => $request->description,
            'cover_image' => $coverImagePath, // Ensure to use the correct variable name
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
