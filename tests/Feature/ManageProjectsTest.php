<?php

namespace Tests\Feature;

use App\Models\Project;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testGuestsCannotManageProjects()
    {
        $project = factory('App\Models\Project')->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get('/projects/edit')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }


    public function testUserCanCreateProject()
    {
        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = factory(Project::class)->raw();

        $this->followingRedirects()->post('/projects', $attributes)
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    public function testUserCanDeleteProject()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->delete($project->path())
            ->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }

    public function testUnauthorizedUsersCannotDeleteProject()
    {
        $project = ProjectFactory::create();

        $this->delete($project->path())
            ->assertRedirect('/login');

        $user = $this->signIn();

        $this->delete($project->path())->assertStatus(403);

        $project->invite($user);

        $this->actingAs($user)->delete($project->path())->assertStatus(403);
    }

    public function testUserCanUpdateProject()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = [
                'title' => 'Changed',
                'description' => 'Changed',
                'notes' => 'Changed'
            ])
            ->assertRedirect($project->path());

        $this->get($project->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('projects', $attributes);
    }

    public function testUserCanViewTheirProject()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee(Str::limit($project->description, 70));
    }

    public function testUserCanSeeProjectsTheyHaveBeenInvitedOnTheirDashboard()
    {
        $user = $this->signIn();

        $project = tap(ProjectFactory::create())->invite($user);

        $this->get('/projects')->assertSee($project->title);
    }

    public function testAuthenticatedUserCannotViewTheProjectsOfOthers()
    {
        $this->signIn();

        $project = factory('App\Models\Project')->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function testAuthenticatedUserCannotUpdateTheProjectsOfOthers()
    {
        $this->signIn();

        $project = factory('App\Models\Project')->create();

        $this->patch($project->path())->assertStatus(403);
    }

    public function testProjectRequiresTitle()
    {

        $this->signIn();

        $attributes = factory('App\Models\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function testProjectRequiresDescription()
    {

        $this->signIn();

        $attributes = factory('App\Models\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
