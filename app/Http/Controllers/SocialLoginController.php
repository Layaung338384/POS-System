<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    //redirect page
    public function redirect($provider){ //provider login google || github
        return Socialite::driver($provider)->redirect();
    }

    //callback page

    public function callback($provider)
{
    try {
        $socialUser = Socialite::driver($provider)->user();

        // First try to find by email
        $user = User::where('email', $socialUser->email)->first();

        if ($user) {
            // Update existing user with social info
            $user->update([
                'name' => $socialUser->name ?? $socialUser->nickname,
                'nickname' => $socialUser->nickname ?? '',
                'provider_id' => $socialUser->id,
                'provider' => $provider,
                'provider_token' => $socialUser->token,
            ]);
        } else {
            // If user not found, create a new one
            $user = User::create([
                'name' => $socialUser->name ?? $socialUser->nickname,
                'nickname' => $socialUser->nickname ?? '',
                'email' => $socialUser->email,
                'provider_id' => $socialUser->id,
                'provider' => $provider,
                'provider_token' => $socialUser->token,
                'role' => 'user',
            ]);
        }

        Auth::login($user);
        return redirect()->route("userHome");

    } catch (\Exception $e) {
        \Log::error("Social login failed: " . $e->getMessage());
        return redirect()->route('login')->withErrors('Social login failed.');
    }
}


    //this is orginal callback
    // public function callback($provider){
    //     $socialLogin = Socialite::driver($provider)->user();

    //         $user = User::updateOrCreate([
    //             'provider_id' => $socialLogin->id,
    //         ], [
    //             'name' => $socialLogin->name,
    //             'nickname' => $socialLogin->nickname,
    //             'email' => $socialLogin->email,
    //             'provider_token' => $socialLogin->token,
    //             'provider' => $provider,  // github and google
    //             'role' => 'user'
    //         ]);

    //         Auth::login($user);
    //         return to_route("userHome");
    // }




}
