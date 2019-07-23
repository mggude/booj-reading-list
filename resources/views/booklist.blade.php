@extends('layouts.app')

@section('content')
<div class="">
    <!-- Row one renders list details -->
    <div class="row no-gutters">
        <div class="col-10">
            <h2>{{ $booklist->title }}</h2>
            <p>Creator: <strong>{{ $booklist->creator }}</strong></p>
            <p>Created On: <strong>{{ $booklist->created_at }}</strong></p>
        </div>
    </div>
    <!-- Row two contains form collapse buttons -->
    <div class="row no-gutters justify-content-center">

        <div class="col-4">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#add-book-form" aria-expanded="false" aria-controls="multiCollapseExample2">Add A Book +</button>
        </div>

        <div class="col-4">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#sort-books-form" aria-expanded="false" aria-controls="multiCollapseExample2">Sort List</button>
        </div>

        <div class="col-4">
             <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#edit-slct-form" aria-expanded="false" aria-controls="multiCollapseExample2">Edit Selected</button>
        </div>
    </div>
    <!-- Row three contains input forms -->
    <div class="row no-gutters justify-content-center">
        <!-- Add Book Form -->
        <div class="col-12">
            <div class="collapse multi-collapse" id="add-book-form">
                <form method="POST" action="/book">
                    {{ csrf_field() }}
                    <div class="row no-gutters">
                        <input type="integer" name="list_id" value="{{ $booklist->id}}" style="display:none">
                        <input class="form-control" type="text" name="title" placeholder="Title" required>
                        <input class="form-control" type="text" name="author" placeholder="Author">
                        <input class="form-control" type="date" name="date_completed" placeholder="Date Completed">
                        <input class="form-control" type="integer" name="rating" placeholder="Rating">
                    </div>
                    <button type="submit" class="btn btn-success add-btn" style="text-align:right;float:right"> 
                                Add Book
                    </button>
                </form>
            </div>
        </div>
        <!-- Sort List Form -->
        <div class="col-12">
            <div class="collapse multi-collapse" id="sort-books-form">
                <select name="sort{{ $booklist->id }}" id="sort{{ $booklist->id }}" class="form-control" type="select" placeholder="Delete/Move Selected Books">
                    <option value="a-z">A-Z</option>
                    <option value="z-a">Z-A</option>
                    <option value="num-asc">Ass</option>
                    <option value="num-desc">Dec</option>
                </select><br>
                <button class="sort-btn">Sort</button>
            </div>
        </div>
        <!-- Edit Selected Books Form -->
        <div class="col-12">
            <div class="collapse multi-collapse" id="edit-slct-form">
                <select name="action" class="form-control" form="list{{ $booklist->id }}" type="select">
                    <option value="delete">Delete Selected</option>
                    <option value="move">Move Selected</option>
                    <option>Sort All</option>
                </select>
                <select name="booklist" class="form-control" type="select" placeholder="Delete/Move Selected Books">
                    @foreach ( $booklists as $booklist)
                    <option value="{{ $booklist->id }}">{{ $booklist->title }}</option>
                    @endforeach
                </select>
                <a class="" style="text-align:right"
                    onclick="event.preventDefault();
                    document.getElementById('list{{ $booklist->id }}').submit();">
                    <button>Submit</button>
                </a>
            </div>
        </div>
    </div>

    <!-- Book list headers -->
    <div class="row no-gutters list-row" style="margin-bottom:15px">
        <strong class="col-5 col-sm-3">Title</strong>
        <strong class="col-5 col-sm-3">Author</strong>
        <strong class="col-sm-2 d-none d-sm-block">Completed</strong>
        <strong class="col-sm-2 d-none d-sm-block">Rating</strong>
        <strong class="col-2 col-sm-2">Select</strong>
    </div>
    <!-- Row renders books in list -->

    <form id="list{{ $booklist->id }}" methodzs="POST" action="/home/edit">
        <!-- {{ method_field('DELETE') }} -->
        {{ csrf_field() }}

        <!-- Display the book entries-->
        @foreach ( $books as $book)
            <div class="row no-gutters list-row">
                <p class="col-5 col-sm-3"><a href="/book/{{ $book->id }}">{{ $book -> title }}</a></p>
                <p class="col-5 col-sm-3">{{ $book -> author }}</p>
                <p class="col-sm-2 d-none d-sm-block">{{ $book -> date_completed }}</p>
                <p class="col-sm-2 d-none d-sm-block">
                    <?php 
                        for ($x = 0; $x < $book->rating; $x++) {
                            echo "+";
                        } 
                    ?>
                </p>
                <input class="col-2 col-sm-2" type="checkbox" name="bookitem[]" value="{{ $book->id }}" checked>
            </div>
            <br>
        @endforeach 
    </form>
    <?php 
        if (isset($_POST['bookitem'])) 
        {
            print_r($_POST['bookitem']); 
        }
        ?>

</div>
@endsection
