<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Exception;

class PostController extends Controller
{
    protected $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     * This is the test comment for checking the workflow
     */
    public function index()
    {
        try {
            $user = \App\Models\User::find(1);
            $posts = $this->postService->index();
            return response()->json(['data' => $posts], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve posts', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     * This is the again comment for checking the github action
     * This is the again comment for checking the github action
     */
    public function store(PostRequest $request)
    {
        try {
            $post = $this->postService->store($request);
            return response()->json(['data' => $post], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to store posts', 'message' => $e->getMessage()], 422);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show($postId)
    {
        try{
            $post = $this->postService->show($postId);
            return response()->json(['data' => $post, "message" => "Data send successfully"], 200);
        }catch(Exception $e){
            return response()->json(['error' => 'Post not found', 'message' => $e->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $postId)
    {
        try {
            $post =$this->postService->update($request, $postId);
            return response()->json(['data'=>$post], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update post', 'message' => $e->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($postId)
    {
        try{
            $postDeleted = $this->postService->delete($postId);
            return response()->json(['data' => $postDeleted], 200);
        }catch(Exception $e){
            return response()->json(['error' => 'Failed to delete post', 'message' => $e->getMessage()], 422);
        }
    }
}
