@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-gray-600">My Projects</h2>
            <a href="/projects/create" class="btn-primary">Add Project</a>
        </div>

    </header>
    <div class="md:flex md:flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="md:w-1/3 px-3 pb-6">
                <div class="bg-white p-5 rounded-lg shadow" style="height: 200px;">
                    <h3 class="card-heading">
                        <a href="{{ $project->path() }}" class="text-black">{{ $project->title }}</a>
                    </h3>
                    <div class="text-gray-light">{{ str_limit($project->description, 70) }}</div>
                </div>
            </div>
        @empty
            <div>
                No projects yet.
            </div>
        @endforelse
    </div>


@endsection
