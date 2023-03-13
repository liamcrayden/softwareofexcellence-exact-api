<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Laravel;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;

class SoftwareOfExcellenceExactAPIProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath($raw = __DIR__.'/../../config/soe_exact.php') ?: $raw;
        $this->publishes([$source => config_path('soe_exact.php')], 'soe_exact');
        $this->mergeConfigFrom($source, 'soe_exact');        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {                     
        $this->app->bind('exact_api_client', function(Container $app) {
            $config = $app->config->get('soe_exact');
            if ( $config )
            {                
                $exact = new ExactAPIClient( 
                    $config['client_id'], 
                    $config['client_secret'], 
                    $config['environment'], 
                    explode(',', $config['scopes']) 
                );
            } else { 
                $exact = new ExactAPIClient( 
                    env('SOE_EXACT_CLIENT_ID', ''), 
                    env('SOE_EXACT_CLIENT_SECRET', ''), 
                    env('SOE_EXACT_ENVIRONMENT', 'qa'), 
                    explode(',', env('SOE_EXACT_SCOPES', 'productsubscription.get')), 
                );
            }
            return $exact;
        }, true);

        
        $loader = AliasLoader::getInstance();
        $loader->alias('ExactAPIClient', ExactAPIClientFacade::class);
    }
}
