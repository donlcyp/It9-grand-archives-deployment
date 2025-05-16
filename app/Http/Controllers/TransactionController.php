<?php
// app/Http/Controllers/TransactionController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowedBook;
use App\Models\Transaction;
use App\Models\RecentlyReturnedBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        // Fetch all borrowed books for the user
        $borrowedBooks = BorrowedBook::where('user_id', $user->id)
            ->with('book')
            ->orderBy('borrowed_at', 'desc')
            ->get();

        // Calculate late fees dynamically for each borrowed book
        foreach ($borrowedBooks as $borrowedBook) {
            $borrowedBook->late_fee = $borrowedBook->calculateLateFee();
            $borrowedBook->save();
        }

        // Fetch books that are due (not returned yet and past due date)
        $dueBooks = BorrowedBook::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->where('due_date', '<', now())
            ->with('book')
            ->get();

        // Fetch recently returned books from recently_returned_books table
        $returnedBooks = RecentlyReturnedBook::where('user_id', $user->id)
            ->with('book')
            ->orderBy('returned_at', 'desc')
            ->take(100)
            ->get();

        // Calculate total due amount from late fees
        $dueAmount = $borrowedBooks->whereNull('returned_at')->sum('late_fee');

        // Fetch payment history
        $paymentHistory = Transaction::where('user_id', $user->id)
            ->where('type', 'payment')
            ->orderBy('created_at', 'desc')
            ->take(100)
            ->get();

        return view('transactions', compact('borrowedBooks', 'dueBooks', 'returnedBooks', 'dueAmount', 'paymentHistory'));
    }
}