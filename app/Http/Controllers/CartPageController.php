<?php

namespace App\Http\Controllers;

use App\Contracts\CartRepositoryInterface;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartPageController extends Controller
{
    public function singleCartPage()
    {
        return view('cart.single');
    }

    /**
     * @param CartRepositoryInterface $cartRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function cartList(CartRepositoryInterface $cartRepository): \Illuminate\Http\JsonResponse
    {
        if (Auth::check()){
            try{
                $cartItem = $cartRepository->getItems(auth()->user()->id);
                return response()->json($cartItem);
            }catch (QueryException|\Exception $e){
                return response()->json('Something went happen', 406);
            }
        }else{
            return response()->json('No items in cart', 404);
        }
    }

    public function checkoutCart(Request $request)
    {
        // validate
        try {
            $data = $this->validate($request, [
                'order_id' => 'required|integer|exists:orders,id',
                'street_address' => 'required | string |max:255',
                'post_code' => 'required|integer|min:1|max:9999',
                'city' => 'required|string|max:100',
                'country'=> 'required|string|max:100'
            ]);

            $order = tap(Order::find($data['order_id']), function ($value)use($data){
                $value->update([
                    'type' => 'order',
                    'address' => auth()->user()->address ?? null,
                    'shipping_address' => json_encode([
                        $data['street_address'],
                        $data['post_code'],
                        $data['city'],
                        $data['country']
                    ], true),
                ]);
            });
            return response()->json($order, 204);

        }catch (ValidationException $exception){
            return response()->json($exception->errors(), 422);
        }catch (QueryException | \Exception $exception){
            dd($exception);
            return response()->json('something went wrong', 406);
        }
        // order status update

        // return response
    }

    public function updateCart(Request $request)
    {
        try {
            $data = $this->validate($request, [
                'order_details_id' => 'required|integer|exists:order_details,id',
                'quantity' => 'required|numeric|min:1',
            ]);

            $order = tap(OrderDetail::find($data['order_details_id']), function ($value) use($data){
                $value->update([
                    'quantity' => $data['quantity']
                ]);
            });
            return response()->json($order, 206);

        }catch (ValidationException $exception){
            return response()->json($exception->errors(), 422);
        }catch (QueryException | \Exception $exception){
            return response()->json('something went wrong', 406);
        }
    }

    public function removeCart(Request $request, CartRepositoryInterface $cartRepository)
    {
        try {
            $data = $this->validate($request, [
                'order_details_id' => 'required|integer|exists:order_details,id'
            ]);
            // remove item
            tap(OrderDetail::find($data['order_details_id']), function ($value){
                $value->destroy($value->id);
            });
            $cartItem = $cartRepository->getItems(auth()->user()->id);

            return response()->json($cartItem, 206);

        }catch (ValidationException $exception){
            return response()->json($exception->errors(), 422);
        }catch (QueryException | \Exception $exception){
            dd($exception);
            return response()->json('something went wrong', 406);
        }
    }

    public function confirmCheckOut()
    {
        return view('cart.confirm-checkout');
    }
}
