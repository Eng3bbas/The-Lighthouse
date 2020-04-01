<?php


namespace Tests\Feature;


use App\Category;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\WithAuthentication;
use Cart;
class CartTest extends TestCase
{
    use RefreshDatabase,WithFaker,WithAuthentication;

    private function createCategory()
    {
        return factory(Category::class)->create();
    }

    public function testAddItem()
    {
        $product = factory(Product::class)->create([
            'user_id' => $this->user->id,
            'category_id' => $this->createCategory()->id
        ]);
        $response = $this->post(route("cart.add"),[
            'id' => $product->id
        ]);
        $response->assertRedirect('/');
        $this->assertTrue(Cart::has($product->id));
    }
    public function testAddManyItems()
    {
        $products = factory(Product::class,10)->create([
            'user_id' => $this->user->id,
            'category_id' => $this->createCategory()->id
        ]);
        foreach ($products as $product) {
            $this->post(route("cart.add"),[
                'id' => $product->id
            ]);
        }
        $this->assertTrue(
            Cart::getContent()->whereIn('id',$products->pluck('id')->all())->isNotEmpty()
        );
    }

    public function testDeleteItem()
    {
        $product = factory(Product::class)->create([
            'user_id' => $this->user->id,
            'category_id' => $this->createCategory()->id
        ]);
        Cart::add($product->id,$product->name,$product->price,1);
        $response = $this->delete(route('cart.destroy', ['id' => $product->id]));
        $response->assertRedirect();
        $this->assertFalse(Cart::has($product->id), "Item is with id:[{$product->id}] found");
    }

    public function testIncrementUpdateQuantity()
    {
        $product = factory(Product::class)->create([
            'user_id' => $this->user->id,
            'category_id' => $this->createCategory()->id
        ]);
        Cart::add($product->id,$product->name,$product->price,1);
        $this->patch(route('cart.update.quantity',['id' => $product->id]))->assertRedirect();
        $this->assertEquals(2,Cart::get($product->id)['quantity']);
    }

    public function testDecrementUpdateQuantity()
    {
        $product = factory(Product::class)->create([
            'user_id' => $this->user->id,
            'category_id' => $this->createCategory()->id
        ]);
        Cart::add($product->id,$product->name,$product->price,2);
        $this->patch(route('cart.update.quantity',['id' => $product->id]),['type' => 'decrement'])->assertRedirect();
        $this->assertEquals(1,Cart::get($product->id)['quantity']);
    }

    public function testIncrementingQuantityWhenCreating()
    {
        $product = factory(Product::class)->create([
            'user_id' => $this->user->id,
            'category_id' => $this->createCategory()->id
        ]);
        Cart::add($product->id,$product->name,$product->price,1);
        Cart::add($product->id,$product->name,$product->price,1);
        $this->assertEquals(2,Cart::get($product->id)->quantity);

    }
}
