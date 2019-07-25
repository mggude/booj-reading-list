<!-- This is the home page after logging in -->
@extends('layouts.app')

@section('content')
    <div>
        <div class="row no-gutters">
            <div class="col-sm-12">
                <h3 style="margin-left:15px">Welcome {{ Auth::user()->name }}</h3>  
            </div>
        </div>
        <div class="row no-gutters justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6">
                <h5 style="text-align:center;margin-top:20px">Create A Reading List</h5>
                <!-- Form to create a reading list -->
                <form method="POST" action="/booklist">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Book List Title" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="creator" name="creator" placeholder="Book List Creator" required>
                    </div>
                    <!-- This will be use to make a booklist private -->
                    <!-- <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Make List Private</label>
                    </div> -->
                    <div class="row no-gutters justify-content-center">
                        <button type="submit" class="btn btn-primary">Create List</button>
                    </div>
                </form>
            </div>            
        </div>

        <!-- If the user has a booklist show the button to discover books -->
        @if ( count($booklists) > 0 )
            <br>
            <br>
            <div class="col-12 col-md-8">
                <div class="alert alert-info" role="alert" style="margin-top:25px">
                    <h4 class="alert-heading">Discover new books!</h4>
                    <br>
                    <a href="/discover">
                    <button type="button" href="/discover" class="btn btn-info">Discover Books</button>
                </a>
                </div>
            </div>
        <!-- Alert the user to make a book list if they haven't already -->  
        @else
                <div class="col-10">
                    <div class="alert alert-info alert-dismissible fade show" role="alert" style="margin-top:20px">
                        <strong>Looks like you don't have a book list yet!</strong> Use the form above to get started.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
        @endif
    </div>
@endsection
