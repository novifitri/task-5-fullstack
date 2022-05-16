<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_category()
    {
        //Given we have an authenticated user
        $this->actingAs(User::factory()->create());
        //And a task object
        $category = Category::factory()->create(['user_id' =>Auth::id()]);
        //When user submits category request to create task endpoint
        $this->post('/categories/create',$category->toArray());
        //It gets stored in the database
        $this->assertDatabaseHas('categories',['id'=> $category->id]);
        $response = $this->get('/categories');
        $response->assertStatus(200);
    }
    public function test_read_category()
    {
        //create auth user first
        $user = User::factory()->create();
        $this->actingAs($user);
        //create category
        $category = Category::factory()->create(['user_id' =>Auth::id()]);
        $response = $this->get('/categories');
        //He should be able to read the category
        $response->assertSee($category->title);
        $response->assertStatus(200);
    }
    public function test_show_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
         //create category
        $category = Category::factory()->create(['user_id' =>Auth::id()]);
        //visit category details
        $response = $this->get('/categories/'. $category->id);
        //now user can see the details
        $response->assertSee($category->name);
    }
    public function test_update_cateogry()
    {
        $this->actingAs(User::factory()->create());
         //And a task which is created by the user
        $category = Category::factory()->create(['user_id' =>Auth::id()]);
        $category->name = "Updated name";
         //When the user hit's the endpoint to update the task
        $this->put('/categories/'.$category->id, $category->toArray());
        //The task should be updated in the database.
        $this->assertDatabaseHas('categories',['id'=> $category->id , 'name' => 'Updated name']);
    }
    public function test_delete_category()
    {
        //Given we have a signed in user
        $this->actingAs(User::factory()->create());
        //And a task which is created by the user
        $category = Category::factory()->create(['user_id' =>Auth::id()]);
        //When the user hit's the endpoint to delete the task
        $this->delete('/categories/'.$category->id);
        //The cate$category should be deleted from the database.
        $this->assertDatabaseMissing('categories',['id'=> $category->id]);
    }
    public function unauthenticated_users_cannot_crud_category()
    {      
        $this->get('/categories')
            ->assertRedirect('/login');
    } 
}
