<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testGuestsCannotManageProjects()
    {
        //$this->withoutExceptionHandling();

        $project = factory('App\Models\Project')->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }


    public function testUserCanCreateProject()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\Models\User')->create());

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function testUserCanViewTheirProject()
    {

        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\Models\User')->create());

        $project = factory('App\Models\Project')->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function testAuthenticatedUserCannotViewTheProjectsOfOthers()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs(factory('App\Models\User')->create());

        $project = factory('App\Models\Project')->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function testProjectRequiresTitle()
    {

        $this->actingAs(factory('App\Models\User')->create());

        $attributes = factory('App\Models\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function testProjectRequiresDescription()
    {

        $this->actingAs(factory('App\Models\User')->create());

        $attributes = factory('App\Models\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
