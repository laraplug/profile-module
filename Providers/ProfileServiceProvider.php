<?php

namespace Modules\Profile\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Profile\Entities\Profile;

class ProfileServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('profiles', array_dot(trans('profile::profiles')));
            // append translations

        });

        // Add Profile Relation to User
        config()->set('asgard.user.config.relations.profile', function() {
            return $this->hasOne(Profile::class);
        });
        // Add request rules when Register
        config()->set('asgard.user.config.requests.register.rules', [
            'profile.phone' => 'required|string',
            'profile.postcode' => 'required|string',
            'profile.address' => 'required|string',
            'profile.address_detail' => 'required|string',
        ]);
    }

    public function boot()
    {

        // Set request message after the translation is loaded
        config()->set('asgard.user.config.requests.register.messages', [
            'profile.phone.required' => trans('profile::profiles.messages.phone is required'),
            'profile.postcode.required' => trans('profile::profiles.messages.postcode is required'),
            'profile.address.required' => trans('profile::profiles.messages.address is required'),
            'profile.address_detail.required' => trans('profile::profiles.messages.address_detail is required'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Profile\Repositories\ProfileRepository',
            function () {
                $repository = new \Modules\Profile\Repositories\Eloquent\EloquentProfileRepository(new \Modules\Profile\Entities\Profile());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Profile\Repositories\Cache\CacheProfileDecorator($repository);
            }
        );
// add bindings

    }
}
