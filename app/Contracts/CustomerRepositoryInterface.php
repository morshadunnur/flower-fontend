<?php
/**
 * @author Author Name: Md Morshadun Nur
 * @email  Email: morshadunnur@gmail.com
 */

namespace App\Contracts;


interface CustomerRepositoryInterface
{
    /**
     * @param $customer_id
     * @return mixed
     */
    public function find($customer_id);
    public function get();
    public function all();
}
