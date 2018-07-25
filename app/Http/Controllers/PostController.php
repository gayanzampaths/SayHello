<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user()!=$post->user){
            return redirect()->back();
        }
        $post -> delete();
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
}
