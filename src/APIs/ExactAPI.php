<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\APIs;

use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\OutsideScopeAccessException;

class ExactAPI 
{
    protected $api_client;

    public function __construct(ExactAPIClient $api_client)
    {
        $this->api_client = $api_client;
    }

    public function getAPIClient()
    {
        return $this->api_client;
    }

    protected function getAccessToken(array $required_scopes = [])
    {
        if ( count($required_scopes) > 0 )
        {
            $current_scopes = $this->api_client->getCurrentScopes();
            foreach( $required_scopes as $required_scope )
            {
                if ( !in_array( $required_scope, $current_scopes ) )
                    throw new OutsideScopeAccessException( $required_scope );
            }
            unset( $current_scopes );
        }
        return $this->api_client->getRefreshedAccessToken();
    }
}