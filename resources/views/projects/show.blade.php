@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-center w-full">
            <p class="text-muted font-normal">
                <a href="/projects" class="text-muted no-underline hover:underline">My Projects</a> / <span class="text-accent font-bold">{{ $project->title }}</span>
            </p>
            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img src="{{ gravatar_url($member->email) }}"
                        alt="{{ $member->name }}'s avatar"
                        class="rounded-full w-10 -mr-2 border-2 border-muted-light shadow">
                @endforeach
                    <img src="{{ gravatar_url($project->owner->email) }}"
                        alt="{{ $project->owner->name }}'s avatar"
                        class="rounded-full w-10 -mr-2 border-2 border-accent-light shadow">

                    <a href="{{ $project->path().'/edit' }}" class="button-primary ml-6">Edit Project</a>
            </div>

        </div>

    </header>
    <div class="md:flex -mx-3">
        <div class="md:w-3/4 px-3 mb-8">
            <div class="mb-6">
                <h2 class="text-muted font-normal text-lg mb-3">Tasks</h2>

                {{-- tasks --}}
                @foreach ($project->tasks as $task)
                    <div class="card-primary mb-3">
                        <form method="POST" action="{{ $task->path() }}">
                            @method('PATCH')
                            @csrf
                            <div class="flex">
                                <input name="body" value="{{ $task->body }}"  class="text-default bg-card w-full {{ $task->completed ? 'text-muted line-through' : '' }}"/>
                                <input name="completed" type="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}/>
                            </div>
                        </form>

                    </div>

                @endforeach
                <div class="card-primary mb-3">
                    <form action="{{ $project->path() . '/tasks' }}" method="POST">
                        @csrf
                        <input placeholder="Add a new task..." class="text-default bg-card w-full py-1" name="body"/>
                    </form>
                </div>
            </div>
            <div>
                <h2 class="text-muted font-normal text-lg mb-3">General Notes</h2>
                <form method="POST" action="{{ $project->path() }}">
                    @csrf
                    @method('PATCH')

                    <textarea
                        name="notes"
                        class="card-primary text-default w-full mb-4"
                        style="min-height: 200px"
                        placeholder="Anything special that you want to make a note of?"
                    >{{ $project->notes }}</textarea>

                    <button type="submit" class="button-primary">Save</button>
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
