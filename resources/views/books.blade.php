<!-- Reading List View -->
@extends('layouts.app')

@section('content')

    <!-- Link to create book form -->
    <a href="/books/create">Create Book</a>

    <h1 style="text-align:center;margin-bottom:40px;">Booj Reading List</h1>

    <!-- Form to request sorted list -->
    <div class="row no-gutters" style="margin-bottom:15px">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown button
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('books', ['sort' => 'title', 'order' => 'asc']) }}">Title Ascending</a>
                <a class="dropdown-item" href="{{ route('books', ['sort' => 'title', 'order' => 'desc']) }}">Title Descending</a>
                <a class="dropdown-item" href="{{ route('books', ['sort' => 'author', 'order' => 'asc']) }}">Author Ascending</a>
                <a class="dropdown-item" href="{{ route('books', ['sort' => 'author', 'order' => 'desc']) }}">Author Descending</a>
                <a class="dropdown-item" href="{{ route('books', ['sort' => 'rating', 'order' => 'asc']) }}">Rating Ascending</a>
                <a class="dropdown-item" href="{{ route('books', ['sort' => 'rating', 'order' => 'desc']) }}">Rating Descending</a>

            </div>
        </div>
    </div>

    <!-- Book list headers -->
    <div class="row no-gutters" style="margin-bottom:15px">
            <strong class="col-4">Title</strong>
            <strong class="col-4">Author</strong>
            <strong class="col-2">Rating</strong>
            <strong class="col-2">Up Vote</strong>
        </div>

    <!-- Rendering the book data -->
    @foreach ( $books as $book)
        <div class="row no-gutters bg-light text-dark" style="padding-left:10px">
            <p class="col-4"><a href="/books/{{ $book->id }}" class="">{{ $book -> title }}</a></p>
            <p class="col-4">{{ $book -> author }}</p>
            <p class="col-2">{{ $book -> rating }}</p>
            <p class="col-2">Up Vote</p>
        </div>
        @endforeach

@endsection
