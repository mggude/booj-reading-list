<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Book;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    /** @test */
    public function a_user_can_create_a_book()
    {
        // When the user hits the endpoint /books to create a new book, while passing the necessary data.
        $book = new Book ([
                'title' => 'Illusions',
                'author' => 'Richard Bach',
                'rating' => 2,
                ]);

        // Then that book should be in the database 
        $this->assertEquals($book->title, 'Illusions');
    }

    /** @test */
    public function a_user_can_delete_a_book()
    {
        // When the user hits the endpoint /books to create a new book, while passing the necessary data.
        $this->post('/books', [
                'title' => 'Illusion',
                'author' => 'Richard Bach',
                'rating' => 2,
                ]);
             
         // Then there should be a new book in the database 
         $this->assertDatabaseHas('books', [
            'title' => 'illusion'
        ]);

        // When the user hits the endpoint /books to delete the book
        $book = Book::where('title', 'Illusion')->first();
        $book = $book->id;
        $this->delete('/books'.'/'.$book);

        // Then book recently created should not be in the database
        $book = Book::where('title', 'Illusion')->first();
        $this->assertNull($book);
    }

    public function a_user_can_sort_the_list_ascending()
    {
        // After multiple books are created
        $this->get('/books', [
            'sort' => 'title',
            'order' => 'desc'
        ])->assertSessionHas('books');
        // The list can be sorted ascending
        
        // Then the second list item should be greater than the first
        
    }

    public function a_user_can_sort_the_list_descending()
    {
        // After multiple books are stored

        // The list can be sorted ascending

        // Then the second list item should be less than the first
        
    }

     public function a_user_can_change_the_order_of_the_list()
     {
         // After multiple books are stored
 
         // A book can be up voted
 
         // The index should be one less than it's origional
         
     }
    
}
