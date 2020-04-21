<div class="card" style="height: 200px;">
    <h3 class="card-heading">
        <a href="{{ $project->path() }}" class="text-black">{{ $project->title }}</a>
    </h3>
    <div class="text-gray-500">{{ str_limit($project->description, 70) }}</div>
</div>
