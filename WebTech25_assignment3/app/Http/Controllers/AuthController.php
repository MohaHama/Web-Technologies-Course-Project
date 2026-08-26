<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSignUp()
    {
        return view('signUp');
    }

    public function signUp(Request $request)
    {
        /* VAlidate request that is sent from the form */
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        /* Create a user model and send it to user table with password hashed */
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        /* Redirect the user to log in page so they can log in with their new account */
        return redirect()->route('login');
    }

    public function showLogin()
    {
        return view('logIn');
    }

    public function logIn(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('event.index');
        }
        return back()->withErrors(['error' => 'Incorrect email or password']);
    }

    public function logOut()
    {
        /* Log user out and redirect to index page */
        Auth::logout();
        return redirect()->route('event.index');
    }
}
