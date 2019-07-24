@extends('layouts.auth')

@section('content')
    <div class="row justify-content-center">
        <a href="/home">Back Home</a>
        <!-- Book card -->
        <div class="col- 10 col-sm-8 col-md-6">
            <div class="card mb-3 book-display" style="max-width: 540px;">
                <!-- Book card image -->
                <div class="row no-gutters">
                    <div class="col-12">
                        <img src="data:image/jpeg;base64,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" class="card-img" alt="...">
                    </div>
                </div> 
                <!-- Book Edit button -->
                <div class="row no-gutters">
                    <button class="btn btn-primary col-4" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Edit this book</button>
                </div>
                <!-- Book info display -->
                <div class="row no-gutters">
                    <div class="collapse multi-collapse show" id="multiCollapseExample1"> 
                        <div class="col-12">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">By: <strong>{{ $book->author }}</strong></p>
                                <p class="card-text">Date Completed: <strong>{{ $book->date_completed }}</strong></p>
                                <p class="card-text">My Rating: <strong>{{ $book->rating }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Book edit form -->
                <div class="row no-gutters">
                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                        <form method="POST" action="/book/{{ $book->id }}">
                        {{method_field('PUT')}}
                            {{ csrf_field() }}
                            <div class="row no-gutters">
                                <input class="form-control" type="text" name="title" placeholder="{{ $book->title }}" required>
                                <input class="form-control" type="text" name="author" placeholder="{{ $book->author }}">
                                <input class="form-control" type="date" name="date_completed" placeholder="{{ $book->date_completed }}">
                                <input class="form-control" type="integer" name="rating" placeholder="{{ $book->rating }}">
                            </div>
                            <button type="submit" class="btn btn-success add-btn" style="text-align:right;float:right"> 
                                        Edit Book
                            </button>
                        </form>
                    </div>
                    @if (session('message'))
        
                            <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection
