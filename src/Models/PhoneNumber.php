<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

use Crayden\SoftwareOfExcellenceExactAPI\Models\PhoneNumberType;
use \ArrayAccess;

class PhoneNumber implements ArrayAccess
{
    private $countryCode;
    private $phoneNumber;
    private $phoneType;

    public function __construct($number)
    {
        isset($number->countryCode) && $this->countryCode = $number->countryCode;
        isset($number->phoneNumber) && $this->phoneNumber = $number->phoneNumber;
        isset($number->phoneType) && $this->phoneType = new PhoneNumberType($number->phoneType);
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
            'countryCode' => $this->countryCode, 
            'phoneNumber' => $this->phoneNumber, 
            'phoneType' => $this->phoneType, 
        ];
    }

    public function __toString()
    {
        return $this->phoneNumber;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function getPhoneType()
    {
        return $this->phoneType;
    }
}