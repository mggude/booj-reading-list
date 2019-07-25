@extends('layouts.auth')

@section('content')
<div class="row no-gutters justify-content-center">
        <!-- Book card -->
        <div class="col- 10 col-sm-8 col-md-6">
            <div class="card mb-3" style="max-width: 540px;">

        <a href="/home">Go Home</a>
        <div class="col-md-8">
    
                <h2>{{ $profile->name }}</h2>
        </div>
        <br>
        <strong>{{ $profile->name }}'s Book List's</strong>
    <div class="accordion" id="accordionExample">

        @foreach ( $booklists as $booklist )
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $booklist->id }}" aria-expanded="true" aria-controls="collapse{{ $booklist->id }}">
                        {{ $booklist->title}}
                        </button>
                    </h2>
                </div>
            <!-- Book list headers -->
                <div id="collapse{{ $booklist->id }}" class="collapse" aria-labelledby="heading{{ $booklist->id }}" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="row no-gutters list-row" style="margin-bottom:15px">
                            <strong class="col-5 col-sm-3">Title</strong>
                            <strong class="col-5 col-sm-3">Author</strong>
                        </div>
                        <!-- Rendering the book data -->
                        @foreach ( $books as $book)
                            <div class="row no-gutters list-row bg-light">
                                <p class="col-5 col-sm-3"><a href="/book/{{ $book->id }}" class="">{{ $book -> title }}</a></p>
                                <p class="col-5 col-sm-3">{{ $book -> author }}</p>
                                </div>
                            <br>
                        @endforeach 
                    </div>
                </div>
            </div>
        @endforeach
    </div>  
</div>
</div>
@endsection
