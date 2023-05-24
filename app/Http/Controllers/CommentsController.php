<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentsResource;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required',
            'news_id' => 'required',
        ]);
        $CommentsCreate = Comments::with('hasUser', 'hasNews')->create([
            'content' => $validatedData['content'],
            'news_id' => $validatedData['news_id'],
            'user_id' => Auth::user()->id,
        ]);
        return response()->json(['message' => 'Comments created successfully.', 'data' => new CommentsResource($CommentsCreate)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function show(Comments $comment)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function edit(Comments $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentsRequest  $request
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comments $comment)
    {
        if (Auth::user()->id != $comment->user_id) {
            return response()->json(['message' => 'anda tidak dapat mengubah komentar orang lain'], 403)->throwResponse();
        }
        $validatedData = $request->validate([
            'content' => 'required',
        ]);
        $comment->update($validatedData);
        return response()->json(['message' => 'Comments updated successfully.', 'data' => new CommentsResource($comment)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comments $comment)
    {
        if (Auth::user()->id != $comment->user_id && Auth::user()->role != 'admin') {
            return response()->json(['message' => 'anda tidak dapat menghapus komentar orang lain'], 403)->throwResponse();
        }
        $comment->delete();
        return response()->json(['message' => 'Comment Deleted successfully.', 'deleted data' => new CommentsResource($comment)], 200);
    }
}
