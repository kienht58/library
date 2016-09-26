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
        $book = Book::where('isbn', $isbn)->first();
        return view('books.show', compact('book'));
    }
}
