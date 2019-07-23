@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <a href="/home">Go Home</a>
        <div class="col-md-8">
    
                <h2>{{ $profile->name }}</h2>
        </div>
    </div>

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

                <div id="collapse{{ $booklist->id }}" class="collapse" aria-labelledby="heading{{ $booklist->id }}" data-parent="#accordionExample">
                    <div class="card-body">
                    @foreach ( $books as $book )
                        <h4>{{ $book->title }}
                    @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>  
</div>
@endsection
