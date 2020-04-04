<?php


namespace App\Repositories;


use App\Order;
use DB;
use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OrderRepository implements IOrderRepository
{
    use Countable;
    private Order $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function getAllOrders()
    {
        return $this->model->with("user")->withCount('products')->latest("id")->paginate();
    }

    /**
     * @param array $data
     * @param array $products
     * @return Order
     * @throws \Throwable
     */
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
                ])->saveOrFail();
            }
            DB::commit();
            return $order;
        }
        catch (Exception $exception){
            DB::rollBack();
            if (request()->acceptsJson()){
                throw new HttpException(500,$exception->getMessage());
            }
            abort(500,"Error occurred: {$exception->getMessage()}" );
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
        return $this->model->where("user_id",$id)->withCount('products')->latest("id")->paginate();
    }


    /**
     * @return mixed
     */
    public function getTotalCost() : int
    {
        return $this->model->sum("total_money");
    }


}
