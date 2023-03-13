<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\APIs;

use \GuzzleHttp\Client as GuzzleClient;
use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\ExactAPI;
use Crayden\SoftwareOfExcellenceExactAPI\Models\SubscriptionList;

class SubscriptionAPI extends ExactAPI
{
    public function getActiveSubscriptions()
    {
        $this->getAccessToken();
        $response = $this->api_client->makeAPIRequest('GET', 'v1/Subscriptions/active', 200);
        return new SubscriptionList( $response );
    }
    
}