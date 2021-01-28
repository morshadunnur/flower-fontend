<?php
/**
 * @author Author Name: Md Morshadun Nur
 * @email  Email: morshadunnur@gmail.com
 */

namespace App\Repositories;


use App\Contracts\CartRepositoryInterface;
use App\Models\Order;

class CartRepository implements CartRepositoryInterface
{
    /**
     * @var Order
     */
    private $model;

    /**
     * CartRepository constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {

        $this->model = $model;
    }

    public function getItems($customer_id)
    {
        return $this->model->select('*')
            ->where('customer_id', $customer_id)
            ->where('type', 'cart')
            ->get();
    }
}
