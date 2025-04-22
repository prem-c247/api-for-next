<?php 
namespace App\Services;

use App\Models\User;

class ProfileService
{

    public function profile(): array
    {
        $user = User::findOrFail(auth()->user()->id);
        return array('user' => $user);
    }

    /**
     * Update a post and persist it to the database.
     *
     * @param Post $post
     * @param array $data
     * @return array An array containing a message and the updated post.
     */
    public function update($request, User $user): mixed
    {
        $name = $request->input('name');
        $role = $request->input('role');
        $user->update([
            'name' => $name,
            'role' => $role,
        ]);
        return array('message' => 'Profile Updated successfully');
    }


    /**
     * Delete a post from the database.
     *
     * @param Post $post The post to be deleted.
     * @return array An array containing a message.
     */
    public function delete(Post $post): array
    {
       $post =  $post->delete();
        if($post){
           return array('message' => 'Post Deleted successfully');
        }else{
           return array('message' => 'Something is wrong');
        }
    }
    public function delete1(Post $post): array
    {
       $post =  $post->delete();
        if($post){
           return array('message' => 'Post Deleted successfully');
        }else{
           return array('message' => 'Something is wrong');
        }
    }

    public function badPractice() {
        if (1 == 1) {
            echo 'Do something dangerous!';
        }
    }

    public function duplicate1() {
        echo "Duplicate me!";
    }
    
    public function duplicate2() {
        echo "Duplicate me!";
    }
    public function duplicate3() {
        echo "Duplicate me!";
    }
}
