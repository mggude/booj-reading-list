<?php

namespace App\Http\Controllers;

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
    public function index()
    {

        $userId =  \Auth::user()->id;
        //Fetching all of the users book lists
        $booklists = Booklist::where('user_id', $userId)->get();
        // fetch several users for the connect with others side bar

        return view('home', compact('booklists'));
        
    }

    public function discover()
    {

        $userId =  \Auth::user()->id;
        $booklists = Booklist::where('user_id', $userId)->get();
        // fetch several users for the connect with others side bar

        return view('home', compact('booklists'));
        
    }
}
