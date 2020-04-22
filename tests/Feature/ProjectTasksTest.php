<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Task;
use Facades\Tests\Setup\ProjectFactory;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestsCannotAddTasksToProjects()
    {
        $project = factory('App\Models\Project')->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    public function testOnlyOwnerOfProjectMayAddTasks()
    {
        $this->signIn();

        $project = factory('App\Models\Project')->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    public function testOnlyOwnerOfProjectMayUpdateTasks()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();


        $this->patch($project->tasks->first()->path(), ['body' => 'changed'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    public function testProjectCanHaveTasks()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())->assertSee('Test task');
    }

    public function testTaskCanBeUpdated()
    {
        $project = ProjectFactory::withTasks(1)->create();


        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'changed'
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed'
        ]);
    }

    public function testTaskCanBeCompleted()
    {
        $project = ProjectFactory::withTasks(1)->create();


        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'changed',
                'completed' => true
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    public function testTaskCanBeMarkIncompleted()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();


        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'changed',
                'completed' => true
            ]);

        $this->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => false
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => false
        ]);
    }

    public function testTaskRequiresABody()
    {

        $project = ProjectFactory::create();

        $attributes = factory('App\Models\Task')->raw(['body' => '']);

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
