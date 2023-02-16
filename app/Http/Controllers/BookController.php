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

        $sortCol = $request->has('sort_col');
        $sortValue = $request->has('sort_value');

        if ($sortCol && $sortValue) {
            $sortCol = $params['sort_col'];

            $sortValue = $params['sort_value'];
        } else {
            $sortCol = 'updated_at';
            $sortValue = 'desc';
        }

        try {
            $list = $this->bookService->getListOfBooks($pageNum, $itemsPerPage, $filterCol, $filterValue, $sortCol, $sortValue);

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

    public function addToCart($id)
    {
        $book = $this->bookService->getOneBook($id);
        if (!$book) {
            abort(404);
        } else {
            $cart = session()->get('cart');
            if (!$cart) {
                //this part of function, get product that chsen by user or request
                $cart[$book['name']] = [
                    "book_id" => $book['id'],
                    "quantity" => 1,
                    "price" => $book['price'],
                    "discount_price" => $book['discount_price']
                ];
                session()->put('cart', $cart);

                return redirect()->back()->with('success', 'Book added to cart successfully!');
            }

            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;

                session()->put('cart', $cart);

                return redirect()->back()->with('success', 'Book added to cart successfully!');
            }

            // if item not exist in cart then add to cart with quantity = 1
            $cart[$book['name']] = [
                "book_id" => $book['id'],
                "quantity" => 1,
                "price" => $book['price'],
                "discount_price" => $book['discount_price']
            ];

            session()->put('cart', $cart); // this code put product of choose in cart

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }

    public function updateCart(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = (int)$request->quantity;
            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }


    // delete or remove product of choose in cart
    public function removeCart(Request $request)
    {
        if ($request->id) {

            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
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
