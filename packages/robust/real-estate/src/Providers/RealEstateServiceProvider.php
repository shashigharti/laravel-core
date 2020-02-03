<?php

namespace Robust\RealEstate\Providers;

use Illuminate\Support\ServiceProvider;
use Robust\RealEstate\Events\SendEmailToFriend;
use Robust\RealEstate\Helpers\CoreSettingHelper;
use Robust\RealEstate\Helpers\AdvanceSearchHelper;
use Robust\RealEstate\Helpers\TabsHelper;
use Robust\RealEstate\Listeners\SendEmailToFriendListener;
use Robust\RealEstate\Console\Kernel;

/**
 * Class RealEstateServiceProvider
 * @package Robust\RealEstate\Providers
 */
class RealEstateServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Robust\RealEstate\Console\Commands\DataPull\DataPull',
        'Robust\RealEstate\Console\Commands\DataPull\PropertiesPull',
        'Robust\RealEstate\Console\Commands\DataPull\LocationsPull',
        'Robust\RealEstate\Console\Commands\DataPull\ImagesPull',
        'Robust\RealEstate\Console\Commands\DataPull\RetsPullAll',

        'Robust\RealEstate\Console\Commands\BannerPropertyCount',
        'Robust\RealEstate\Console\Commands\UpdateListingNames',
        'Robust\RealEstate\Console\Commands\CreateAttributes',
        'Robust\RealEstate\Console\Commands\CreateLocations',
        'Robust\RealEstate\Console\Commands\CreateMarketReport',
        'Robust\RealEstate\Console\Commands\UpdateGeoLocations',
        'Robust\RealEstate\Console\Commands\UpdateLocationsCount',
        'Robust\RealEstate\Console\Commands\RegisterCommands',

        'Robust\RealEstate\Console\Commands\Installation\ResetSinglePageDetail',
        'Robust\RealEstate\Console\Commands\ListingsAlertToLead',
        'Robust\RealEstate\Console\Commands\MultiplePropertyViewAlert',
    ];


    public function register()
    {
        parent::register(); // TODO: Change the autogenerated stub

        $this->app->bind(AdvanceSearchHelper::class, function ($app) {
            return new AdvanceSearchHelper($app->make('Robust\RealEstate\Repositories\Website\AttributeRepository'));
        });

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'real-estate');
        $this->register_includes();
    }

    public function register_includes()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/permissions.php', 'real-estate.permissions');
        $this->mergeConfigFrom(__DIR__ . '/../../config/frw.php', 'real-estate.frw');
        $this->mergeConfigFrom(__DIR__ . '/../../config/settings.php', 'real-estate.settings');
        $this->mergeConfigFrom(__DIR__ . '/../../config/single-page-detail.php', 'real-estate.single-page-detail');
        $this->commands($this->commands);
    }
}
