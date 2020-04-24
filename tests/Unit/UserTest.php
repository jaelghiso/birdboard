<?php

namespace Tests\Unit;

use App\Models\User;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserHasProjects()
    {
        $user = factory('App\Models\User')->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    public function testUserHasAvailableProjects()
    {

        $john = $this->signIn();

        ProjectFactory::ownedBy($john)->create();

        $this->assertCount(1, $john->availableProjects());

        $sally = factory(User::class)->create();
        $nick = factory(User::class)->create();

        $project = tap(ProjectFactory::ownedBy($sally)->create())->invite($nick);

        $this->assertCount(1, $john->availableProjects());

        $project->invite($john);

        $this->assertCount(2, $john->availableProjects());
    }
}
