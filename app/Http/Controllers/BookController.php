<?php

namespace App\Http\Controllers;
use App\Services\BookServices;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function __construct()
    {
        $this->bookService = app(BookServices::class);
    }

    public function store(Request $request) {
        $upload = $this->bookService->store($request);
        if($upload !== true) {
            return response()->json([
                'status' => 422,
                'message' => $upload,
                'data' => []
            ]);
        }
        else {
            return response()->json([
                'status' => 200,
                'message' => 'SUCCESS',
                'data' => []
            ]);
           
        }  
     
      
    }

    public function getOneBook($book_id) {
        $book = $this->bookService->getOneBook($book_id);
        if($book) {
            // tạm thời trả ở đây trả về kết quả dạng json, về sau sẽ được thay thế thành trả về view và data
            return response()->json([
                'status' => 200,
                'message' => 'SUCCESS',
                'data' => $book->toArray()
            ]);
        }
        else return response()->json([
            'status' => 404,
            'message' => 'THE BOOK WITH ID:'.$book_id.' IS NOT EXIST IN THE DATABASE',
            'data' => []
        ]);
        return $book;
    }
}
