<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{

    public function update(User $user, Project $project)
    {

        return $user->is($project->owner)
            ? Response::allow()
            : Response::deny('You do not own this post.');
    }
}
