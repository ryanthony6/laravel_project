<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reviews = Review::all();
        return view('homepage', compact('reviews'));
    }

}