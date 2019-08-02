<!-- Booklist view with update capabilities -->

@extends('layouts.app')

@section('content')

    <a href="/">Home</a>
    <h1>Booj Reading List</h1>

  
    <div class="row no-gutters" style="margin-bottom:15px">
        <!-- Add Book Form -->
        <div class="col-12 col-lg-4">
            <p style="text-align:center"><strong>Add a book to this list</strong></p>
            <form method="POST" action="/books">
                    {{ csrf_field() }}
                    <div class="row no-gutters justify-content-center">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" name="title" placeholder="Title" required>
                            <label for="author">Author</label>
                            <input class="form-control" type="text" name="author" placeholder="Author">
                            <label for="rating">Book Rating</label>
                            <select name="rating" type="select" class="form-control" id="rating">   
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success add-btn" style="text-align:right;float:right"> 
                                Add Book
                    </button>
                </form>
        </div>
    </div>

@endsection
