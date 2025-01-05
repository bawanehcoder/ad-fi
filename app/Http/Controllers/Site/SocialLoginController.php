<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\HandleSocialMediaLoginCallbackRequest;
use App\Http\Requests\Site\RedirectToProviderRequest;
use App\Services\SocialLoginService;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider(RedirectToProviderRequest $request)
    {

        switch ($request->validated()['provider']) {
            case 'twitter':

                // dd(Socialite::driver($request->validated()['provider'])->redirect());
                return Socialite::driver($request->validated()['provider'])->redirect();



            case 'facebook':
            case 'instagram':
            case 'google':
                //  dd(Socialite::driver($request->validated()['provider'])->stateless()->redirect());

                return Socialite::driver($request->validated()['provider'])->stateless()->redirect();
            default:
                abort(500);
                break;
        }
    }
    public function handleProviderCallback(HandleSocialMediaLoginCallbackRequest $request)
    {

        //get user data
        return SocialLoginService::ProviderCallback('google');

    }

    public function google()
    {
        return SocialLoginService::ProviderCallback('google');

        // Socialite::driver('google')->stateless()->user();
    }

    public function facebook()
    {
        return SocialLoginService::ProviderCallback('facebook');

        // Socialite::driver('google')->stateless()->user();
    }
}
