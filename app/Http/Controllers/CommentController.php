<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('user', 'feedback')->paginate(10);

        return response()->json(['data' => $comments], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'feedback_id' => 'required|exists:feedbacks,id',
            'content' => 'required|string',
        ]);

        $comment = Comment::create([
            'feedback_id' => $request->input('feedback_id'),
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return response()->json(['message' => 'Comment created successfully', 'data' => $comment], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
