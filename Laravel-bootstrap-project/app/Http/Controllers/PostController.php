<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Function used to create posts
    public function createPost(Request $request) {
        //implement that only logged user should create posts 

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']); // "strip_tags" ensures that no malicious code is written in the input fields
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id(); // This is used to get the id of the user (this particular istance). So "user_id" can be used as foreign key in the table posts
        
        Post::create($incomingFields);

        return redirect('/');
    }

    // Function used to redirect user to a page where he can modify is post
    public function showEditScreen(Post $post) {
        // If the user that want to modify the post isn't the same that made it, he get redirected to the home page
        if(auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]); // Whenever the if statement above is false, "view" brings the user to the page for modify the post
    }

    // Function used to update the post
    public function actuallyUpdatePost(Post $post, Request $request) {
        if(auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields); // "update"is used for updatign the content in the database

        return redirect('/');
    }

    public function deletePost(Post $post) {
        if(auth()->user()->id === $post['user_id']) {
            $post->delete(); // "delete" is used to delete the post in the database
        }

        return redirect('/');
    }
}
