<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\TelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      if ($this->app->isLocal()) {
        $this->app->register(TelescopeServiceProvider::class);
      }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//      $this->hideSensitiveRequestDetails();
//
//      Telescope::filter(function (IncomingEntry $entry) {
//        if ($this->app->isLocal()) {
//          return true;
//        }
//
//        return $entry->isReportableException() ||
//          $entry->isFailedJob() ||
//          $entry->isScheduledTask() ||
//          $entry->hasMonitoredTag();
//      });
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
      Gate::define('viewTelescope', function ($user) {
        return in_array($user->email, [
          'taylor@laravel.com',
        ]);
      });
    }
}
