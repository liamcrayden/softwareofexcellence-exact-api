<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

use Crayden\SoftwareOfExcellenceExactAPI\Models\Provider;
use Crayden\SoftwareOfExcellenceExactAPI\Models\AppointmentStatus;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PatientAPI;
use \ArrayAccess;
use \DateTime;

class Patient implements ArrayAccess
{
    private $id;
    private $payingPatientId;
    private $isActive;
    private $dateOfBirth;
    private $defaultDentistId;
    private $defaultHygienistId;
    private $title;
    private $preferredName;
    private $firstName;
    private $middleName;
    private $lastName;
    private $sex;
    private $consentedToMarketing;
    private $healthServiceIdentifier;
    private $nationalInsuranceIdentifier;
    private $defaultPayor;
    private $patientHasAddress;
    private $patientHasEmail;
    private $patientHasSms;

    public function __construct($patient)
    {
        isset($patient->id) && $this->id = $patient->id;
        isset($patient->payingPatientId) && $this->payingPatientId = $patient->payingPatientId;
        isset($patient->isActive) && $this->isActive = $patient->isActive;
        isset($patient->dateOfBirth) && $this->dateOfBirth = $patient->dateOfBirth;
        isset($patient->defaultDentistId) && $this->defaultDentistId = $patient->defaultDentistId;
        isset($patient->defaultHygienistId) && $this->defaultHygienistId = $patient->defaultHygienistId;
        isset($patient->title) && $this->title = $patient->title;
        isset($patient->preferredName) && $this->preferredName = $patient->preferredName;
        isset($patient->firstName) && $this->firstName = $patient->firstName;
        isset($patient->middleName) && $this->middleName = $patient->middleName;
        isset($patient->lastName) && $this->lastName = $patient->lastName;
        isset($patient->sex) && $this->sex = new Sex($patient->sex);
        isset($patient->consentedToMarketing) && $this->consentedToMarketing = new Consent($patient->consentedToMarketing);
        isset($patient->healthServiceIdentifier) && $this->healthServiceIdentifier = $patient->healthServiceIdentifier;
        isset($patient->nationalInsuranceIdentifier) && $this->nationalInsuranceIdentifier = $patient->nationalInsuranceIdentifier;
        isset($patient->defaultPayor) && $this->defaultPayor = new PayorType($patient->defaultPayor);
        isset($patient->patientHasAddress) && $this->patientHasAddress = $patient->patientHasAddress;
        isset($patient->patientHasEmail) && $this->patientHasEmail = $patient->patientHasEmail;
        isset($patient->patientHasSms) && $this->patientHasSms = $patient->patientHasSms;   
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
            'payingPatientId' => $this->payingPatientId, 
            'isActive' => $this->isActive,
            'dateOfBirth' => $this->dateOfBirth,
            'defaultDentistId' => $this->defaultDentistId, 
            'defaultHygienistId' => $this->defaultHygienistId, 
            'title' => $this->title, 
            'preferredName' => $this->preferredName, 
            'firstName' => $this->firstName, 
            'middleName' => $this->middleName, 
            'lastName' => $this->lastName, 
            'sex' => $this->sex, 
            'consentedToMarketing' => $this->consentedToMarketing, 
            'healthServiceIdentifier' => $this->healthServiceIdentifier, 
            'nationalInsuranceIdentifier' => $this->nationalInsuranceIdentifier, 
            'defaultPayor' => $this->defaultPayor, 
            'patientHasAddress' => $this->patientHasAddress, 
            'patientHasEmail' => $this->patientHasEmail, 
            'patientHasSms' => $this->patientHasSms, 
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPayingPatientId()
    {
        return $this->payingPatientId;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function getDefaultDentistId()
    {
        return $this->defaultDentistId;
    }

    public function getDefaultHygienistId()
    {
        return $this->defaultHygienistId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPreferredName()
    {
        return $this->preferredName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getMiddleName()
    {
        return $this->middleName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getFullName($with_title = FALSE)
    {
        $name = [];
        if ( $with_title && strlen(trim($this->title)) > 0 ) 
            $name[] = trim($this->title);
        if ( strlen(trim($this->firstName)) > 0 )
            $name[] = trim($this->firstName);
        if ( strlen(trim($this->middleName)) > 0 )
            $name[] = trim($this->middleName);
        if ( strlen(trim($this->lastName)) > 0 )
            $name[] = trim($this->lastName);
        return implode(' ', $name);
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function getConsentedToMarketing()
    {
        return $this->consentedToMarketing;
    }

    public function getHealthServiceIdentifier()
    {
        return $this->healthServiceIdentifier;
    }

    public function getNationalInsuranceIdentifier()
    {
        return $this->nationalInsuranceIdentifier;
    }

    public function getDefaultPayor()
    {
        return $this->defaultPayor;
    }

    public function getPatientHasAddress()
    {
        return $this->patientHasAddress;
    }

    public function getPatientHasEmail()
    {
        return $this->patientHasEmail;
    }

    public function getPatientHasSms()
    {
        return $this->patientHasSms;
    }    
}