<!-- Booklist view with update capabilities -->

@extends('layouts.app')

@section('content')
<div class="home-console">
    <!-- Row one renders list details -->
    <div class="row no-gutters bg-light">
        <div class="col-10" style="padding-left:20px">
            <h2>{{ $booklist->title }}</h2>
            <p>Creator: <strong>{{ $booklist->creator }}</strong></p>
            <p>Created On: <strong>{{ $booklist->created_at }}</strong></p>
        </div>
    </div>
    <!-- Row two, buttons for collapsible forms -->
    <div class="row no-gutters justify-content-center bg-light" style="padding-bottom:20px">
        <div class="col">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#add-book-form" aria-expanded="false" aria-controls="multiCollapseExample2">Add A Book +</button>
        </div>
        <!-- Only allow more or delete if there is a book in the list -->
        @if ( count($books) > 0 )
            <div class="col">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#edit-slct-form" aria-expanded="false" aria-controls="multiCollapseExample2">Edit Selected</button>
            </div>
        @endif
        <!-- Only allow sort if more than one book in list -->
        @if ( count($books) > 1 )
            <div class="col">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#sort-books-form" aria-expanded="false" aria-controls="multiCollapseExample2">Sort List</button>
            </div>
        @endif
    </div>
    <!-- Row three contains collapsible forms -->
    <div class="row no-gutters justify-content-center bg-light">
        <!-- Add Book Form -->
        <div class="col-12 col-lg-4">
            <div class="collapse multi-collapse" id="add-book-form">
            <p style="text-align:center"><strong>Add a book to this list</strong></p>
            <form method="POST" action="/book">
                    {{ csrf_field() }}
                    <div class="row no-gutters justify-content-center">
                    <div class="form-group">
                        <input type="integer" name="list_id" value="{{ $booklist->id}}" style="display:none">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" placeholder="Title" required>
                        <label for="author">Author</label>
                        <input class="form-control" type="text" name="author" placeholder="Author">
                        <label for="date_completed">Date Completed</label>
                        <input class="form-control" type="date" name="date_completed" placeholder="Date Completed">
                            <label for="rating">Book Rating</label>
                            <select name="rating" type="select" class="form-control" id="rating">   
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success add-btn" style="text-align:right;float:right"> 
                                Add Book
                    </button>
                </form>
            </div>
        </div>
        <!-- Only render update forms if there are books to update -->
        @if ( count($books) > 0 )
            <!-- Edit Selected Books Form -->
            <div class="col-10 col-md-6 col-lg-4 bg-light">
                <div class="collapse multi-collapse" id="edit-slct-form">
                    <input type="text" name="listId" value="{{ $booklist->id }}" style="display:none">
                    <label for="userAction">Move or delete selected books</label>
                    <select name="userAction" id="userAction" class="form-control"  type="select" form="updateBooklist">
                        <option value="move">Move Selected</option>
                        <option value="delete">Delete Selected</option>
                    </select>
                    <div id="select-list">
                        <label for="userAction">If moving, select a destination list</label>
                        <select name="booklist" id="booklist" class="form-control" type="select" form="updateBooklist" required>
                            @foreach ( $booklists as $booklist)
                                <option value="{{ $booklist->id }}">{{ $booklist->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <a class="" style="text-align:right"
                        onclick="event.preventDefault();
                        document.getElementById('updateBooklist').submit();">
                        <button>Submit</button>
                    </a>
                </div> 
            </div>
            <!-- Sort List Form -->
            <div class="col-10 col-md-6 col-lg-4 bg-light">
                <div class="collapse multi-collapse" id="sort-books-form">
                    <form method="POST" action="/booklist/{{ $booklist->id }}">
                        {{method_field('PUT')}}
                        {{ csrf_field() }}
                        <label for="sortOptions">Sort By</label>
                        <select name="sortOptions" id="sortOptions" class="form-control" type="select" placeholder="Sort By...">
                            <option value="title">Title</option>
                            <option value="author">Author</option>
                            <option value="date">Date Completed</option>
                            <option value="rating">Rating</option>
                            <option value="custom">My Order</option>
                        </select><br>
                        <input type="radio" name="sortid" value="asc">Ascending
                        <input type="radio" name="sortid" value="desc">Descending
                        <br>
                        <button class="sort-btn" type="submit">Sort</button>
                    </form>
                </div>
            </div>
        @endif
        <!-- Render message if it's there, from back-end validation -->
        @if (session('message'))
            <div class="alert alert-success col-10" role="alert">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <!-- Display the books in the list-->
    @if ( count($books) > 0 )
        <!-- Render Book Rows in form for mass update-->
        <form id="updateBooklist" method="POST" action="/book/multiple">
            {{ csrf_field() }}
            <!-- Hidden input for current list id -->
            <input type="text" value="{{ $booklist->id }}" name="listId" style="display:none">
            <!-- Book list headers -->
            <div class="row no-gutters list-row" style="margin-bottom:15px">
                <strong class="col-5 col-sm-3">Title</strong>
                <strong class="col-5 col-sm-3">Author</strong>
                <strong class="col-sm-2 d-none d-sm-block">Date Completed</strong>
                <strong class="col-sm-2 d-none d-sm-block">Rating</strong>
                <strong class="col-2 col-sm-2">Select</strong>
            </div>
            <!-- Rendering the book data -->
            @foreach ( $books as $book)
                <div class="row no-gutters list-row bg-light text-dark" style="padding-left:10px">
                    <p class="col-5 col-sm-3"><a href="/book/{{ $book->id }}" class="">{{ $book -> title }}</a></p>
                    <p class="col-5 col-sm-3">{{ $book -> author }}</p>
                    <p class="col-sm-2 d-none d-sm-block">{{ $book -> date_completed }}</p>
                    <!-- Rendering stars for the rating. -->
                    <p class="col-sm-2 d-none d-sm-block">
                        <?php 
                            for ($x = 0; $x < $book->rating; $x++) {
                                echo "+";
                            } 
                        ?>
                    </p>
                    <!-- Check box to select this book -->
                    <input class="col-2 col-sm-2" style="margin-top:5px" type="checkbox" name="bookitem[]" value="{{ $book->id }}">
                </div>
                <br>
            @endforeach 
        </form>
            <!-- Creating array for checked boxes -->
            <?php 
                if (isset($_POST['bookitem'])) 
                {
                    print_r($_POST['bookitem']); 
                }
                ?>
        <!-- If no books render a message to discover books -->
        @else
            <div class="col-12 col-md-8">
                <div class="alert alert-info" role="alert" style="margin-top:25px">
                    <h4 class="alert-heading">Add a book to your list!</h4>
                            <br>
                    Discover books for your list...
                    <br>
                    <a href="/discover">
                    <button type="button" href="/discover" class="btn btn-info">Discover Books</button>
                </a>
                    <hr>
                    <p class="mb-0">Or use the pannel above to add a book.</p>
                </div>
            </div>
    @endif
</div>
@endsection
