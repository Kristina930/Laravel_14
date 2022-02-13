<?php

namespace App\Providers;

use App\Events\LoginEvent;
use App\Listeners\UpdateLastLoginAtListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    //Через запятую мы добавляем слушателей, связка 3

    /**
     * @var \string[][]
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LoginEvent::class => [
            UpdateLastLoginAtListener::class,
        ],
        //почему-то не видит данные ссылки
        /*SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\\VKontakte\\VKontakteExtendSocialite@handle',*/
        SocialiteProviders\Manager\SocialiteWasCalled::class => [
        // ... other providers
        SocialiteProviders\VKontakte\VKontakteExtendSocialite::class.'@handle',
        ],

        SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // ... other providers
            SocialiteProviders\GitHub\GitHubExtendSocialite::class.'@handle',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
