<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class emailReviewController extends Controller
{
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $rowcount = 5;

        if (strlen($katakunci)) {
            $visitorReviews = Contact::whereRaw('LOWER(name) like ?', ['%' . strtolower($katakunci) . '%'])
                ->orWhereRaw('LOWER(message) like ?', ['%' . strtolower($katakunci) . '%'])
                ->paginate($rowcount);
        } else {
            $visitorReviews = Contact::orderBy('name', 'desc')->paginate($rowcount);
        }

        return view('admin.reviews.displayReview', compact('visitorReviews'));
    }

}
