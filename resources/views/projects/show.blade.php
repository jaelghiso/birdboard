@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-center">
            <p class="text-gray-600 pr-6">
                <a href="/projects" class="text-gray-600">My Projects</a> / {{ $project->title }}
            </p>
            <a href="#" class="btn-primary">Add Task</a>
        </div>

    </header>
    <div class="md:flex -mx-3">
        <div class="md:w-3/4 px-3 mb-8">
            <div class="mb-6">
                <h2 class="text-gray-600 text-lg mb-3">Tasks</h2>

                {{-- tasks --}}
                @foreach ($project->tasks as $task)
                    <div class="card mb-3">
                        <form method="POST" action="{{ $task->path() }}">
                            @method('PATCH')
                            @csrf
                            <div class="flex">
                                <input name="body" value="{{ $task->body }}"  class="w-full {{ $task->completed ? 'text-gray-500 line-through' : '' }}"/>
                                <input name="completed" type="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}/>
                            </div>
                        </form>

                    </div>

                @endforeach
                <div class="card mb-3">
                    <form action="{{ $project->path() . '/tasks' }}" method="POST">
                        @csrf
                        <input placeholder="Add a new task..." class="w-full py-1" name="body"/>
                    </form>
                </div>
            </div>
            <div>
                <h2 class="text-gray-600 text-lg mb-3">General Notes</h2>
                <form action="{{ $project->path() }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <textarea name="notes" class="card w-full" style="min-height:200px;" placeholder="Anything special that you want a note of?">{{ $project->notes }}</textarea>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>


        </div>
        <div class="md:w-1/4 px-3">
            @include('projects.card')
        </div>

    </div>


@endsection
