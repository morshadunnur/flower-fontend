<?php

namespace App\Http\Controllers;

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
        $this->middleware('guest');
    }
    public function index()
    {
        return view('home');
    }
}
