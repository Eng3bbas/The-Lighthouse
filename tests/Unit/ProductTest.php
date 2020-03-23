<?php

namespace Tests\Unit;


use App\Category;
use App\Product;
use App\Services\UserService;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;
use Tests\WithAuthentication;

class ProductTest extends TestCase
{
    use RefreshDatabase , WithFaker,WithAuthentication;

    private function createCategory()
    {
        return factory(Category::class)->create();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testProductsIndex()
    {
        factory(Product::class,10)->create([
            'user_id' => $this->user->id,
            'category_id' => $this->createCategory()->id
        ]);

        $response = $this->get('/');
        $this->withoutExceptionHandling();
        $response->assertDontSee('No Products');
    }

    public function testNoProductsInIndex()
    {
        $this->get('/')->assertSee('No Products');
    }

    public function testCreateProduct()
    {
        $this->setAsAdmin();
        $this->actingAs($this->user);
        $category = $this->createCategory();
        $response = $this->post(route('products.store'),$data = [
            'name' => $this->faker->name,
            'price' => $this->faker->randomNumber(4),
            'category_id' => $category->id
        ]);
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products',$data);
    }

    public function testCreateProductWithImage()
    {
        Storage::disk('local');
        $this->setAsAdmin();
        $this->actingAs($this->user);
        $category = $this->createCategory();
        $response = $this->post(route('products.store'),[
            'name' => $this->faker->name,
            'price' => $this->faker->randomNumber(4),
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('img.png')
        ]);
        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('productImg');
    }

    public function testShowSingle()
    {
        $product = factory(Product::class)->create(['user_id' => $this->user->id , 'category_id' => $this->createCategory()->id]);
        $response = $this->get(route('products.show',['id' => $product->id]));
        $response->assertStatus(200);
    }

    public function testUpdateProduct()
    {
        $this->setAsAdmin();
        $this->actingAs($this->user);
        $category = $this->createCategory();
        $product = factory(Product::class)->create(['user_id' => $this->user->id , 'category_id' => $category->id]);
        $response = $this->put(route('products.update',['id' => $product->id]),[
            'name' => $this->faker->name,
            'price' => $this->faker->randomNumber(4),
            'category_id' => $category->id,
        ]);
        $response->assertRedirect(route("products.index"));
    }

    public function testCanDeleteProduct()
    {
        $this->setAsAdmin();
        $this->actingAs($this->user);
        $category = $this->createCategory();
        $product = factory(Product::class)->create(['user_id' => $this->user->id , 'category_id' => $category->id]);
        $response = $this->delete(route("products.destroy",['id' => $product->id]));
        $response->assertRedirect(route("products.index"));
        $this->assertDatabaseMissing('products',[
            'id' => $product->id,
            'name' => $product->name
        ]);
    }

    public function testValidationWhenCreateAProduct()
    {
        $this->setAsAdmin();
        $this->actingAs($this->user);
        $response = $this->post(route("products.store"));
        $response->assertSessionHasErrors();
    }

    public function testValidationWhenUpdateAProduct()
    {
        $this->setAsAdmin();
        $this->actingAs($this->user);
        $category = $this->createCategory();
        $product = factory(Product::class)->create(['user_id' => $this->user->id , 'category_id' => $category->id]);
        $this->put(route('products.update',['id' => $product->id]))->assertSessionHasErrors();
    }

    public function testGetProductsByCategoryId()
    {
        $category = $this->createCategory();
        factory(Product::class,20)->create(['user_id' => $this->user->id , 'category_id' => $category->id]);
        $response = $this->get($route = route('products.by-category',['categoryId' => $category->id]));
        $response->assertDontSee('No Products');
        $response->assertSee($route."?page=2");
    }
}
