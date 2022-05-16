<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
  
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_read_article()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        //create articles
        $category = Category::factory()->create();
        $article = Article::factory()->create([
            'user_id' =>Auth::id(),
            'category_id' => $category->id
        ]);
        $response = $this->get('/articles');
        //He should be able to read the articles
        $response->assertSee($article->title);
        $response->assertStatus(200);
    }
    public function test_create_article()
    {
        $this->actingAs(User::factory()->create());
         //create articles
         $category = Category::factory()->create(['user_id' =>Auth::id()]);
         $article = Article::factory()->create([
             'user_id'      => Auth::id(),
             'category_id' => $category->id
         ]);
         //When user submits article request to create task endpoint
         $this->post('/articles/create',$article->toArray());
         //It gets stored in the database
         $this->assertDatabaseHas('articles',['id'=> $article->id]);
         $response = $this->get('/articles');
         $response->assertSee($article->title);
         $response->assertStatus(200);
    }
    public function test_update_article()
    {
        $this->actingAs(User::factory()->create());
         //And a task which is created by the user
        $category = Category::factory()->create(['user_id' =>Auth::id()]);
        $article = Article::factory()->create([
            'user_id'      => Auth::id(),
            'category_id' => $category->id
        ]);
        $article->title = "Updated title";
        $article->content = "Konten updated";
        $article->category_id = $category->id;
        $article->save();
        //The task should be updated in the database.
        $this->assertDatabaseHas('articles',['id'=> $article->id , 'title' => 'Updated title']);
    }
    public function test_delete_article()
    {
        //Given we have a signed in user
        $this->actingAs(User::factory()->create());
        //And a task which is created by the user
        $category = Category::factory()->create(['user_id' =>Auth::id()]);
        $article = Article::factory()->create([
            'user_id'      => Auth::id(),
            'category_id' => $category->id
        ]);
        //When the user hit's the endpoint to delete the article
        $this->delete('/articles/'.$article->id);
        //The article should be deleted from the database.
        $this->assertDatabaseMissing('articles',['id'=> $article->id]);
    }
    public function unauthenticated_users_cannot_crud_article()
    {      
        $this->get('/myarticles')
            ->assertRedirect('/login');
    } }








