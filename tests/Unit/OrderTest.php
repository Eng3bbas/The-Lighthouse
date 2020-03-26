<?php


namespace Tests\Unit;


use App\Category;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\User;
use Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\WithAuthentication;

class OrderTest extends TestCase
{
    use RefreshDatabase,WithFaker,WithAuthentication;

    public function testCreatingOrder()
    {
        //$this->withoutExceptionHandling();

        $products = factory(Product::class,10)->create([
            'user_id' => $this->user->id,
            'category_id' => factory(Category::class)->create()->id,
            'image' => null
        ]);
        foreach ($products as $product) {
            Cart::add($product->id,$product->name,$product->price,rand(1,10))->associate(Product::class);
        }
        $this->setAuthentication();
        $response = $this->post(route('orders.store'),$data = [
            'address' => $this->faker->address,
            'notes' => $this->faker->paragraph
        ]);
        $response->assertRedirect('/');
        $this->assertDatabaseHas('orders',[
            'id' => 1,
            'user_id' => $this->user->id,
            'address' => $data['address'],
            'notes' => $data['notes']
        ]);
        $this->assertDatabaseHas('order_product',[
           'order_id' => 1,
           'product_id' => 1
        ]);
        $this->assertTrue(Cart::isEmpty());
    }

    public function testOrdersAsAdmin()
    {
        $this->setAuthentication(true);
        factory(Order::class,10)->create([
            'user_id' => factory(User::class)->create()->id
        ]);
        $response = $this->get(route("orders.index"));
        $response->assertDontSee('No Orders');
    }

    public function testOrdersAsUser()
    {
        $this->setAuthentication();
        factory(Order::class,10)->create();
        $response = $this->get(route("orders.index"));
        $response->assertDontSee('No Orders');
    }

    public function testShowingAnOrderWithProductsAsAdmin()
    {
        $this->setAuthentication(true);
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);
        factory(OrderProduct::class,10)->create();
        $response = $this->get(route('orders.show',['id' => $order->id]));
        $response->assertStatus(200);
    }

    public function testShowingAnOrderWithProductsAsUser()
    {
        $this->setAuthentication(true);
        $order = factory(Order::class)->create();
        factory(OrderProduct::class,10)->create();
        $response = $this->get(route('orders.show',['id' => $order->id]));
        $response->assertStatus(200);
    }

    public function testDeletingAnOrderAsUser()
    {
        $this->setAuthentication();
        $order = factory(Order::class)->create();
        $response = $this->delete(route("orders.destroy",['id' => $order->id]));
        $response->assertRedirect('/');
    }
    public function testDeletingAnOrderAsAdmin()
    {
        $this->setAuthentication(true);
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);
        $response = $this->delete(route("orders.destroy",['id' => $order->id]));
        $response->assertRedirect('/');
    }

    public function testUpdatingAnOrderAsUser()
    {
        $this->setAuthentication();
        $order = factory(Order::class)->create(['user_id' => $this->user->id]);
        $response = $this->put(route("orders.update",['id' => $order->id]),[
            'address' => 'my address'
        ]);
        $response->assertRedirect('/');
        $this->assertDatabaseHas('orders',[
            'id' => $order->id,
            'address' => 'my address'
        ]);
    }
    public function testUpdatingAnOrderAsAdmin()
    {
        $this->setAuthentication(true);
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);
        $response = $this->put(route("orders.update",['id' => $order->id]),[
            'address' => 'my address'
        ]);
        $response->assertRedirect('/');
        $this->assertDatabaseHas('orders',[
            'id' => $order->id,
            'address' => 'my address'
        ]);
    }

    public function testPermissionDeniedWhenDeleteOrder()
    {
        $this->setAuthentication();
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);
        $response = $this->delete(route("orders.destroy",['id' => $order->id]));
        $response->assertStatus(403);
    }

    public function testPermissionDeniedWhenUpdateOrder()
    {
        $this->setAuthentication();
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);
        $response = $this->put(route("orders.update",['id' => $order->id]),[
            'address' => 'my address'
        ]);
        $response->assertStatus(403);
    }

    public function testIndexWithoutOrders()
    {
        $this->setAuthentication();
        $response = $this->get(route("orders.index"));
        $response->assertSee('No Orders');
    }
}
