<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;

class GoogleAuthController extends Controller
{
    // login page
    public function index()
    {
        return view('login');
    }

    // redirect to google log in
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // callback function (if login from google successful)
    public function callbackGoogle()
    {
        try {
            // get user data from google
            $userGoogle = Socialite::driver('google')->user();

            // try to find user in the database
            $user = User::where('email', $userGoogle->getEmail())
                ->orWhere('google_id', $userGoogle->getId())
                ->first();

            // if user is found and google id is not empty
            if ($user && $user->google_id != null) {
                // login the user
                auth()->login($user);
                Request()->session()->regenerate();

                return redirect()->intended(route('user.home'))->with('success', "You're logged in!");
            } else if ($user && $user->google_id == null) {
                //
                $user->name = $userGoogle->getName();
                $user->google_id = $userGoogle->getId();
                $user->email_verified_at = now();
                $user->created_at = now();
                $user->save();

                // login the user
                auth()->login($user);
                Request()->session()->regenerate();
                return redirect()->intended(route('user.home'))->with('success', "You're logged in!");

            } else {
                // create new user
                $newUser = User::create([
                    'name' => $userGoogle->getName(),
                    'email' => $userGoogle->getEmail(),
                    'google_id' => $userGoogle->getId(),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                ]);

                // login the user
                auth()->login($newUser);
                Request()->session()->regenerate();

                return redirect()->route('user.home')->with('success', "You're logged in!");
            }
        } catch (\Exception $e) {
            // if failed to login with google
            return redirect()->route('login')->with('alert', 'Login Failed');
        }
    }

    // redirect admin
    public function redirectToGoogleAdmin()
    {
        return Socialite::buildProvider(
            GoogleProvider::class,
            config('services.google-admin')
        )->redirect();
    }

    // callback function (if login from google successful)
    public function callbackGoogleAdmin()
    {
        try {
            // get user data from google
            $userGoogle = Socialite::buildProvider(
                GoogleProvider::class,
                config('services.google-admin')
            )->user();

            // try to find user in the database
            $user = User::where('email', $userGoogle->getEmail())
                ->orWhere('google_id', $userGoogle->getId())
                ->first();

            // if user is found
            if ($user && $user->role == 'admin') {
                // update the data (assumed that admin is injectedly added from the database and the google ID is still empty)
                if ($user->google_id != $userGoogle->getId()) {
                    $user->name = $userGoogle->getName();
                    $user->google_id = $userGoogle->getId();
                    $user->email_verified_at = now();
                    $user->created_at = now();
                    $user->save();
                }

                // login the user
                auth()->login($user);
                Request()->session()->regenerate();

                // check if the user is an admin or a regular user
                return redirect()->intended(route('admin.dashboard'))->with('success', "You're logged in as admin!");
            } else {
                // if not found, then redirect to the login page
                return redirect()->route('login')->with('alert', 'Login Failed');
            }
        } catch (\Exception $e) {
            // if failed to login with google
            return redirect()->route('login')->with('alert', 'Login Failed');
        }
    }

    public function logout()
    {
        auth()->logout();
        Request()->session()->invalidate();
        Request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}
