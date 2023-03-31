<?php

namespace Crayden\SoftwareOfExcellenceExactAPI;

use GuzzleHttp\Client as GuzzleClient;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidEnvironmentException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidScopeException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\AuthorizationException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\APITransportException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\OutsideScopeAccessException;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\AppointmentAPI;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PayorAPI;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PatientAPI;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PracticeAPI;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PractitionerAPI;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\SubscriptionAPI;
use \DateTime;

class ExactAPIClient 
{

    private $client_id;
    private $client_secret;    
    private $qa_api_base_url = 'https://qa-api.ex.softwareofexcellence.com';
    private $qa_auth_base_url = 'https://qa-auth.softwareofexcellence.com';
    private $production_api_base_url = 'https://api.ex.softwareofexcellence.com';
    private $production_auth_base_url = 'https://auth.softwareofexcellence.com';    
    private $environment = 'qa';
    private $scopes = [ 'productsubscription.get' ];
    private $access_token = '';
    private $access_token_expiry = null;
    private $api_client;
    private $auth_client;

    public function __construct(string $client_id, string $client_secret, string $environment = '', array $scopes = [])
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->setEnvironment( strlen($environment) > 0 ? $environment : 'qa' );
        $this->access_token_expiry = new DateTime();
        $this->scopes = $scopes;
    }    

    public function getClientID()
    {
        return $this->client_id;
    }

    public function getClientSecret()
    {
        return $this->client_secret;
    }

    public function getUnderlyingAPIClient()
    {
        return $this->api_client;
    }

    public function getUnderlyingAuthClient()
    {
        return $this->auth_client;
    }

    public function getEnvironment()
    {
        return $this->environment;
    }

    public function setEnvironment(string $environment)
    {
        switch( $environment ) 
        {
            case 'qa':
                $this->environment = 'qa';
                $this->api_client = new GuzzleClient([
                    'base_uri' => $this->qa_api_base_url,
                ]);
                $this->auth_client = new GuzzleClient([
                    'base_uri' => $this->qa_auth_base_url,
                ]);
                break;
            case 'production':
                $this->environment = 'production';
                $this->api_client = new GuzzleClient([
                    'base_uri' => $this->production_api_base_url,
                ]);
                $this->auth_client = new GuzzleClient([
                    'base_uri' => $this->production_auth_base_url,
                ]);
                break;
            default:
                throw new Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidEnvironmentException( $environment );
                break;
        }
        return $this;
    }

    public function getCurrentScopes()
    {
        return $this->scopes;
    }

    public function addScope(string $scope)
    {
        $this->addScopes([ $scope ]);
        return $this;
    }

    public function addScopes(array $scopes)
    {
        foreach( $scopes as $scope )
        {
            $scope = strtolower( trim( $scope ) );
            if ( in_array( $scope, [ 
                'appointment.list', 
                'appointment.get', 
                'patient.list', 
                'patient.get', 
                'patient.contact', 
                'practice.get', 
                'payor.list', 
                'payor.get', 
                'practitioner.list', 
                'practitioner.get', 
                'productsubscription.get', 
                'patient.get.contactdetails.phone', 
                'patient.get.contactdetails.email', 
            ] ))
            {
                array_push( $this->scopes, $scope );
                $this->scopes = array_unique( $this->scopes );
            } else { 
                throw new Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidScopeException( $scope );
            }
        }
        return $this;
    }

    public function appointmentAPI()
    {
        return new AppointmentAPI($this);
    }

    public function patientAPI()
    {
        return new PatientAPI($this);
    }

    public function payorAPI()
    {
        return new PayorAPI($this);
    }

    public function practiceAPI()
    {
        return new PracticeAPI($this);
    }

    public function practitionerAPI()
    {
        return new PractitionerAPI($this);
    }

    public function subscriptionAPI()
    {
        return new SubscriptionAPI($this);
    }

    public function getRefreshedAccessToken()
    {
        if ( strlen( $this->access_token ) > 0 )
        {
            if ( new DateTime() > $this->access_token_expiry) 
            {
                return $this->retrieveAccessToken();
            } else {
                return $this->access_token;
            }   
        } else { 
            return $this->retrieveAccessToken();
        }
    }

    public function retrieveAccessToken()
    {
        try 
        { 
            $response = $this->auth_client->request('POST', '/connect/token', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode( $this->getClientID() . ':' . $this->getClientSecret() ),
                    'Content-Type'  => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'scope' => implode(' ', $this->getCurrentScopes() ),
                ], 
            ]);

            if ( $response->getStatusCode() === 200 )
            {         
                try {    
                    $body = json_decode( (string) $response->getBody() );
                    if ( is_object($body) && isset($body->access_token) && strlen($body->access_token) > 0 )
                    {
                        $this->access_token = $body->access_token;
                        if ( isset($body->expires_in) && is_integer($body->expires_in) && $body->expires_in > 20 )
                        {
                            $this->access_token_expiry = new DateTime();
                            $this->access_token_expiry->modify('+' . $body->expires_in . ' seconds');
                        }
                        return $body->access_token;
                    } else { 
                        throw new Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException( (string) $response->getBody() );    
                    }
                } catch ( \Exception $e ) { 
                    throw new Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException( (string) $response->getBody() );
                }            
                
            } else { 
                throw new Crayden\SoftwareOfExcellenceExactAPI\Exceptions\AuthorizationException( $response->getReasonPhrase(), $response->getStatusCode() );
            }
        } catch ( \Exception $e ) { 
            throw new Crayden\SoftwareOfExcellenceExactAPI\Exceptions\AuthorizationException( $response->getReasonPhrase(), $response->getStatusCode() );
        }
        
    }

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function setAccessToken(string $access_token)
    {
        $this->access_token = $access_token;
        return $this;
    }

    public function makeAPIRequest($method, $url, $expected_code = FALSE, $headers = [], $payload = '')
    {
        if ( $expected_code === FALSE )
            $expected_code = 200;

        try
        {
            $response = $this->getUnderlyingAPIClient()->request( $method , $url, [
                'headers' => array_merge($headers, 
                    [
                        'Authorization' => 'Bearer ' . $this->access_token,
                        'Accept'  => 'application/json', 
                        'Content-Type'  => 'application/json', 
                        'x-api-version' => '1.0', 
                    ]),
                'body' => $payload, 
            ]);
            
            if ( $response->getStatusCode() === $expected_code )
            {
                try { 
                    $body = json_decode( (string) $response->getBody() );
                    return $body;
                } catch ( \Exception $e ) { 
                    throw new \Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException( (string) $response->getBody() );
                }                        
            } else { 
                throw new \Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException( (string) $response->getBody() );
            }
        } catch ( \Exception $e ) { 
            throw new APITransportException( $e->getMessage(), $e->getCode() );            
        }
    }

}