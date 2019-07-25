<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersAccessTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     */
        /** @test */

        public function a_user_can_have_a_booklist()
        {
            $user = factory('App\User')->create();
    
            $booklist = $user->booklists()->create(['title' => 'My List']);
    
            $this->assertEquals('My List', $booklist->title);
        }
            /** @test */

        public function a_user_can_add_a_book_to_a_booklist()
        {
            $user = factory('App\User')->create();
    
            $booklist = $user->booklists()->create(['title' => 'Acme']);
    
            $book = $user->books()->create([
                'title' => 'Illusions',
                'list_id' => $booklist->id,
                ]);
                
            $this->assertEquals($book->list_id, $booklist->id);
        }

            /** @test */

            public function a_user_can_sort_a_booklist()
            {
                $user = factory('App\User')->create();
        
                $booklist = $user->booklists()->create(['title' => 'Acme']);
        
                $book = factory('App\Book', 10)->create([
                                                    'user_id' => $user->id,
                                                    'list_id' => '2'
                                                ]);

                $this->actingAs($user)->put('/booklist'.'/'.$booklist->id)
                                ->assertRedirect('/booklist'.'/'.$booklist->id);
            }
            /** @test */

            public function a_user_can_delete_multiple()
            {
                $user = factory('App\User')->create();
        
                $booklist = $user->booklists()->create(['title' => 'Acme']);
        
                $books = factory('App\Book', 10)->create([
                                                    'user_id' => $user->id,
                                                    'list_id' => '2'
                                                ]);
                $bookitem = array();
                foreach($books as $book) {
                    $bookitem[] = $book->id;
                }

                $this->actingAs($user)->post('/book/multiple', [
                                                'bookitem' => $books,
                                                'action' => 'delete'
                                                    ]);
                $this->assertEquals(count($books), 0);
            }

}
