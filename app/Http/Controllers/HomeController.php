<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
