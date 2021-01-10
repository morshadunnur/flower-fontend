<?php

namespace App\Http\Controllers;

use App\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * HomePageController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index()
    {
        return view('home');
    }

    public function detailsProduct($slug, ProductRepositoryInterface $productRepository)
    {
        $product = $productRepository->findBySlug($slug);
        if (!$product) return redirect()->route('flower.home');
        return view('product.details', compact('product'));
    }
}
