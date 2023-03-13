<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\APIs;

use \GuzzleHttp\Client as GuzzleClient;
use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\ExactAPI;
use Crayden\SoftwareOfExcellenceExactAPI\Models\Practice;
use Crayden\SoftwareOfExcellenceExactAPI\Models\Payor;

use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\APITransportException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\PracticeInaccessibleException;

class PayorAPI extends ExactAPI
{
    public function getPayor(string $practice_id, string $payor_id)
    {        
        $this->getAccessToken(['payor.get']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 'v1/Practices/' . 
                urlencode($practice_id) . '/Payors/' . urlencode($payor_id), 200);
            return new Payor( $response );
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

    public function getPayorsForPractice(Practice $practice)
    {        
        $this->getAccessToken(['payor.get']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 'v1/Practices/' . 
                urlencode($practice->getId()) . '/Payors', 200);

            if ( is_array($response) )
            {
                $return = [];
                foreach( $response as $payor )
                {
                    $return[] = new Payor($payor);
                }
                return $return;
            } else { 
                return [];
            }
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