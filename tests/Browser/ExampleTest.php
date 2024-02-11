<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    /** @test */


    public function test_create_task_form()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tasks/create')
                ->type('title', 'New Task Title')
                ->type('description', 'Task Description')
                ->select('status', 'To Do') // Assuming you have a select field with the name 'status'
                ->click('.submit-button')
                ->waitForText('Task created successfully') // Use waitForText to wait for the success message
                ->assertSee('Task created successfully'); // Assertion to check if the success message is present
        });
    }
}
