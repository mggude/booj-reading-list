<!-- View for /home/discover route -->
@extends('layouts.auth')

@section('content')


    @if (session('status'))
            {{ session('status') }}
    @endif

    <div>
        <a href="/home">Home</a>
        <nav id="navbar-example2" class="navbar sticky-top navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Categories</a>
            <ul class="nav nav-pills" id="discover-nav"></ul>
        </nav>

        <div class="row no-gutters justify-content-center" style="color:white">
            <div class="form-check col-4 col-sm-2 col-md-1">
                <input class="form-check-input" type="radio" name="searchParam"value="title" checked>
                <label class="form-check-label" for="searchTitle">
                    Title
                </label>
            </div>
            <div class="form-check col-4 col-sm-2 col-md1">
                <input class="form-check-input" type="radio" name="searchParam" value="author">
                <label class="form-check-label" for="searchAuthor">
                    Author
                </label>
            </div>
                <div class="form-check col-4 col-sm-2 col-md-1">
                <input class="form-check-input" type="radio" name="searchParam" value="subject">
                <label class="form-check-label" for="searchSubject">
                    Subject
                </label>
            </div>


            <div class="input-group search-area">
                <input class="col-8 col-lg-4" type="text" id="searchBox">
                <button class="col-2 col-lg-1" id="searchButton">Search</button>
            </div>
        </div>

        <div id="searchResults">
            
        </div>

        <!-- Modal For Adding Books -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Add Book
            </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/book">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="author" id="author" placeholder="Book Author">
                            </div>
                            <div class="form-group">
                                <label for="date_completed">Date Completed</label>
                                <input type="date" class="form-control" name="date_completed" id="date_completed">
                            </div>
                            <div class="form-group">
                                <label for="rating">Book Rating</label>
                                <select name="rating" type="select" class="form-control" id="rating">   
                                    <option value="5">5</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="list_id">Select a book list</label>
                                <select name="list_id" class="form-control" type="select" required>
                                    @foreach ( $booklists as $booklist)
                                        <option value="{{ $booklist->id }}">{{ $booklist->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Add Book</button>
                            @if (session('status'))
                            <div class="alert alert-warning" role="alert">
                            {{ session('status') }}
                            </div>
                            @endif
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div data-spy="scroll" data-target="#navbar-example2" data-offset="0" id="row-container"></div>

    </div>

@endsection
