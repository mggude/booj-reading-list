@extends('layouts.app')

@section('content')
    <div>
        <div class="row no-gutters">
            <div class="col-sm-12">
                <h3>Welcome {{ Auth::user()->name }}</h3>  
            </div>
        </div>

        <div class="row no-gutters justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6">
                <h5 style="text-align:center;margin-top:20px">Create A Reading List</h5>
                <form method="POST" action="/booklist">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Book List Title" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="creator" name="creator" placeholder="Book List Creator" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Make List Private</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Create List</button>
                </form>
            </div>
        </div>


        <a href="/home/discover">
        <button href="/discover">Discover Books</button>
        </a>

    </div>
@endsection
