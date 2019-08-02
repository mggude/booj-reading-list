<!-- Booklist view with update capabilities -->

@extends('layouts.app')

@section('content')
    
<a href="/books/{{ $book->id }}/edit">Edit This Book</a>

    <h1>Book Reading List</h1>

    <div>
            <h5 class="card-title">{{ $book->title }}</h5>
            <p class="card-text">By: <strong>{{ $book->author }}</strong></p>
            <p class="card-text">Rating: <strong>{{ $book->rating }}</strong></p>
        </div>

@endsection
