<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

use Crayden\SoftwareOfExcellenceExactAPI\APIs\PayorAPI;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\AppointmentAPI;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PractitionerAPI;
use Crayden\SoftwareOfExcellenceExactAPI\APIs\PatientAPI;
use Crayden\SoftwareOfExcellenceExactAPI\Models\Address;
use Crayden\SoftwareOfExcellenceExactAPI\Models\PracticeLocation;
use Crayden\SoftwareOfExcellenceExactAPI\Models\Payor;
use Crayden\SoftwareOfExcellenceExactAPI\Models\Patient;
use Crayden\SoftwareOfExcellenceExactAPI\Models\AppointmentStatus;
use Crayden\SoftwareOfExcellenceExactAPI\Models\Practitioner;

use \ArrayAccess;
use \DateTime;

class Practice implements ArrayAccess
{
    private $practiceId;
    private $practiceName;
    private $installationId;
    private $organizationId;
    private $organizationName;
    private $address;
    private $phoneNumber;
    private $emailAddress;
    private $websiteAddress;
    private $country;
    private $countrySubdivision;
    private $brandingLogoUrl;
    private $supportedPayors = [];
    private $openingHours;
    private $practiceTimezoneUtcOffsetMinutes;
    private $pmsVersion;
    private $pmsDisplayVersion;
    private $updatedOn;
    private $locations = [];

    public function __construct(object $practice) 
    {
        $this->address = new Address(null);
        isset($practice->practiceId) && $this->practiceId = $practice->practiceId;
        isset($practice->practiceName) && $this->practiceName = $practice->practiceName;
        isset($practice->installationId) && $this->installationId = $practice->installationId;
        isset($practice->organizationId) && $this->organizationId = $practice->organizationId;
        isset($practice->organizationName) && $this->organizationName = $practice->organizationName;
        isset($practice->address) && $this->address = new Address( $practice->address );
        isset($practice->phoneNumber) && $this->phoneNumber = $practice->phoneNumber;
        isset($practice->emailAddress) && $this->emailAddress = $practice->emailAddress;
        isset($practice->websiteAddress) && $this->websiteAddress = $practice->websiteAddress;
        isset($practice->country) && $this->country = $practice->country;
        isset($practice->countrySubdivision) && $this->countrySubdivision = $practice->countrySubdivision;
        isset($practice->brandingLogoUrl) && $this->brandingLogoUrl = $practice->brandingLogoUrl;
        isset($practice->supportedPayors) && $this->supportedPayors = $this->enumeratePayors($practice->supportedPayors);
        isset($practice->openingHours) && $this->openingHours = $practice->openingHours;
        isset($practice->practiceTimezoneUtcOffsetMinutes) && $this->practiceTimezoneUtcOffsetMinutes = $practice->practiceTimezoneUtcOffsetMinutes;
        isset($practice->pmsVersion) && $this->pmsVersion = $practice->pmsVersion;
        isset($practice->pmsDisplayVersion) && $this->pmsDisplayVersion = $practice->pmsDisplayVersion;
        isset($practice->updatedOn) && $this->updatedOn = new DateTime($practice->updatedOn);
        isset($practice->locations) && $this->locations = $this->enumerateLocations($practice->locations);
    }

    private function enumerateLocations($locations)
    {
        $l = [];
        foreach( $locations as $location )
        {
            $l[] = new PracticeLocation($location);
        }
        return $l;
    }

    private function enumeratePayors($payors)
    {
        $p = [];
        foreach( $payors as $payor )
        {
            $p[] = new Payor($payor);
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
            'practiceId' => $this->practiceId, 
            'practiceName' => $this->practiceName, 
            'installationId' => $this->installationId, 
            'organizationId' => $this->organizationId, 
            'organizationName' => $this->organizationName, 
            'address' => $this->address, 
            'phoneNumber' => $this->phoneNumber, 
            'emailAddress' => $this->emailAddress, 
            'websiteAddress' => $this->websiteAddress, 
            'country' => $this->country, 
            'countrySubdivision' => $this->countrySubdivision, 
            'brandingLogoUrl' => $this->brandingLogoUrl, 
            'supportedPayors' => $this->supportedPayors, 
            'openingHours' => $this->openingHours, 
            'practiceTimezoneUtcOffsetMinutes' => $this->practiceTimezoneUtcOffsetMinutes, 
            'pmsVersion' => $this->pmsVersion, 
            'pmsDisplayVersion' => $this->pmsDisplayVersion, 
            'updatedOn' => $this->updatedOn, 
            'locations' => $this->locations,
        ];
    }

    public function getPracticeId()
    {
        return $this->practiceId;
    }

    public function getPracticeName()
    {
        return $this->practiceName;
    }

    public function getInstallationId()
    {
        return $this->installationId;
    }

    public function getOrganizationId()
    {
        return $this->organizationId;
    }

    public function getOrganizationName()
    {
        return $this->organizationName;
    }

    public function getAddress(bool $as_array = FALSE)
    {
        return $as_array ? $this->address->toArray() : $this->address;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    public function getWebsiteAddress()
    {
        return $this->websiteAddress;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCountrySubdivision()
    {
        return $this->getCountrySubdivision;
    }

    public function getBrandingLogoUrl()
    {
        return $this->brandingLogoUrl;
    }

    public function getSupportedPayors()
    {
        return $this->supportedPayors;
    }

    public function getOpeningHours()
    {
        return $this->openingHours;
    }

    public function getPracticeTimezoneUtcOffsetMinutes()
    {
        return $this->practiceTimezoneUtcOffsetMinutes;
    }

    public function getPmsVersion()
    {
        return $this->pmsVersion;
    }

    public function getPmsDisplayVersion()
    {
        return $this->pmsDisplayVersion;
    }

    public function getUpdatedOn($as_string = FALSE)
    {
        return $as_string ? $this->updatedOn->__toString() : $this->updatedOn;
    }

    public function getLocations()
    {
        return $this->locations;
    }

    public function getPayors()
    {
        $payorAPI = new PayorAPI;
        return $payorAPI->getPayorsForPractice($this);
    }

    public function getPatients()
    {
        $patientAPI = new PatientAPI;
        return $patientAPI->getPatientsForPractice($this);
    }

    public function getAllAppointmentsBetween(DateTime $from, DateTime $to)
    {
        $appointmentAPI = new AppointmentAPI;
        return $appointmentAPI->getAppointmentsBetween($this->getPracticeId(), $from, $to);
    }

    public function getAppointmentsByStatus(AppointmentStatus $status, DateTime $from, DateTime $to)
    {
        $appointmentAPI = new AppointmentAPI;
        return $appointmentAPI->getAppointmentsByStatus($this->getPracticeId(), $from, $to, $status);
    }

    public function getAppointmentsByPractitioner(Practitioner $practitioner, DateTime $from, DateTime $to, $status = null)
    {
        $appointmentAPI = new AppointmentAPI;
        return $appointmentAPI->getAppointmentsByStatus($this->getPracticeId(), $from, $to, $practitioner, $status);
    }

    public function getAppointmentsByPatient(Patient $patient, DateTime $from, DateTime $to, $status = null)
    {
        $appointmentAPI = new AppointmentAPI;
        return $appointmentAPI->getAppointmentsByStatus($this->getPracticeId(), $from, $to, $patient, $status);
    }

    public function getPractitioners()
    {
        $practitionerAPI = new PractitionerAPI;
        return $practitionerAPI->getPractitionersForPractice($this);
    }
}