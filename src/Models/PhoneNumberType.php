<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

class PhoneNumberType
{
    private $type;

    public function __construct($phone_number_type)
    {
        switch ($phone_number_type)
        {
            case 'Home': 
            case 'Work':
            case 'Mobile':
                $this->type = $phone_number_type;
                break;
            default:
                $this->type = 'Unknown';
                break;
        }
    }
    
    public function __toString()
    {
        return $this->type;
    }
    
    public function getType()
    {
        return $this->type;
    }

    public function isHome()
    {
        return $this->type === 'Home';
    }

    public function isWork()
    {
        return $this->type === 'Work';
    }

    public function isMobile()
    {
        return $this->type === 'Mobile';
    }
}