<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        //If sort request, order books
        if ($request->sort) {
            $sortId = $request->sort.$request->order;
            switch ($sortId) {
                //Sort by title
                case "titleasc":
                    $books = Book::orderBy('title', 'asc')->get();
                    break;
                case "titledesc":
                    $books = Book::orderBy('title', 'desc')->get();
                    break;
                //Sort by author
                case "authorasc":
                    $books = Book::orderBy('author', 'asc')->get();
                    break;
                case "authordesc":
                    $books = Book::orderBy('author', 'desc')->get();
                    break;
                //Sort by rating
                case "ratingasc":
                    $books = Book::orderBy('rating', 'asc')->get();
                    break;
                case "ratingdesc":
                    $books = Book::orderBy('rating', 'desc')->get();
                    break;
                //Sort by custom
                case "customasc":
                    $books = Book::orderBy('id', 'asc')->get();
                    break;
                case "customdesc":
                    $books = Book::orderBy('id', 'desc')->get();
                    break;
                //Default
                default:
                    $books = Book::all();
                    break;
            }

            return view('readinglist', compact('books'));

        } else {

            //If no sort request, return all books
            $books = Book::all();
            return view('readinglist', compact('books'));
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('createbook');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book;
        //Title
        $book->title = $request->title;
        //Author
        $book->author = $request->author;
        //Users rating
        $book->rating = $request->rating;
        //Saving to the database
        $book->save();

        return redirect('readinglist');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Find book by ID
        $book = Book::find($id);
        
        return view('book', compact('book'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find book by ID
        $book = Book::find($id);
        
        return view('editbook', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
       
        $book->title = $request->title;
        $book->author = $request->author;
        $book->rating = $request->rating;
        $book->save();
        
        return redirect('/books'.'/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::find($id)->delete();
        return redirect('books');
    }
}
