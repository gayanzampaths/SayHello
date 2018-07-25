<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function about(){
        return view('pages.about');
    }

    public function timeline(){
        $posts = Post::orderBy('created_at', 'desc')->get();
        //$users = User::all();
        return view('pages.timeline',['posts' => $posts /*,'users' => $users*/]);
    }

    public function profile(){
        $uposts = Post::where('user_id',Auth::user()->id)->get();
        $user = Auth::user();
        return view('pages.profile',['uposts' => $uposts, 'user' => $user]);
    }

    public function editProfile(){
        $user = Auth::user();
        return view('pages.editprofile',['user'=>$user]);
    }
}
