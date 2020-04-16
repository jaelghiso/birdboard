@extends('layouts.app')

@section('content')

    <form method="POST" action="/projects" class="container">
        @csrf
        <h1 >Create a Project</h1>

        <div>
            <label for="">Title</label>
            <div>
                <input type="text" name="title" placeholder="Title" />
            </div>
        </div>
        <div>
            <label for="">Description</label>
            <div>
                <input type="text" name="description" placeholder="Description" />
            </div>
        </div>
        <div >
            <div >
                <button type="submit" >Create Project</button>
                <a href="/projects">Cancel</a>
            </div>
        </div>
    </form>
@endsection
