<?php

namespace Strappberry\Devkillerinator;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Strappberry\Devkillerinator\Commands\DevkillerinatorLandingCommand;
use Strappberry\Devkillerinator\Commands\DevkillerinatorModelCommand;

class DevkillerinatorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('devkillerinator')
            ->hasConfigFile()
            // ->hasViews()
            // ->hasMigration('create_devkillerinator_table')
            ->hasCommands([
                DevkillerinatorLandingCommand::class,
                DevkillerinatorModelCommand::class,
            ]);
    }
}
