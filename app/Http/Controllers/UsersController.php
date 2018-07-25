<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function postSignUp(Request $request){

        $this -> validate($request, [
            'email' => 'email|unique:users|required',
            'name' => 'required',
            'pwd' => 'required|min:6'
        ]);

        $email = $request['email'];
        $name = $request['name'];
        $password = bcrypt($request['pwd']);

        $user = new User();
        $user -> email = $email;
        $user -> name = $name;
        $user -> password = $password;

        $user -> save();

        Auth::login($user);

        return redirect('timeline');
    }

    public function postSignIn(Request $request){

        $this -> validate($request, [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            return redirect() -> intended('timeline');
        }
        return redirect() -> back();
    }

    public function getLogout(){
        Auth::logout();
        return redirect()-> route('/');
    }

    public function saveProfile(Request $request){

        $this->validate($request, [
            'name' => 'required|max:120',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg'
        ]);
        $user = Auth::user();
        $user->name = $request['name'];
        $user->update();
        $file = $request->file('image');
        $filename = $request['name'].'_'.$user->id.'.jpg';
        if($file){
            Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('profile');
    }

    public function fetchImage($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file,200);
    }

}
