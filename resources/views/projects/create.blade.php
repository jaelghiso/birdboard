@extends('layouts.app')

@section('content')
    <div class="md:w-1/2 md:mx-auto bg-white md:py-12 md:px-16 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">Let's start something new</h1>
        <form method="POST" action="/projects"
        >
        @csrf

        @include('projects.partials.form', [
            'project' => new App\Models\Project,
            'buttonText' => 'Create Project'
            ])
    </form>
    </div>

@endsection
