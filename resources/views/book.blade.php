<!-- Booklist view with update capabilities -->

@extends('layouts.app')

@section('content')
    <a href="/books">Back to reading list</a><br>
    <a href="/books/{{ $book->id }}/edit">Edit This Book</a>


    <div>
            <h1 class="card-title">{{ $book->title }}</h1>
            <p class="card-text">By: <strong>{{ $book->author }}</strong></p>
            <p class="card-text">Rating: <strong>{{ $book->rating }}</strong></p>
        </div>

@endsection
