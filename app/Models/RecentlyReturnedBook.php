<?php
// app/Models/RecentlyReturnedBook.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentlyReturnedBook extends Model
{
    protected $fillable = [
        'borrowed_book_id',
        'user_id',
        'book_id',
        'returned_at',
    ];

    protected $casts = [
        'returned_at' => 'datetime',
    ];

    public function borrowedBook()
    {
        return $this->belongsTo(BorrowedBook::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
