<?php
/**
 * @author Author Name: Md Morshadun Nur
 * @email  Email: morshadunnur@gmail.com
 */

namespace App\Http\Controllers;


use App\Contracts\ProductRepositoryInterface;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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

    public function getProductDetails(Request $request, ProductRepositoryInterface $productRepository)
    {
        try{
            $data = $this->validate($request, [
                'product_id' => 'required|numeric|integer|min:1|exists:products,id'
            ]);
            $product = $productRepository->getDetailsById($data['product_id']);
            return response()->json($product, 200);
        }catch (ValidationException $exception){
            return response()->json([
                'errors' => $exception->errors()
            ], 422);
        }
    }

    public function processCart(Request $request)
    {
        if (Auth::check()){
            // validate data
            $data = $this->validate($request, [
                'product_id' => 'required|numeric|integer|exists:products,id',
                'selling_price' => 'required|numeric',
                'quantity' => 'required|numeric'
            ]);
            // Create new cart type order and add order details
            $order = DB::transaction(function() use ($request){
                return $order = tap(Order::create([
                    'customer_id' => auth()->user()->id,
                    'global_order_status' => 1,
                    'type' => 'cart',
                    'placed_date' => date('Y-m-d H:i:s')
                ]), function ($order) use ($request){
                    OrderDetail::create([
                       'order_id' => $order->id,
                       'product_id' => $request->product_id,
                       'quantity' => $request->quantity,
                       'price' => $request->selling_price,
                       'status' => 1,
                    ]);
                });
            });
            return response()->json($order, 200);
        }else{
            return response()->json('Guest user', 401);
        }
    }
}
