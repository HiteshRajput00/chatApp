<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credent =  $request->validate([
            'email' => 'required',
            'password' => 'required'
          ]);

          if(Auth::attempt($credent)){
            return redirect(url('/dashboard'));
          }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        Auth::login($user);
        return redirect(url('/dashboard'));
    }

    Public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
