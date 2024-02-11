<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class ExampleTest extends TestCase
{
    public function it_can_list_all_tasks()
    {
        $tasks = Task::factory(5)->create();

        $response = $this->json('GET', '/api/tasks');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    /** @test */
    public function it_can_show_a_single_task()
    {
        $task = Task::factory()->create();

        $response = $this->json('GET', "/api/tasks/{$task->id}");

        $response->assertStatus(200)
            ->assertJson(['data' => $task->toArray()]);
    }

    /** @test */
    public function it_can_create_a_task()
    {
        $taskData = Task::factory()->raw();

        $response = $this->json('POST', '/api/tasks', $taskData);

        $response->assertStatus(201)
            ->assertJson(['data' => $taskData]);
    }

    /** @test */
    public function it_can_update_a_task()
    {
        $task = Task::factory()->create();
        $updatedData = ['title' => 'Updated Title'];

        $response = $this->json('PUT', "/api/tasks/{$task->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJson(['data' => $updatedData]);
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $task = Task::factory()->create();

        $response = $this->json('DELETE', "/api/tasks/{$task->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
