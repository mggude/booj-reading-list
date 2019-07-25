<?php

namespace App\Http\Controllers;

use App\User;
use App\Book;
use App\Booklist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    /** Home page when logged in */
    public function index()
    {
        //Fetching all of the users book lists
        $booklists = Booklist::where('user_id', auth()->id())->get();
        //Fetch several users, for the connect with others side bar
        $users = User::where('id', '!=', auth()->id())->get();
        return view('home', compact('booklists', 'users'));
        
    }

    //Handles route for the discover page
    public function discover()
    {

        //Fetching all of the users book lists for access in the add book form
        $booklists = Booklist::where('user_id', auth()->id())->get();

        return view('discover', compact('booklists'));
        
    }

    public function profile($id)
    {

        //For seeing what others are reading.
        //Ability to make boooklists private coming soon
        $profile = User::find($id);
        $booklists = Booklist::where('user_id', $id)->get();
        $books = Book::where('user_id', $id)->get();

        return view('profile', compact('profile', 'booklists', 'books'));
        
    }

    public function catchAll()
    {

        return route('/');

    }
}
