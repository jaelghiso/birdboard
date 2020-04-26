@extends('layouts.app')

@section('content')
    <div class="md:w-1/2 md:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow">
        <h1 class="text-2xl font-normal text-muted mb-10 text-center">Edit Your Project</h1>

        <form method="POST" action="{{ $project->path() }}">
            @method('PATCH')
            @csrf

            @include('projects.partials.form', [
                'buttonText' => 'Update Project'
                ])

        </form>

    </div>


@endsection
