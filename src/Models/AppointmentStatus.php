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
            case 'Booked':
            case 'Arrived':
            case 'Complete':
            case 'FailedToAttend':
            case 'Seated':
            case 'Confirmed':
            case 'Cancelled':
            case 'Rebooked':
            case 'ReturnedToWaitingRoom':
            case 'Reseated':
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
        return $this->value === 'Complete';
    }

    public function isInSurgery()
    {
        return in_array(['Arrived', 'Seated', 'ReturnedToWaitingRoom', 'Reseated'], $this->value);
    }
}