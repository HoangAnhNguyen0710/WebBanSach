<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\GetBookListRequest;
use App\Services\BookServices;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    protected $bookService;
    public function __construct()
    {
        $this->bookService = app(BookServices::class);
    }

    public function store(CreateBookRequest $request)
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

    public function getOneBook($id)
    {
        $book = $this->bookService->getOne($id);
        if ($book) {
            return view('bookDetail', compact('book'));
        }
        $message = 'THE BOOK WITH ID:' . $id . ' IS NOT EXIST';
        return view('bookDetail', compact('message'));
    }

    public function getBooksBy(Request $request)
    {
        $find = $this->bookService->getBooksBy($request);
        if ($find == []) {
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
