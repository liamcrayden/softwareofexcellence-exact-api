<?php 

namespace Crayden\SoftwareOfExcellenceExactAPI\Laravel;

use Illuminate\Support\Facades\Facade;

class ExactAPIClientFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'exact_api_client';
    }
}