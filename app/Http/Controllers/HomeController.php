<?php

namespace App\Http\Controllers;

use App\Services\BookServices;
use App\Services\CategoryServices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    protected $bookService;
    protected $categoryService;
    public function __construct()
    {
        $this->bookService = app(BookServices::class);
        $this->categoryService = app(CategoryServices::class);
    }

    public function index() {
        $recentBook = $this->bookService->getListOfBooks(1, 4, null, null);
        $bestSellerBook = $this->bookService->getListOfBooks(1, 4, null, null, 'sold', 'desc');
        $categoryList = $this->categoryService->getAllWithColumnList(['id', 'category_name']);
        $bookByCategory = $categoryList;
        foreach($categoryList as $offset => $category) {
            $bookByCategory[$offset]['list'] = $this->bookService->getListOfBooks(1, 2, 'category_id' , $bookByCategory[$offset]['id'])->toArray()['data'];
        }

        return view('home', compact('recentBook', 'bestSellerBook', 'bookByCategory', 'categoryList'));
    }
}
