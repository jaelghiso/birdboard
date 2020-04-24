<div class="card flex flex-col mt-3">
    <h3 class="card-heading">
        Invite a User
    </h3>
    <form method="POST" action="{{ $project->path() . '/invitations'}}" class="flex flex-col">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="input bg-transparent border border-gray-400 rounded py-2 px-3 text-xs" placeholder="Email address">
        </div>
        <button type="submit" class="self-end btn btn-primary">Invite</button>
    </form>
    @include('errors', ['bag' => 'invitations'])
</div>
