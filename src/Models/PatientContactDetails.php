<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

use Crayden\SoftwareOfExcellenceExactAPI\Models\PhoneNumber;
use \ArrayAccess;

class PatientContactDetails implements ArrayAccess
{
    private $emailAddresses = [];
    private $phoneNumbers = [];

    public function __construct($contact)
    {
        isset($contact->emailAddresses) && $this->emailAddresses = $contact->emailAddresses;
        isset($contact->phoneNumbers) && $this->phoneNumbers = array_map(
            function($number) { return new PhoneNumber($number); }, $contact->phoneNumbers
        );
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
            'emailAddresses' => $this->emailAddresses, 
            'phoneNumbers' => $this->phoneNumbers, 
        ];
    }

    public function getEmailAddresses()
    {
        return $this->emailAddresses;
    }

    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    public function getPrimaryEmailAddress()
    {
        return isset($this->emailAddresses[0]) ? $this->emailAddresses[0] : '';
    }

    public function getPrimaryPhoneNumber()
    {
        return isset($this->phoneNumbers[0]) ? $this->phoneNumbers[0] : '';
    }

    public function hasEmailAddress()
    {
        return isset($this->emailAddresses[0]);
    }

    public function hasPhoneNumber()
    {
        return isset($this->phoneNumbers[0]);
    }

    public function containsEmailAddress(string $email)
    {
        return in_array($email, $this->emailAddresses);
    }

    public function containsPhoneNumber(string $number)
    {
        return in_array($number, $this->phoneNumbers);
    }
}