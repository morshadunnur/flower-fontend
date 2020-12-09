<?php
/**
 * @author Author Name: Md Morshadun Nur
 * @email  Email: morshadunnur@gmail.com
 */

namespace App\Repositories;


use App\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{

    public function get(): \Illuminate\Support\Collection
    {
        return DB::table('products')->select('id','title','feature_image','description')->where('status', 1)->get();
    }
}
