<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
class AuthGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $findUser = User::where('email', $user->getEmail())->first();   
        if ($findUser) {
            Auth::login($findUser);
        } else {
            // If the user doesn't exist, you can create a new user
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'role' => 2,
                'google_id' => $user->id,
                'status' => 1,
                'password' => encrypt('my-google') // Generate a random password
            ]);
            Auth::login($newUser);
        }
        // Here you can handle the user information as needed
        // For example, you can create a new user or log in an existing one

        return redirect()->route('visitor.page')->with('success', 'Logged in successfully!');
    }
}
