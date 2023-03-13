<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

class ProviderType
{
    private $type;

    public function __construct($provider_type)
    {
        switch ($provider_type)
        {
            case 'Dentist':
            case 'Hygienist':
                $this->type = $provider_type;
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

    public function isDentist()
    {
        return $this->type === 'Dentist';
    }

    public function isHygienist()
    {
        return $this->type === 'Hygienist';
    }
}