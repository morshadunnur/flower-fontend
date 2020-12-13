<?php
/**
 * @author Author Name: Md Morshadun Nur
 * @email  Email: morshadunnur@gmail.com
 */

namespace App\Repositories;


use App\Contracts\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Product
     */
    private $model;

    /**
     * ProductRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {

        $this->model = $model;
    }

    public function get(): \Illuminate\Support\Collection
    {
        return $this->model->active()->with('prices')->get();
    }
}
