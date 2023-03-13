<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

class Sex
{
    private $sex;

    public function __construct($sex)
    {
        switch ($sex)
        {
            case 'Unspecified':
            case 'Male':
            case 'Female':
            case 'Other':
                $this->sex = $sex;
                break;
            default:
                $this->sex = 'Unspecified';
                break;
        }
    }
    
    public function __toString()
    {
        return $this->sex;
    }
    
    public function getSex()
    {
        return $this->sex;
    }
}