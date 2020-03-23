<?php


namespace App\Repositories;


use App\Order;
use DB;
use Exception;

class OrderRepository implements IOrderRepository
{
    private Order $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function getAllOrders()
    {
        return $this->model->with("user")->latest("id")->paginate();
    }

    public function create(array $data, array $products) : Order
    {
        DB::beginTransaction();
        try {
            $order = $this->model->create($data);
            foreach ($products as $product) {
                $order->products()->newPivot([
                    'order_id' => $order->id ,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity']
                ])->save();
            }
            DB::commit();
            return $order;
        }
        catch (Exception $exception){
            abort(500,"Error occurred:" . $exception->getMessage());
        }
    }

    public function findOrFail(int $id, array $columns = ['*']) : Order
    {
        return $this->model->findOrFail($id,$columns);
    }

    public function update(int $id,array $data) : bool
    {
        return $this->findOrFail($id)->update($data);
    }
    /**
     * @param int $id
     * @throws Exception
     */
    public function delete(int $id) : void
    {
       $this->findOrFail($id)->delete();
    }
    public function getByUserId(int $id)
    {
        return $this->model->where("user_id",$id)->latest("id")->paginate();
    }
}
