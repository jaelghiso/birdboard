<div class="card-primary flex flex-col" style="height: 200px;">
    <h3 class="font-normal text-xl py-2 -ml-5 mb-3 border-l-4 border-accent-light pl-4">
        <a href="{{ $project->path() }}" class="text-muted font-bold no-underline">{{ $project->title }}</a>
    </h3>
    <div class="text-muted mb-4 flex-1">{{ str_limit($project->description, 60) }}</div>

    @can('manage', $project)
        <footer>
            <form action="{{ $project->path() }}" method="POST" class="text-right">
                @method('DELETE')
                @csrf
                <button type="submit" class="text-xs text-muted font-bold">Delete</button>
            </form>
        </footer>
    @endcan
</div>
