<?php

namespace Tests\Feature;

use App\Models\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    function testNonOwnersMayNotInviteUsers()
    {
        $project = ProjectFactory::create();

        $user = factory(User::class)->create();

        $assertInvitationForbidden = function () use ($user, $project) {
            $this->actingAs($user)
                ->post($project->path() . '/invitations')
                ->assertStatus(403);
        };

        $assertInvitationForbidden();

        $project->invite($user);

        $assertInvitationForbidden();
    }

    function testProjectOwnerCanInviteAUser()
    {
        $project = ProjectFactory::create();

        $userToInvite = factory(User::class)->create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => $userToInvite->email
            ])
            ->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($userToInvite));
    }

    function testEmailMustBeAssociatedWithAValidBirdboardAccount()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => 'notauser@example.com'
            ])
            ->assertSessionHasErrors([
                'email' => 'The user you are inviting must have a Birdboard account.'
            ], null, 'invitations');
    }

    function testInvitedUsersMayUpdateProjectDetails()
    {
        $project = ProjectFactory::create();

        $project->invite($anotherUser = factory(User::class)->create());

        $this->signIn($anotherUser);
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
