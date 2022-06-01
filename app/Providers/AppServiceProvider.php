<?php

namespace App\Providers;

use App\Services\Import\CompositeImporter;
use App\Services\Import\Google\Importer;
use App\Services\Import\ImporterContext;
use App\Services\Import\NewYorkTime\Client;
use App\Services\Import\PegasasImporter;
use Illuminate\Support\ServiceProvider;
use App\Services\Import\NewYorkTime\Importer as NewYorkTime;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function () {
            return new Client(config('import.new_york_time.secret'));
        });

        $this->app->bind('nyt.client', function () {
            return new Client(config('import.new_york_time.secret'));
        });

        $this->app->tag([Importer::class, NewYorkTime::class, PegasasImporter::class], 'importers');

        $this->app->bind(ImporterContext::class, function () {
            return new ImporterContext($this->app->tagged('importers'));
        });

        $this->app->bind(CompositeImporter::class, function () {
            return new CompositeImporter($this->app->tagged('importers'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
