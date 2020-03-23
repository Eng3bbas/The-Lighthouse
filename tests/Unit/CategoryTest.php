<?php


namespace Tests\Unit;



use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\WithAuthentication;

class CategoryTest extends TestCase
{
    use RefreshDatabase , WithFaker, WithAuthentication;
     private const CATEGORIES_INDEX = 'categories.index';
    public function testIndexWithCategories()
    {
        factory(Category::class,10)->create();
        $this->get(route(self::CATEGORIES_INDEX))->assertDontSee('No Categories');
    }

    public function testIndexWithoutCategories()
    {
        $this->get(route(self::CATEGORIES_INDEX))->assertSee('No Categories');
    }

    public function testCanCreateACategory()
    {
        $this->setAuthentication(true);
        $response = $this->post(route('categories.store'),$data = [
            'name' => $this->faker->name
        ]);
        $response->assertRedirect(route(self::CATEGORIES_INDEX));
        $this->assertDatabaseHas('categories',$data);
    }

    public function testCanShowACategory()
    {
        $category = factory(Category::class)->create();
        $response = $this->get(route('categories.show',['id' => $category->id]));
        $response->assertStatus(200);
        $this->assertDatabaseHas('categories',['id' => $category->id]);
    }

    public function testCanUpdateACategory()
    {
        $this->setAuthentication(true);
        $category = factory(Category::class)->create();
        $response = $this->put(route('categories.update',['id' => $category->id]),[
            'name' => $this->faker->name
        ]);
        $response->assertRedirect(route(self::CATEGORIES_INDEX));
    }

    public function testCanDeleteACategory()
    {
        $this->setAuthentication(true);
        $category = factory(Category::class)->create();
        $this->delete(route('categories.destroy',['id' => $category->id]))
            ->assertRedirect(route(self::CATEGORIES_INDEX));
        $this->assertDatabaseMissing('categories',[
            'id' => $category->id
        ]);
    }

    public function testValidationErrorsWhenCreateACategory()
    {
        $this->setAuthentication(true);
        $this->post(route('categories.store'))
            ->assertSessionHasErrors();
    }
    public function testValidationErrorsWhenUpdateACategory()
    {
        $this->setAuthentication(true);
        $category = factory(Category::class)->create();
        $this->put(route('categories.update',['id' => $category->id]))
            ->assertSessionHasErrors();
    }

    public function testNotFoundCategoryWhenUpdate()
    {
        $this->setAuthentication(true);
        $this->put('categories.update',['id' => rand(0,10)])
            ->assertStatus(404);
    }

    public function testNotFoundCategoryWhenDelete()
    {
        $this->setAuthentication(true);
        $this->put('categories.destroy',['id' => rand(0,10)])
            ->assertStatus(404);
    }

    public function testNotFoundCategoryWhenShow()
    {
        $this->get('categories.show',['id' => rand(0,10)])
            ->assertStatus(404);
    }

    public function testUnauthorizedWhenCreateCategory()
    {
        $response = $this->post(route('categories.store'),$data = [
            'name' => $this->faker->name
        ]);
        $response->assertRedirect('login');
    }
}
