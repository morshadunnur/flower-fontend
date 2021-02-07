<?php
/**
 * @author Author Name: Md Morshadun Nur
 * @email  Email: morshadunnur@gmail.com
 */

namespace App\Repositories;


use App\Contracts\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var Order
     */
    private $model;

    /**
     * OrderRepository constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {

        $this->model = $model;
    }

    /**
     * @param $order_id
     * @return mixed|void
     */
    public function find($order_id)
    {

    }

    /**
     * @param $customer_id
     * @return mixed|void
     */
    public function findByCustomerId($customer_id)
    {
        return $this->model->select('*')->where([
            ['customer_id', $customer_id],
            ['type', 'cart']
        ])->first();
    }
}
