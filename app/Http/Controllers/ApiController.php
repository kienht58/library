<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Book;
use App\Http\Requests;
class ApiController extends Controller
{
    public function index() {
        $books = Book::all();
        return response()->json([
            'books' => $books
        ]);
    }
    public function show() {
        $data = $_GET;
        $book = Book::where('id', $data['id'])->first();
        return response()->json([
            'book' => $book
        ]);
    }
    public function create(Request $request) {
        $data = $request->all();
        $book = new Book;
        $book->isbn = $data['isbn'];
        $book->name = $data['name'];
        $book->description = $data['description'];
        $book->save();
        return response()->json([
            'id' => $book->id
        ]);
    }
    public function edit(Request $request) {
        $data = $request->all();
        $book = Book::where('id', $data['id'])->first();
        $book->isbn = $data['isbn'];
        $book->name = $data['name'];
        $book->description = $data['description'];
        $book->save();
        return response()->json([
            'id' => $book->id
        ]);
    }
    public function destroy(Request $request) {
        $data = $request->all();
        $book = Book::where('id', $data['id'])->first();
        $book->delete();
        return response()->json([
            'msg' => 'completed!'
        ]);
    }
}
