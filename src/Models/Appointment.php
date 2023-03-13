<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

use Crayden\SoftwareOfExcellenceExactAPI\Models\Provider;
use Crayden\SoftwareOfExcellenceExactAPI\Models\AppointmentStatus;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PatientAPI;
use \ArrayAccess;
use \DateTime;

class Appointment implements ArrayAccess
{
    private $id;
    private $providers;
    private $patientId;
    private $payorId;
    private $location;
    private $primaryFamilyAppointmentId;
    private $nextFamilyAppointmentId;
    private $familyAppointmentIds;
    private $chairDurationMinutes;
    private $scheduledDurationMinutes;
    private $actualDurationMinutes;
    private $startDate;
    private $endDate;
    private $isFirstVisit;
    private $arrivalDate;
    private $completionDate;
    private $cancellationDate;
    private $status;
    private $createdByUserId;
    private $createdDate;
    private $lastUpdatedByUserId;
    private $lastUpdatedDate;

    public function __construct($appointment)
    {
        isset($appointment->id) && $this->id = $appointment->id;
        isset($appointment->providers) && $this->providers = $this->enumerateProviders($appointment->providers);
        isset($appointment->patientId) && $this->patientId = $appointment->patientId;
        isset($appointment->payorId) && $this->payorId = $appointment->payorId;
        isset($appointment->location) && $this->location = $appointment->location;
        isset($appointment->primaryFamilyAppointmentId) && $this->primaryFamilyAppointmentId = $appointment->primaryFamilyAppointmentId;
        isset($appointment->nextFamilyAppointmentId) && $this->nextFamilyAppointmentId = $appointment->nextFamilyAppointmentId;
        isset($appointment->familyAppointmentIds) && $this->familyAppointmentIds = $appointment->familyAppointmentIds;
        isset($appointment->chairDurationMinutes) && $this->chairDurationMinutes = $appointment->chairDurationMinutes;
        isset($appointment->scheduledDurationMinutes) && $this->scheduledDurationMinutes = $appointment->scheduledDurationMinutes;
        isset($appointment->actualDurationMinutes) && $this->actualDurationMinutes = $appointment->actualDurationMinutes;
        isset($appointment->startDate) && $this->startDate = new DateTime($appointment->startDate);
        isset($appointment->endDate) && $this->endDate = new DateTime($appointment->endDate);
        isset($appointment->isFirstVisit) && $this->isFirstVisit = $appointment->isFirstVisit;
        isset($appointment->arrivalDate) && $this->arrivalDate = is_null($appointment->arrivalDate) ? null : new DateTime($appointment->arrivalDate);
        isset($appointment->completionDate) && $this->completionDate = is_null($appointment->completionDate) ? null : new DateTime($appointment->completionDate);
        isset($appointment->cancellationDate) && $this->cancellationDate = is_null($appointment->cancellationDate) ? null : new DateTime($appointment->cancellationDate);
        isset($appointment->status) && $this->status = new AppointmentStatus($appointment->status);
        isset($appointment->createdByUserId) && $this->createdByUserId = $appointment->createdByUserId;
        isset($appointment->createdDate) && $this->createdDate = $appointment->createdDate;
        isset($appointment->lastUpdatedByUserId) && $this->lastUpdatedByUserId = $appointment->lastUpdatedByUserId;
        isset($appointment->lastUpdatedDate) && $this->lastUpdatedDate = is_null($appointment->lastUpdatedDate) ? null : new DateTime($appointment->lastUpdatedDate);
    }

    private function enumerateProviders($providers)
    {
        $p = [];
        foreach( $providers as $provider )
        {
            $p[] = new Provider($provider);
        }
        return $p;
    }

    #[\ReturnTypeWillChange]
    public function offsetSet(mixed $offset, $value) 
    {
        return;
    }

    #[\ReturnTypeWillChange]
    public function offsetExists(mixed $offset) 
    {
        return isset($this->{$offset});
    }

    #[\ReturnTypeWillChange]
    public function offsetUnset(mixed $offset) 
    {
        return;
    }

    #[\ReturnTypeWillChange]
    public function offsetGet(mixed $offset) 
    {
        return isset($this->{$offset}) ? $this->{$offset} : null;
    }

    public function toArray()
    {
        return [ 
            'id' => $this->id, 
            'providers' => $this->providers, 
            'patientId' => $this->patientId, 
            'payorId' => $this->payorId, 
            'location' => $this->location, 
            'primaryFamilyAppointmentId' => $this->primaryFamilyAppointmentId, 
            'nextFamilyAppointmentId' => $this->nextFamilyAppointmentId, 
            'familyAppointmentIds' => $this->familyAppointmentIds, 
            'chairDurationMinutes' => $this->chairDurationMinutes, 
            'scheduledDurationMinutes' => $this->scheduledDurationMinutes, 
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'isFirstVisit' => $this->isFirstVisit,
            'arrivalDate' => $this->arrivalDate, 
            'completionDate' => $this->completionDate,    
            'cancellationDate' => $this->cancellationDate,                              
            'status' => $this->status, 
            'createdByUserId' => $this->createdByUserId, 
            'createdDate' => $this->createdDate, 
            'lastUpdatedByUserId' => $this->lastUpdatedByUserId, 
            'lastUpdatedDate' => $this->lastUpdatedDate, 
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getProviders()
    {
        return $this->providers;
    }

    public function getPatientId()
    {
        return $this->patientId;
    }
    
    public function getPayorId()
    {
        return $this->payorId;
    }

    public function getLocation()
    {
        return $this->location;
    }
    
    public function getPrimaryFamilyAppointmentId()
    {
        return $this->primaryFamilyAppointmentId;
    }

    public function getNextFamilyAppointmentId()
    {
        return $this->nextFamilyAppointmentId;
    }

    public function getFamilyAppointmentIds()
    {
        return $this->familyAppointmentIds;
    }

    public function getChairDurationMinutes()
    {
        return $this->chairDurationMinutes;
    }


    public function getScheduledDurationMinutes()
    {
        return $this->scheduledDurationMinutes;
    }

    public function getActualDurationMinutes()
    {
        return $this->actualDurationMinutes;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getIsFirstVisit()
    {
        return $this->isFirstVisit;
    }

    public function getArrivalDate()
    {
        return $this->arrivalDate;
    }

    public function getCompletionDate()
    {
        return $this->completionDate;
    }

    public function getCancellationDate()
    {
        return $this->cancellationDate;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCreatedByUserId()
    {
        return $this->createdByUserId;
    }

    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    public function getLastUpdatedByUserId()
    {
        return $this->lastUpdatedByUserId;
    }

    public function getLastUpdatedDate()
    {
        return $this->lastUpdatedDate;
    }
}