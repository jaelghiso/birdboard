<div class="card" style="height: 200px;">
    <h3 class="card-heading">
        <a href="{{ $project->path() }}" class="text-black">{{ $project->title }}</a>
    </h3>
    <div class="text-gray-500 mb-4">{{ str_limit($project->description, 70) }}</div>
    <footer>
        <form action="{{ $project->path() }}" method="POST" class="text-right">
            @method('DELETE')
            @csrf
            <button type="submit" class="text-xs text-gray-800">Delete</button>
        </form>
    </footer>
</div>
