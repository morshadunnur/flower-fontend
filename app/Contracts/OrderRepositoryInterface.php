<?php
/**
 * @author Author Name: Md Morshadun Nur
 * @email  Email: morshadunnur@gmail.com
 */

namespace App\Contracts;


interface OrderRepositoryInterface
{
    /**
     * @param $order_id
     * @return mixed
     */
    public function find($order_id);

    /**
     * @param $customer_id
     * @return mixed
     */
    public function findByCustomerId($customer_id);
}
