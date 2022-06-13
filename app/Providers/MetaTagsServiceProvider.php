<?php

namespace App\Providers;

use Butschster\Head\Contracts\Packages\PackageInterface;
use Butschster\Head\Packages\Package;
use Butschster\Head\MetaTags\Entities\Favicon;
use Butschster\Head\Facades\PackageManager;
use Butschster\Head\MetaTags\Meta;
use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Butschster\Head\Contracts\Packages\ManagerInterface;
use Butschster\Head\Providers\MetaTagsApplicationServiceProvider as ServiceProvider;

class MetaTagsServiceProvider extends ServiceProvider
{
    protected function packages()
    {
        // Favicons
        PackageManager::create('favicons', function (Package $package) {
            $package->setFavicon(asset('favicon.ico'))
                ->addTag(
                    'favicon.16x16',
                    new Favicon(asset('favicon-16x16.png'), [
                        'sizes' => '16x16'
                    ])
                )
                ->addTag(
                    'favicon.32x32',
                    new Favicon(asset('favicon-32x32.png'), [
                        'sizes' => '32x32'
                    ])
                )
                ->addLink('apple-touch-icon-precomposed', [
                    'href' => asset('apple-touch-icon-144x144.png'),
                    'sizes' => '144x144'
                ])
                ->addLink('apple-touch-icon-precomposed', [
                    'href' => asset('apple-touch-icon-152x152.png'),
                    'sizes' => '152x152'
                ])
                ->addMeta('application-name', ['content' => 'Stuffed Recipes'])
                ->addMeta('msapplication-TileColor', ['content' => '#ffffff'])
                ->addMeta('msapplication-TileImage', ['content' => asset('mstile-144x144.png')]);
        });

        // Application Styles
        PackageManager::create('application_styles', function (Package $package) {
            $package->addStyle('app.css', mix('css/stuffed.css'));
        });

        // Application Scripts
        PackageManager::create('application_scripts', function (Package $package) {
            $package->addScript('app.js', mix('js/stuffed.js'), ['defer'], Meta::PLACEMENT_HEAD);
        });
    }

    // if you don't want to change anything in this method just remove it
    protected function registerMeta(): void
    {
        $this->app->singleton(MetaInterface::class, function () {
            $meta = new Meta(
                $this->app[ManagerInterface::class],
                $this->app['config']
            );

            // It just an imagination, you can automatically
            // add favicon if it exists
            // if (file_exists(public_path('favicon.ico'))) {
            //    $meta->setFavicon('/favicon.ico');
            // }

            // This method gets default values from config and creates tags, includes default packages, e.t.c
            // If you don't want to use default values just remove it.
            $meta->initialize();

            return $meta;
        });
    }
}
