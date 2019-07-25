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

    // Handle multiple selected books requests
    public function multiple(Request $request)
    {   
        //Action for selected books. Move? Delete?
        $action = $request->userAction;
        //List id of destination booklist
        $newLocation = $request->booklist;
        //The books as an array
        $items = $request->bookitem;

        //Checking if items are selected
        if ($items) {
            switch ($action) {
                case "delete":
                        //Deleting the selected books
                        foreach($items as $item) { Book::find($item)->delete(); };
                        return redirect()->back();
                        break;
                case "move":
                        //Changing the location of the selected books
                        foreach($items as $item) { Book::find($item)->update(['list_id' => $newLocation ]); };
                        return redirect()->back();
                        break;
                default:
                    return redirect()->back()->with('status', 'You must select an action.');
                    break;
            }
        } else { 
            //Redirecting if no books selected
            return redirect()->back()->with('status', 'You must select a book.');
        }
    }

    //Create a new book
    public function create(Request $request)
    {        

        //Validate that the book has a title
        $this->validate(request(), [

            'title' => 'required'

        ]);
        
        $book = new Book;
        //Associate book with a user
        $book->user_id = auth()->id();
        //Associate book with a list
        $book->list_id = $request->list_id;
        //Sort id for users custom list
        $book->sort_id = Book::count() + 1;
        //Title
        $book->title = $request->title;
        //Author
        $book->author = $request->author;
        //Date user completed book
        $book->date_completed = $request->date_completed;
        //Users rating
        $book->rating = $request->rating;
        //Saving to the database
        $book->save();

        return redirect()->back()->with('message', 'Book saved!');
    }

    public function show($id)
    {
        //Find book by ID
        $book = Book::find($id);
        //For rendering update or add form on view
        $user_id =  \Auth::user()->id;
        $booklists = Booklist::where('user_id', auth()->id())->get();

        return view('book', compact('book', 'user_id', 'booklists'));

    }

    public function update(Request $request, $id)
    {

        $book = Book::find($id);

        //Authorizing the book update
        if ( $book->user_id !== auth()->id()) {
            return abort(403, 'Unauthorized action.');
        }

        $book->title = $request->title;

        $book->author = $request->author;

        $book->date_completed = $request->date_completed;

        $book->rating = $request->rating;

        $book->save();
        
        return redirect()->back()->with('message', 'Book successfully updated!');

    }

}
