<?php

namespace App\Http\Controllers;

use App\Contracts\CartRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartPageController extends Controller
{
    public function singleCartPage()
    {
        return view('cart.single');
    }

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
            return response()->json('No items for this user', 404);
        }
    }
}
