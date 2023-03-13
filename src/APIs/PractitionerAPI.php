<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\APIs;

use \GuzzleHttp\Client as GuzzleClient;
use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\ExactAPI;
use Crayden\SoftwareOfExcellenceExactAPI\Models\Practice;
use Crayden\SoftwareOfExcellenceExactAPI\Models\Practitioner;

use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\APITransportException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\PracticeInaccessibleException;

class PractitionerAPI extends ExactAPI
{
    public function getPractitioner(string $practice_id, string $practitioner_id)
    {        
        $this->getAccessToken(['practitioner.get']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 'v1/Practices/' . 
                urlencode($practice_id) . '/Practitioners/' . urlencode($practitioner_id), 200);
            return new Practitioner( $response );
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

    public function getPractitionersForPractice(Practice $practice)
    {        
        $this->getAccessToken(['practitioner.list']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 'v1/Practices/' . 
                urlencode($practice->getId()) . '/Practitioners', 200);

            if ( is_array($response) )
            {
                $return = [];
                foreach( $response as $practitioner )
                {
                    $return[] = new Practitioner($practitioner);
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