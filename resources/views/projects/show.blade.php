@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-center w-full">
            <p class="text-gray-600">
                <a href="/projects" class="text-gray-600">My Projects</a> / <span class="text-primary font-bold">{{ $project->title }}</span>
            </p>
            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img src="{{ gravatar_url($member->email) }}"
                        alt="{{ $member->name }}'s avatar"
                        class="rounded-full w-10 -mr-2 border-2 border-white shadow">
                @endforeach
                    <img src="{{ gravatar_url($project->owner->email) }}"
                        alt="{{ $project->owner->name }}'s avatar"
                        class="rounded-full w-10 -mr-2 border-2 border-white shadow">

                    <a href="{{ $project->path().'/edit' }}" class="btn-primary ml-6">Edit Project</a>
            </div>

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
                <form method="POST" action="{{ $project->path() }}">
                    @csrf
                    @method('PATCH')

                    <textarea
                        name="notes"
                        class="card text-default w-full mb-4"
                        style="min-height: 200px"
                        placeholder="Anything special that you want to make a note of?"
                    >{{ $project->notes }}</textarea>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                @include('errors')
            </div>


        </div>
        <div class="md:w-1/4 px-3">
            @include('projects.card')
            @include('projects.activity.card')

            @can('manage', $project)
                @include('projects.invite')
            @endcan
        </div>

    </div>


@endsection
