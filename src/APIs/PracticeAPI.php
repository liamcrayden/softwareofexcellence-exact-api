<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\APIs;

use \GuzzleHttp\Client as GuzzleClient;
use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\ExactAPI;
use Crayden\SoftwareOfExcellenceExactAPI\Models\Practice;

use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\APITransportException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\PracticeInaccessibleException;

class PracticeAPI extends ExactAPI
{
    public function getPractice(string $practice_id)
    {        
        $this->getAccessToken(['practice.get']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 'v1/Practices/' . urlencode($practice_id) . '/details', 200);
            return new Practice( $response );
        } catch ( APITransportException $e ) { 
            switch ( $e->getCode() )
            {
                case 400:
                    throw new InvalidAPIResponseException( $e->getMessage(), $e->getCode());
                case 403: 
                case 404:
                    throw new PracticeInaccessibleException;
                    break;
            }
            throw $e;
        } catch ( \Exception $e ) { 
            throw $e;
        }
    }    
}