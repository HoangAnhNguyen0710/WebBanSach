<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetBookListRequest;
use App\Services\BookServices;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function __construct()
    {
        $this->bookService = app(BookServices::class);
    }

    public function store(Request $request)
    {
        $upload = $this->bookService->store($request);

        if ($upload !== true) {
            return response()->json([
                'status' => 422,
                'message' => $upload,
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => []
        ]);
    }
    public function getBookList(GetBookListRequest $request)
    {
        $params = $request->all();
        $pageNum = $params['page'];
        $itemsPerPage = null;

        if ($request->has('items_per_page')) {
            $itemsPerPage = $params['items_per_page'];
        }

        $filterCol = $request->has('filter_col');
        $filterValue = $request->has('filter_value');

        if ($filterCol && $filterValue) {
            $filterCol = $params['filter_col'];

            $filterValue = $params['filter_value'];
        } else {
            $filterCol = null;
        }

        try {
            $list = $this->bookService->getListOfBooks($pageNum, $itemsPerPage, $filterCol, $filterValue);

            return response()->json(['status' => 200, 'data' => $list]);
        } catch (\Exception $e) {
            throw new \Exception($e);

            return response()->json(['status' => 400, 'data' => []]);
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

    public function getBooksBy(Request $request) {
        $find = $this->bookService->getBooksBy($request);
        if($find == []) {
            return response()->json([
                'status' => 404,
                'message' => 'NOT FOUND',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => $find
        ]);
    }
}
