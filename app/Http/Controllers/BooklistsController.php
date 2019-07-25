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

    //Retrieving a booklist and its books in a sorted order
    public function index($id)
    {
        //Find the selected list
        $booklist = Booklist::find($id);
        $userId =  \Auth::user()->id;
        //If booklist not found redirect home
        if (!$booklist) {
            return redirect('home');
        } 
        
        $list_user_id = $booklist->user_id;
        if ($userId !== $list_user_id) {
            //If booklist doesn't belong to user redirect home
            return redirect('home')->with('status', 'This is not your book list');
        }
        
        //Check to see if list has a sort preference
        if ($booklist->sort_id) {
            $listSortId = $booklist->sort_id;
        } else {
            $listSortId = "default";
        }
        
        // Retrieving books in the list based on sort request
        switch ($listSortId) {
            //Sort by title
            case "titleasc":
                $books = Book::where('list_id', $id)->orderBy('title', 'asc')->get();
                break;
            case "titledesc":
                $books = Book::where('list_id', $id)->orderBy('title', 'desc')->get();
                break;
            //Sort by author
            case "authorasc":
                $books = Book::where('list_id', $id)->orderBy('author', 'asc')->get();
                break;
            case "authordesc":
                $books = Book::where('list_id', $id)->orderBy('author', 'desc')->get();
                break;
            //Sort by date
            case "dateasc":
                $books = Book::where('list_id', $id)->orderBy('date_completed', 'asc')->get();
                break;
            case "datedesc":
                $books = Book::where('list_id', $id)->orderBy('date_completed', 'desc')->get();
                break;
            //Sort by rating
            case "ratingasc":
                $books = Book::where('list_id', $id)->orderBy('rating', 'asc')->get();
                break;
            case "ratingdesc":
                $books = Book::where('list_id', $id)->orderBy('rating', 'desc')->get();
                break;
            //Sort by custom
            case "customasc":
                $books = Book::where('list_id', $id)->orderBy('id', 'asc')->get();
                break;
            case "customdesc":
                $books = Book::where('list_id', $id)->orderBy('id', 'desc')->get();
                break;
            //Default
            default:
                $books = Book::where('list_id', $id)->get();
                break;
        }

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

    public function update(Request $request, $id)
    {
        //Updating the sort order for the list
        //Retrieving values from submitted form
        $sortOption = $request->sortOptions;
        $sortVal = $request->sortid;

        //Creating sortid by combining sort option and sort val
        $sortId = $sortOption.$sortVal;

        //Updating the sordId in the database
        $booklist = Booklist::find($id);
        $booklist->sort_id = $sortId;
        $booklist->save();

        return redirect('/booklist'.'/'.$id);
    }

    //Destroy a book list
    public function destroy($id)
    {

        Booklist::find($id)->delete();
        return redirect('/home');

    }
}
