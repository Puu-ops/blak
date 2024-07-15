<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    //
    public function showDetails($book_id)
    {
    $book = Book::findOrFail($book_id); // เรียกหนังสือที่ต้องการยืมจาก Book model

    return view('borrow.details', compact('book'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'return_days' => 'required|integer|in:3,7,14',
        ]);

        // ตรวจสอบว่าผู้ใช้งานได้ยืมหนังสือเล่มนี้แล้วหรือไม่
        $existingBorrow = Borrow::where('user_id', auth()->id())
                                ->where('book_id', $validatedData['book_id'])
                                ->first();

        if ($existingBorrow) {
            return redirect()->back()->with('error', 'คุณได้ยืมหนังสือเล่มนี้ไปแล้ว');
        }

        $borrow = new Borrow();
        $borrow->book_id = $validatedData['book_id'];
        $borrow->user_id = auth()->id(); // ใช้ user ที่ล็อกอินในปัจจุบัน
        $borrow->borrowed_at = now();
        $borrow->return_by = now()->addDays((int) $validatedData['return_days']);
        $borrow->save();

        return redirect()->route('dashboard')->with('alert', 'ยืมหนังสือสำเร็จ!');

    }

    public function borrowStatus()
    {
        $borrows = Borrow::where('user_id', auth()->id())->whereNotNull('borrowed_at')->whereNull('returned_at')->get();

        return view('borrow.status', compact('borrows'));
    }

    public function returnBook($bookId)
    {
    $borrow = Borrow::where('user_id', auth()->id())
                    ->where('book_id', $bookId)
                    ->whereNotNull('borrowed_at')
                    ->whereNull('returned_at')
                    ->first();

    if (!$borrow) {
        abort(404);
    }

    $borrow->returned_at = now();
    $borrow->save();

    return redirect()->route('borrow.status')->with('success', 'คืนหนังสือสำเร็จแล้ว');
    }

    public function history()
    {
        $borrows = Borrow::where('user_id', Auth::id())->orderBy('borrowed_at', 'desc')->get();

        return view('borrow.history', compact('borrows'));
    }

    public function allBorrow()
    {
        $borrows = Borrow::with('user', 'book')->orderBy('borrowed_at', 'desc')->get();

        return view('borrow.all-borrows', compact('borrows'));
    }


}
