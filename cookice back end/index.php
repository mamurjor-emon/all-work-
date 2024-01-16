<!-- steps in coolices  -->
1. composer require statikbe/laravel-cookie-consent
2. php artisan vendor:publish --provider="Statikbe\CookieConsent\CookieConsentServiceProvider" --tag="public"
3. <link rel="stylesheet" type="text/css" href="{{asset("vendor/cookie-consent/css/cookie-consent.css")}}">
4.  app/Http/Kernel.php => 
    class Kernel extends HttpKernel
    {
        protected $middleware = [
            // ...
            \Statikbe\CookieConsent\CookieConsentMiddleware::class,
        ];

        // ...
    }
5. app/Http/Kernel.php
   class Kernel extends HttpKernel
    {
    // ...

    protected $routeMiddleware = [
        // ...
        'cookie-consent' => \Statikbe\CookieConsent\CookieConsentMiddleware::class,
    ];
    }
6. routes/web.php
    Route::group([
        'middleware' => ['cookie-consent']
    ], function(){
        // ...
    });
7. php artisan vendor:publish --provider="Statikbe\CookieConsent\CookieConsentServiceProvider" --tag="lang"
8. (optional) 
    return [
        'alert_title' => 'Deze website gebruikt cookies',
        'setting_analytics' => 'Analytische cookies',
    ];
9. php artisan vendor:publish --provider="Statikbe\CookieConsent\CookieConsentServiceProvider" --tag="views"
10. <a href="javascript:void(0)" class="js-lcc-settings-toggle">@lang('cookie-consent::texts.alert_settings')</a>
11. php artisan vendor:publish --provider="Statikbe\CookieConsent\CookieConsentServiceProvider" --tag="config"
12. (optional)
    return [
        'cookie_key' => '__cookie_consent',
        'cookie_value_analytics' => '2',
        'cookie_value_marketing' => '3',
        'cookie_value_both' => 'true',
        'cookie_value_none' => 'false',
        'cookie_expiration_days' => '365',
        'gtm_event' => 'pageview',
        'ignored_paths' => [],
        'policy_url_en' => env('COOKIE_POLICY_URL_EN', null),
        'policy_url_fr' => env('COOKIE_POLICY_URL_FR', null),
        'policy_url_nl' => env('COOKIE_POLICY_URL_NL', null),
    ];
13. 'ignored_paths => ['/en/cookie-policy', '/api/documentation*']; 
    (You can customize some settings that work with your GTM.Don't show modal on cookie policy page or other pagesIf you don't want the modal to be shown on certain pages you can add the relative url to the ignored paths setting. This also accepts wildcards (see the Laravel Str::is() helper).)
14. php artisan vendor:publish --provider="Statikbe\CookieConsent\CookieConsentServiceProvider" --tag="lang"
15. php artisan vendor:publish --provider="Statikbe\CookieConsent\CookieConsentServiceProvider" --tag="views"


<!-- End  -->
        
