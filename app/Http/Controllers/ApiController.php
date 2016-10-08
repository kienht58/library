<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Book;
use App\Http\Requests;
class ApiController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $books = Book::all();
        if(sizeof($books)) {
            return response()->json([
                "error" => false,
                'books' => $books
            ]);
        } else {
            return response()->json([
                'error' => true,
                'msg' => "Danh sách rỗng!"
            ]);
        }

    }

    public function show() {
        $data = $_GET;
        if(isset($data) && isset($data['id']) && $data['id'] != "") {
            $book = Book::where('id', $data['id'])->first();
            if($book) {
                return response()->json([
                    'error' => false,
                    'book' => $book
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'msg' => 'Không tìm thấy sách! Vui lòng thử lại sau!'
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'msg' => 'ID không hợp lệ! Vui lòng kiểm tra lại!'
            ]);
        }
    }

    public function create(Request $request) {
        if(\Auth::user()->is_librarian) {
            $data = $request->all();
            $validator = \Validator::make($data, [
                'isbn10' => 'required|unique:books|string|size:10',
                'isbn13' => 'required|unique:books|string|size:13',
                'name' => 'required|string',
                'author' => 'required|string',
                'description' => 'string'
            ], [
                'isbn10.required' => 'Mã ISBN10 không được để trống!',
                'isbn10.unique' => 'Mã ISBN10 đã tồn tại!',
                'isbn10.size' => 'Mã ISBN10 không chính xác!',
                'isbn13.required' => 'Mã ISBN13 không được để trống!',
                'isbn13.unique' => 'Mã ISBN13 đã tồn tại!',
                'isbn13.size' => 'Mã ISBN13 không chính xác!',
                'name.required' => 'Tên sách không được để trống!',
                'author.required' => 'Tên tác giả không được để trống'
            ]);
            if($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'msg' => $validator->errors()->all()
                ]);
            }

            $book = new Book;
            $book->isbn10 = $data['isbn10'];
            $book->isbn13 = $data['isbn13'];
            $book->name = $data['name'];
            $book->author = $data['author'];
            $book->description = isset($data['description']) ? $data['description'] : "";
            if($book->save()) {
                return response()->json([
                    'error' => false,
                    'id' => $book->id
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'msg' => 'Có lỗi trong quá trình tạo! Vui lòng thử lại!'
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'msg' => 'Bạn không có quyền thực hiện hành động này!'
            ]);
        }
    }
    public function edit(Request $request) {
        if(\Auth::user()->is_librarian) {
            $data = $request->all();
            if(isset($data)) {
                $validator = \Validator::make($data, [
                    'isbn10' => 'required|unique:books|string|size:10',
                    'isbn13' => 'required|unique:books|string|size:13',
                    'name' => 'required|string',
                    'author' => 'required|string',
                    'description' => 'string'
                ], [
                    'isbn10.required' => 'Mã ISBN10 không được để trống!',
                    'isbn10.unique' => 'Mã ISBN10 đã tồn tại!',
                    'isbn10.size' => 'Mã ISBN10 không chính xác!',
                    'isbn13.required' => 'Mã ISBN13 không được để trống!',
                    'isbn13.unique' => 'Mã ISBN13 đã tồn tại!',
                    'isbn13.size' => 'Mã ISBN13 không chính xác!',
                    'name.required' => 'Tên sách không được để trống!',
                    'author.required' => 'Tên tác giả không được để trống'
                ]);

                if($validator->fails()) {
                    return $validator->errors()->all();
                }

                if(isset($data['id']) && $data['id'] != "") {
                    $book = Book::where('id', $data['id'])->first();
                    if($book) {
                        $book->isbn10 = $data['isbn10'];
                        $book->isbn13 = $data['isbn13'];
                        $book->name = $data['name'];
                        $book->author = $data['author'];
                        $book->description = isset($data['description']) ? $data['description'] : "";

                        if($book->save()) {
                            return response()->json([
                                'error' => false,
                                'id' => $book->id
                            ]);
                        } else {
                            return response()->json([
                                'error' => true,
                                'msg' => 'Có lỗi trong quá trình cập nhật. Vui lòng thử lại sau!'
                            ]);
                        }
                    } else {
                        return response()->json([
                            'error' => true,
                            'msg' => 'Không tìm thấy sách đã yêu cầu!'
                        ]);
                    }
                } else {
                    return response()->json([
                        'error' => true,
                        'msg' => 'ID không hợp lệ! Vui lòng kiểm tra lại!'
                    ]);
                }
            }
        } else {
            return response()->json([
                'error' => true,
                'msg' => 'Bạn không có quyền thực hiện hành động này!'
            ]);
        }
    }

    public function destroy(Request $request) {
        if(\Auth::user()->is_librarian) {
            $data = $request->all();
            $book = Book::where('id', $data['id'])->first();
            if($book) {
                if($book->delete()) {
                    return response()->json([
                        'error' => false,
                        'msg' => 'Xóa thành công!'
                    ]);
                } else {
                    return response()->json([
                        'error' => true,
                        'msg' => 'Có lỗi trong quá trình xóa. Vui lòng thử lại sau!'
                    ]);
                }
            } else {
                return response()->json([
                    'error' => true,
                    'msg' => 'Không tìm thấy sách đã yêu cầu!'
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'msg' => 'Bạn không có quyền thực hiện hành động này!'
            ]);
        }
    }
}
