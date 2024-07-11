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

        if($validator->fails()){
            $data = [
                'message' => 'Error en los datos',
                'errors' => $validator->errors(),
                'status' => 400

            ];
            return response()->json($data,400);
        }

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'birth_year' => $request->birth_year,
            'death_year' => $request->death_year,
            'language' => $request->language,
            'genres' => $request->genres,
            'pdf_path' => $request->pdf_path,
            'image_path' => $request->image_path,
        ]);

        if(!$book){
            $data = [
                'message' => 'Error en la creación del libro',
                'status' => 500

            ];
            return response()->json($data,500);
        }
        $data = [
            'book' => $book,
            'status' => 201

        ];
        return response()->json($data,201);
    }
}
