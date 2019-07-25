<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_make_a_booklist()
    {
        $this->actingAs(factory('App\User')->create());
        
        $this->post('/booklist', [
            'user_id' => '2',
            'title' => 'Best Book',
            'creator' => 'Jill',
            'sort_id' => 'authorasc',
        ]);

        $this->assertDatabaseHas('booklists', ['title' => 'Best Book']);
    }

    
    /** @test */

    public function guests_may_not_make_a_booklist() {
        {
            $this->post('/booklist')->assertRedirect('/login');
        }
    }
}
