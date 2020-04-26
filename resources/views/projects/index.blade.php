@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-muted text-base font-normal">My Projects</h2>
            <a href="/projects/create" class="button-primary" @click.prevent="$modal.show('new-project')">Add Project</a>
        </div>

    </header>
    <div class="md:flex md:flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="md:w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <div>
                No projects yet.
            </div>
        @endforelse
    </div>

    <new-project-modal></new-project-modal>

@endsection
