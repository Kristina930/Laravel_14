<?php

declare(strict_types=1);

namespace App\Contracts;

use Laravel\Socialite\Contracts\User;

interface Social
{
    /**
     * @param User $socialUser
     * @param string $network
     * @return string
     */
    public function setUser(User $socialUser, string $network): string;
}
