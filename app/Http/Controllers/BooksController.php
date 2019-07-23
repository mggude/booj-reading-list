<?php

namespace App\Http\Controllers;

use App\Book;
use App\Booklist;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }

    // Handle multiple selected requests
    public function index(Request $request)
    {
        
        $action = $request->hello;
        $items = $request->bookitem;

        switch ($action) {
            case "delete":
                foreach($items as $item) { Book::find($item)->delete(); };
                break;
            case "move":

                break;
            default:
                break;
        }

        return redirect('/booklist/{id}');

    }

    //Create a new book
    public function create(Request $request)
    {        

        $this->validate(request(), [

            'title' => 'required'

        ]);
        
        $book = new Book;

        $book->user_id = auth()->id();

        $book->list_id = $request->list_id;

        $book->sort_id = Book::count() + 1;

        $book->title = $request->title;

        $book->author = $request->author;

        $book->date_completed = $request->date_completed;

        $book->rating = $request->rating;

        $book->save();
        
        //Redirect to the booklist this book was added to
        $url = '/booklist'.'/'.$book->list_id;

        return redirect($url);
    }

    public function show(Book $book)
    {

        $userId =  \Auth::user()->id;

        $booklists = Booklist::where('user_id', $userId)->get();

        return view('book', compact('book', 'booklists'));

    }

}
