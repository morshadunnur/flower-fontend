<?php

namespace App\Http\Controllers;

use App\Contracts\CartRepositoryInterface;
use App\Models\Order;
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
                'order_id' => 'required|integer|exists:orders,id'
            ]);

            $order = tap(Order::find($data['order_id']), function ($value){
                $value->update([
                    'type' => 'order'
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
}
