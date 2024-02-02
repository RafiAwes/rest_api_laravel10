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
            'price' => 'required|digits:10',
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
            ])

        }



    }
}
