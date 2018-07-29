<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function postCreatePost(Request $request){

        $this->validate($request, [
           'body' =>  'required|max:1000'
        ]);

        $post = new Post();
        $post -> body = $request['body'];
        $message = 'There was an Error!';
        if($request -> user() -> posts() -> save($post)){
            $message = 'Post Successfully Created!';
        }
        return redirect()->route('timeline')->with(['message' => $message]);
    }

    public function getDeletePost($post_id){
        $post = Post::where('id',$post_id)->first();
        $like = Like::where('post_id',$post_id);
        if(Auth::user()!=$post->user){
            return redirect()->back();
        }
        $post -> delete();
        $like -> delete();

        return redirect()->route('timeline') ->with(['message' => 'Successfully Deleted!']);
    }

    public function postEditPost(Request $request){
        $this->validate($request, [
            'body' => 'required',
            'postId' => 'required'
        ]);
        $post = Post::find($request['postId']);
        if(Auth::user()!=$post->user){
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->update();
        return response() -> json(['new_body' => $post->body], 200);
    }

    public function likePost(Request $request){
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }
}
