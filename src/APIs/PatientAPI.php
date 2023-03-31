<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\APIs;

use \GuzzleHttp\Client as GuzzleClient;
use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\ExactAPI;
use Crayden\SoftwareOfExcellenceExactAPI\Models\Patient;
use Crayden\SoftwareOfExcellenceExactAPI\Models\PatientContactDetails;
use Crayden\SoftwareOfExcellenceExactAPI\Models\PatientContactRequest;
use Crayden\SoftwareOfExcellenceExactAPI\Models\Practice;

use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\APITransportException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\PracticeInaccessibleException;

class PatientAPI extends ExactAPI
{
    public function getPatient(string $practice_id, string $patient_id)
    {
        $this->getAccessToken(['patient.get']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 'v1/Practices/' . 
                urlencode($practice_id) . '/Patients/' . urlencode($patient_id), 200);
            return new Patient( $response );
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

    public function getPatientContactDetails(string $practice_id, string $patient_id)
    {
        $this->getAccessToken(['patient.get', 'patient.get.contactdetails.phone', 'patient.get.contactdetails.email']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 'v1/Practices/' . 
                urlencode($practice_id) . '/Patients/' . urlencode($patient_id) . 
                '/ContactDetails', 200);
                print_r($response);
            return new PatientContactDetails( $response );
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

    public function sendContact(string $practice_id, string $patient_id, PatientContactRequest $request)
    {
        $this->getAccessToken(['patient.contact']);
        try {             
            $response = $this->api_client->makeAPIRequest('POST', 'v1/Practices/' . 
                urlencode($practice_id) . '/Patients/' . urlencode($patient_id) . 
                '/Contact', 202, [], (string)$request);
            return TRUE;
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

    public function getPatientsForPractice(Practice $practice)
    {        
        $this->getAccessToken(['patient.list']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 'v1/Practices/' . 
                urlencode($practice->getPracticeId()) . '/Patients', 200);
            if ( is_array($response) )
            {
                $return = [];
                foreach( $response as $patient )
                {
                    $return[] = new Patient($patient);
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