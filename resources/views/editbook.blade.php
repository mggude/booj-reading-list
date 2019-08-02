<!-- Booklist view with update capabilities -->

@extends('layouts.app')

@section('content')

    <a href="/books">Back to reading list</a><br>
    <a href="/books/{{ $book->id }}">Back to Book</a>
   
    <div class="row no-gutters" style="margin-bottom:15px">
        <!-- Add Book Form -->
        <div class="col-12 col-lg-4">
            <p style="text-align:center"><strong>Edit:</strong> {{ $book->title }}</p>
            <form method="POST" action="/books/{{ $book->id }}">
                {{method_field('PUT')}}
                    {{ csrf_field() }}
                    <div class="row no-gutters">
                        <input class="form-control" type="text" name="title" value="{{ $book->title }}" placeholder="{{ $book->title }}" required>
                        <input class="form-control" type="text" name="author" value="{{ $book->author }}" placeholder="{{ $book->author }}">
                        <input class="form-control" type="integer" name="rating" value="{{ $book->rating }}" placeholder="{{ $book->rating }}">
                    </div>
                    <button type="submit" class="btn btn-success add-btn" style="text-align:right;float:right"> 
                                Edit Book
                    </button>
                </form>
        </div>
        <!-- Delete Book Button -->
        <div class="col-12">
        <form method="POST" action="/books/{{ $book->id }}">
                {{method_field('DELETE')}}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">Delete Book</button>

                </form>
        </div>
    </div>

@endsection
