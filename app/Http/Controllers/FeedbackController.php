<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedback::with('user','comments.user')->paginate(10);

        return response()->json(['data' => $feedbacks], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|in:bug report,feature request,improvement',
            'product_id' => 'required'
        ]);

        $feedback = Feedback::create($request->all());

        return response()->json(['message' => 'Feedback created successfully', 'data' => $feedback], 201);
    }
}
