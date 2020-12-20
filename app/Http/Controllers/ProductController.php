<?php
/**
 * @author Author Name: Md Morshadun Nur
 * @email  Email: morshadunnur@gmail.com
 */

namespace App\Http\Controllers;


use App\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * ProductController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getProductList(ProductRepositoryInterface $productRepository): \Illuminate\Http\JsonResponse
    {
        $products = $productRepository->get()->map(function ($product) {
            return [
                'productId'    => $product->id,
                'productName'  => $product->title,
                'slug'         => $product->slug,
                'productThumb' => $product->feature_image,
                'Description'  => $product->description,
                'price'        => $product->prices[0]->selling_price,
                'stock'        => $product->prices->sum('quantity')
            ];
        });
        return response()->json($products, 200);
    }
}
