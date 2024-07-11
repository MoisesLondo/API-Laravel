<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
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

    public function save(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'author' => 'required',
            'birth_year' => 'required',
            'death_year' => 'required',
            'language' => 'required',
            'genres' => 'required',
            'pdf_path' => 'required',
            'image_path' => 'required',
        ]);
    }
}
