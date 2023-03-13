<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\APIs;

use \GuzzleHttp\Client as GuzzleClient;
use Crayden\SoftwareOfExcellenceExactAPI\ExactAPIClient;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\ExactAPI;
use Crayden\SoftwareOfExcellenceExactAPI\Models\Appointment;
use Crayden\SoftwareOfExcellenceExactAPI\Models\AppointmentStatus;
use Crayden\SoftwareOfExcellenceExactAPI\Models\PracticeLocation;

use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\APITransportException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\PracticeInaccessibleException;
use Crayden\SoftwareOfExcellenceExactAPI\Exceptions\InvalidAPIResponseException;

use \DateTime;

class AppointmentAPI extends ExactAPI
{
    public function getAppointment(string $practice_id, string $appointment_id)
    {        
        $this->getAccessToken(['appointment.get']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 'v1/Practices/' . 
                urlencode($practice_id) . '/Appointments/' . urlencode($appointment_id), 200);
            return new Appointment( $response );
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

    // TODO: Implement continuationToken
    public function getAppointmentsBetween(string $practice_id, DateTime $from, DateTime $to)
    {        
        $this->getAccessToken(['appointment.list']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 
                'v1/Practices/' . $practice_id . '/Appointments/?' . 
                'from=' . urlencode($from->format(DATE_ISO8601)) . 
                '&to=' . urlencode($to->format(DATE_ISO8601)), 
            200);
            if ( is_array($response) )
            {
                $return = [];
                foreach( $response as $appointment )
                {
                    $return[] = new Appointment($appointment);
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

    // TODO: Implement continuationToken
    public function getAppointmentsByStatus(string $practice_id, DateTime $from, DateTime $to, AppointmentStatus $status)
    {        
        $this->getAccessToken(['appointment.list']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 
                'v1/Practices/' . $practice_id . '/Appointments/?' . 
                'from=' . urlencode($from->format(DATE_ISO8601)) . 
                '&to=' . urlencode($to->format(DATE_ISO8601)) . 
                '&status=' . urlencode($status->getValue()), 
            200);
            if ( is_array($response) )
            {
                $return = [];
                foreach( $response as $appointment )
                {
                    $return[] = new Appointment($appointment);
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

    // TODO: Implement continuationToken
    public function getAppointmentsByPractitioner(string $practice_id, DateTime $from, DateTime $to, Practitioner $practitioner, $status = null)
    {        
        $this->getAccessToken(['appointment.list']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 
                'v1/Practices/' . $practice_id . '/Appointments/?' . 
                'from=' . urlencode($from->format(DATE_ISO8601)) . 
                '&to=' . urlencode($to->format(DATE_ISO8601)) . 
                '&practitionerId=' . urlencode($practitioner->getId()) .  
                '&status=' . urlencode( 
                    is_a($status, 'Crayden\SoftwareOfExcellenceExactAPI\Models\AppointmentStatus') ? $status->getValue() : ''
                ), 
            200);
            if ( is_array($response) )
            {
                $return = [];
                foreach( $response as $appointment )
                {
                    $return[] = new Appointment($appointment);
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

    // TODO: Implement continuationToken
    public function getAppointmentsByPatient(string $practice_id, DateTime $from, DateTime $to, Patient $patient, $status = null)
    {        
        $this->getAccessToken(['appointment.list']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 
                'v1/Practices/' . $practice_id . '/Appointments/?' . 
                'from=' . urlencode($from->format(DATE_ISO8601)) . 
                '&to=' . urlencode($to->format(DATE_ISO8601)) . 
                '&patientId=' . urlencode($patient->getId()) .  
                '&status=' . urlencode( is_a($status, 'Crayden\SoftwareOfExcellenceExactAPI\Models\AppointmentStatus') ? $status->getValue() : ''), 
            200);
            if ( is_array($response) )
            {
                $return = [];
                foreach( $response as $appointment )
                {
                    $return[] = new Appointment($appointment);
                }
                return $return;
            } else { 
                return [];
            }
            return new Appointment( $response );
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

    // TODO: Implement continuationToken
    public function getAppointmentsByLocation(string $practice_id, DateTime $from, DateTime $to, PracticeLocation $location, $status = null)
    {        
        $this->getAccessToken(['appointment.list']);
        try {             
            $response = $this->api_client->makeAPIRequest('GET', 
                'v1/Practices/' . $practice_id . '/Appointments/?' . 
                'from=' . urlencode($from->format(DATE_ISO8601)) . 
                '&to=' . urlencode($to->format(DATE_ISO8601)) . 
                '&locationId=' . urlencode($location->getId()) .  
                '&status=' . urlencode( is_a($status, 'Crayden\SoftwareOfExcellenceExactAPI\Models\AppointmentStatus') ? $status->getValue() : ''), 
            200);
            if ( is_array($response) )
            {
                $return = [];
                foreach( $response as $appointment )
                {
                    $return[] = new Appointment($appointment);
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