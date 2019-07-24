<!-- View for /home/discover route -->
@extends('layouts.auth')

@section('content')


    @if (session('status'))
            {{ session('status') }}
    @endif

    <div>
        <a href="/home">Home</a>
        <nav id="navbar-example2" class="navbar sticky-top navbar-light bg-light">
            <a class="navbar-brand" href="#">Categories</a>
            <ul class="nav nav-pills" id="discover-nav"></ul>
        </nav>

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
                        <div class="form-group">
                            <input type="text" class="form-control" id="addTitle" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="addAuthor" placeholder="Book Author">
                        </div>
                        <div class="form-group">
                        <label for="addDate">Date Completed</label>
                            <input type="date" class="form-control" name="addDate" id="addDate">
                        </div>
                        <div class="form-group">
                        <label for="addRating">Book Rating</label>
                            <select type="select" class="form-control" id="addRating" placeholder="">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="booklist">Select a book list</label>
                            <select name="booklist" class="form-control" type="select" form="updateBooklist" placeholder="Delete/Move Selected Books" required>
                                @foreach ( $booklists as $booklist)
                                    <option value="{{ $booklist->id }}">{{ $booklist->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Add Book</button>
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
