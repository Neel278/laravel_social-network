<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function getDashboard()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('dashboard', ['posts' => $posts]);
    }
    public function postCreatePost(Request $request)
    {
        //validation
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        //get post
        $post = new Post();
        $post->body = $request['body'];
        $message = "There was an error !!";
        //first save user_id then post of that user
        if ($request->user()->posts()->save($post)) {
            $message = "Post Inserted Successfully !!";
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }
    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('dashboard')->with(['message' => 'Message Deleted Successfully !!']);
    }
    public function postEditPost(Request $request)
    {
        // validation
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $post = Post::find($request['postId']);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->update();
        return response()->json(['new_body' => $post->body], 200);
    }
    public function postLikePost(Request $request)
    {
        //data fetch from $request

        //check if already like or dislike is available or not

        //if already available then check if it is same like to like or dislike to dislike

        //if same like->like or dislike->dislike then cancel like or dislike(update)

        //if they are not same then add new like or dislike(save)

        //save or update all info accordingly
    }
}
