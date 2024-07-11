<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class bookController extends Controller
{
    public function index(){
        $books = Book::all();
        $data = [
            'books' => $books,
            'status'=> 200
        ];
        return response()->json($data,200);
    }
}
