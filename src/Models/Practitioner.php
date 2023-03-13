<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;
use \ArrayAccess;

class Practitioner implements ArrayAccess
{
    private $id;
    private $role;
    private $userName;
    private $name;
    private $isActive;    

    public function __construct($p)
    {
        isset($p->id) && $this->id = $p->id;
        isset($p->role) && $this->role = $p->role;
        isset($p->userName) && $this->userName = $p->userName;
        isset($p->name) && $this->name = $p->name;
        isset($p->isActive) && $this->isActive = $p->isActive;
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
            'role' => $this->role, 
            'userName' => $this->userName, 
            'name' => $this->name, 
            'isActive' => $this->isActive, 
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function geRole()
    {
        return $this->role;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }    
}