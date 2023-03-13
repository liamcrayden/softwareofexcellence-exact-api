<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

use Crayden\SoftwareOfExcellenceExactAPI\Models\PayorType;
use \ArrayAccess;

class Payor implements ArrayAccess
{
    private $id;
    private $payorType;
    private $name;
    private $displayName;
    private $isActive;    

    public function __construct($payor)
    {
        isset($payor->id) && $this->id = $payor->id;
        isset($payor->payorType) && $this->payorType = new PayorType($payor->payorType);
        isset($payor->name) && $this->name = $payor->name;
        isset($payor->displayName) && $this->displayName = $payor->displayName;
        isset($payor->isActive) && $this->isActive = $payor->isActive;
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
            'id' => $this->id, 
            'payorType' => $this->payorType, 
            'name' => $this->name, 
            'displayName' => $this->displayName, 
            'isActive' => $this->isActive, 
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPayorType()
    {
        return $this->payorType;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDisplayName()
    {
        return $this->displayName;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }    
}