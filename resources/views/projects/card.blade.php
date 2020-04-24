<div class="card flex flex-col" style="height: 200px;">
    <h3 class="card-heading">
        <a href="{{ $project->path() }}" class="text-gray-800 font-bold">{{ $project->title }}</a>
    </h3>
    <div class="text-gray-600 mb-4 flex-1">{{ str_limit($project->description, 60) }}</div>

    @can('manage', $project)
        <footer>
            <form action="{{ $project->path() }}" method="POST" class="text-right">
                @method('DELETE')
                @csrf
                <button type="submit" class="text-xs text-gray-600 font-bold">Delete</button>
            </form>
        </footer>
    @endcan
</div>
