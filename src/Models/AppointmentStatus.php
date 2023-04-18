<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

class AppointmentStatus
{
    private $value;

    public function __construct($status)
    {
        switch ($status)
        {
            case 'Unset':
            case 'Pending':
            case 'Arrived':
            case 'Completed':
            case 'DidNotAttend':
            case 'InSurgery':
            case 'Confirmed':
            case 'Cancelled':
                $this->value = $status;
                break;
            default:
                $this->value = 'Unset';
                break;
        }
    }
    
    public function __toString()
    {
        return $this->value;
    }
    
    public function getValue()
    {
        return $this->value;
    }

    public function isComplete()
    {
        return $this->value === 'Completed';
    }

    public function isInSurgery()
    {
        return in_array(['Arrived', 'InSurgery'], $this->value);
    }
}