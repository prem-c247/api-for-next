<?php 
// app/Services/PostService.php
namespace App\Services;

use App\Models\Post;

class PostService
{
    /**
     * Retrieve all posts from the database.
     *
     * @return array An array of all posts.
     */


    public function index(): array
    {
        $post = Post::all()->toArray();
        return array('posts' => $post);
    }
    
    /**
     * Create a new post and persist it to the database.
     *
     * @param Illuminate\Http\Request $request
     * @return array An array containing a message and the created post.
     */
    public function store($request): mixed
    {
        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
        return array('message' => 'Post created successfully', 'post' => $post);
    }

    public function show($postId): mixed
    {
        $post = Post::find($postId);
        return array('post' => $post);
    }
    /**
     * Update a post and persist it to the database.
     *
     * @param Post $post
     * @param array $data
     * @return array An array containing a message and the updated post.
     */
    public function update($request, $postId): mixed
    {
        $title = $request->input('title');
        $content = $request->input('content');
        Post::where('id', $postId)->update([
            'title' => $title,
            'content' => $content,
        ]);
        return array('message' => 'Post Updated successfully');
    }


    /**
     * Delete a post from the database.
     *
     * @param Post $post The post to be deleted.
     * @return array An array containing a message.
     */
    public function delete($postId): array
    {
        $post =  Post::find($postId)->delete();
        return array('message' => 'Post Deleted successfully');
        
    }
}
