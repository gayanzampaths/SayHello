<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

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
        return redirect('timeline')->with(['message' => $message]);
    }

    public function getDeletePost($post_id){
        $post = Post::where('id',$post_id)->first();
        $post -> delete();
        return redirect('timeline') ->with(['message' => 'Successfully Deleted!']);
    }
}
