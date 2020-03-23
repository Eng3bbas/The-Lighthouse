<?php


namespace App\Services;

use Cart;
class CartService
{
    private ProductService $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function hasItems()
    {
        return !Cart::isEmpty();
    }
    public function getItems()
    {
        return Cart::getContent();
    }
    /**
     * @param int $id
     * @param int|null $quantity
     * @param array $attributes
     * @param array $conditions
     * @throws \Darryldecode\Cart\Exceptions\UnknownModelException
     */
    public function addItem(int $id,int $quantity = null, $attributes = [], $conditions = [])
    {
        $product = $this->productService->show($id);
        Cart::add(
            $id,
            $product->name,
            $product->price,
            $quantity,
            $attributes,
            $conditions
        )->associate('App\Product');
    }

    public function deleteItem(int $id)
    {
        abort_if(!$this->isItemExists($id),404,"Item not found in cart with id :[{$id}]");
        Cart::remove($id);
    }

    /**
     * @param int $id
     * @param string $updateType
     */
    public function updateQuantity(int $id , string $updateType)
    {
        abort_if(!$this->isItemExists($id),404,"Item not found in cart with id :[{$id}]");
        Cart::update($id,[
            'quantity' => $updateType === "increment" ? 1 : -1
        ]);
    }

    public function getTotalPrice()
    {
        return Cart::getTotal();
    }

    public function getItemsCount()
    {
        return Cart::getContent()->count();
    }
    public function isItemExists(int $id)
    {
        return Cart::has($id);
    }

    public function clear()
    {
        Cart::clear();
    }
}
