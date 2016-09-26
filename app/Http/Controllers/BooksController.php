<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Book;
use App\Http\Requests;
class BooksController extends Controller
{
    public function index() {
        $books = Book::all();
        return view('books.index', compact('books'));
    }
    public function show($isbn) {
        $length = strlen($isbn);
        if($length == 10) {
            $book = Book::where('isbn10', $isbn)->first();
        } else if($length == 13) {
            $book = Book::where('isbn13', $isbn)->first();
        }
        return view('books.show', compact('book'));
    }
}
