

    <div class="field mb-6">
        <label for="title" class="text-sm text-default mb-2 block">Title</label>

        <div class="control">
            <input type="text"
            class="bg-transparent border border-muted-light rounded p-2 text-sm text-muted w-full"
            name="title"
            placeholder="My next awesome project"
            required
            value="{{ $project->title }}">
        </div>
    </div>
    <div class="field mb-6">
        <label for="description" class=" text-sm text-default mb-2-bloc">Description</label>

        <div class="control">
            <textarea name="description" rows="10"
            class="bg-transparent border border-muted-light rounded p-2 text-sm text-muted w-full"
            placeholder="I should start learning piano."
            required
            > {{ $project->description }}</textarea>
        </div>
    </div>
    <div class="field">
        <div class="control">
            <a href="{{ $project->path() }}" class="button is-outlined text-default font-bold mr-2">Cancel</a>
            <button type="submit" class="button is-link">{{ $buttonText ?? '' }}</button>
        </div>
    </div>
    @if ($errors->any())
        <div class="field mt-6">
            @foreach ($errors->all() as $error)
                <li class="text-sm text-red">{{ $error }}</li>
            @endforeach
        </div>
    @endif


