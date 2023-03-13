<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

class PatientMessageType
{
    private $type;

    public function __construct($patient_message_type)
    {
        switch ($patient_message_type)
        {
            case 'Sms':
            case 'Email':
                $this->type = $patient_message_type;
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

    public function isSms()
    {
        return $this->type === 'Sms';
    }

    public function isEmail()
    {
        return $this->type === 'Email';
    }
}