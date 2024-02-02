<?php

namespace App\Http\Controllers\API;

use App\Models\books;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class booksController extends Controller
{
    public function index(){
        $books = books::all();

        if($books->count() > 0){

            return response()->json([

                'status' => 200,
                'books' => $books,
            ],200);
        }
        else{
            return response()->json([

                'status' => 404,
                'books' => 'no books found',
            ],404);
        }
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'price' => 'required',
        ]);

        if($validator->fails()){

            return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
        }else{

            $books = books::create([

            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'price' => $request->price,
            ]);

            if($books){

                return response()->json([
                    'status' => 200,
                    'message'=> "Book added successfully"
                ], 200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message'=> "Something went wrong"
                ], 500);
            }

        }
    }

    public function show($id){
        $book = books::find($id);

        if($book){
            return response()->json([
                'status' => 200,
                'book'=> $book
            ], 200);

        } else {
            return response()->json([
                'status' => 404,
                'message'=> "Books not found"
            ], 404);
        }

    }
}
