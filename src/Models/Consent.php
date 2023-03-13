<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

class Consent
{
    private $value;

    public function __construct($consent)
    {
        switch ($consent)
        {
            case 'NotAsked':
            case 'Consented':
            case 'Refused':
                $this->value = $consent;
                break;
            default:
                $this->value = 'NotAsked';
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

    public function hasConsented()
    {
        return $this->type === 'Consented';
    }
}