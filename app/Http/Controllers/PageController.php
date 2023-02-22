<?php

namespace App\Http\Controllers;

use App\Services\BookServices;
use App\Services\CategoryServices;
use App\Services\OrderServices;
use App\Services\PublisherServices;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    protected $bookService;
    protected $categoryService;
    protected $publisherService;
    protected $orderService;
    public function __construct()
    {
        $this->bookService = app(BookServices::class);
        $this->categoryService = app(CategoryServices::class);
        $this->publisherService = app(PublisherServices::class);
        $this->orderService = app(OrderServices::class);
    }

    public function home() {
        $recentBook = $this->bookService->getListOfBooks(1, 4, null, null);
        $bestSellerBook = $this->bookService->getListOfBooks(1, 4, null, null, 'sold', 'desc');
        $categoryList = $this->categoryService->getAllWithColumnList(['id', 'category_name']);
        $bookByCategory = $categoryList;
        foreach($categoryList as $offset => $category) {
            $bookByCategory[$offset]['list'] = $this->bookService->getListOfBooks(1, 2, 'category_id' , $bookByCategory[$offset]['id'])->toArray()['data'];
        }
        return view('home', compact('recentBook', 'bestSellerBook', 'bookByCategory', 'categoryList'));
    }

    public function filter(Request $request) {
        if($request->only('page'))
        $pageNum = $request->only('page')['page'];
        else $pageNum = 1;
        
        if($request->only('items_per_page'))
        $itemsPerPage = $request->only('items_per_page')['items_per_page'];
        else $itemsPerPage = 5;
      
        $filterCol =  $request->only('filterCol')['filterCol'];
        $filterValue =  $request->only('filterValue')['filterValue'];
        $bookList = $this->bookService->getListOfBooks($pageNum, $itemsPerPage, $filterCol, $filterValue);

        $categoryList = $this->categoryService->getAllWithColumnList(['id', 'category_name']);
        if($filterCol == "category_id") {
            $filterValue = $this->categoryService->getCategoryName($filterValue);
        }
        if($filterCol == "publisher_id") {
            $filterValue = $this->publisherService->getPublisherName($filterValue);
        }
        return view('filterBy', compact('bookList', 'categoryList', 'filterValue'));
    }

    public function createOrder() {
        $categoryList = $this->categoryService->getAllWithColumnList(['id', 'category_name']);
        return view('createOrder', compact('categoryList'));
    }


    public function orderList() {
        $customerId = auth()->user()->id;
        $orderList = $this->orderService->getOrderByUser($customerId);
        // dd($orderList);
        $categoryList = $this->categoryService->getAllWithColumnList(['id', 'category_name']);
        return view('orderList', compact('orderList', 'categoryList'));
    }
}
