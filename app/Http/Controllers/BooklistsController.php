<?php

namespace App\Http\Controllers;

use App\User;
use App\Book;
use App\Booklist;
use Illuminate\Http\Request;

class BooklistsController extends Controller
{
     
    public function __construct()
    {

        $this->middleware('auth');

    }

    //Retrieving a booklist and its books
    public function index($id)
    {

        $booklist = Booklist::find($id);

        //Check to see if list has a sort preference
        
        if ($booklist->sort_id) {
            $listSortId = $booklist->sort_id;
        } else {
            $listSortId = "default";
        }
        
        // Retrieving books in the list based on sort request
        switch ($listSortId) {
            case "a-z":
                $books = Book::where('list_id', $id)
                    ->orderBy('title', 'asc')
                    ->get();
                break;
            case "z-a":
                $books = Book::where('list_id', $id)
                    ->orderBy('title', 'desc')
                    ->get();
                break;
            case "num-asc":
                $books = Book::where('list_id', $id)
                    ->orderBy('id', 'asc')
                    ->get();
                break;
            case "num-desc":
                $books = Book::where('list_id', $id)
                    ->orderBy('id', 'desc')
                    ->get();
                break;
            default:
                $books = Book::where('list_id', $id)->get();
                break;
        }

        $userId =  \Auth::user()->id;
        //Fetching all of the users book lists for side nav
        $booklists = Booklist::where('user_id', $userId)->get();
        //Fetching other users for connecting
        $users = User::all();


        return view('booklist', compact('booklist', 'books', 'booklists', 'users'));
    }

    //Create a new list
    public function create(Request $request)
    {

        $this->validate(request(), [

            'title' => 'required',
            'creator' => 'required'

        ]);

        $booklist = new Booklist;

        $booklist->user_id = auth()->id();

        $booklist->title = $request->title;

        $booklist->creator = $request->creator;

        $booklist->save();
        
        $url = '/booklist'.'/'.$booklist->id;

        return redirect($url);
    }

    //Destroy a book list
    public function destroy($id)
    {

        Booklist::find($id)->delete();
        return redirect('/home');

    }
}
