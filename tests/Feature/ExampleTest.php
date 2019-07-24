<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_is_created()
    {
        $this->actingAs(factory('App\User')->create());
        
        $this->post('/booklist', [
            'user_id' => '1',
            'title' => 'Best Book',
            'creator' => 'Jill',
            'sort_id' => 'authorasc',
        ]);

        $this->assertDatabaseHas('booklists', ['title' => 'Best Book']);
    }
}
