<?php
/**
 * @author Author Name: Md Morshadun Nur
 * @email  Email: morshadunnur@gmail.com
 */

namespace App\Contracts;


interface OrderDetailsRepositoryInterface
{
    /**
     * @param $details_id
     * @return mixed
     */
    public function find($details_id);
}
