<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Social;
use App\Models\User as Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User;

class SocialService implements Social
{
    /**
     * @param User $socialUser
     * @param string $network
     * @return string
     * @throws \Exception
     */
    public function setUser(User $socialUser, string $network): string
    {
        $user = Model::query()->where('email', $socialUser->getEmail())->first();
        if($user) {
            $user->name = $socialUser->getName();
            $user->avatar = $socialUser->getAvatar();

            if($user->save()) {
                Auth::loginUsingId($user->id);

                return route('account');
            }
        }else {
            //register here
            return route('register');
        }

        throw new \Exception("Получаем ошибку через социальную сеть: " . $network);
    }
}
