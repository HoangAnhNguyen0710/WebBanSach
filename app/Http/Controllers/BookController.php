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
}
