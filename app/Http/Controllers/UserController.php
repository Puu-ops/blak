<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class UserController extends Controller
{
    public function index()
    {
        $books = Book::all(); // Example query to fetch books, adjust as per your application logic
        return view('dashboard', compact('books'));
    }
}