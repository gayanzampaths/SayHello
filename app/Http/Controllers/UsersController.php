<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
