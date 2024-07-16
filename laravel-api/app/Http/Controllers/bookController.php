<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class bookController extends Controller
{
    public function books(){
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
            'author' => 'required|array',
            'author.*' => 'string',
            'birth_date' => 'required',
            'death_date' => 'required',
            'language' => 'required|array',
            'language.*' => 'string',
            'generos' => 'required|array',
            'generos.*' => 'string',
            'downloads' => 'required',
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
            'birth_date' => $request->birth_date,
            'death_date' => $request->death_date,
            'language' => $request->language,
            'generos' => $request->generos,
            'downloads' => $request->downloads,
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

    public function oneBook($id){
        $book = Book::find($id);
        if(!$book){
            $data = [
                'message' => 'El libro no existe',
                'status' => 404
            ];
            return response()->json($data,404);

        }
        $data = [
            'book' => $book,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function delete($id){
        $book = Book::find($id);
        if(!$book){
            $data = [
                'message' => 'El libro no existe',
                'status' => 404
            ];
            return response()->json($data,404);

        }
        $book->delete();

        $data = [
            'message' => 'Libro eliminado',
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function update(Request $request, $id){
        $book = Book::find($id);
        if(!$book){
            $data = [
                'message' => 'El libro no existe',
                'status' => 404
            ];
            return response()->json($data,404);

        }
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'author' => 'required|array',
            'author.*' => 'string',
            'birth_date' => 'required',
            'death_date' => 'required',
            'language' => 'required|array',
            'language.*' => 'string',
            'generos' => 'required|array',
            'generos.*' => 'string',
            'downloads' => 'required',
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
        $book->title = $request->title;
        $book->author = $request->author;
        $book->birth_date = $request->birth_date;
        $book->death_date = $request->death_date;
        $book->language = $request->language;
        $book->generos = $request->generos;
        $book->downloads = $request->downloads;
        $book->pdf_path = $request->pdf_path;
        $book->image_path = $request->image_path;

        $book->save();
        $data = [
            'message' => 'Libro actualizado',
            'book' => $book,
            'status' => 200
            ];
            return response()->json($data,200);

    }

}
