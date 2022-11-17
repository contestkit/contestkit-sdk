<?php

namespace ContestKit\Sdk;

use ContestKit\Sdk\Client\ContestKitClient;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ContestKitServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('sdk')
            ->hasConfigFile();
        // ->hasViews()
            // ->hasMigration('create_skeleton_table')
            // ->hasCommand(SkeletonCommand::class);
    }

    public function registeringPackage()
    {
        $this->app->singleton(
            ContestKitClient::class,
            fn () => new ContestKitClient(config('sdk'))
        );
    }
}
