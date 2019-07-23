@extends('layouts.app')

@section('content')
<div class="row no-gutters justify-content-center">

        <!-- Side navigation for users book lists -->
        <div class="col-3">

            @section('sidebar')
                This is the master sidebar.
            @show
            @foreach ( $booklists as $booklist)
                <a href="/booklist/{{ $booklist->id }}">
                    <h5>{{ $booklist->title }}</h5><br>
                </a>
            @endforeach
        </div>

        <!-- Main UI for interacting with book lists -->
        <div class="col-md-6">
                <h1>Console</h1>

                If no booklist associated with user render the booklist form

                @yield('booklist')
                @yield('home')
        </div>

        <!-- Side bar for connecting with other users -->
        <div class="col-3">
            @foreach ( $booklists as $booklist)
                <a href="/booklist/{{ $booklist->id }}">
                    <h5>{{ $booklist->title }}</h5><br>
                </a>
            @endforeach
        </div>
    
    
    </div>
</div>
@endsection