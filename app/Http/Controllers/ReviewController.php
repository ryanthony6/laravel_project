<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::orderBy('id', 'asc')->paginate(6);

        return view('admin.reviews.reviews', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the number of reviews has reached the limit
        if (Review::count() >= 6) {
            return redirect()->route('reviews.index')->with('error', 'You cannot add more than 6 reviews.');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'comment' => 'required|string',
        ]);

        // Create a new review
        Review::create($request->all());

        // Redirect to the reviews index page
        return redirect()->route('reviews.index')->with('success', 'Review added successfully.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::find($id);

        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'comment' => 'required|string',
        ]);
        $review = Review::find($id);
        $review->update($request->all());
        return redirect()->route('reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::find($id);
        $review->delete();
        return redirect()->route('reviews.index');
    }
}
